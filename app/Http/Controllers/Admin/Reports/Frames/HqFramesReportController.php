<?php

namespace App\Http\Controllers\Admin\Reports\Frames;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Repositories\FramesReportRepository;

class HqFramesReportController extends Controller
{
    //
    private $frameReportRepository;

    public function __construct(FramesReportRepository $frameReportRepository)
    {
        $this->frameReportRepository = $frameReportRepository;
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $page_title = trans('menus.admins.sidebar.reports.frames');
        return view('admin.reports.hq.frames.index', [
            'page_title' => $page_title
        ]);
    }

    public function getFramesReport(Request $request)
    {


        // Get frames report data from the repository
        $admin = Auth::guard('admin')->user();
        $data = $this->frameReportRepository->getAllHqFrames($admin);
        // Check if the request is AJAX
        if ($request->ajax()) {
            // Return the data as JSON for DataTables
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('actions', function ($row) {
                    // Add actions column if needed
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
    }

    public function export()
    {
    }
}
