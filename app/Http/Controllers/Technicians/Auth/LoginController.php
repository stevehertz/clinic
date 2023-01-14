<?php

namespace App\Http\Controllers\Technicians\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('guest:technician');   
    }

    public function index()
    {
        # code...
    }
}
