<?php

namespace App\Http\Controllers\Users\Patients;

use Carbon\Carbon;
use App\Models\Clinic;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\Patients\StoreSelfRegistrationRequest;

class SelfRegistrationController extends Controller
{
    //
    public function register(Clinic $clinic)  
    {
        $page_title = "Patient Registration";
        return view('users.patients.register', [
            'clinic' => $clinic,
            'page_title' => $page_title,
        ]); 
    }

    public function store(StoreSelfRegistrationRequest $request, Clinic $clinic)  
    {
        $data = $request->all();

        $patient = new Patient;
        
        $patient->clinic_id = $clinic->id;
        $patient->first_name = $data['first_name'];
        $patient->last_name = $data['last_name'];
        $patient->id_number = $data['id_number'];
        $patient->phone = $data['phone'];
        $patient->email = $data['email'];
        $patient->dob = $data['dob'];
        $patient->gender = $data['gender'];
        $patient->address = $data['address'];
        $patient->next_of_kin = $data['next_of_kin'];
        $patient->next_of_kin_contact = $data['next_of_kin_contact'];
        $patient->date_in = Carbon::now()->format('Y-m-d');

        if ($patient->save()) {
            $response['status'] = true;
            $response['message'] = 'Patient created successfully';
            return response()->json($response, 200);
        }
    }
}
