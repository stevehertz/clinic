<?php

namespace App\Exports;

use App\Models\Patient;
use App\Models\Report;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class ReportsExport implements FromView
{
    use Exportable;
    public $from_date;
    public $to_date;

    public function __construct($from_date, $to_date)
    {
        $this->from_date = $from_date;
        $this->to_date = $to_date;
    }

    /**
     * @return \Illuminate\Support\View
     */


    public function view(): View
    {
        if (!empty($this->from_date) && !empty($this->to_date)) {
            $data = Report::whereBetween('appointment_date', [request()->input('from_date'), request()->input('to_date')])
                ->get();
        } else {
            $data = Report::latest()->get();
        }
        return view('admin.clinic_reports.reports', [
            'reports' => $data
        ]);
    }
}
