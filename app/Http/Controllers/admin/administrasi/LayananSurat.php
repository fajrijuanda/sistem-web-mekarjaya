<?php

namespace App\Http\Controllers\admin\administrasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LayananSurat extends Controller
{
    public function index()
    {

        $pageConfigs = ['myLayout' => 'horizontal'];

        return view('content.admin.services.pages.layanan-surat', ['pageConfigs' => $pageConfigs]);
    }

    public function publicIndex()
    {
        $pageConfigs = ['myLayout' => 'front']; // Asumsi layout publik berbeda atau tanpa sidebar

        return view('content.public.pages.layanan-surat', ['pageConfigs' => $pageConfigs]);
    }
}
