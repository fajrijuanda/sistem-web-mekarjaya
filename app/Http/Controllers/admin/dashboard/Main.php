<?php

namespace App\Http\Controllers\admin\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Main extends Controller
{
    public function index()
    {

        $pageConfigs = ['myLayout' => 'horizontal'];

        return view('content.admin.dashboard.main-dashboard', ['pageConfigs' => $pageConfigs]);
    }
}
