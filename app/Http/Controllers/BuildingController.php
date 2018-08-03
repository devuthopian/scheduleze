<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use DB;
use App\PanelTemplate;
use App\Business;
use Session;
use Illuminate\Support\Facades\Hash;
/*use Illuminate\Support\Facades\Route;*/


class BuildingController extends Controller
{

    /**
     * @var Upload path
     */
    protected $businessid = '';
    
    /**
     * Constructor
     */
    public function __construct()
    { 
        // Set the businessid
        $this->businessid = session('business_id');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($name)
    {
        $businessid = $this->businessid;
        $Model = 'App\\'.$name;
        $Building = Business::find($businessid)->$name;
        //$Buildingdesc = $Model::where([['business', $businessid],['removed',0]])->pluck('name', 'id');

        $Modelproduct = new $Model;
        $ColumnName = $Modelproduct->getTableColumns();

        //$Building = $Model::where([['business', $businessid]])->first();
        $BladeName = strtolower($name);
        return view('building.'.$BladeName, compact('Building','name','ColumnName'));
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
        $businessid = $this->businessid;
        $validatedData = Validator::make($request->all(), [
            'price' => 'bail|required',
            'rank' => 'bail|required',
            'forcecall' => 'bail|required',
        ]);

        if ($validatedData->fails()) {
            return redirect('BuildingTypess')->withErrors($validatedData)->withInput();
        }

        $data = Input::get();
        
        /*
        $redirecturl = $data['txtform'];
        $txtForm = 'App\\Dp'.$data['txtform'];
        $htmldata = array_diff_key($data, ['_token' => "xy", 'txtform' => "xy", 'submit' => "xy", 'id' => '0']);
        $BuildingTypes = $txtForm::updateOrCreate(
            ['id' => $data['id'],'business' => $businessid],
            [
                'business' => $businessid,
                'form_html' => json_encode($htmldata['htmlFormat']),
                'builder_area' => json_encode($htmldata['txtBuilderArea'])
            ]
        );*/
        for($i = 0; $i < count($data['desc']); $i++) {
            if(isset($data['selected'][0])){
                if($data['id'][$i] == $data['selected'][0]){
                    $selected = 1;
                }else{
                    $selected = 0;
                }
            }else{
                $selected = 0;
            }
            $redirecturl = $data['txtform'];
            $txtForm = 'App\\'.$data['txtform'];
            $BuildingTypes = $txtForm::updateOrCreate(
                ['id' => $data['id'][$i],'removed' => '0'],
                [
                    'name' => $data['desc'][$i], 
                    'buffer' => $data['buffer'][$i], 
                    'business' => $businessid,
                    'price' => str_replace('$', '', $data['price'][$i]),
                    'status' => $data['forcecall'][$i],
                    'rank' => $data['rank'][$i],
                    'selected' => $selected
                ]
            );
        }
        $txtForm = strtolower($txtForm);

        return redirect('/form/'.$redirecturl)->with('Successfully saved!');
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

    public function updatebuild(Request $request)
    {
        $id = $request->input('id');
        $table = $request->input('table');
        $ModelTable = 'App\\'.$table;
        $BuildingTypes = $ModelTable::where('id',$id)->update(['removed'=> 1]);

        $result = array('msg' => 'Successfully removed!' );

        return json_encode($result);

        /*return redirect('/BuildingTypess')->with('Successfully removed!');*/
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
