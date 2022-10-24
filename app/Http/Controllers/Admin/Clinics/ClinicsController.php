<?php

namespace App\Http\Controllers\Admin\Clinics;

use App\Http\Controllers\Controller;
use App\Http\Resources\Clinic as ResourcesClinic;
use App\Models\Admin;
use App\Models\Clinic;
use COM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ClinicsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        # code...
        $admin = Admin::findOrFail(Auth::guard('admin')->user()->id);
        $organization = $admin->organization;

        if ($request->ajax()) {
            $data = $organization->clinic;
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('logo', function ($row) {
                    return '<img src="' . asset('storage/clinics/' . $row['logo']) . '" class="img-circle img-size-32 mr-2">';
                })
                ->addColumn('select', function ($row) {
                    $selectBtn = '<a href="#" id="' . $row['id'] . '" class="btn btn-primary selectBtn"><i class="fa fa-check"></i></a>';
                    return $selectBtn;
                })
                ->rawColumns(['logo', 'select'])
                ->make(true);
        }

        $page_title = 'Clinics';
        return view('admin.clinics.index', compact('organization', 'page_title'));
    }

    public function store(Request $request)
    {
        # code...
        $data = $request->all();

        $validator = Validator::make($data, [
            'clinic' => 'required|string|max:255',
            'logo' => 'image|mimes:png,jpg,jpeg|nullable|max:2048',
            'phone' => 'required|numeric',
            'email' => 'required|string|email|max:255',
            'location' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 401);
        }

        if ($request->hasFile('logo')) {

            $logoNameWithExt = $request->file('logo')->getClientOriginalName();

            // Get Filename
            $logoName = pathinfo($logoNameWithExt, PATHINFO_FILENAME);

            // Get just Extension
            $extension = $request->file('logo')->getClientOriginalExtension();

            // Filename To store
            $logoNameToStore = $logoName . '_' . time() . '.' . $extension;

            // Upload Image
            $path = $request->file('logo')->storeAs('public/clinics', $logoNameToStore);
        } else {
            $logoNameToStore = 'noimage.png';
        }

        $admin = Admin::findOrFail(Auth::guard('admin')->user()->id);
        $organization = $admin->organization;
        $clinics = new Clinic;

        $clinics->organization_id = $organization->id;
        $clinics->clinic = $data['clinic'];
        $clinics->logo = $logoNameToStore;
        $clinics->phone = $data['phone'];
        $clinics->email = $data['email'];
        $clinics->address = $data['address'];
        $clinics->location = $data['location'];
        $clinics->initials = $data['initials'];

        $clinics->save();

        $response['status'] = true;
        $response['message'] = 'Clinic added successfully';
        return response()->json($response, 200);
    }

    public function show(Request $request)
    {
        # code...
        $data = $request->all();

        $validator = Validator::make($data, [
            'clinic_id' => 'required|integer|exists:clinics,id',
        ]);

        if($validator->fails()){
            $errors = $validator->errors();
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 401);
        }

        $clinic = Clinic::findOrFail($data['clinic_id']);
        return new ResourcesClinic($clinic);
    }

    public function view($id)
    {
        # code...
        $clinic = Clinic::findOrFail($id);
        $patients = $clinic->patient->count();
        $page_title = 'Clinic';
        return view('admin.clinics.view', compact('clinic', 'page_title', 'patients'));
    }

    public function update(Request $request)
    {
        # code...
        $data = $request->all();

        $validator = Validator::make($data, [
            'clinic_id' => 'required|integer|exists:clinics,id',
            'clinic' => 'required|string|max:255',
            'logo' => 'image|mimes:png,jpg,jpeg|nullable',
            'phone' => 'required|numeric',
            'email' => 'required|string|email|max:255',
            'location' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 401);
        }

        if ($request->hasFile('logo')) {

            $logoNameWithExt = $request->file('logo')->getClientOriginalName();

            // Get Filename
            $logoName = pathinfo($logoNameWithExt, PATHINFO_FILENAME);

            // Get just Extension
            $extension = $request->file('logo')->getClientOriginalExtension();

            // Filename To store
            $logoNameToStore = $logoName . '_' . time() . '.' . $extension;

            // Upload Image
            $path = $request->file('logo')->storeAs('public/clinics', $logoNameToStore);
        }

        $clinic = Clinic::findOrFail($data['clinic_id']);

        $clinic->id = $clinic->id;
        $clinic->organization_id = $clinic->organization_id;
        $clinic->clinic = $data['clinic'];
        if ($request->hasFile('logo')) {
            $clinic->logo = $logoNameToStore;
        }
        $clinic->phone = $data['phone'];
        $clinic->email = $data['email'];
        $clinic->address = $data['address'];
        $clinic->location = $data['location'];
        $clinic->initials = $data['initials'];

        $clinic->save();

        $response['status'] = true;
        $response['message'] = 'Clinic updated successfully';
        return response()->json($response, 200);

    }
}
