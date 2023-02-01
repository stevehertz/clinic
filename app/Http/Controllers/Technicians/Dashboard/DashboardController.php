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
        $orders = $workshop->order->where('status', '!=', 'APPROVED')->sortBy('created_at', SORT_DESC);
        $sum_lenses = $workshop->lens->sum('closing');
        $num_sales = $workshop->workshop_sale->count();
        $page_title = "Dashboard";
        return view('technicians.dashboard.index', [
            'page_title' => $page_title,
            'workshop' => $workshop,
            'orders' => $orders,
            'sum_lenses' => $sum_lenses,
            'num_sales' => $num_sales
        ]);
    }
}
