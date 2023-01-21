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
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Update" class="update btn btn-tools btn-sm updateLensBtn"><i class="fa fa-edit"></i></a>';
                    $btn = $btn .= ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="delete btn btn-tools btn-sm deleteTechnicianBtn"><i class="fa fa-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['type', 'material', 'action'])
                ->make(true);
        }
        $num_lens = $workshop->lens->count();
        $lens_types = $organization->lens_type->sortBy('created_at', SORT_DESC);
        $lens_materials = $organization->lens_material->sortBy('created_at', SORT_DESC);
        $page_title = "Lens";
        return view('technicians.lens.index', [
            'page_title' => $page_title,
            'num_lens' => $num_lens,
            'types' => $lens_types,
            'materials' => $lens_materials,
        ]);
    }

    public function store(Request $request)
    {
        # code...
        $data = $request->except("_token");

        $validator = Validator::make($data, [
            'power' => 'required',
            'lens_type_id' => 'required|integer|exists:lens_types,id',
            'lens_material_id' => 'required|integer|exists:lens_materials,id',
            'lens_index' => 'required',
            'eye' => 'required|string',
            'opening' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 401);
        }

        $technician = Technician::findOrFail(Auth::guard('technician')->user()->id);

        $workshop = $technician->workshop;

        $opening = $data['opening'];

        $purchased = 0;

        $transfered = 0;

        $total = ($opening + $purchased) - $transfered;

        $sold = 0;

        $closing = $total - $sold;

        $num_lens = $workshop->lens->count();

        $code = $workshop->initials . "-" . Str::upper(Str::random(2));

        $workshop->lens()->create([
            'organization_id' => $workshop->organization->id,
            'power' => $data['power'],
            'code' => $code,
            'lens_type_id' => $data['lens_type_id'],
            'lens_material_id' => $data['lens_material_id'],
            'lens_index' => $data['lens_index'],
            'date_added' => Carbon::now()->format('Y-m-d'),
            'eye' => $data['eye'],
            'opening' => $opening,
            'purchased' => $purchased,
            'transfered' => $transfered,
            'total' => $total,
            'sold' => $sold,
            'closing' => $closing,
        ]);

        $response['status'] = true;
        $response['message'] = "New Lens Has Been Added To Stocks";

        return response()->json($response);
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

    public function destroy($id)
    {
        # code...
        $lens = Lens::findOrFail($id);
        $lens->delete();
        $response['status'] = true;
        $response['message'] = "You have successfully deleted lens from stock";
        return response()->json($response);
    }
}
