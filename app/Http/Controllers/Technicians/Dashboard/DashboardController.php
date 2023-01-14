<?php

namespace App\Http\Controllers\Technicians\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:technician');   
    }

    public function index()
    {
        # code...
        $page_title = "Dashboard";
        return view('technicians.dashboard.index', [
            'page_title' => $page_title
        ]);
    }
}
