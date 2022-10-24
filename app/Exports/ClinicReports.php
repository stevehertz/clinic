<?php

namespace App\Exports;

use App\Models\Report;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class ClinicReports implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;

    private $clinic_id;
    public $from_date;
    public $to_date;

    public function __construct($clinic_id, $from_date, $to_date)
    {
        $this->clinic_id = $clinic_id;
        $this->from_date = $from_date;
        $this->to_date = $to_date;
    }

    public function view(): View
    {
        if (!empty($this->from_date) && !empty($this->to_date)) {
            $data = Report::whereBetween('appointment_date', [request()->input('from_date'), request()->input('to_date')])
            ->where('clinic_id', $this->clinic_id)
            ->get();
        } else {
            $data = Report::where('clinic_id', $this->clinic_id)->latest()->get();
        }
        return view('admin.reports.reports', [
            'reports' => $data
        ]);
    }
}
