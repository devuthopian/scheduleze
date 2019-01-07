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

        $Model = 'App\\Building'.$name;
        $modelTableName = 'Building'.$name;
        $BladeName = 'building'.strtolower($name);

        $Building = !empty(Business::find($businessid)->$modelTableName) ? Business::find($businessid)->$modelTableName : '';

        if($name == 'Addons'){
            $Model = 'App\\'.$name;
            $BladeName = strtolower($name);
            $Building = !empty(Business::find($businessid)->$name) ? Business::find($businessid)->$name : '';
        }

        //$Building = !empty(Business::find($businessid)->$name) ? Business::find($businessid)->$name : '';
        //$Buildingdesc = $Model::where([['business', $businessid],['removed',0]])->pluck('name', 'id');

        $Modelproduct = new $Model;
        $ColumnName = $Modelproduct->getTableColumns();        

        $users_details = DB::table('users')
        ->join('users_details', 'users.id', '=', 'users_details.user_id')
        ->select('users.id', 'users_details.name', 'users_details.administrator')
        ->where('users_details.business', '=', $businessid)
        ->get();

        $ServiceContent = ServiceContent::where([['business_type_id', '=', session('indus_id')],['business', '=', $this->businessid]])->first();

        //$Building = $Model::where([['business', $businessid]])->first();
        

        if ($name == 'Types') {
            $type = 1;
        } elseif ($name == 'Sizes') {
            $type = 2;
        } elseif ($name == 'Ages') {
            $type = 3;
        } else {
            $type = 4;
        }

        $getbusindus = getBusinessIndustry(session('indus_id'));

        $exception = Exceptions::select('exception','user_id')->where('type', $type)->get();
        $nameStrLower = strtolower(substr_replace($name, "", -1)).'_label';
        $labelName = $getbusindus->$nameStrLower;

        return view('building.'.$BladeName, compact('Building', 'name', 'ColumnName', 'exception', 'users_details', 'ServiceContent', 'labelName'));
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

                if($data['txtform'] == 'Addons') {
                    $txtForm = 'App\\'.$data['txtform'];
                }  else {
                    $txtForm = 'App\\Building'.$data['txtform'];
                }

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
            if ($type == 'Types') {
                $type = 1;
            } elseif ($type == 'Sizes') {
                $type = 2;
            } elseif ($type == 'Ages') {
                $type = 3;
            } else {
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
        if ($data['type'] == 'Types'){
            $type = 1;
        }elseif ($data['type'] == 'Sizes') {
            $type = 2;
        }elseif ($data['type'] == 'Ages') {
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
        if($table == 'Addons' || $table == 'BusinessTypes' || $table == 'Location') {
            $ModelTable = 'App\\'.$table;
        }
        else {
            $ModelTable = 'App\\Building'.$table;
        }
        $ModelTable::where('id',$id)->update(['removed'=> 1]);

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
