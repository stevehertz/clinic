<?php

namespace App\Http\Controllers\Admin\Admins;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Rules\MatchAdminOldPassword;
use Illuminate\Http\Request;
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

    public function index()
    {
        # code...
        $admin = Admin::findOrFail(Auth::guard('admin')->user()->id);
        $page_title = 'Admin Profile';
        return view('admin.admins.index', [
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
            'username' => 'required|string|max:255|unique:admins,username,'.Auth::guard('admin')->user()->id,
        ]);

        if($validator->fails()){
            $errors = $validator->errors();
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 422);
        }

        if($request->hasFile('profile')){
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
        if($request->hasFile('profile')){
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

        if($validator->fails()){
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
