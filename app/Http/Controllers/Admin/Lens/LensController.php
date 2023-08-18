<?php

namespace App\Http\Controllers\Admin\Lens;

use App\Http\Controllers\Controller;
use App\Models\Lens;
use App\Models\Workshop;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LensController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        //
        $workshop = Workshop::findOrFail($id);
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
                    $btn = $btn .= ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="delete btn btn-tools btn-sm deleteLensBtn"><i class="fa fa-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action', 'type', 'material'])
                ->make(true);
        }
        $num_lens = $workshop->lens->count();
        $num_lens_purchase = $workshop->lens_purchase->count();
        $num_lens_transfer_from = $workshop->lens_transfer->count();
        $lenses = $workshop->lens->sortBy('created_at', SORT_DESC);
        $organization = $workshop->organization;
        $lens_types = $organization->lens_type->sortBy('created_at', SORT_DESC);
        $lens_materials = $organization->lens_material->sortBy('created_at', SORT_DESC);
        $vendors = $organization->vendor->sortBy('created_at', SORT_DESC);
        $num_lens_request = $workshop->request_lens()->where('status', 'REQUESTED')->count();
        $page_title = "Lenses";
        return view('admin.lens.index', [
            'workshop' => $workshop,
            'page_title' => $page_title,
            'num_lens' => $num_lens,
            'num_lens_purchase' => $num_lens_purchase,
            'num_lens_transfer_from' => $num_lens_transfer_from,
            'types' => $lens_types,
            'materials' => $lens_materials,
            'lenses' => $lenses,
            'vendors' => $vendors,
            'num_lens_request' => $num_lens_request,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->except("_token");

        $validator = Validator::make($data, [
            'workshop_id' => 'required|integer|exists:workshops,id',
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

        $workshop = Workshop::findOrFail($data['workshop_id']);

        $opening = $data['opening'];

        $purchased = 0;

        $transfered = 0;

        $total = ($opening + $purchased) - $transfered;

        $sold = 0;

        $closing = $total - $sold;

        $code = $workshop->initials . "-" . Str::upper(Str::random(5));

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


    /**
     * Import a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request)
    {
        $data = $request->except('_token');

        $validator = Validator::make($data, []);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        $data = $request->except("_token");

        $validator = Validator::make($data, [
            'lens_id' => 'required|integer|exists:lenses,id'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 401);
        }

        $lens = Lens::findOrFail($data['lens_id']);

        $response = [
            'status' => true,
            'data' => $lens
        ];

        return response()->json($response, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $data = $request->except("_token");

        $validator = Validator::make($data, [
            'lens_id' => 'required|integer|exists:lenses,id',
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

        $lens = Lens::findOrFail($data['lens_id']);

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $data = $request->except("_token");

        $validator = Validator::make($data, [
            'lens_id' => 'required|integer|exists:lenses,id'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 401);
        }

        $lens = Lens::findOrFail($data['lens_id']);
        $lens->delete();
        $response['status'] = true;
        $response['message'] = "You have successfully deleted lens from stock";
        return response()->json($response);
    }
}
