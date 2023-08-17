<?php

namespace App\Http\Controllers\Users\Appointments;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\ClientType;
use App\Models\Clinic;
use App\Models\Patient;
use App\Models\User;
use App\Models\PaymentDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class AppointmentsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $user = User::find(auth()->user()->id);
        $clinic = $user->clinic;
        if ($request->ajax()) {
            if (!empty($request->from_date) && !empty($request->to_date)) {
                $data = $clinic->appointment()
                    ->join('patients', 'appointments.patient_id', '=', 'patients.id')
                    ->join('payment_details', 'appointments.id', '=', 'payment_details.appointment_id')
                    ->join('client_types', 'payment_details.client_type_id', '=', 'client_types.id')
                    ->select('appointments.*', 'patients.first_name', 'patients.last_name', 'client_types.type')
                    ->where('appointments.clinic_id', $clinic->id)
                    ->where('patients.status', 1)
                    ->whereBetween('appointments.date', [$request->from_date, $request->to_date])
                    ->get();
            } else {
                $data = Appointment::join('patients', 'appointments.patient_id', '=', 'patients.id')
                    ->join('payment_details', 'appointments.id', '=', 'payment_details.appointment_id')
                    ->join('client_types', 'payment_details.client_type_id', '=', 'client_types.id')
                    ->select('appointments.*', 'patients.first_name', 'patients.last_name', 'client_types.type')
                    ->where('appointments.clinic_id', $clinic->id)
                    ->where('patients.status', 1)
                    ->orderBy('appointments.created_at', 'desc')
                    ->get();
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('full_names', function ($row) {
                    return $row->first_name . ' ' . $row->last_name;
                })
                ->addColumn('appointment_status', function ($row) {
                    if ($row->status == 0) {
                        $output = ' <a href="#" id="' . $row['id'] . '" data-clinic="' . $row['clinic_id'] . '" data-patient="' . $row['patient_id'] . '" class="btn btn-info btn-sm scheduleAppointment">';
                        $output .= '<i class="fa fa-calendar"></i> Schedule';
                        $output .= '</a>';
                    } else {
                        $output = '<span class="badge badge-success">Scheduled</span>';
                    }
                    return $output;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="#" id="' . $row['id'] . '" class="btn btn-tool viewBtn"><i class="fa fa-eye"></i></a>';
                    return $btn;
                })
                ->rawColumns(['full_names', 'appointment_status', 'action'])
                ->make(true);
        }
        $doctors = User::where('clinic_id', $clinic->id)->whereRoleIs('doctor')->latest()->get();
        $page_title = 'Appointments';
        return view('users.appointments.index', [
            'user' => $user,
            'clinic' => $clinic,
            'doctors' => $doctors,
            'page_title' => $page_title,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user = User::find(auth()->user()->id);
        $clinic = $user->clinic;
        $organization = $clinic->organization;
        $client_types = $organization->client_type->sortBy('created_at', SORT_DESC);
        $insurances = $organization->insurance->sortBy('created_at', SORT_DESC);
        $patients  = $clinic->patient->sortBy('created_at', SORT_DESC);
        $page_title = 'New Appointment';
        return view('users.appointments.create', [
            'user' => $user,
            'clinic' => $clinic,
            'client_types' => $client_types,
            'insurances' => $insurances,
            'patients' => $patients,
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
            'patient_id' => 'required|integer|exists:patients,id',
            'client_type_id' => 'required|integer|exists:client_types,id',
            'insurance_id' => 'nullable|integer|exists:insurances,id',
            'scheme' => 'nullable|string|max:255',
            'principal' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'workplace' => 'nullable|string|max:255',
            'nhif_number' => 'nullable|string|max:255',
            'nhif_principal_member' => 'nullable|string|max:255',
            'nhif_principal_member_phone' => 'nullable|string|max:255',
            'principal_workplace' => 'nullable|string|max:255',
            'card_number' => 'nullable|string|max:255',
            'hospital_client_number' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            # code...
            $errors = $validator->errors();
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 401);
        }

        $clinic = Clinic::findOrFail($data['clinic_id']);
        $patient = Patient::findOrFail($data['patient_id']);
        $client_type = ClientType::findOrFail($data['client_type_id']);

        // create appointment
        $appointment = new Appointment;
        $appointment->clinic_id = $clinic->id;
        $appointment->patient_id = $patient->id;
        $appointment->date = Carbon::now()->format('Y-m-d');
        $appointment->appointment_time = Carbon::now()->format('H:i:s');
        $appointment->user_id = Auth::user()->id;

        if ($appointment->save()) {

            // create payment detail
            $payment_detail = new PaymentDetail;
            $payment_detail->clinic_id = $clinic->id;
            $payment_detail->patient_id = $patient->id;
            $payment_detail->appointment_id = $appointment->id;
            $payment_detail->client_type_id = $client_type->id;
            if ($request->insurance_id) {
                $payment_detail->insurance_id = $data['insurance_id'];
            }
            $payment_detail->scheme = $data['scheme'];
            $payment_detail->principal = $data['principal'];
            $payment_detail->phone = $data['phone'];
            $payment_detail->workplace = $data['workplace'];
            $payment_detail->principal_workplace = $data['principal_workplace'];
            $payment_detail->card_number = $data['card_number'];

            if ($payment_detail->save()) {

                // generate report
                $report = $clinic->report()->create([
                    'patient_id' => $patient->id,
                    'appointment_id' => $appointment->id,
                    'payment_details_id' => $payment_detail->id,
                    'appointment_date' => $appointment->date,
                ]);

                // update current appointment report id
                $current_appointment = Appointment::findOrFail($appointment->id);

                $current_appointment->report_id = $report->id;

                // save report id
                $request->session()->put('report_id', $report->id);
                $current_appointment->save();

                $response['status'] = true;
                $response['patient_id'] = $patient->id;
                $response['appointment_id'] = $appointment->id;
                $response['message'] = 'Payment details created successfully';
                return response()->json($response, 200);
            }
        } else {
            $response['staus'] = false;
            $response['errors'] = 'Something went wrong';
            return response()->json($response, 401);
        }
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
            'appointment_id' => 'required|integer|exists:appointments,id',
        ]);

        if ($validator->fails()) {
            # code...
            $errors = $validator->errors();
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 401);
        }

        $appointment = Appointment::findOrFail($data['appointment_id']);

        $response['status'] = true;
        $response['data'] = $appointment;
        return response()->json($response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        # code...
        $user = User::find(auth()->user()->id);
        $clinic = $user->clinic;
        $appointment = Appointment::findOrFail($id);
        $patient = $appointment->patient;
        $payment_details = $appointment->payment_detail;
        $doctors = User::where('clinic_id', $clinic->id)->whereRoleIs('doctor')->latest()->get();
        $page_title = 'Appointment Details';
        $doctor_schedule = $appointment->doctor_schedule;
        return view('users.appointments.view', [
            'user' => $user,
            'clinic' => $clinic,
            'appointment' => $appointment,
            'patient' => $patient,
            'payment_details' => $payment_details,
            'doctor_schedule' => $doctor_schedule,
            'doctors' => $doctors,
            'page_title' => $page_title,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
