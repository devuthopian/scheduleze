<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\BusinessTypes;
use App\ServiceContent;

class BackendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(session('backend_admin') != 1) {
            return redirect('/scheduleze/booking/appointment')->with('warning', 'you can\'t access backend');
        }
        //
        $data = Input::get();

        if(!empty($data['name'])) {

            foreach ($data['name'] as $key => $value) {
                BusinessTypes::updateOrCreate(
                    ['id' => $data['id'][$key], 'removed' => '0'],
                    [
                        'business' => $data['business'][$key],
                        'type_label' => $data['type_label'][$key],
                        'size_label' => $data['size_label'][$key],
                        'age_label' => $data['age_label'][$key],
                        'agent_name' => $data['name'][$key],
                        'addon_label' => $data['addon_label'][$key],
                        'directory' => strtolower(str_replace(' ', '_', $data['name'][$key])).'/'
                    ]
                );
            }
        }

        $BusinessTypes = BusinessTypes::where('removed', 0)->get();
        return view('backend.Industries', compact('BusinessTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function changeContent()
    {
        if(session('backend_admin') != 1) {
            return redirect('/scheduleze/booking/appointment')->with('warning', 'you can\'t access backend');
        }
        
        $data = Input::get();
        $default = !empty($data) ? $data['txtIndustries'] : '1';
        
        $BusinessTypes = BusinessTypes::where('id', $default)->first();
        $ServiceContent = ServiceContent::where('business_type_id', $default)->first();

        return view('backend.ServiceContent', compact('BusinessTypes', 'ServiceContent'));
    }


    public function storeServiceContent(Request $request)
    {
        $data = Input::get();
        
        $BusinessTypes = ServiceContent::updateOrCreate(
            ['business_type_id' => $data['txtBusinessType']],
            [
                'type_content' => $data['building_type'],
                'size_content' => $data['building_size'],
                'age_content' => $data['building_age'],
                'add_on_service_content' => $data['add_on_service']
            ]
        );

        return redirect('backend/services/content')->with('message', trans('scheduleze.MessageServiceContent'));
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
