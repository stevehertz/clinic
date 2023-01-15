<?php

namespace App\Http\Controllers\Technicians\Technicians;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TechniciansController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:technician');   
    }

    public function index()
    {
        # code...
    }

    public function logout()
    {
        # code...
        Auth::guard('technician')->logout();
        return redirect()->route('technicians.login');
    }
}
