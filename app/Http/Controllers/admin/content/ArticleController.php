<?php

namespace App\Http\Controllers\admin\content;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User; // Pastikan model User diimpor
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ArticleController extends Controller
{
    /**
     * Menampilkan daftar artikel di halaman admin (DataTables).
     */
    public function index(Request $request)
    {
        if (!$request->ajax()) {
            $stats = [
                'total' => Article::count(),
                'published' => Article::where('status', 'Published')->count(),
                'draft' => Article::where('status', 'Draft')->count(),
                'total_views' => Article::sum('views'),
            ];
            $pageConfigs = ['myLayout' => 'horizontal'];
            return view('content.admin.contents.pages.article-list', compact('pageConfigs', 'stats'));
        }

        $query = Article::with('user')->select('articles.*'); // Eager load relasi user

        // Handle pencarian
        if ($search = $request->input('search.value')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('category', 'LIKE', "%{$search}%")
                    ->orWhere('status', 'LIKE', "%{$search}%")
                    ->orWhereHas('user', function ($subQuery) use ($search) {
                        $subQuery->where('name', 'LIKE', "%{$search}%");
                    });
            });
        }

        $totalFiltered = $query->count();
        $totalData = Article::count();

        // Handle sorting & pagination
        $orderColumn = $request->input('order.0.column');
        $orderDir = $request->input('order.0.dir', 'desc');
        $columns = [1 => 'title', 2 => 'category', 3 => 'user_id', 4 => 'published_date', 5 => 'status'];
        $order = $columns[$orderColumn] ?? 'published_date';

        $articles = $query->offset($request->input('start'))
            ->limit($request->input('length'))
            ->orderBy($order, $orderDir)
            ->get();

        $data = [];
        foreach ($articles as $article) {
            $nestedData = [];
            $nestedData['title'] = $article->title;
            $nestedData['slug'] = $article->slug;
            $nestedData['category'] = $article->category;
            $nestedData['penulis'] = $article->user->name ?? 'N/A';
            $nestedData['status'] = $article->status;
            $nestedData['thumbnail'] = $article->thumbnail; // Nama file mentah
            $nestedData['avatar_penulis'] = $article->user->avatar_url; // Dari accessor di model User
            $nestedData['published_date'] = $article->formatted_published_date; // Dari accessor
            $nestedData['thumbnail_url'] = $article->thumbnail_url; // Dari accessor
            $data[] = $nestedData;
        }

        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => intval($totalData),
            'recordsFiltered' => intval($totalFiltered),
            'data' => $data,
        ]);
    }

    /**
     * Menampilkan daftar artikel di halaman publik.
     */
    public function publicIndex(Request $request)
    {
        $query = Article::with('user')->where('status', 'Published');

        // Filter berdasarkan Kategori
        if ($category = $request->query('category', 'all')) {
            if ($category !== 'all') {
                $query->where('category', $category);
            }
        }

        // Filter berdasarkan Tahun
        if ($year = $request->query('year', 'all')) {
            if ($year !== 'all') {
                $query->whereYear('published_date', $year);
            }
        }

        // Sorting
        $sortBy = $request->query('sort_by', 'newest');
        $query->orderBy('published_date', $sortBy === 'oldest' ? 'asc' : 'desc');

        $articles = $query->paginate(9); // Menggunakan pagination bawaan Laravel

        // Ambil data untuk dropdown filter
        $uniqueCategories = Article::where('status', 'Published')->distinct()->pluck('category')->sort();
        // ✅ KODE PERBAIKAN (Berfungsi di semua database)
        $publishedDates = Article::where('status', 'Published')
            ->whereNotNull('published_date') // Ambil tanggal yang tidak null
            ->pluck('published_date');     // Ambil koleksi objek Carbon

        $uniqueYears = $publishedDates->map(function ($date) {
            return $date->year; // Gunakan atribut 'year' dari Carbon
        })->unique()->sortDesc()->values();

        return view('content.public.pages.article-list', [
            'pageConfigs' => ['myLayout' => 'front'],
            'articles' => $articles,
            'uniqueCategories' => $uniqueCategories,
            'uniqueYears' => $uniqueYears,
            'currentCategory' => $category,
            'currentYear' => $year,
            'currentSortBy' => $sortBy,
        ]);
    }

    /**
     * Menampilkan detail artikel di halaman publik.
     */
    public function publicShow(Article $article) // Pastikan menggunakan Route Model Binding
    {
        // ✅ TAMBAHKAN LOGIKA PENGHITUNG VIEW
        $viewed = session()->get('viewed_articles', []);
        if (!in_array($article->id, $viewed)) {
            // Gunakan increment untuk performa yang lebih baik
            $article->increment('views');
            // Simpan ID artikel ke session agar tidak dihitung lagi
            session()->push('viewed_articles', $article->id);
        }

        return view('content.public.pages.article-show', [
            'pageConfigs' => ['myLayout' => 'front'],
            'article' => $article,
        ]);
    }


    /**
     * Menampilkan detail artikel di halaman admin.
     */
    public function show(Article $article) // Gunakan Route Model Binding
    {
        $viewed = session()->get('viewed_articles', []);
        if (!in_array($article->id, $viewed)) {
            // Gunakan increment untuk performa yang lebih baik
            $article->increment('views');
            // Simpan ID artikel ke session agar tidak dihitung lagi
            session()->push('viewed_articles', $article->id);
        }

        return view('content.admin.contents.pages.article-view', [
            'pageConfigs' => ['myLayout' => 'horizontal'],
            'article' => $article
        ]);
    }

    /**
     * Menampilkan form untuk membuat artikel baru.
     */
    public function create(Article $article)
    {

        return view('content.admin.contents.pages.article-form', [
            'pageConfigs' => ['myLayout' => 'horizontal'],
            'article' => $article
        ]);
    }

    /**
     * Menyimpan artikel baru ke database.
     * Diperbarui untuk menangani request AJAX.
     */
    public function store(Request $request): JsonResponse
    {
        // Validator::make() digunakan agar kita bisa mengontrol response error secara manual
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'title' => 'required|string|max:255|unique:articles,title',
            'content' => 'required|string|min:20', // Beri validasi minimal agar tidak kosong
            'category' => 'required|string',
            'status' => 'required|in:Published,Draft',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Jika validasi gagal, kembalikan response JSON dengan status 422
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Data yang diberikan tidak valid.',
                'errors' => $validator->errors()
            ], 422);
        }

        $validatedData = $validator->validated();
        $imagePath = null;

        DB::beginTransaction();

        try {
            if ($request->hasFile('thumbnail')) {
                $imagePath = $request->file('thumbnail')->store('public/articles');
            }

            $baseSlug = Str::slug($validatedData['title'], '-');
            $slug = $baseSlug;
            $counter = 2;
            while (Article::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter++;
            }

            Article::create([
                'title' => $validatedData['title'],
                'slug' => $slug,
                'content' => $validatedData['content'],
                'category' => $validatedData['category'],
                'status' => $validatedData['status'],
                'user_id' => Auth::id(),
                'published_date' => ($validatedData['status'] === 'Published') ? now() : null,
                'thumbnail' => $imagePath ? basename($imagePath) : null,
            ]);

            DB::commit();

            // ✅ SAAT SUKSES: Kembalikan response JSON dengan URL untuk redirect
            return response()->json([
                'success' => true,
                'message' => 'Artikel berhasil disimpan!',
                'redirect_url' => route('admin.article.index')
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            if ($imagePath) {
                Storage::delete($imagePath);
            }

            // ✅ SAAT GAGAL: Kembalikan response JSON dengan status 500
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan pada server: ' . $e->getMessage()
            ], 500);
        }
    }


    /**
     * Meng-handle upload gambar dari editor (Quill/TinyMCE).
     */
    public function uploadEditorImage(Request $request): JsonResponse
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = $request->file('image')->store('public/articles/content');
        $url = Storage::url($path);

        return response()->json(['location' => $url]);
    }

    /**
     * Menampilkan form untuk mengedit artikel.
     */
    public function edit($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        return view('content.admin.contents.pages.article-form', [
            'pageConfigs' => ['myLayout' => 'horizontal'],
            'article' => $article
        ]);
    }


    /**
     * ✅ FUNGSI BARU: Memproses pembaruan artikel yang ada.
     */
    public function update(Request $request, $slug): JsonResponse
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        // Validasi, pastikan judul unik kecuali untuk artikel ini sendiri
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255', Rule::unique('articles')->ignore($article->getKey())],
            'content' => ['required', 'string', 'min:20'],
            'category' => ['required', 'string'],
            'status' => ['required', 'in:Published,Draft'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Data tidak valid.', 'errors' => $validator->errors()], 422);
        }

        $validatedData = $validator->validated();

        DB::beginTransaction();
        try {
            // Handle upload thumbnail baru jika ada
            if ($request->hasFile('thumbnail')) {
                // Hapus thumbnail lama jika ada
                if (!empty($article->thumbnail)) {
                    Storage::disk('public')->delete('articles/' . $article->thumbnail);
                }
                // Simpan thumbnail baru dan perbarui path-nya
                $path = $request->file('thumbnail')->store('articles', 'public');
                $validatedData['thumbnail'] = basename($path);
            }

            // Generate slug baru jika judul berubah
            if ($validatedData['title'] !== $article->title) {
                $baseSlug = Str::slug($validatedData['title'], '-');
                $slugNew = $baseSlug;
                $counter = 2;
                while (Article::where('slug', $slugNew)->where('id', '!=', $article->getKey())->exists()) {
                    $slugNew = $baseSlug . '-' . $counter++;
                }
                $validatedData['slug'] = $slugNew;
            }

            // Atur ulang tanggal publikasi jika status diubah menjadi "Published"
            if ($validatedData['status'] === 'Published' && is_null($article->published_date)) {
                $validatedData['published_date'] = now();
            }

            // Update data artikel
            $article->update($validatedData);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Artikel berhasil diperbarui!',
                'redirect_url' => route('admin.article.index')
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan pada server: ' . $e->getMessage()], 500);
        }
    }


    public function destroy($slug): JsonResponse
    {
        $article = Article::where('slug', $slug)->first();

        if (!$article) {
            return response()->json(['success' => false, 'message' => 'Artikel tidak ditemukan.'], 404);
        }

        // Hapus file thumbnail jika ada
        if (!empty($article->thumbnail)) {
            Storage::delete('public/articles/' . $article->thumbnail);
        }

        $article->delete();

        return response()->json(['success' => true, 'message' => 'Artikel berhasil dihapus.']);
    }
}