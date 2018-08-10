<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appointment;
//use App\AppointmentForm;
use App\Business;
use App\BusinessHours;
use App\PanelForm;
use Illuminate\Support\Facades\Input;
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

        return view('appointments.index', compact('businessinfo', 'ages', 'sizes', 'types','addons','Location','id'));
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
    public function storebusinesshours(Request $request)
    {
        $id = session('id');
        $business_id = session('business_id');

        $data = Input::get();
        //dd(count($data['houropen']));
        for($i = 0; $i < count($data['houropen']); $i++) {
            $totalstart = $data['houropen'][$i].$data['minuteopen'][$i];
            if ($data['amopen'][$i]=="PM") {
                if ($data['houropen'][$i]!="12") {
                    $totalstart = ($totalstart + 1200);
                }
            } else { //AM case
                if ($data['houropen'][$i]=="12") {
                    $totalstart= "00".$data['minuteopen'][$i];
                }
            }

            $totalend = $data['hourclose'][$i].$data['minuteclose'][$i];
            if ($data['amclose'][$i]=="PM") {
                if ($data['hourclose'][$i]!="12") {
                    $totalend = ($totalend + 1200);
                }
            } else { //AM case
                if ($data['hourclose'][$i]=="12") {
                    $totalend= "00".$data['minuteclose'][$i];
                }
            }
            $BuildingTypes = BusinessHours::updateOrCreate(
                ['user_id' => $id,'day' => $i],
                [
                    'user_id' => $id,
                    'business' => $business_id, 
                    'starttime' => $totalstart, 
                    'endtime' => $totalend,
                    'day' => $i
                ]
            );
        }
        return redirect('/scheduleze/BusinessHours')->with('Successfully saved!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function bookingform(Request $request)
    {
        //$id = Session::get('id');
        //$hashvalue = Session::get('hashvalue');
        $data = Input::get();
        //session(['appointments' => $data]);
        //$username = session('username');
        $panel_id = session('panel_id');

        $PanelForm = PanelForm::where('panel_id',$panel_id)->first();

        return view('appointments.appointment_form', compact('PanelForm','data'));
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
