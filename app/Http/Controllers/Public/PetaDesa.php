<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PetaDesa extends Controller
{
    public function index()
    {
        // Kirim data yang dibutuhkan ke view
        return view('content.public.pages.peta-desa', [
            'pageConfigs' => ['myLayout' => 'front']
        ]);
    }
}
