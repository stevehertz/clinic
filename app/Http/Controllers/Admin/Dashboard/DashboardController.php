<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Clinic;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index($id)
    {
        # code...
        $clinic  = Clinic::findOrFail($id);
        $appointments = $clinic->appointment()
            ->join('patients', 'appointments.patient_id', '=', 'patients.id')
            ->join('payment_details', 'appointments.id', '=', 'payment_details.appointment_id')
            ->join('client_types', 'payment_details.client_type_id', '=', 'client_types.id')
            ->select('appointments.*', 'patients.first_name', 'patients.last_name', 'client_types.type')
            ->orderBy('appointments.created_at', 'desc')
            ->limit(10)
            ->get();
        $payments = $clinic->payment_bill()->sum('paid_amount');
        $remittances = $clinic->remittance()->sum('amount');
        $page_title = 'Dashboard';
        $patients = $clinic->patient->count();
        return view('admin.dashboard.index', compact('clinic', 'page_title', 'patients', 'appointments', 'payments', 'remittances'));
    }
}
