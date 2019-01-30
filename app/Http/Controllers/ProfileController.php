<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Business;
use App\UserDetails;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use DB;
use File;


class ProfileController extends Controller
{
    protected $business_id = '';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->business_id = session('business_id');
    }

    public function profile_validator(array $data)
    {
        return Validator::make($data, [
            'firstname'         => 'required',
            'lastname'          => 'required',
            'password'          => 'confirmed',
        ]);
    }

   public function business_profile_validator(array $data)
    {
        return Validator::make($data, [
            'business_name'     => 'required',
            'business_fname'    => 'required',
            'business_lname'    => 'required',
        ]);
    }

    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Http\Response
    */
    public function UserProfile($id = null)
    {
        if(empty($id)){
            $userid           =   Auth::id();
        }else{
            $userid           =   $id;
        }

        $UserData =   UserDetails::where('user_id', $userid)->first();
        $allindustries = getallIndustries();

        $data = [
            'UserData' => $UserData,
            'allindustries' => $allindustries
        ];

        return view('profiles.UserProfileEdit')->with($data);
    }

    public function RemoveUserProfile($id = '')
    {
        DB::table('users_details')->where('user_id', $id)->update(['removed' => 1]);

        return redirect('/scheduleze/inspectors')->with('message', 'successfully removed');
    }

    public function SaveEmailAttachment(Request $request)
    {
        Validator::make($request->file(), [
            'file' => 'required|max:10000|mimes:doc,docx,pdf,jpg',
        ])->validate();

        $data = Input::get();
        $files = $request->file();

        foreach($files as $key){
            $name = $key->getClientOriginalName();
            //$keyextension = $key->getClientOriginalExtension();
            $getFilename = $key->getFilename();
            $key->move(public_path( 'attachments/'.$this->business_id ), $name );
        }
        
        $business = Business::where('id', $this->business_id)->update(['email_attachment' => $name]);

        return view('profiles.EmailAttachment', compact('name'));
    }

    public function updateUserAccount(Request $request)
    {
        $userid = $request->input('userid');
        
        if(empty($userid)){
            $userid            =   Auth::id();
        }

        $profile_validator = $this->profile_validator($request->all());
        if ($profile_validator->fails()) {
            return back()->withErrors($profile_validator)->withInput();
        }

        $indus_id = $request->input('typework');


        $UserDetails = UserDetails::firstOrNew(array('user_id' => $userid));
        $UserDetails->user_id        = $userid;

        if(is_numeric($indus_id)) {
            $UserDetails->indus_id   = $indus_id;
        } else {
            $UserDetails->custom_indus_name   = $indus_id;
        }
        
        $UserDetails->name           = $request->input('firstname');
        $UserDetails->lastname       = $request->input('lastname');
        $UserDetails->email2         = $request->input('backupEmail');
        $UserDetails->padding_day    = $request->input('padding_day');
        $UserDetails->look_ahead     = $request->input('day_forward');
        $UserDetails->throttle       = $request->input('throttle');
        $UserDetails->permission     = $request->input('permission');
        $UserDetails->user->name     = $request->input('username');
        $UserDetails->user->email    = $request->input('Email');
        if(!empty($request->input('password'))){
            $UserDetails->user->password     = bcrypt($request->input('password'));
        }
        $UserDetails->business       = session('business_id');
        $UserDetails->save();
        $UserDetails->user->save();

        if(is_numeric($indus_id)) {
            $IndustryName = get_field('business_types', 'business', $indus_id); //tablename, columnname, Id
            session(['IndustryName' => $IndustryName]);
        } else {
            session(['IndustryName' => $indus_id]);
        }
      
        return redirect('/profile')->with('message', trans('profile.updateSuccess'));
    }

    public function UserBusinessProfile()
    {
        //$userid           =   Auth::id();
        $business_id = session('business_id');
        $admin_user_id = UserDetails::where([['business', '=', $business_id], ['administrator', '=', 1]])->first();
        $UserBusinessData = Business::where('user_id', $admin_user_id->user_id)->first();

        //$panel_template = DB::table('panel_template')->select('unique_id')->where([['user_id', '=', $admin_user_id->user_id],['marked_domain', '=', 1]])->first();

        session(['user_logo' => $admin_user_id->upload_logo]);

        $data = [
            'UserBusinessData' => $UserBusinessData,
            'admin_user_id' => $admin_user_id->user_id
        ];

        return view('profiles.UserBusinessProfileEdit')->with($data);
    }
    public function updateUserBusinessAccount(Request $request)
    {
        $permission = session('permission');
        $administrator = session('administrator');
        $business_id = session('business_id');

        if($permission == 0){
            return redirect('/business_info')->with('warning', trans('profile.warning'));
        }

        $business_profile_validator = $this->business_profile_validator($request->all());

        if ($business_profile_validator->fails()) {
            return back()->withErrors($business_profile_validator)->withInput();
        }

        $panelu = $request->input('domain_name');
        $panelurl = substr($panelu, strrpos($panelu, '/') + 1);

        $userid =   Auth::id();
        $unique_url = DB::table('panel_template')->where('business', $business_id)->update(['unique_url' => $panelurl, 'marked_domain' => 1]);

        if($unique_url){
            session(['hashvalue' => $panelurl]);
        }

        if($administrator == 0){
            $userid = UserDetails::select('user_id')->where([['business', '=', $business_id], ['administrator', '=', 1]])->first();
            $userid = $userid->user_id;
        }

        $UserBusinessDetails = Business::firstOrNew(array('user_id' => $userid));
        $UserBusinessDetails->user_id           = $userid;
        $UserBusinessDetails->name              = $request->input('business_name');
        $UserBusinessDetails->contact_firstname = $request->input('business_fname');
        $UserBusinessDetails->contact_lastname  = $request->input('business_lname');
        $UserBusinessDetails->address           = $request->input('business_address');
        $UserBusinessDetails->city              = $request->input('business_city');
        $UserBusinessDetails->state             = $request->input('state');
        $UserBusinessDetails->zip               = $request->input('business_zip');
        $UserBusinessDetails->phone             = $request->input('business_phone');
        $UserBusinessDetails->phone2            = $request->input('business_additional_phone');
        $UserBusinessDetails->timezone          = $request->input('business_timezone');
        $UserBusinessDetails->email             = $request->input('business_email');
        $UserBusinessDetails->website           = $request->input('business_website');
        $UserBusinessDetails->paypal            = $request->input('offer_paypal_account');
        $UserBusinessDetails->paypal_email          = $request->input('business_paypal_email');
        $UserBusinessDetails->public_email      = $request->input('business_public_email');
        $UserBusinessDetails->email2            = $request->input('business_secondary_email');
        $UserBusinessDetails->offer_cancellation = $request->input('offer_cancellation');
        $UserBusinessDetails->no_cancel_within      = $request->input('no_cancel_within');
        $UserBusinessDetails->require_inspection_zip  = $request->input('require_inspection_zip');
        $UserBusinessDetails->print_ticket_email      = $request->input('print_ticket_email');
        $UserBusinessDetails->require_agent           = $request->input('require_agent');
        $UserBusinessDetails->require_listing_agent   = $request->input('require_listing_agent');
        $UserBusinessDetails->agent_company_label     = $request->input('agent_company_label');
        $UserBusinessDetails->enotice_days_before     = $request->input('enotice_days_before');
        $UserBusinessDetails->include_event_ics       = $request->input('include_event_ics');

        $UserBusinessDetails->save();

        $files = $request->file();
        $name = '';
        foreach($files as $key){
            $name = $key->getClientOriginalName();
            //$keyextension = $key->getClientOriginalExtension();
            $getFilename = $key->getFilename();
            $key->move(public_path( 'attachments/logo/'.$userid ), $name );
        }

        $UserDetails = UserDetails::firstOrNew(array('user_id' => $userid));
        $UserDetails->upload_logo = $name;
        $UserDetails->business = $UserBusinessDetails->id;
        $UserDetails->save();

        session(['business_id' => $UserBusinessDetails->id, 'user_logo' => $name]);
        get_business_information($UserBusinessDetails->id);
        
        if (strpos($panelurl, ".") !== false) {
            $rchar = array('https', 'http', 'www'); // content to be deleted from string

            $panelurl = str_replace($rchar, "", $panelurl);
            //$panelurl = preg_replace('/[^A-Za-z0-9\-]/', '', $panelurl);
        }

        $data = json_encode(['Element 1','Element 2','Element 3','Element 4','Element 5']);
        $file ='.htaccess';
        $destinationPath = storage_path('upload/');
        if (!is_dir($destinationPath)) { 
            mkdir($destinationPath,0755,true);
        }
        $content_string = "RewriteEngine On\n";

        $serverName = $_SERVER['SERVER_NAME'];
        // change www.website.com for your website
        $content_string .= "Redirect 301 / http://".$serverName."/template/".$panelurl."\n";
        File::put($destinationPath.$file, $content_string);
        $destinationPath = storage_path('upload/'.$file);
        //return response()->download($destinationPath);

        //return redirect('/business_info')->with('message', 'Successfully Updated! Please download the file <a href="http://'.$serverName.'/schedulepanel/'.$file.'">.htaccess file</a> and paste it into your root folder i.e in public_html in '.$panelurl.' server.');

        return redirect('/business_info')->with('message', 'Successfully Updated!');
        
        //return redirect('/business_info')->with('message', trans('profile.updateSuccess'));
    }

}