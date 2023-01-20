<?php

namespace App\Http\Controllers\Technicians\Lens;

use App\Http\Controllers\Controller;
use App\Models\Technician;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $technician = Technician::findOrFail(Auth::guard('technician')->user()->id);
        $workshop = $technician->workshop;
        if($request->ajax()){
            $data = $workshop->lens->sortBy('created_at', SORT_DESC);
            return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('type', function($row){
                $type = $row->lens_type->type;
                return $type;
            })
            ->addColumn('material', function($row){
                $material = $row->lens_material->title;
                return $material;
            })
            ->addColumn('action', function($row){

            })
            ->rawColumns(['type', 'material', 'action'])
            ->make(true);
        }
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
