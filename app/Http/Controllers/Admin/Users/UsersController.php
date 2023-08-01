<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Mail\UsersMail;
use App\Models\Admin;
use App\Models\Clinic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UsersController extends Controller
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
    public function index(Request $request, $id)
    {
        //
        $admin = Admin::findOrFail(Auth::guard('admin')->user()->id);
        $clinic = Clinic::findOrFail($id);
        $organization = $clinic->organization;
        if ($request->ajax()) {
            $data = $clinic->user()->orderBy('id', 'desc')->get();
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('full_names', function($row){
                    return $row['first_name'] . ' ' . $row['last_name'];
                })
                ->addColumn('status', function($row){
                    return $row['status'] ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<div class="btn-group">';
                    $btn = $btn . '<button type="button" class="btn btn-default">Action</button>';
                    $btn = $btn . '<button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">';
                    $btn = $btn . '<span class="sr-only">Toggle Dropdown</span>';
                    $btn = $btn . '</button>';
                    $btn = $btn . '<div class="dropdown-menu" role="menu">';
                    $btn = $btn . '<a class="dropdown-item" href="javascript:void(0)">View</a>';
                    $btn = $btn . '<a class="dropdown-item" href="javascript:void(0)">Deactivate</a>';
                    $btn = $btn . '<a class="dropdown-item delete deleteUsersBtn" data-id="' . $row->id . '" href="javascript:void(0)">Delete</a>';
                    $btn = $btn . '</div>';
                    $btn = $btn . '</div>';
                    return $btn;
                })
                ->rawColumns(['action', 'full_names', 'status'])
                ->make(true);
        }
        $patients = $clinic->patient->count();
        $page_title = trans('pages.users');
        return view('admin.users.index', [
            'admin' => $admin,
            'clinic' => $clinic,
            'organization' => $organization,
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|numeric|min:10|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'status' => 'required|boolean',
            'role_id' => 'required',
        ]);

        if($validator->fails()){
            $errors = $validator->errors();
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 401);
        }

        $clinic = Clinic::findOrFail($data['clinic_id']);

        $password = Str::random(8);

        $user = $clinic->user()->create([
            'organization_id' => $clinic->organization_id,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'status' => $data['status'],
            'username' => Str::random(6),
            'password' => Hash::make($password),
        ]);

        $user->attachRole($data['role_id']);

        $details['name'] = $user->first_name . ' ' . $user->last_name;
        $details['email'] = $user->email;
        $details['password'] = $password;
        $details['url'] = route('users.login');

        Mail::to($user->email)->send(new UsersMail($details));

        $response['status'] = true;
        $response['message'] = 'User successfully created';
        return response()->json($response, 200);
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
    public function destroy(Request $request)
    {
        //
        $data = $request->all();

        $validator = Validator::make($data, [
            'user_id' => 'required|integer|exists:users,id'
        ]);

        if($validator->fails()){
            $errors = $validator->errors();
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 401);
        }

        $user = User::findOrFail($data['user_id']);
        $user->delete();

        $response['status'] = true;
        $response['message'] = 'You have successfully removed the current doctor';
        return response()->json($response, 200);
     }
}
