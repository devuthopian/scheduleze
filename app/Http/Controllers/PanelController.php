<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\PanelTemplate;
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

        $template = json_encode([
          'gjs-components'=> $template->gjs_components,
          'gjs-styles'=> $template->gjs_styles,
          'gjs-assets'=> $template->gjs_assets,
          'gjs-css'=> $template->gjs_css,
          'gjs-html'=> $template->gjs_html,
          'url' => $template->unqiue_url
        ]);        
        

        return $template;
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
    public function store(Request $request, $id)
    {
        $username = Session::get('username');
        $hashvalue = Session::get('hashvalue');
        $data = Input::get();
        if(empty($hashvalue)){
            $hashvalue = str_replace ('/', '', Hash::make($username, ['Saringan'=>'Naruto Uzumaki! Road To Ninja.']));
        }
        $PanelTemplate = PanelTemplate::updateOrCreate(
            ['user_id' => $id],
            [
                'gjs_assets' => $data['gjs-assets'], 
                'gjs_css' => $data['gjs-css'], 
                'gjs_styles' => $data['gjs-styles'],
                'gjs_html' => $data['gjs-html'],
                'gjs_components' => $data['gjs-components'],
                'unqiue_url' => $hashvalue
            ]
        );
        if($PanelTemplate->id){
            $ans = array('message' => 'Successfully Saved!', 'sharelink' => $PanelTemplate->unqiue_url );
            return json_encode($ans);
        }else{
            $ans = array('message' => 'Soemthing went wrong' );
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
