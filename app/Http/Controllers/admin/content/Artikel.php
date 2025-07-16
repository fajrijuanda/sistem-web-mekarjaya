<?php

namespace App\Http\Controllers\admin\content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon; 
use Illuminate\Support\Str;// Import Carbon untuk parsing tanggal

class Artikel extends Controller
{
    private $jsonPath = 'assets/json/data-artikel.json'; // Path relative to public directory

    /**
     * Load article data from JSON file.
     * @return array
     */
    private function loadArticleData()
    {
        $fullPath = public_path($this->jsonPath);
        if (File::exists($fullPath)) {
            $jsonContent = File::get($fullPath);
            return json_decode($jsonContent, true);
        }
        return ['data' => []]; // Return array with empty 'data' key if file not found
    }

    /**
     * Helper function to find an article by slug from JSON.
     * @param string $slug
     * @return object|null
     */
    private function findArticleBySlug($slug)
    {
        $articlesData = $this->loadArticleData();
        if (isset($articlesData['data']) && is_array($articlesData['data'])) {
            foreach ($articlesData['data'] as $item) {
                if (isset($item['slug']) && $item['slug'] === $slug) {
                    $article = (object) $item;

                    // Tambahkan 'thumbnail_url' jika menggunakan 'gambar_unggulan'
                    if (isset($article->gambar_unggulan) && $article->gambar_unggulan) {
                        $article->thumbnail_url = asset('assets/img/artikel/' . $article->gambar_unggulan);
                    } else {
                        // Placeholder image jika tidak ada gambar unggulan
                        $article->thumbnail_url = 'https://placehold.co/800x450/cccccc/ffffff?text=No+Image';
                    }

                    // Ubah format tanggal_terbit agar kompatibel dengan Carbon
                    if (isset($article->tanggal_terbit)) {
                        try {
                            // Set locale untuk Carbon agar bisa parsing nama bulan Indonesia
                            Carbon::setLocale('id');
                            $parsedDate = Carbon::parse($article->tanggal_terbit);
                            $article->published_at_carbon = $parsedDate; // Simpan objek Carbon
                            $article->published_at_formatted = $parsedDate->translatedFormat('d F Y'); // Format untuk tampilan
                        } catch (\Exception $e) {
                            $article->published_at_carbon = null;
                            $article->published_at_formatted = $article->tanggal_terbit; // Tetap gunakan string asli jika gagal parsing
                        }
                    } else {
                        $article->published_at_carbon = null;
                        $article->published_at_formatted = null;
                    }

                    // Siapkan preview konten
                    $article->preview_content = $this->getArticlePreview($article->content, 200); // Batasi 200 karakter

                    return $article;
                }
            }
        }
        return null;
    }

    /**
     * Get a truncated and stripped version of the article content for preview.
     * @param string $htmlContent
     * @param int $limit
     * @return string
     */
    private function getArticlePreview($htmlContent, $limit = 200)
    {
        $text = strip_tags($htmlContent); // Hapus semua tag HTML
        return Str::limit($text, $limit, '...'); // Batasi panjang teks
    }


    /**
     * Display the admin view of the article list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageConfigs = ['myLayout' => 'horizontal'];
        $articles = $this->loadArticleData()['data'];
        return view('content.admin.contents.pages.artikel', [
            'pageConfigs' => $pageConfigs,
            'articles' => $articles
        ]);
    }

    /**
     * Display the public view of the article list.
     * Accessible by anyone (guest or logged-in users).
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function publicIndex(Request $request)
    {
        $pageConfigs = ['myLayout' => 'front'];

        $articlesData = $this->loadArticleData()['data'];

        // Filter hanya artikel yang Published
        $publishedArticles = collect($articlesData)->filter(function ($article) {
            return isset($article['status']) && $article['status'] === 'Published';
        })->map(function ($article) {
            // Map each article to include Carbon object for sorting and formatted date
            $articleObj = (object) $article;
            if (isset($articleObj->tanggal_terbit)) {
                try {
                    Carbon::setLocale('id');
                    $articleObj->published_at_carbon = Carbon::parse($articleObj->tanggal_terbit);
                    $articleObj->published_at_formatted = $articleObj->published_at_carbon->translatedFormat('d F Y');
                } catch (\Exception $e) {
                    $articleObj->published_at_carbon = null;
                    $articleObj->published_at_formatted = $articleObj->tanggal_terbit;
                }
            } else {
                $articleObj->published_at_carbon = null;
                $articleObj->published_at_formatted = null;
            }

            if (isset($articleObj->gambar_unggulan) && $articleObj->gambar_unggulan) {
                $articleObj->thumbnail_url = asset('assets/img/artikel/' . $articleObj->gambar_unggulan);
            } else {
                $articleObj->thumbnail_url = 'https://placehold.co/800x450/cccccc/ffffff?text=No+Image';
            }

            $articleObj->preview_content = $this->getArticlePreview($articleObj->content, 200);

            return $articleObj;
        });

        // Ambil kategori unik dan tahun unik dari artikel yang sudah dipublikasi
        $uniqueCategories = $publishedArticles->pluck('kategori')->unique()->sort()->values()->all();
        $uniqueYears = $publishedArticles->pluck('published_at_carbon')
            ->filter() // Filter out null dates
            ->map(function ($date) {
                return $date->year; })
            ->unique()
            ->sortDesc() // Urutkan tahun dari terbaru ke terlama
            ->values()
            ->all();

        // Terapkan Filter
        $sortBy = $request->query('sort_by', 'newest'); // default: newest
        $filterYear = $request->query('year', 'all'); // default: all years
        $filterCategory = $request->query('category', 'all'); // default: all categories

        $filteredArticles = $publishedArticles->filter(function ($article) use ($filterYear, $filterCategory) {
            $matchYear = true;
            $matchCategory = true;

            if ($filterYear !== 'all' && $article->published_at_carbon) {
                $matchYear = ($article->published_at_carbon->year == $filterYear);
            }

            if ($filterCategory !== 'all') {
                $matchCategory = ($article->kategori === $filterCategory);
            }

            return $matchYear && $matchCategory;
        });

        // Terapkan Sorting
        if ($sortBy === 'oldest') {
            $filteredArticles = $filteredArticles->sortBy(function ($article) {
                return $article->published_at_carbon ? $article->published_at_carbon->timestamp : PHP_INT_MAX; // Taruh null di akhir
            })->values();
        } else { // newest (default)
            $filteredArticles = $filteredArticles->sortByDesc(function ($article) {
                return $article->published_at_carbon ? $article->published_at_carbon->timestamp : PHP_INT_MIN; // Taruh null di akhir
            })->values();
        }

        return view('content.public.pages.artikel-list', [
            'pageConfigs' => $pageConfigs,
            'articles' => $filteredArticles,
            'uniqueCategories' => $uniqueCategories,
            'uniqueYears' => $uniqueYears,
            'currentSortBy' => $sortBy,
            'currentYear' => $filterYear,
            'currentCategory' => $filterCategory,
        ]);
    }

    /**
     * Display the public view of a single article.
     * Accessible by anyone (guest or logged-in users).
     *
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function publicShow($slug)
    {
        $pageConfigs = ['myLayout' => 'front'];
        $article = $this->findArticleBySlug($slug);

        if (!$article) {
            abort(404, 'Artikel tidak ditemukan.');
        }

        return view('content.public.pages.artikel-detail', compact('article', 'pageConfigs'));
    }

    // create (admin)
    public function create()
    {
        $pageConfigs = ['myLayout' => 'horizontal'];
        return view('content.admin.contents.pages.create-artikel-2', ['pageConfigs' => $pageConfigs]);
    }

    // show (admin view detail artikel)
    public function show($slug)
    {
        $pageConfigs = ['myLayout' => 'horizontal'];
        $article = $this->findArticleBySlug($slug);

        if (!$article) {
            abort(404, 'Artikel tidak ditemukan.');
        }

        return view('content.admin.contents.pages.artikel-view', compact('article', 'pageConfigs'));
    }

    // edit (admin)
    public function edit($slug)
    {
        $pageConfigs = ['myLayout' => 'horizontal'];
        $article = $this->findArticleBySlug($slug);

        if (!$article) {
            abort(404, 'Artikel tidak ditemukan untuk diedit.');
        }

        return view('content.admin.contents.pages.artikel-edit', compact('article', 'pageConfigs'));
    }

    // Anda perlu menambahkan fungsi store, update, destroy untuk artikel jika belum ada
    // Contoh:
    /*
    public function store(Request $request)
    {
        // Logic untuk menyimpan artikel baru ke JSON
    }

    public function update(Request $request, $slug)
    {
        // Logic untuk memperbarui artikel di JSON
    }

    public function destroy($slug)
    {
        // Logic untuk menghapus artikel dari JSON
    }
    */
}
