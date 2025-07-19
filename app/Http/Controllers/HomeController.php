<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the public view of the village profile.
     * Accessible by anyone (guest or logged-in users).
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageConfigs = ['myLayout' => 'front']; // Asumsi layout publik berbeda atau tanpa sidebar

        return view('content.public.pages.home', ['pageConfigs' => $pageConfigs]);
    }
}
