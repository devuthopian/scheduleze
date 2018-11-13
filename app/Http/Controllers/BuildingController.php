<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use DB;
use App\PanelTemplate;
use App\Business;
use App\Exceptions;
use App\UserDetails;
use App\ServiceContent;
use Session;
use Illuminate\Support\Facades\Hash;
/*use Illuminate\Support\Facades\Route;*/


class BuildingController extends Controller
{

    /**
     * @var Business ID
     */
    protected $businessid = '';
    
    /**
     * Constructor
     */
    public function __construct()
    { 
        // Set the businessid
        $this->businessid = !empty(session('business_id')) ? session('business_id') : '';
        if(session('permission') == null || session('permission') == 0){
            return redirect('/scheduleze/booking/appointment')->send();
        }
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

        $Building = !empty(Business::find($businessid)->$name) ? Business::find($businessid)->$name : '';
        //$Buildingdesc = $Model::where([['business', $businessid],['removed',0]])->pluck('name', 'id');

        $Modelproduct = new $Model;
        $ColumnName = $Modelproduct->getTableColumns();        

        $users_details = DB::table('users')
        ->join('users_details', 'users.id', '=', 'users_details.user_id')
        ->select('users.id', 'users.name', 'users_details.administrator')
        ->where('users_details.business', '=', $businessid)
        ->get();

        $ServiceContent = ServiceContent::where([['business_type_id', '=', session('indus_id')],['business', '=', $this->businessid]])->first();

        //$Building = $Model::where([['business', $businessid]])->first();
        $BladeName = strtolower($name);

        if ($name == 'BuildingTypes'){
            $type = 1;
        }elseif ($name == 'BuildingSizes') {
            $type = 2;
        }elseif ($name == 'BuildingAges') {
            $type = 3;
        }else{
            $type = 4;
        }

        $exception = Exceptions::select('exception','user_id')->where('type', $type)->get();

        return view('building.'.$BladeName, compact('Building', 'name', 'ColumnName', 'exception', 'users_details', 'ServiceContent'));
    }


    public function storeServiceContent(Request $request)
    {
        $data = Input::get();
        
        $BusinessTypes = ServiceContent::updateOrCreate(
            ['business' => $this->businessid, 'business_type_id' => $data['txtBusinessType']],
            [
                'type_content' => $data['building_type'],
                'size_content' => $data['building_size'],
                'age_content' => $data['building_age'],
                'add_on_service_content' => $data['add_on_service']
            ]
        );

        return redirect('/services/content')->with('message', trans('scheduleze.MessageServiceContent'));
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
        $data = Input::get();

        $collection = get_bus_users();

        foreach ($data['desc'] as $key => $value) {

            $col = array();
            foreach ($collection as $keycol => $value) {
                $col[] = $collection[$keycol]->user_id;
                $resevercol[] = $collection[$keycol]->user_id;
            }
            if(isset($data['desc']) && !empty($data['desc'][$key])){
                if(isset($data['selected'][0])){
                    if($data['id'][$key] == $data['selected'][0]){
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
                    ['id' => $data['id'][$key],'removed' => '0'],
                    [
                        'name' => $data['desc'][$key], 
                        'buffer' => $data['buffer'][$key], 
                        'business' => $businessid,
                        'price' => str_replace('$', '', $data['price'][$key]),
                        'status' => $data['forcecall'][$key],
                        'rank' => $data['rank'][$key],
                        'selected' => $selected
                    ]
                );
            }
            
            
            if(isset($data['selectedusers'][$key]) && !empty($data['selectedusers'][$key])){
                foreach ($col as $k => $value) { //
                    if(in_array($col[$k], $data['selectedusers'][$key])){
                        unset($col[$k]);
                    }
                }
            }

            $type = $data['txtform'];
            if ($type == 'BuildingTypes'){
                $type = 1;
            }elseif ($type == 'BuildingSizes') {
                $type = 2;
            }elseif ($type == 'BuildingSizes') {
                $type = 3;
            }else{
                $type = 4;
            }

            if(isset($col) && !empty($col)){
                foreach ($col as $keysel => $v) {
                    Exceptions::updateOrCreate(
                        ['exception' => $BuildingTypes->id, 'type' => $type, 'user_id' => $col[$keysel]],
                        [
                            'user_id' => $col[$keysel],
                            'exception' => $BuildingTypes->id,
                            'type' => $type
                        ]
                    );
                }
            }
        }

        $txtForm = strtolower($txtForm);

        return redirect('/scheduleze/appointments')->with('message', trans('scheduleze.MessageforSuccess'));
    }

    public function storeException(Request $request)
    {
        $data = Input::get();
        //dd($data);
        if ($data['type'] == 'BuildingTypes'){
            $type = 1;
        }elseif ($data['type'] == 'BuildingSizes') {
            $type = 2;
        }elseif ($data['type'] == 'BuildingAges') {
            $type = 3;
        }else{
            $type = 4;
        }

        if(isset($data['user_id'])){
            //for ($i=0; $i < count($data['user_id']); $i++) {
            foreach ($data['user_id'] as $key => $value) {

                $exception = Exceptions::updateOrCreate(
                    ['exception' => $data['exception'], 'type' => $type, 'user_id' => $data['user_id'][$key]],
                    [
                        'user_id' => $data['user_id'][$key],
                        'exception' => $data['exception'],
                        'type' => $type
                    ]
                );
            }
        }else{
            $exception = Exceptions::where([['exception', '=', $data['exception']],['type','=',$type]])->delete();
        }

        $Success = array(
            'success' => 'true' 
        );

        return json_encode($Success);
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
