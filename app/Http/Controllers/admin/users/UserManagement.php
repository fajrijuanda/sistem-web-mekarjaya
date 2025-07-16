<?php

namespace App\Http\Controllers\admin\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserManagement extends Controller
{
  /**
   * Redirect to user-management view.
   *
   */
  public function UserManagement()
  {
    // dd('UserManagement');
    $users = User::all();
    $userCount = $users->count();
    $verified = User::whereNotNull('email_verified_at')->get()->count();
    $notVerified = User::whereNull('email_verified_at')->get()->count();
    $usersUnique = $users->unique(['email']);
    $userDuplicates = $users->diff($usersUnique)->count();
    $pageConfigs = ['myLayout' => 'horizontal'];
    return view('content.admin.users.user-management', [
      'totalUser' => $userCount,
      'verified' => $verified,
      'notVerified' => $notVerified,
      'userDuplicates' => $userDuplicates,
      'pageConfigs' => $pageConfigs
    ]);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $columns = [
      1 => 'id',
      2 => 'name',
      3 => 'email',
      4 => 'email_verified_at',
      5 => 'role', // Tambahkan kolom role
    ];

    $search = [];

    $totalData = User::count();

    $totalFiltered = $totalData;

    $limit = $request->input('length');
    $start = $request->input('start');
    $order = $columns[$request->input('order.0.column')];
    $dir = $request->input('order.0.dir');

    if (empty($request->input('search.value'))) {
      $users = User::offset($start)
        ->limit($limit)
        ->orderBy($order, $dir)
        ->get();
    } else {
      $search = $request->input('search.value');

      $users = User::where('id', 'LIKE', "%{$search}%")
        ->orWhere('name', 'LIKE', "%{$search}%")
        ->orWhere('email', 'LIKE', "%{$search}%")
        ->orWhere('role', 'LIKE', "%{$search}%") // Tambahkan pencarian berdasarkan role
        ->offset($start)
        ->limit($limit)
        ->orderBy($order, $dir)
        ->get();

      $totalFiltered = User::where('id', 'LIKE', "%{$search}%")
        ->orWhere('name', 'LIKE', "%{$search}%")
        ->orWhere('email', 'LIKE', "%{$search}%")
        ->orWhere('role', 'LIKE', "%{$search}%") // Tambahkan pencarian berdasarkan role
        ->count();
    }

    $data = [];

    if (!empty($users)) {
      // providing a dummy id instead of database ids
      $ids = $start;

      foreach ($users as $user) {
        $nestedData['id'] = $user->id;
        $nestedData['fake_id'] = ++$ids;
        $nestedData['name'] = $user->name;
        $nestedData['email'] = $user->email;
        $nestedData['email_verified_at'] = $user->email_verified_at;
        $nestedData['role'] = $user->role; // Tambahkan data role

        $data[] = $nestedData;
      }
    }

    if ($data) {
      return response()->json([
        'draw' => intval($request->input('draw')),
        'recordsTotal' => intval($totalData),
        'recordsFiltered' => intval($totalFiltered),
        'code' => 200,
        'data' => $data,
      ]);
    } else {
      return response()->json([
        'message' => 'Internal Server Error',
        'code' => 500,
        'data' => [],
      ]);
    }
  }
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    try {
      $userID = $request->id;

      if ($userID) {
        // Logika update - jika Anda menggunakan updateOrCreate di sini,
        // pastikan semua field relevan di-handle.
        $users = User::updateOrCreate(
          ['id' => $userID],
          [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role // Memastikan role juga terupdate
          ]
        );
        return response()->json('Updated');
      } else {
        // Validasi input untuk pembuatan user baru
        $request->validate([
          'name' => 'required|string|max:255',
          'email' => 'required|email|max:255|unique:users,email',
          'role' => 'required|string|in:superadmin,admin-pelayanan,admin-konten',
        ]);

        // Ambil nilai profile_photo_path dari request, atau gunakan default
        $profilePhotoPath = $request->input('profile_photo_path', 'avatars/1.png');

        // Buat user baru dengan password default, email_verified_at, dan profile_photo_path
        $users = User::create(
          [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('password123'), // Password default yang di-hash
            'role' => $request->role, // Role dari input form
            'email_verified_at' => Carbon::now(), // Mengisi dengan timestamp saat ini
            'profile_photo_path' => $profilePhotoPath // Mengisi path foto profil
          ]
        );

        return response()->json('Created');
      }
    } catch (ValidationException $e) {
      return response()->json(['errors' => $e->errors()], 422);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Failed to create user', 'error' => $e->getMessage()], 500);
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  // public function show($id)
  // {
  //   //
  // }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id): JsonResponse
  {
    $user = User::findOrFail($id);
    return response()->json($user);
  }

  public function update(Request $request, $id)
  {
    try {
      // Validasi input
      $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $id,
        'role' => 'required|string|in:superadmin,admin-pelayanan,admin-konten', // Sesuaikan dengan roles yang valid
        // 'password' => 'nullable|string|min:8|confirmed', // Jika mengizinkan update password
      ]);

      // Cari user berdasarkan ID
      $user = User::find($id);

      // Cek apakah user ditemukan
      if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
      }

      // Perbarui atribut user
      $user->name = $request->name;
      $user->email = $request->email;
      $user->role = $request->role; // Tambahkan pembaruan role

      // Jika Anda memiliki field password di form update, tangani di sini
      // if ($request->filled('password')) {
      //     $user->password = Hash::make($request->password);
      // }

      // Simpan perubahan
      $user->save();

      return response()->json(['message' => 'User updated successfully'], 200);

    } catch (ValidationException $e) {
      // Tangani error validasi
      return response()->json(['errors' => $e->errors()], 422);
    } catch (\Exception $e) {
      // Tangani error lainnya (misalnya error database)
      return response()->json(['message' => 'Failed to update user', 'error' => $e->getMessage()], 500);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    try {
      // Temukan pengguna berdasarkan ID
      $user = User::find($id);

      // Cek apakah pengguna ditemukan
      if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
      }

      // Hapus pengguna
      $user->delete();

      // Berikan respons sukses
      return response()->json(['message' => 'User deleted successfully'], 200);

    } catch (\Exception $e) {
      // Tangani kesalahan jika terjadi masalah saat menghapus
      return response()->json(['message' => 'Failed to delete user', 'error' => $e->getMessage()], 500);
    }
  }
}
