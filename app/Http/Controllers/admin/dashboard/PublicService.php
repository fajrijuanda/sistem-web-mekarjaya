<?php

namespace App\Http\Controllers\admin\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PublicService extends Controller
{
    public function index()
    {

        $pageConfigs = ['myLayout' => 'horizontal'];

        return view('content.admin.dashboard.services.admin-dashboard-services', ['pageConfigs' => $pageConfigs]);
    }
}
