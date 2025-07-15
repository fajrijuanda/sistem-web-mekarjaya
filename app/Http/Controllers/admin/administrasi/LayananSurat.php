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
}
