<?php

namespace App\Http\Controllers\Admin\Admins;

use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rules\MatchAdminOldPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        # code...
        $admin = Admin::findOrFail(Auth::guard('admin')->user()->id);
        if ($request->ajax()) {
            $data = Admin::latest()->get();
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('full_names', function ($row) {
                    return $row->first_name . ' ' . $row->last_name;
                })
                ->addColumn('profile', function ($row) {
                    $profile = '<img src="' . asset('storage/admin/' . $row->profile) . '" alt="Product 1" class="img-circle img-size-32 mr-2">';
                    return $profile;
                })
                ->addColumn('action', function ($row) {
                })
                ->rawColumns(['action', 'full_names', 'profile'])
                ->make(true);
        }
        $page_title = 'Admin Profile';
        return view('admin.admins.index', [
            'admin' => $admin,
            'page_title' => $page_title,
        ]);
    }

    public function create()
    {
        $page_title = "admins";
        return view('admin.admins.create', [
            'page_title' => $page_title
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->except("_token");

        $validator = Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'profile' => 'image|mimes:jpeg,png,jpg,gif,svg|nullable',
            'phone' => 'required|string|max:255|unique:admins,phone,' . Auth::guard('admin')->user()->id,
            'email' => 'required|string|email|max:255|unique:admins,email,' . Auth::guard('admin')->user()->id,
            'gender' => 'required|string',
            'dob' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 422);
        }

        if ($request->hasFile('profile')) {
            // file name with extension
            $profileNameWithExt = $request->file('profile')->getClientOriginalName();

            // Get Filename
            $profileName = pathinfo($profileNameWithExt, PATHINFO_FILENAME);

            // Get just Extension
            $extension = $request->file('profile')->getClientOriginalExtension();

            // Filename To store
            $profileNameToStore = $profileName . '_' . time() . '.' . $extension;

            // Upload Image
            $path = $request->file('profile')->storeAs('public/admin', $profileNameToStore);
        } else {
            $profileNameToStore = "noimage.png";
        }

        $admin = new Admin;

        $admin->first_name = $data['first_name'];
        $admin->last_name = $data['last_name'];
        $admin->profile = $profileNameToStore;
        $admin->phone = $data['phone'];
        $admin->email = $data['email'];
        $admin->gender = $data['gender'];
        $admin->dob = $data['dob'];
        $admin->username =  $data['first_name'];
        $password = Str::random(6);
        $admin->password = Hash::make($password);
        if ($admin->save()) {
            $admin->sendMail($admin->email, $password);
            $response['status'] = true;
            $response['messsage'] = 'You have successfully updated your profile';

            return response()->json($response, 200);
        }
    }

    public function profile()
    {
        $admin = Admin::findOrFail(Auth::guard('admin')->user()->id);
        $page_title = 'Admin Profile';
        return view('admin.admins.profile', [
            'admin' => $admin,
            'page_title' => $page_title,
        ]);
    }

    public function update(Request $request)
    {
        # code...
        $data = $request->all();

        $validator = Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'profile' => 'image|mimes:jpeg,png,jpg,gif,svg|nullable',
            'phone' => 'required|string|max:255|unique:admins,phone,' . Auth::guard('admin')->user()->id,
            'email' => 'required|string|email|max:255|unique:admins,email,' . Auth::guard('admin')->user()->id,
            'gender' => 'required|string',
            'dob' => 'required',
            'username' => 'required|string|max:255|unique:admins,username,' . Auth::guard('admin')->user()->id,
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 422);
        }

        if ($request->hasFile('profile')) {
            // file name with extension
            $profileNameWithExt = $request->file('profile')->getClientOriginalName();

            // Get Filename
            $profileName = pathinfo($profileNameWithExt, PATHINFO_FILENAME);

            // Get just Extension
            $extension = $request->file('profile')->getClientOriginalExtension();

            // Filename To store
            $profileNameToStore = $profileName . '_' . time() . '.' . $extension;

            // Upload Image
            $path = $request->file('profile')->storeAs('public/admin', $profileNameToStore);
        }

        $admin = Admin::findOrFail(Auth::guard('admin')->user()->id);

        $admin->id = $admin->id;
        $admin->first_name = $data['first_name'];
        $admin->last_name = $data['last_name'];
        if ($request->hasFile('profile')) {
            $admin->profile = $profileNameToStore;
        }
        $admin->phone = $data['phone'];
        $admin->email = $data['email'];
        $admin->gender = $data['gender'];
        $admin->dob = $data['dob'];
        $admin->username = $data['username'];

        $admin->save();

        $response['status'] = true;
        $response['messsage'] = 'You have successfully updated your profile';

        return response()->json($response, 200);
    }

    public function update_password(Request $request)
    {
        # code...
        $data = $request->all();

        $validator = Validator::make($data, [
            'current_password' => ['required', new MatchAdminOldPassword],
            'new_password' => ['required', 'min:6'],
            'confirm_password' => ['required', 'min:6', 'same:new_password'],
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 422);
        }

        $admin = Admin::findOrFail(Auth::guard('admin')->user()->id);

        $admin->id = $admin->id;
        $admin->password = Hash::make($data['new_password']);

        $admin->save();

        $response['status'] = true;
        $response['message'] = 'Password updated successfully';
        return response()->json($response, 200);
    }

    public function logout()
    {
        # code...
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
