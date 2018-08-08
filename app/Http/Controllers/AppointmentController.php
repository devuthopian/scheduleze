<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appointment;
//use App\AppointmentForm;
use App\Business;
use Session;
use DB;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = session('id');
        $businessinfo = Business::where('user_id',$id)->first();
        $ages = !empty($businessinfo->BuildingAges) ? $businessinfo->BuildingAges : '';
        $sizes = !empty($businessinfo->BuildingSizes) ? $businessinfo->BuildingSizes : '';
        $types = !empty($businessinfo->BuildingTypes) ? $businessinfo->BuildingTypes : '';
        $addons = !empty($businessinfo->Addons) ? $businessinfo->Addons : '';

        if($businessinfo){
            $Location = $businessinfo->Location->pluck('name', 'id');
        }else{
            $Location = '';
        }

        return view('appointments.index', compact('businessinfo', 'ages', 'sizes', 'types','addons','Location'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function destroy($id)
    {
        //
    }
}
