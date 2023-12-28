<?php

namespace App\Http\Controllers\Users\Cases;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CaseStocksController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');   
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $user = User::findOrFail(Auth::user()->id);
        $clinic = $user->clinic;
        $page_title = trans('users.page.inventory.sub_page.cases');
        return view('users.cases.index', [
            'clinic' => $clinic,
            'page_title' => $page_title
        ]);
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
    }
}
