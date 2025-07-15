<?php

namespace App\Http\Controllers\admin\administrasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArsipDokumen extends Controller
{
    public function index()
    {

        $pageConfigs = ['myLayout' => 'horizontal'];

        return view('content.admin.services.pages.arsip-dokumen', ['pageConfigs' => $pageConfigs]);
    }
}
