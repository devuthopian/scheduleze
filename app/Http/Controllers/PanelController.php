<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\PanelTemplate;
use App\AppointmentForm;
use App\UserDetails;
use App\PanelDefault;
use Session;
use Illuminate\Support\Facades\Hash;
use DB;
use File;
use Storage;

class PanelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, $panel_defualt = '')
    {
        $data = '';
        $business_id = session('business_id');
        if(!empty($panel_defualt)){
            $template = PanelDefault::where('business', $business_id)->first();
        }
        else{
            $template = PanelTemplate::where('business', $business_id)->first();
        }

        if(!empty($template)){
            Session::put('hashvalue', $template->unique_url);

            $data = json_encode([
              'gjs-components'=> $template->gjs_components,
              'gjs-styles'=> $template->gjs_styles,
              'gjs-assets'=> $template->gjs_assets,
              'gjs-css'=> $template->gjs_css,
              'gjs-html'=> $template->gjs_html,
              'url' => $template->unique_url
            ]);
        }
        

        return $data;
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

    public function storeAppointment(Request $request)
    {
        $id = Session::get('id');
        $hashvalue = Session::get('hashvalue');
        $data = Input::get();
        $username = session('username');
        $business_id = session('business_id');

        if(empty($hashvalue)){
            $hashvalue = str_replace ('/', '', Hash::make($username, ['Saringan'=>'Naruto Uzumaki! Road To Ninja.']));
            Session::put('hashvalue', $hashvalue);
        }
        $paneltemp = PanelTemplate::where('business', $business_id)->first();
        if($paneltemp){
            $gjs_html = $paneltemp->gjs_html;
            if(!empty($gjs_html)){
                $new_html = $data['gjs_html'];
                $new_html = str_replace("$","\\$",$new_html);
                $divid = "dontbreakdiv";
                $gjs_html = preg_replace("#<div[^>]*id=\"{$divid}\".*?</div>#si",$new_html,$gjs_html);
                $gjs_css = $paneltemp->gjs_css;
            }else{
                $gjs_html = $data['gjs_html'];
                $gjs_css = $data['gjs_css'];
            }
        }else{
            $gjs_html = $data['gjs_html'];
            $gjs_css = $data['gjs_css'];
        }

        $PanelTemplate = PanelTemplate::updateOrCreate(
            ['business' => $business_id],
            [   
                'business' => $business_id,
                'gjs_html' => $gjs_html,
                'unique_url' => $hashvalue,
                'gjs_css' => $gjs_css
            ]
        );

        $PanelDefault = PanelDefault::where('business', $business_id)->first();
        if($PanelDefault){
            $gjs_html = $PanelDefault->gjs_html;
            if(!empty($gjs_html)){
                $new_html = $data['gjs_html'];
                $new_html = str_replace("$","\\$",$new_html);
                $divid = "dontbreakdiv";
                $gjs_html = preg_replace("#<div[^>]*id=\"{$divid}\".*?</div>#si",$new_html,$gjs_html);
                $gjs_css = $PanelDefault->gjs_css;
            }else{
                $gjs_html = $data['gjs_html'];
                $gjs_css = $data['gjs_css'];
            }
        }else{
            $gjs_html = $data['gjs_html'];
            $gjs_css = $data['gjs_css'];
        }

        $PanelDefault = PanelDefault::updateOrCreate(
            ['business' => $business_id],
            [   
                'business' => $business_id,
                'gjs_html' => $gjs_html,
                'unique_url' => $hashvalue,
                'gjs_css' => $gjs_css
            ]
        );

        
        if($PanelTemplate->id){
            $ans = array('message' =>  trans('scheduleze.MessageforSuccess'));
            return json_encode($ans);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        //$username = Session::get('username');
        $username = session('username');
        $business_id = session('business_id');
        $hashvalue = Session::get('hashvalue');
        $indus_id = Session::get('indus_id');

        $Industry_name = get_field("industries", "page_name", $indus_id);
        $data = Input::get();
        $dbimages = json_decode($data['gjs-assets'], true);

        if(empty($hashvalue)){
            $hashvalue = str_replace ('/', '', Hash::make($username, ['Saringan'=>'Naruto Uzumaki! Road To Ninja.']));
            Session::put('hashvalue', $hashvalue);
        }

        if(empty($data['gjs-styles'])){
            $gjs_styles = '';
        }else{
            $gjs_components = $data['gjs-styles'];
        }
        if(empty($data['gjs-components'])){
            $gjs_components = '';
        }else{
            $gjs_components = $data['gjs-components'];
        }
        $PanelTemplate = PanelTemplate::updateOrCreate(
            ['business' => $business_id],
            [
                'gjs_assets' => $data['gjs-assets'], 
                'gjs_css' => $data['gjs-css'], 
                'gjs_styles' => $gjs_styles,
                'gjs_html' => $data['gjs-html'],
                'gjs_components' => $gjs_components,
                'unique_url' => $hashvalue
            ]
        );


        Storage::makeDirectory('/template/'.$Industry_name.'/'.$business_id, 0777, true);
        Storage::disk('custom_local')->put($Industry_name.'/'.$business_id.'/index.html', $data['gjs-html']);
        Storage::disk('custom_local')->append($Industry_name.'/'.$business_id.'/index.html', '<style>'.$data['gjs-css'].'</style>');
        Storage::disk('custom_local')->put($Industry_name.'/'.$business_id.'/'.$dbimages[0]['src'], $dbimages[0]['src']);
        
        if($PanelTemplate->id){
            session(['panel_id' => $PanelTemplate->id]);
            $ans = array('message' => trans('scheduleze.MessageforSuccess'), 'sharelink' => $PanelTemplate->unique_url );
            return json_encode($ans);
        }else{
            $ans = array('message' => trans('scheduleze.MessageforWarning') );
            return json_encode($ans);
        }
    }

     /**
     * Store a newly created resource in storage by image.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveimagetemplate(Request $request, $id)
    {
        $indus_id = Session::get('indus_id');
        $Industry_name = get_field("industries", "page_name", $indus_id);

        $business_id = session('business_id');
        $template = PanelTemplate::where('business', $business_id)->first();
        $files = $request->file();

        $hashvalue = Session::get('hashvalue');
        if(empty($hashvalue)){
            $hashvalue = str_replace ('/', '', Hash::make($username, ['Saringan'=>'Naruto Uzumaki! Road To Ninja.']));
            Session::put('hashvalue', $hashvalue);
        }

        if($template){
            $dbimages = json_decode($template->gjs_assets, true);
        }else{
            $dbimages = '';
        }

        foreach($files as $key){
            foreach ($key as $value) {
                $name = $value->getClientOriginalName();
                $getFilename = $value->getFilename();
                $value->move( 'template/view/images/', $name );

                File::copy(base_path('template/view/images/'.$name), base_path('scheduling/view/images/'.$name));
                Storage::disk('custom_local')->put($Industry_name.'/'.$business_id.'/view/images/'.$name, $name);

                $filename[] = array('type' => 'image','src' => 'images/'.$name, "unitDim" => "px","height" => 0,"width" => 0 );
                $viewfile[] = array('type' => 'image','src' => 'view/images/'.$name, "unitDim" => "px","height" => 0,"width" => 0 );
            }
        }

        if(!empty($dbimages)){
            $result = array_merge($dbimages, $filename);
        }else{
            $result = $filename;
        }

        $PanelTemplate = PanelTemplate::updateOrCreate(
            ['business' => $business_id],
            [
                'gjs_assets' => json_encode($result),
                'unique_url' => $hashvalue
            ]
        );

        if($PanelTemplate->id){
            session(['panel_id'=>$PanelTemplate->id]);
            $ans = array('data' => $viewfile );
            return json_encode($ans);
        }
    }

    /**
     * Download the zip file (we are not using it, right now.. until he asked for it to download the template from server)
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function zipFileDownload()
    {
        $business_id = session('business_id');

        $indus_id = Session::get('indus_id');
        $Industry_name = get_field("industries", "page_name", $indus_id);

        $zipFileName = Carbon\Carbon::now().'.zip';
        $zip = new ZipArchive;
        $files = Storage::disk('custom_local')->allFiles($Industry_name.'/'.$business_id);

        if ($zip->open('storage/app/' .$Industry_name.'/'.$business_id .'/'. $zipFileName, ZipArchive::CREATE) === TRUE) { 
            foreach($files as $file) {
                $zip->addFile($file->file_path, $file->file_name);
            }    
            $zip->close();
        }
        $headers = array(
            'Content-Type' => 'application/octet-stream',
        );

        $filetopath = 'storage/app/' .$Industry_name.'/'.$business_id .'/'.$zipFileName;
        if(file_exists($filetopath)){
            return response()->download($filetopath, $zipFileName, $headers);
        }
        return ['status'=>'file does not exist'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $business_id = session('business_id');
        $user_id = session('id');
        $administrator = session('administrator');
        $permission = session('permission');

        if($permission == 0){
            $inspectors = UserDetails::where([['user_id', '=', $user_id],['removed', '=', '0']])->get();
        }else{
            $inspectors = UserDetails::where([['business', '=', $business_id],['removed', '=', '0']])->get();
        }

        $template = PanelTemplate::where('unique_url', $id)->orWhere('id', $id)->first();
        session(['panel_id' => $template->id]);

        if(empty($business_id)){
            $business_id = get_field('users_details', 'business', $template->user_id);
            session(['business_id' => $business_id]);
    
            get_business_information($business_id);

            $inspectors = UserDetails::where([['business', '=', $business_id],['removed', '=', '0']])->get();
        }    

        return view('building.template', compact('template','inspectors'));
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
        $data = Input::get();

        foreach ($data as $key => $value) {
            $fieldname[$key] = $value;
        }
        $AppointmentForm = AppointmentForm::updateOrCreate(
            ['user_id' => $id],
            [
                'admin_id' => $data['txtId'],
                'form_fields_name' => json_encode($fieldname)
            ]
        );
        if($AppointmentForm->id){
            Session::flash('status', 'Form was successfully Saved!');
            return redirect('/scheduling_solutions');
        }else{
            Session::flash('status',  trans('scheduleze.MessageforWarning'));
            return redirect('/scheduling_solutions');
        }
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
