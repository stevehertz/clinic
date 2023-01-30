<?php

namespace App\Http\Controllers\Admin\Frames;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Clinic;
use App\Models\Frame;
use App\Models\FrameBrand;
use App\Models\FrameMaterial;
use App\Models\FrameSize;
use App\Models\FrameType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FramesController extends Controller
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
        $clinic = Clinic::findOrFail($id);
        $organization = $clinic->organization;
        if ($request->ajax()) {
            $data = $clinic->frame->sortBy('created_at', SORT_DESC);
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('brand', function($row){
                    $brand = $row->frame_brand->title;
                    return $brand;
                })
                ->addColumn('size', function($row){
                    $size = $row->frame_size->size;
                    return $size;
                })
                ->addColumn('type', function($row){
                    $type = $row->frame_type->title;
                    return $type;
                })
                ->addColumn('material', function($row){
                    $material = $row->frame_material->title;
                    return $material;
                })
                ->addColumn('photo', function ($row) {
                    $img = '<img src="' . asset('storage/frames/' . $row->photo) . '" alt="' . $row->title . '" class="img-circle img-size-32 mr-2" width="100px">';
                    return $img;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 1) {
                        return '<span class="badge badge-success">Active</span>';
                    } else {
                        return '<span class="badge badge-danger">Inactive</span>';
                    }
                })
                ->addColumn('update', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-tools btn-sm editFrame"><i class="fa fa-edit"></i></a>';
                    return $btn;
                })
                ->addColumn('delete', function($row){
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Delete" class="delete btn btn-tools btn-sm deleteFrame"><i class="fa fa-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['brand', 'size', 'material', 'photo', 'status', 'update', 'delete'])
                ->make(true);
        }
        $patients = $clinic->patient->count();
        $frame_types = $organization->frame_type->sortBy('created_at', SORT_DESC);
        $frame_sizes = $organization->frame_size->sortBy('created_at', SORT_DESC);
        $frame_materials = $organization->frame_material->sortBy('created_at', SORT_DESC);
        $frame_brands = $organization->frame_brand->sortBy('created_at', SORT_DESC);
        $frame_colors = $organization->frame_color->sortBy('created_at', SORT_DESC);
        $frame_shapes = $organization->frame_shape->sortBy('created_at', SORT_DESC);
        $clinic_frames = $clinic->frame->sortBy('created_at', SORT_DESC);
        $num_frames = $clinic->frame->count();
        $num_frame_stocks = $clinic->frame_stock->count(); // number of frame stocks 
        $stocks = $clinic->frame_stock->sortBy('created_at', SORT_DESC); //Load all stocks to get entered stock frame code for purchase
        $transfer_stocks = $clinic->frame_stock->where('closing_stock', '>', 0)->sortBy('created_at', SORT_DESC); // Get the available stocks before transfer
        $transfer_doctors = $clinic->user->sortBy('created_at', SORT_DESC);
        $num_frame_purchases = $clinic->frame_purchase->count(); // num of frame purchases
        // load clinics to transfer to
        $clinics = $organization->clinic->where('id', '!=', $clinic->id)->sortBy('created_at', SORT_DESC);
        // Number of transfered stocks
        $num_transfers = $clinic->frame_transfer_from->count();

        $page_title = 'Frames';
        return view('admin.frames.index', [
            'page_title' => $page_title,
            'clinic' => $clinic,
            'organization' => $organization,
            'patients' => $patients,
            'frame_types' => $frame_types,
            'frame_sizes' => $frame_sizes,
            'frame_materials' => $frame_materials,
            'frame_brands' => $frame_brands,
            'frame_colors' => $frame_colors,
            'frame_shapes' => $frame_shapes,
            'clinic_frames' => $clinic_frames,
            'num_frames' => $num_frames,
            'num_stocks' => $num_frame_stocks,
            'stocks' => $stocks,
            'num_purchases' => $num_frame_purchases,
            'transfer_clinics' => $clinics,
            'transfer_stocks' => $transfer_stocks,
            'transfer_doctors' => $transfer_doctors,
            'num_transfers' => $num_transfers,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function frames(Request $request, $id)
    {
        # code...
        $clinic = Clinic::findOrFail($id);
        $organization = $clinic->organization;
        if ($request->ajax()) {
            $data = $clinic->frame()->join('frame_brands', 'frame_brands.id', '=', 'frames.brand_id')
                ->join('frame_types', 'frame_types.id', '=', 'frames.type_id')
                ->join('frame_sizes', 'frame_sizes.id', '=', 'frames.size_id')
                ->join('frame_materials', 'frame_materials.id', '=', 'frames.material_id')
                ->select('frames.*', 'frame_sizes.size as size', 'frame_brands.title as brand', 'frame_types.title as type', 'frame_materials.title as material')
                ->get();
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('photo', function ($row) {
                    $img = '<img src="' . asset('storage/frames/' . $row->photo) . '" alt="' . $row->title . '" class="img-circle img-size-32 mr-2" width="100px">';
                    return $img;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 1) {
                        return '<span class="badge badge-success">Active</span>';
                    } else {
                        return '<span class="badge badge-danger">Inactive</span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Delete" class="delete btn btn-tools btn-sm deleteFrame"><i class="fa fa-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action', 'photo', 'status'])
                ->make(true);
        }
        $patients = $clinic->patient->count();
        $num_frames = $clinic->frame->count();
        $frame_types = $organization->frame_type->sortBy('created_at', SORT_DESC);
        $frame_sizes = $organization->frame_size->sortBy('created_at', SORT_DESC);
        $frame_materials = $organization->frame_material->sortBy('created_at', SORT_DESC);
        $frame_brands = $organization->frame_brand->sortBy('created_at', SORT_DESC);
        $page_title = 'All Frames';
        return view('admin.frames.frames', [
            'clinic' => $clinic,
            'patients' => $patients,
            'num_frames' => $num_frames,
            'frame_types' => $frame_types,
            'frame_sizes' => $frame_sizes,
            'frame_materials' => $frame_materials,
            'frame_brands' => $frame_brands,
            'page_title' => $page_title,
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
        $data = $request->all();

        $validator = Validator::make($data, [
            'clinic_id' => 'required|integer|exists:clinics,id',
            'code' => 'required|string|unique:frames,code',
            'type_id' => 'required|integer|exists:frame_types,id',
            'brand_id' => 'required|integer|exists:frame_brands,id',
            'size_id' => 'required|integer|exists:frame_sizes,id',
            'material_id' => 'required|integer|exists:frame_materials,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 401);
        }

        if ($request->hasFile('photo')) {
            // file name with extension
            $photoNameWithExt = $request->file('photo')->getClientOriginalName();

            // Get Filename
            $photoName = pathinfo($photoNameWithExt, PATHINFO_FILENAME);

            // Get just Extension
            $extension = $request->file('photo')->getClientOriginalExtension();

            // Filename To store
            $photoNameToStore = $photoName . '_' . time() . '.' . $extension;

            // Upload Image
            $path = $request->file('photo')->storeAs('public/frames', $photoNameToStore);
        } else {
            $photoNameToStore = 'noimage.png';
        }

        $frame_type = FrameType::findOrFail($data['type_id']);

        $frame_brand = FrameBrand::findOrFail($data['brand_id']);

        $frame_size = FrameSize::findOrFail($data['size_id']);

        $frame_material = FrameMaterial::findOrFail($data['material_id']);

        $clinic = Clinic::findOrFail($data['clinic_id']);

        $clinic->frame()->create([
            'brand_id' => $frame_brand->id,
            'type_id' => $frame_type->id,
            'size_id' => $frame_size->id,
            'material_id' => $frame_material->id,
            'code' => $data['code'],
            'photo' => $photoNameToStore,
            'status' => $data['status'],
        ]);

        $response['status'] = true;
        $response['message'] = 'Frame created successfully';
        return response()->json($response, 200);
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
        $data = $request->all();

        $validator = Validator::make($data, [
            'frame_id' => 'required|integer|exists:frames,id',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 401);
        }

        $frame = Frame::findOrFail($data['frame_id']);

        $response['status'] = true;
        $response['data'] = $frame;
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
        $data = $request->all();

        $validator = Validator::make($data, [
            'frame_id' => 'required|integer|exists:frames,id',
            'clinic_id' => 'required|integer|exists:clinics,id',
            'code' => 'required|string|unique:frames,code,' . $data['frame_id'],
            'type_id' => 'required|integer|exists:frame_types,id',
            'brand_id' => 'required|integer|exists:frame_brands,id',
            'size_id' => 'required|integer|exists:frame_sizes,id',
            'material_id' => 'required|integer|exists:frame_materials,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 401);
        }

        if ($request->hasFile('photo')) {
            // file name with extension
            $photoNameWithExt = $request->file('photo')->getClientOriginalName();

            // Get Filename
            $photoName = pathinfo($photoNameWithExt, PATHINFO_FILENAME);

            // Get just Extension
            $extension = $request->file('photo')->getClientOriginalExtension();

            // Filename To store
            $photoNameToStore = $photoName . '_' . time() . '.' . $extension;

            // Upload Image
            $path = $request->file('photo')->storeAs('public/frames', $photoNameToStore);
        }

        $clinic = Clinic::findOrFail($data['clinic_id']);

        $frame = $clinic->frame()->findOrFail($data['frame_id']);

        $frame_type = FrameType::findOrFail($data['type_id']);

        $frame_brand = FrameBrand::findOrFail($data['brand_id']);

        $frame_size = FrameSize::findOrFail($data['size_id']);

        $frame_material = FrameMaterial::findOrFail($data['material_id']);

        if ($request->hasFile('photo')) {
            if ($frame->photo != 'noimage.png') {
                Storage::delete('public/frames/' . $frame->photo);
            }
            $frame->photo = $photoNameToStore;
        }

        $frame->update([
            'brand_id' => $frame_brand->id,
            'type_id' => $frame_type->id,
            'size_id' => $frame_size->id,
            'material_id' => $frame_material->id,
            'code' => $data['code'],
            'status' => $data['status'],
        ]);

        $response['status'] = true;
        $response['message'] = 'Frame updated successfully';
        return response()->json($response, 200);
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
        $data = $request->all();

        $validator = Validator::make($data, [
            'frame_id' => 'required|integer|exists:frames,id',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 401);
        }

        $frame = Frame::findOrFail($data['frame_id']);
        if ($frame->photo != 'noimage.png') {
            Storage::delete('public/frames/' . $frame->photo);
        }

        $frame->delete();

        $response['status'] = true;
        $response['message'] = 'Frame deleted successfully';
        return response()->json($response, 200);
    }
}
