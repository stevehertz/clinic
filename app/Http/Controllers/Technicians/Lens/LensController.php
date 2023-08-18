<?php

namespace App\Http\Controllers\Technicians\Lens;

use App\Http\Controllers\Controller;
use App\Models\Lens;
use App\Models\Technician;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
        $organization = $workshop->organization;
        if ($request->ajax()) {
            $data = $workshop->lens->sortBy('created_at', SORT_DESC);
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('type', function ($row) {
                    $type = $row->lens_type->type;
                    return $type;
                })
                ->addColumn('material', function ($row) {
                    $material = $row->lens_material->title;
                    return $material;
                })
                ->rawColumns(['type', 'material'])
                ->make(true);
        }
        $num_lens = $workshop->lens->count();
        $num_lens_purchase = $workshop->lens_purchase->count();
        $lens_types = $organization->lens_type->sortBy('created_at', SORT_DESC);
        $lens_materials = $organization->lens_material->sortBy('created_at', SORT_DESC);
        $lenses = $workshop->lens->sortBy('created_at', SORT_DESC);
        $vendors = $organization->vendor->sortBy('created_at', SORT_DESC);
        $num_lens_transfer_from = $workshop->lens_transfer->count();
        $transfer_workshops = $organization->workshop->where('id', '!=', $workshop->id);
        $page_title = trans('pages.technicians.inventory.title');
        $lens_pages = trans('pages.technicians.inventory.lens');
        return view('technicians.lens.index', [
            'page_title' => $page_title,
            'lens_pages' => $lens_pages,
            'num_lens' => $num_lens,
            'num_lens_purchase' => $num_lens_purchase,
            'types' => $lens_types,
            'materials' => $lens_materials,
            'lenses' => $lenses,
            'vendors' => $vendors,
            'num_lens_transfer_from' => $num_lens_transfer_from,
            'transfer_workshops' => $transfer_workshops,
        ]);
    }

    public function show($id)
    {
        # code...
        $lens = Lens::findOrFail($id);
        $response['status'] = true;
        $response['data'] = $lens;
        return response()->json($response);
    }

    public function update(Request $request, $id)
    {
        # code...
        $data = $request->except("_token");

        $validator = Validator::make($data, [
            'power' => 'required',
            'lens_type_id' => 'required|integer|exists:lens_types,id',
            'lens_material_id' => 'required|integer|exists:lens_materials,id',
            'lens_index' => 'required',
            'eye' => 'required|string'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 401);
        }

        $lens = Lens::findOrFail($id);

        $lens->update([
            'power' => $data['power'],
            'lens_type_id' => $data['lens_type_id'],
            'lens_material_id' => $data['lens_material_id'],
            'lens_index' => $data['lens_index'],
            'eye' => $data['eye'],
        ]);

        $response['status'] = true;
        $response['message'] = "You have successfully updated lens details";

        return response()->json($response);
    }
}
