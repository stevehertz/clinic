<?php

namespace App\Http\Controllers\Admin\Patients;

use App\Exports\PatientsReport;
use App\Http\Controllers\Controller;
use App\Http\Resources\Patient as ResourcesPatient;
use App\Models\Admin;
use App\Models\Appointment;
use App\Models\Clinic;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use PhpParser\Builder\Param;
use Yajra\DataTables\Facades\DataTables;

class PatientsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request, $id)
    {
        # code...
        $clinic = Clinic::findOrFail($id);
        if ($request->ajax()) {
            if (!empty($request->from_date) && !empty($request->to_date)) {
                $data = $clinic->patient()
                    ->whereBetween('appointments.date', [$request->from_date, $request->to_date])
                    ->get();
            } else {
                $data = $clinic->patient()->latest()->get();
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('full_names', function ($row) {
                    return $row->first_name . ' ' . $row->last_name;
                })
                ->addColumn('doctor_full_names', function ($row) {
                    return $row->user->first_name . ' ' . $row->user->last_name;
                })
                ->addColumn('added_by', function ($row) {
                    return $row->user->first_name . ' ' . $row->user->last_name;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="#" id="' . $row['id'] . '" class="btn btn-tool viewBtn"><i class="fa fa-user"></i></a>';
                    $btn = $btn . '<a href="#" id="' . $row['id'] . '" class="btn btn-tool deleteBtn"><i class="fa fa-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['full_names', 'action', 'added_by'])
                ->make(true);
        }
        $page_title = 'patients';
        $patients = $clinic->patient->count();
        return view('admin.patients.index', [
            'page_title' => $page_title,
            'clinic' => $clinic,
            'patients' => $patients,
        ]);
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
        $request->session()->put('patient_id', $patient->id);
        return new ResourcesPatient($patient);
    }

    public function view(Request $request, $id)
    {
        # code...
        $clinic = Clinic::findOrFail($id);
        $patients = $clinic->patient->count();
        if ($request->session()->has('patient_id')) {
            $patient = Patient::findOrFail($request->session()->get('patient_id'));
            $appointments = $patient->appointment->sortBy('created_at', SORT_DESC);
            $schedules = $patient->docor_schedule->sortBy('created_at', SORT_DESC);
            $request->session()->forget('patient_id');
            $page_title = 'View Patient';
            return view('admin.patients.view', [
                'clinic' => $clinic,
                'page_title' => $page_title,
                'patients' => $patients,
                'patient' => $patient,
                'appointments' => $appointments,
                'schedules' => $schedules,
            ]);
        }
        return redirect()->route('admin.patients.index', $clinic->id);
    }

    public function export(Request $request, $id)
    {
        # code...
        $clinic = Clinic::findOrFail($id);
        $from_date = $request->input('from_date') ? $request->input('from_date') : '';
        $to_date = $request->input('to_date')  ? $request->input('to_date') : '';
        return (new PatientsReport($clinic->id, $from_date, $to_date))->download('patients' . time() . '.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
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
