<?php

namespace App\Http\Controllers\Admin\Cases;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Settings\Cases\FrameCaseRequest;
use App\Http\Requests\Admin\Settings\Cases\UpdateFrameCaseRequest;
use App\Models\CaseColor;
use App\Models\CaseShape;
use App\Models\CaseSize;
use App\Models\FrameCase;
use Illuminate\Http\Request;

class FrameCasesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = FrameCase::latest()->get();
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('size', function ($row) {
                    return $row->case_size->title;
                })
                ->addColumn('color', function ($row) {
                    return $row->case_color->title;
                })
                ->addColumn('shape', function ($row) {
                    return $row->case_shape->title;
                })
                ->addColumn('actions', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-outline-primary updateCaseBtn">';
                    $btn = $btn . '<i class="fa fa-edit"></i>';
                    $btn = $btn . '</a>';
                    $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-outline-danger deleteCaseBtn">';
                    $btn = $btn . '<i class="fa fa-trash"></i>';
                    $btn = $btn . '</a>';
                    return $btn;
                })
                ->rawColumns(['size', 'color', 'shape', 'actions'])
                ->make(true);
        }
        $page_title = trans('pages.settings.page_title');
        $case_sizes = CaseSize::latest()->get();
        $case_colors = CaseColor::latest()->get();
        $case_shapes = CaseShape::latest()->get();
        return view('admin.cases.frame_cases.index', [
            'page_title' => $page_title,
            'case_sizes' => $case_sizes,
            'case_shapes' => $case_shapes,
            'case_colors' => $case_colors
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FrameCaseRequest $request)
    {
        //
        $data = $request->except("_token");

        $frame_case = new FrameCase;

        $frame_case->create([
            'color_id' => $data['color_id'],
            'size_id' => $data['size_id'],
            'shape_id' => $data['shape_id'],
            'code' => $data['code']
        ]);

        $response = [
            'status' => true,
            'message' => 'New Cases added' 
        ];

        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $case = FrameCase::findOrFail($id);
        
        $response = [
            'status' => true,
            'data' => $case
        ];

        return response()->json($response, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFrameCaseRequest $request, $id)
    {
        //
        $case = FrameCase::findOrFail($id);

        $data = $request->except('_token');

        $case->update([
            'color_id' => $data['color_id'],
            'size_id' => $data['size_id'],
            'shape_id' => $data['shape_id'],
            'code' => $data['code']
        ]);

        $response = [
            'status' => true,
            'message' => 'Cases Updated' 
        ];

        return response()->json($response, 200);
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
        $case = FrameCase::findOrFail($id);

        $case->delete();

        $response = [
            'status' => true,
            'message' => 'Cases deleted' 
        ];

        return response()->json($response, 200);
    }
}
