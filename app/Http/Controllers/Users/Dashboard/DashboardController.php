<?php

namespace App\Http\Controllers\Users\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        # code...
        $user = User::findOrFail(auth()->user()->id);
        $clinic = $user->clinic;
        $appointments = $clinic->appointment()
            ->join('patients', 'appointments.patient_id', '=', 'patients.id')
            ->join('payment_details', 'appointments.id', '=', 'payment_details.appointment_id')
            ->join('client_types', 'payment_details.client_type_id', '=', 'client_types.id')
            ->select('appointments.*', 'patients.first_name', 'patients.last_name', 'client_types.type')
            ->orderBy('appointments.created_at', 'desc')
            ->limit(10)
            ->get();
        $doctors = User::where('clinic_id', $clinic->id)->whereRoleIs('doctor')->latest()->get();
        $patients = $clinic->patient->count();
        $num_appointments = $clinic->appointment->count();
        $schedules = $clinic->doctor_schedule->where('user_id', $user->id)->count();
        $orders = $clinic->order->count();
        $page_title = 'Dashboard';
        return view('users.dashboard.index', compact('clinic', 'page_title', 'appointments', 'doctors', 'patients', 'num_appointments', 'schedules', 'orders'));
    }
}
