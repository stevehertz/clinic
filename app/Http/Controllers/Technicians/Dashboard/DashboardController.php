<?php

namespace App\Http\Controllers\Technicians\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Technician;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $technician = Technician::findOrFail(Auth::guard('technician')->user()->id);
        $workshop = $technician->workshop;
        $page_title = "Dashboard";
        return view('technicians.dashboard.index', [
            'page_title' => $page_title,
            'workshop' => $workshop,
        ]);
    }
}
