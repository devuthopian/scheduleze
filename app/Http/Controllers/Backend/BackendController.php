<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\BusinessTypes;
use App\ServiceContent;
use App\PageHelper;

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
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showHelpers()
    {
        return view('backend.helpers');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($raw_page)
    {
        if (strpos($raw_page, '_') !== false) {
            $parts = explode('_', $raw_page);
            $page = $parts[0].' '.$parts[1];
            $page_name = ucwords($page);
        } else {
            $page_name = ucwords($raw_page);
        }

        $PageData = PageHelper::where('slug', $raw_page)->first();

        return view('backend.form', compact('page_name', 'PageData', 'raw_page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $raw_page)
    {
        if (preg_match('/^[a-z]+_[a-z]+$/i', $raw_page)) {
            $parts = explode('_', $raw_page);
            $page = $parts[0].' '.$parts[1];
        }
        $page_name = ucwords($raw_page);

        $detail = $request->summernoteInput;
        try {
            $dom = new \domdocument();
            $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        } catch(Exception $e) {
            dd($e);
        }
 
        $images = $dom->getelementsbytagname('img');

        if(!empty($images)) {
            foreach($images as $k => $img){                
                $data = $img->getattribute('src');

                if (\strpos($data, ';') !== false) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                
     
                    $image_name = time().$k.'.png';
                    $path = public_path() .'/'. $image_name;
         
                    file_put_contents($path, $data);

                    $img->removeattribute('src');
                    $img->setattribute('src', '/public/'.$image_name);
                } else {
                    $img->setattribute('src', $data);
                }
                
            }
        }
 
        $detail = $dom->savehtml();

        $PageData = PageHelper::updateOrCreate(
            ['slug' => $raw_page],
            [
                'slug' => $raw_page,
                'page_name' => $page_name, 
                'content' => $detail
            ]
        );

        return redirect('backend/services/helpers/'.$raw_page)->with('message', 'Updated Successfully');

        //return view('backend.form', compact('page_name', 'PageData', 'raw_page'));
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
