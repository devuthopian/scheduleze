<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\PanelTemplate;
use App\AppointmentForm;
use Session;
use Illuminate\Support\Facades\Hash;
use DB;

class PanelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $template = PanelTemplate::where('user_id',$id)->first();
        Session::put('hashvalue', $template->unqiue_url);

        $data = json_encode([
          'gjs-components'=> $template->gjs_components,
          'gjs-styles'=> $template->gjs_styles,
          'gjs-assets'=> $template->gjs_assets,
          'gjs-css'=> $template->gjs_css,
          'gjs-html'=> $template->gjs_html,
          'url' => $template->unqiue_url
        ]);        
        

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

        if(empty($hashvalue)){
            $hashvalue = str_replace ('/', '', Hash::make($username, ['Saringan'=>'Naruto Uzumaki! Road To Ninja.']));
            Session::put('hashvalue', $hashvalue);
        }
        $paneltemp = PanelTemplate::where('user_id',$id)->first();
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
            ['user_id' => $id],
            [   
                'user_id' => $id,
                'gjs_html' => $gjs_html,
                'unqiue_url' => $hashvalue,
                'gjs_css' => $gjs_css
            ]
        );
        if($PanelTemplate->id){
            $ans = array('message' => 'Successfully Saved!' );
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
        $hashvalue = Session::get('hashvalue');
        $data = Input::get();
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
            ['user_id' => $id],
            [
                'gjs_assets' => $data['gjs-assets'], 
                'gjs_css' => $data['gjs-css'], 
                'gjs_styles' => $gjs_styles,
                'gjs_html' => $data['gjs-html'],
                'gjs_components' => $gjs_components,
                'unqiue_url' => $hashvalue
            ]
        );
        if($PanelTemplate->id){
            session(['panel_id'=>$PanelTemplate->id]);
            $ans = array('message' => 'Successfully Saved!', 'sharelink' => $PanelTemplate->unqiue_url );
            return json_encode($ans);
        }else{
            $ans = array('message' => 'Something went wrong' );
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
        $template = PanelTemplate::where('user_id',$id)->first();
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
                $value->move(public_path( 'template/view/images/' ), $name );
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
            ['user_id' => $id],
            [
                'gjs_assets' => json_encode($result),
                'unqiue_url' => $hashvalue
            ]
        );

        if($PanelTemplate->id){
            session(['panel_id'=>$PanelTemplate->id]);
            $ans = array('data' => $viewfile );
            return json_encode($ans);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $template = PanelTemplate::where('unqiue_url',$id)->orWhere('id', $id)->first();
        session(['panel_id' => $template->id]);
        return view('building.template', compact('template'));
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
            Session::flash('status', 'Something Went Wrong!');
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
