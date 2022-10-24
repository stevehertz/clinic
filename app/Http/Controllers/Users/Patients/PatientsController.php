<?php

namespace App\Http\Controllers\Users\Patients;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Clinic;
use App\Models\Patient;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PatientsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        # code..
        $user = User::findOrFail(Auth::user()->id);
        $clinic = $user->clinic;
        if ($request->ajax()) {
            $data = $clinic->patient->sortBy('created_at', SORT_DESC);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('full_names', function ($row) {
                    return $row->first_name . ' ' . $row->last_name;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="#" id="' . $row['id'] . '" class="btn btn-tool editBtn"><i class="fa fa-edit"></i></a>';
                    $btn = $btn . '<a href="#" id="' . $row['id'] . '" class="btn btn-tool viewBtn"><i class="fa fa-user"></i></a>';
                    return $btn;
                })
                ->rawColumns(['full_names', 'action'])
                ->make(true);
        }
        $page_title = 'Patients';
        return view('users.patients.index', [
            'page_title' => $page_title,
            'clinic' => $clinic,
        ]);
    }

    public function create()
    {
        # code...
        $user = User::findOrFail(Auth::user()->id);
        $clinic = $user->clinic;
        $organization = $clinic->organization;
        $client_types = $organization->client_type->sortBy('created_at', SORT_DESC);
        $insurances = $organization->insurance->sortBy('created_at', SORT_DESC);
        $page_title = 'Create Patient';
        return view('users.patients.create', [
            'page_title' => $page_title,
            'clinic' => $clinic,
            'client_types' => $client_types,
            'insurances' => $insurances,
        ]);
    }

    public function store(Request $request)
    {
        # code...
        $data = $request->all();

        $validator = Validator::make($data, [
            'clinic_id' => 'required|integer|exists:clinics,id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'id_number' => 'required|numeric|unique:patients,id_number',
            'phone' => 'required|numeric|min:10',
            'email' => 'nullable|string|email|max:255',
            'dob' => 'required|string|max:255|date_format:Y-m-d',
            'gender' => 'required|string',
            'next_of_kin_contact' => 'nullable|numeric|min:10',
        ], [
            'dob.date_format' => 'Date of Birth Must Match The Format: Y-m-d'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 401);
        }

        $clinic = Clinic::findOrFail($data['clinic_id']);

        $patient = new Patient;

        $patient->user_id = Auth::user()->id; //doctor id
        $patient->clinic_id = $clinic->id;
        $patient->first_name = $data['first_name'];
        $patient->last_name = $data['last_name'];
        $patient->id_number = $data['id_number'];
        $patient->phone = $data['phone'];
        $patient->email = $data['email'];
        $patient->dob = $data['dob'];
        $patient->gender = $data['gender'];
        $patient->address = $data['address'];
        $patient->next_of_kin = $data['next_of_kin'];
        $patient->next_of_kin_contact = $data['next_of_kin_contact'];

        if ($patient->save()) {
            $request->session()->put('patient_id', $patient->id);
            $response['patient_id'] = $patient->id;
            $response['status'] = true;
            $response['message'] = 'Patient created successfully';
            return response()->json($response, 200);
        }
    }

    public function show(Request $request)
    {
        # code...
        $data = $request->all();

        $validator = Validator::make($data, [
            'patient_id' => 'required|integer|exists:patients,id'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 401);
        }

        $patient = Patient::findOrFail($data['patient_id']);

        $response['status'] = true;
        $response['data'] = $patient;
        return response()->json($response, 200);
    }

    public function view($id)
    {
        # code...
        $user = User::findOrFail(Auth::user()->id);
        $clinic = $user->clinic;
        $patient = Patient::findOrFail($id);
        $appointments = $patient->appointment->sortBy('created_at', SORT_DESC);
        $doctors = User::where('clinic_id', $clinic->id)->whereRoleIs('doctor')->get();
        $schedules = $patient->docor_schedule->sortBy('created_at', SORT_DESC);
        $page_title = 'View Patient';
        return view('users.patients.view', [
            'page_title' => $page_title,
            'clinic' => $clinic,
            'patient' => $patient,
            'appointments' => $appointments,
            'doctors' => $doctors,
            'schedules' => $schedules,
        ]);
    }

    public function edit($id)
    {
        $user = User::findOrFail(Auth::user()->id);
        $clinic = $user->clinic;
        $organization = $clinic->organization;
        $client_types = $organization->client_type->sortBy('created_at', SORT_DESC);
        $insurances = $organization->insurance->sortBy('created_at', SORT_DESC);
        $patient = Patient::findOrFail($id);
        $page_title = 'Update Patient Details';
        return view('users.patients.edit', [
            'page_title' => $page_title,
            'clinic' => $clinic,
            'client_types' => $client_types,
            'insurances' => $insurances,
            'patient' => $patient,
        ]);
    }

    public function update(Request $request, $id)
    {
        # code...
        $data = $request->all();

        $validator = Validator::make($data, [
            'clinic_id' => 'required|integer|exists:clinics,id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'id_number' => 'required|string|unique:patients,id_number,'.$id,
            'phone' => 'required|numeric|min:10',
            'email' => 'nullable|string|email|max:255',
            'dob' => 'required|string|max:255|date_format:Y-m-d',
            'gender' => 'required|string',
            'next_of_kin_contact' => 'nullable|numeric|min:10',
        ], [
            'dob.date_format' => 'Date of Birth Must Match The Format: Y-m-d'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 401);
        }

        $clinic = Clinic::findOrFail($data['clinic_id']);

        $patient = $clinic->patient()->findOrFail($id);

        $patient->id = $patient->id;
        $patient->user_id = $patient->user_id; //doctor id
        $patient->clinic_id = $clinic->id;
        $patient->first_name = $data['first_name'];
        $patient->last_name = $data['last_name'];
        $patient->id_number = $data['id_number'];
        $patient->phone = $data['phone'];
        $patient->email = $data['email'];
        $patient->dob = $data['dob'];
        $patient->gender = $data['gender'];
        $patient->address = $data['address'];
        $patient->next_of_kin = $data['next_of_kin'];
        $patient->next_of_kin_contact = $data['next_of_kin_contact'];
        $patient->updated_by = Auth::user()->id;

        $patient->save();

        $response['status'] = true;
        $response['message'] = "You have successfully updated current patient details";

        return response()->json($response, 200);
    }


    public function destroy(Request $request)
    {
        # code...
        $data = $request->all();

        $validator = Validator::make($data, [
            'patient_id' => 'required|integer|exists:patients,id'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 401);
        }

        $patient = Patient::findOrFail($data['patient_id']);

        if ($patient->delete()) {
            $response['status'] = true;
            $response['message'] = 'Patient deleted successfully';
            return response()->json($response, 200);
        } else {
            $response['status'] = false;
            $response['errors'] = 'Error deleting patient';
            return response()->json($response, 401);
        }
    }
}
