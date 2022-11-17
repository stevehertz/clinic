<?php

namespace App\Http\Controllers\Users\Schedule;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Clinic;
use App\Models\DoctorSchedule;
use App\Models\Patient;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DoctorSchedulesController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        # code...
        $user = User::findOrFail(auth()->user()->id);
        $clinic = $user->clinic;
        if ($request->ajax()) {

            if (!empty($request->from_date) && !empty($request->to_date)) {
                $data = $clinic->doctor_schedule()->join('patients', 'patients.id', '=', 'doctor_schedules.patient_id')
                    ->join('users', 'users.id', '=', 'doctor_schedules.user_id')
                    ->select('doctor_schedules.*', 'users.first_name as dr_first', 'users.last_name as dr_last', 'patients.first_name  as patient_first', 'patients.last_name as patient_last')
                    ->where('doctor_schedules.user_id', $user->id)
                    ->whereBetween('doctor_schedules.date', [$request->from_date, $request->to_date])
                    ->get();
            } else {
                $data = $clinic->doctor_schedule()->join('patients', 'patients.id', '=', 'doctor_schedules.patient_id')
                    ->join('users', 'users.id', '=', 'doctor_schedules.user_id')
                    ->select('doctor_schedules.*', 'users.first_name as dr_first', 'users.last_name as dr_last', 'patients.first_name  as patient_first', 'patients.last_name as patient_last')
                    ->where('doctor_schedules.user_id', $user->id)
                    ->get();
            }
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('patient_name', function ($row) {
                    return $row->patient_first . ' ' . $row->patient_last;
                })
                ->addColumn('dr_name', function ($row) {
                    return $row->dr_first . ' ' . $row->dr_last;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="View" class="btn btn-tool btn-sm viewDoctorSchedule"><i class="fa fa-eye"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action', 'patient_name', 'dr_name'])
                ->make(true);
        }
        $page_title = 'Doctor Schedules';
        return view('users.schedules.index', compact('clinic', 'page_title'));
    }

    public function store(Request $request)
    {
        # code...
        $data = $request->all();

        $validator = Validator::make($data, [
            'clinic_id' => 'required|integer|exists:clinics,id',
            'user_id' => 'required|integer|exists:users,id',
            'patient_id' => 'required|integer|exists:patients,id',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 401);
        }

        $clinic = Clinic::findOrFail($data['clinic_id']);
        $user = User::findOrFail($data['user_id']);
        $patient = Patient::findOrFail($data['patient_id']);
        $appointment = Appointment::findOrFail($data['appointment_id']);
        $schedule = new DoctorSchedule;
        $schedule->clinic_id = $clinic->id;
        $schedule->user_id = $user->id;
        $schedule->patient_id = $patient->id;
        $schedule->appointment_id = $appointment->id;
        $today = Carbon::now();
        $day = Carbon::parse($today)->format('l');
        $time = Carbon::parse($today)->format('H:i:s');
        $schedule->day = $day;
        $schedule->date = $today;
        $schedule->time = $time;
        $schedule->status = 1;

        if ($schedule->save()) {

            $report = $clinic->report()->findOrFail($appointment->report_id);

            $report->update([
                'schedule_id' => $schedule->id,
            ]);

            $appointment->id = $appointment->id;
            $appointment->status = 1;
            $appointment->save();
            $response['status'] = true;
            $response['message'] = 'Schedule created successfully';
            $response['schedule_id'] = $schedule->id;
            return response()->json($response, 200);
        }
    }

    public function show(Request $request)
    {
        # code...
        $data = $request->all();

        $validator = Validator::make($data, [
            'schedule_id' => 'required|integer|exists:doctor_schedules,id',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 401);
        }

        $schedule = DoctorSchedule::findOrFail($data['schedule_id']);
        $response['status'] = true;
        $response['data'] = $schedule;
        return response()->json($response, 200);
    }

    public function view($id)
    {
        # code...
        $user = User::findOrFail(auth()->user()->id);
        $clinic = $user->clinic;
        $organization = $clinic->organization;
        $types = $organization->lens_type->sortBy('created_at', SORT_DESC);
        $materials = $organization->lens_material->sortBy('created_at', SORT_DESC);
        $workshops = $organization->workshop->sortBy('created_at', SORT_DESC);

        $schedule = DoctorSchedule::findOrFail($id);
        $patient = $schedule->patient;
        $doctor = $schedule->user; // This users with the roles of doctor or optimist
        $appointment = $schedule->appointment;
        $payment_details = $appointment->payment_detail;
        $diagnosis = $schedule->diagnosis;
        if ($diagnosis) {
            $lens_power = $diagnosis->lens_power;
            if ($lens_power) {
                $lens_prescription = $lens_power->lens_prescription;
                $frame_prescription = $lens_power->frame_prescription;
            } else {
                $lens_prescription = null;
                $frame_prescription = null;
            }
            $procedure = $diagnosis->procedure;
            $appointment = $diagnosis->appointment;
            $payment_bill = $appointment->payment_bill;
        } else {
            $lens_power = null;
            $lens_prescription = null;
            $frame_prescription = null;
            $procedure = null;
            $appointment = null;
            $payment_bill = null;
        }
        // Load frame stocks for the clinic
        $frame_stocks = $clinic->frame_stock()->where('closing_stock', '>', 0)->latest()->get();
        $page_title = 'View Schedule';
        return view('users.schedules.view', [
            'clinic' => $clinic,
            'schedule' => $schedule,
            'patient' => $patient,
            'doctor' => $doctor,
            'appointment' => $appointment,
            'payment_details' => $payment_details,
            'diagnosis' => $diagnosis,
            'lens_power' => $lens_power,
            'lens_prescription' => $lens_prescription,
            'frame_prescription' => $frame_prescription,
            'types' => $types,
            'materials' => $materials,
            'workshops' => $workshops,
            'procedure' => $procedure,
            'payment_bill' => $payment_bill,
            'frame_stocks' => $frame_stocks,
            'page_title' => $page_title,
        ]);
    }
}
