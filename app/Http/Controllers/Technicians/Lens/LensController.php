<?php

namespace App\Http\Controllers\Technicians\Lens;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LensController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:technician');   
    }

    public function index(Request $request)
    {
        # code...
        $page_title = "Lens";
        return view('technicians.lens.index', [
            'page_title' => $page_title,
        ]);
    }

    public function store(Request $request)
    {
        # code...
    }

    public function show($id    )
    {
        # code...
    }
}
