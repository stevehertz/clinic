<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Exports\ClinicReports;
use App\Exports\ReportsExport;
use App\Http\Controllers\Controller;
use App\Models\Clinic;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportsController extends Controller
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
                $data = $clinic->report()
                    ->whereBetween('appointment_date', [$request->from_date, $request->to_date])
                    ->get();
            } else {
                $data = $clinic->report()->latest()->get();
            }
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('full_name', function ($row) {
                    return $row->patient->first_name . ' ' . $row->patient->last_name;
                })
                ->addColumn('appointment_date', function ($row) {
                    return date('d-m-Y', strtotime($row->appointment_date));
                })
                ->addColumn('type', function ($row) {
                    if($row->payment_detail){
                        return $row->payment_detail->client_type->type;
                    }
                })
                ->addColumn('appointment_status', function ($row) {
                    if ($row->appointment->status == 0)
                    {
                        $output = '<span class="badge badge-danger">Not Scheduled</span>';
                    }
                    else
                    {
                        $output = '<span class="badge badge-success">Scheduled</span>';
                    }

                    return $output;
                })
                ->addColumn('scheduled_date', function ($row) {
                    if ($row->doctor_schedule) {
                        return $row->doctor_schedule->date;
                    }
                })
                ->addColumn('doctor_full_name', function ($row) {
                    if ($row->doctor_schedule) {
                        return $row->doctor_schedule->user->first_name . ' ' . $row->doctor_schedule->user->last_name;
                    }
                })
                ->addColumn('consultation_fee', function ($row) {
                    return number_format($row->consultation_fee, 2, '.', ',');
                })
                ->addColumn('agreed_amount', function ($row) {
                    return number_format($row->agreed_amount, 2, '.', ',');
                })
                ->addColumn('paid_amount', function ($row) {
                    return number_format($row->paid_amount, 2, '.', ',');
                })
                ->addColumn('order_date', function ($row) {
                    if ($row->order) {
                        return date('d-m-Y', strtotime($row->order->order_date));
                    }
                })
                ->addColumn('order_status', function ($row) {
                    if ($row->order) {
                        return date('d-m-Y', strtotime($row->order->status));
                    }
                })
                ->rawColumns(['full_name', 'appointment_date', 'type', 'appointment_status', 'scheduled_date', 'doctor_full_name',   'consultation_fee', 'agreed_amount', 'order_date', 'order_status'])
                ->make(true);
        }
        $patients = $clinic->patient->count();
        $page_title = "Reports";
        return view('admin.reports.index', [
            'clinic' => $clinic,
            'patients' => $patients,
            'page_title' => $page_title
        ]);
    }

    public function export(Request $request, $id)
    {
        # code...
        $clinic = Clinic::findOrFail($id);
        $from_date = $request->input('from_date') ? $request->input('from_date') : '';
        $to_date = $request->input('to_date')  ? $request->input('to_date') : '';
        return (new ClinicReports($clinic->id, $from_date, $to_date))->download('reports' . time() . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }
}
