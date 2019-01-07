<!-- <link rel="stylesheet" href="{{ URL::asset('css/panelstyle.css') }}">
<a href="{{ URL::previous() }}" class="gobutton">Go Back</a>
<hr> -->
@php 
    if(empty(session('business_id'))){
        $gjs = PanelTemplate($data['reference_id'], 'user_id');
    }
    else{
        $gjs = PanelTemplate(session('business_id'), 'business');
    }
    $userId = Auth::id();
@endphp
<title>Scheduleze | Customer Scheduling Solutions</title>
<meta name="keywords" content="Scheduleze | Customer Scheduling Solutions"/>
<meta name="body" content="Scheduleze | Customer Scheduling Solutions"/>
<meta name="description" content="Scheduleze | Customer Scheduling Solutions"/>
<meta name="summary" content="Scheduleze | Customer Scheduling Solutions"/>
<meta http-equiv="Bulletin-Text" content="Scheduleze | Customer Scheduling Solutions"/>
<meta name="page-topic" content="Scheduleze | Customer Scheduling Solutions"/>
<link rel="shortcut icon" href="{{ asset('images/favicon_icon.png') }}" type="image/x-icon" />
<link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
<div class="loader"></div>


{!! $gjs->gjs_html !!}
<style type="text/css">
    @if(!empty($gjs))
        {!! $gjs->gjs_css !!}
    @endif

    .header_section {
        float: unset !important;
        width: 96%;
    }
</style>
<div class="NewForm">
    @if (is_array($PanelForm) || is_object($PanelForm))

        @foreach ($PanelForm as $pform)
        @endforeach
    @else
        @php
            $addons = array();
            $BuildType = $data['building_type'];
            if(empty(session('business_id'))){
                $businessId = get_field('users_details', 'business', $data['reference_id']);
            }else{
                $businessId = Session::get('business_id');
            }

            if(!empty($data['building_size'])){
                $building_size = $data['building_size'];
            }else{
                $building_size = '';
            }
            
            if(!empty($data['building_age'])){
                $building_age = $data['building_age'];
            }else{
                $building_age = '';
            }
            
            $location = !empty($data['location']) ? $data['location'] : '';
            if(array_key_exists('addons', $data)){
                $addons = $data['addons'];
            }
            $inspection_information = get_proposed_inspection_information($businessId, $BuildType, $building_size, $building_age, $addons, $location);
            if ($inspection_information['status'] == "0"){
            }

            session(['total_price' => $inspection_information['total_price']]);

            $total_time = $inspection_information['total_time'];
            if ($total_time < 1800){
                session(['total_time' => 10800]);
                $total_time = 10800;
            } else {
                session(['total_time' => $total_time]);
            }

            if ($inspection_information['status'] == "1"){  //building_type had a status of two, zero out the other fields
                $building_size = '';
                $building_age = '';
            } elseif ($inspection_information['status'] == "2"){ //building size status had a value of 2 so disregard the age input
                $building_age = '';
            }

            $authorized_inspectors = get_inspector_exceptions($businessId, $BuildType, $building_size, $building_age, $addons, session('total_price'), $data['reference_id']);
            $increment = 900;
            if(!empty($data['addon'])){
                session(['addon' => $data['addon']]);
            }
            if(!empty($data[0]['starttime'])){
                $start_date = date ("g:i a, F jS", $data[0]['starttime']);
            }

            $building_ages = '';
            if(!empty($data['building_ages'])){
                $building_ages = $data['building_ages'];
            }

            $building_sizes = '';
            if(!empty($data['building_size'])){
                $building_sizes = $data['building_size'];
            }

            if(!empty(session('engage'))) {
                $engage = session('engage');
            } else {
                $engage = get_field('users_details', 'engage', $data['reference_id']);
            }

            if(!empty(session('business_information.address'))) {
                $address = session('business_information.address');
                $city = session('business_information.city');
                $state = session('business_information.state');
                $zip = session('business_information.zip');
                $phone = session('business_information.phone');
            } else {
                $address = get_field('business', 'address', $data['reference_id']);
                $city = get_field('business', 'city', $data['reference_id']);
                $state = get_field('business', 'state', $data['reference_id']);
                $zip = get_field('business', 'zip', $data['reference_id']);
                $phone = get_field('business', 'phone', $data['reference_id']);
            }
        @endphp
        <table class="accent" width="650">
            <tbody>
                <tr>
                    <td>
                        {!! Form::open([ 'route' => ['BookAppointment'],'method' => 'post', 'id' => 'txtForm', 'name' => 'appointment'] ) !!}
                            <table border="0" cellspacing="0" cellpadding="5">
                                <tbody>
                                    <tr>
                                        <td colspan="3">
                                            <span class="head">Appointment Details </span><span class="warning"></span>
                                            <br>
                                            <span class="note">	
                                                @php
                                                    $tot = buildType($data);                                     
                                                @endphp

                                                @if(!empty($tot))
                                                    @for($i=0;$i<count($tot);$i++) 
                                                        {{ $tot[$i] }}
                                                        <br>
                                                    @endfor 
                                                @endif
                                                <br>Total Cost: ${!! CountAppFormCost($data) !!}
                                            </span>
                                            <input type="hidden" name="full_description" value="">
                                            <input type="hidden" name="addons_description" value="">
                                            <input type="hidden" name="total_price" value="{!! CountAppFormCost($data) !!}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">                                            
                                            <input type="hidden" name="inspector" value="{{ $data[0]['inspector'] }}">
                                            <input type="hidden" name="location" value="{{ $location }}">
                                            <input type="hidden" name="engage" value="{{ $engage }}">
                                            <input type="hidden" name="building_type" value="{{ $data['building_type'] }}">
                                            <input type="hidden" name="building_ages" value="{{ $building_ages }}">
                                            <input type="hidden" name="building_size" value="{{ $building_sizes }}">
                                            <input type="hidden" name="business" value="{{ $data['businessId'] }}">
                                            @if(!empty($data[0]['starttime']))
                                                <input type="hidden" name="starttime" value="{{ $data[0]['starttime'] }}">
                                            @endif
                                            @if(empty($data[0]['starttime']))
                                                <span class="subhead">
                                                    Click menu to view all openings for {!! usernameAppoint($data[0]['inspector']) !!}
                                                </span>
                                                <br>
                                                @foreach($authorized_inspectors as $qualified_inspector)
                                                    @php print_r(get_available_times_popup2($location, $total_time, $qualified_inspector->user_id, $qualified_inspector->look_ahead, $increment, 0, 0)); @endphp
                                                @endforeach
                                                <br>
                                                <span class="note">
                                                    Don't see a time that fits your schedule?  Please call 907-223-4958.
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        @if($engage == 1 && !empty($location))
                                            <td colspan="3"><span class="formlabel"><b>Inspection in {!! getlocation($location) !!}</b></span>
                                                <br>
                                                <input type="text" name="requiredInspection_Address" size="40" value="" required>
                                        @else
                                            <td colspan="3"><span class="formlabel"><b>Appointment in {{ $city }}</b>
                                                <input type="hidden" name="requiredInspection_Address" size="40" value="{{ $city }} at {{ $address }}, {{ $state }}, {{ $zip }} #{{$phone}}" required>
                                                <br>
                                                at {{ $address }}, {{ $city }}, {{ $state }}, {{ $zip }}</span>
                                            <br>
                                        @endif
                                                <br>
                                                @if(!empty($data[0]['starttime']))
                                                    <span class="note"><b>Beginning at {{ $start_date }}.  <!-- Cost: ${!! CountAppFormCost($data) !!} --></b></span>
                                                @endif
                                                <br>
                                                <!--<span class="note">Home/Condo 2501-3500 sq. ft. ($475)<br>
            											 Total Cost: $500</span>-->
                                            </td>
                                    </tr>
                                    <tr>
                                        <td><span class="signuplabel"><b>First name</b></span>
                                            <br>
                                            <input type="text" name="requiredFirstname" size="20" value="" required>
                                        </td>
                                        <td><span class="signuplabel"><b>Last name</b></span>
                                            <br>
                                            <input type="text" name="requiredLastname" size="20" value="" required>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><span class="signup_label_optional">Current Address</span>
                                            <br>
                                            <input type="text" name="Current_Address" size="20" value="">
                                        </td>
                                        <td><span class="signup_label_optional">City</span>
                                            <br>
                                            <input type="text" name="City" size="20" value="">
                                        </td>
                                        <td><span class="signup_label_optional">State, ZIP</span>
                                            <br>
                                            {!! state() !!}
                                            <input type="text" name="ZIP" size="8" value="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="signuplabel"><b>Email</b></span>
                                            <br>
                                            <input type="email" name="requiredEmail" size="20" value="" maxlength="128" required>
                                        </td>
                                        <td><span class="signuplabel"><b>Phone</b></span>
                                            <br>
                                            <input type="text" name="requiredPhone" size="9" value="" required>
                                            <select name="phone_name" class="smallselect">
                                                <option value="Cell">Cell</option>
                                                <option value="Home">Home</option>
                                                <option value="Fax">Fax</option>
                                                <option value="Pager">Pager</option>
                                                <option value="Work">Work</option>
                                                <option value="Other">Other</option>
                                                <option value="N/A">N/A</option>
                                            </select>
                                        </td>
                                        <td><span class="signup_label_optional">Additional Phone</span>
                                            <br>
                                            <input type="text" name="phone2" size="9" value="">
                                            <select name="phone2_name" class="smallselect">
                                                <option value="Work">Work</option>
                                                <option value="Cell">Cell</option>
                                                <option value="Home">Home</option>
                                                <option value="Fax">Fax</option>
                                                <option value="Pager">Pager</option>
                                                <option value="Other">Other</option>
                                                <option value="N/A">N/A</option>
                                            </select>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td valign="top"><span class="signup_label_optional">Agent Name</span>
                                            <br>
                                            <input type="text" name="Agent_Name" value="{{ $agent_name_cookie }}" size="20">
                                        </td>
                                        <td valign="top"><span class="signup_label_optional">Agent Phone</span>
                                            <br>
                                            <input type="text" name="Agent_Phone" value="{{ $agent_phone_cookie }}" size="20">
                                        </td>
                                        <td valign="top"><span class="signup_label_optional">Agent Email<br></span>
                                            <input type="email" name="Agent_Email" value="{{ $agent_email_cookie }}" size="20">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" valign="middle"><span class="signup_label_optional">Method of Entry </span><span class="note">(Access codes etc)</span>
                                            <br>
                                            <select name="entry_method" size="1" class="smallselect">
                                                <option value="">Choose...</option>
                                                <option value="E-box installed">MLS electronic box</option>
                                                <option value="Combination Code">Combo Box (Text combo to inspector)</option>
                                                <option value="Owner will be present">Owner will be present</option>
                                                <option value="Buyer's agent will meet you">Buyer's agent will meet you</option>
                                                <option value="Seller's agent will meet you">Seller's agent will meet you</option>
                                                <option value="Buyer has access">Buyer has access</option>
                                                <option value="Other: ">Other, see "Notes" below</option>

                                            </select>
                                        </td>
                                        <td valign="middle"><span class="signup_label_optional">MLS Number</span>
                                            <br>
                                            <input type="text" name="mls" value="" size="20" maxlength="244">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" valign="middle"><span class="signup_label_optional">Notes:<br>
        								<input type="text" name="notes" value="" size="69"></span></td>
                                    </tr>
                                    <tr>
                                        <td valign="middle">
                                            <input type="hidden" name="trigger" value="1">
                                            <input type="submit" name="submit" value="Reserve Time »">
                                        </td>
                                        <td><span class="note">Required fields are in <b>bold.</b></span></td>
                                        <td valign="middle">
                                            <input type="checkbox" name="remember_agent" value="1" unchecked=""> <span class="note">Remember this Agent</span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <span class="formlabel">If you do not find an opening that fits your needs, please contact us and we will make every effort to accommodate your schedule.<p></p><p>Call 907-223-4958 or email<br></p></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        {!! Form::close() !!}
                    </td>
                </tr>
            </tbody>
        </table>
    @endif

</div>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript">
    var htmlcss = '.gjs-cv-canvas{top:0;width:100%;height:100%}.panel{width:90%;max-width:700px;border-radius:3px;padding:30px 20px;margin:150px auto 0;background-color:#d983a6;box-shadow:0 3px 10px 0 rgba(0,0,0,0.25);color:rgba(255,255,255,0.75);font:caption;font-weight:100}.welcome{text-align:center;font-weight:100;margin:0}.logo{width:70px;height:70px;vertical-align:middle}.logo path{pointer-events:none;fill:none;stroke-linecap:round;stroke-width:7;stroke:#fff}.big-title{text-align:center;font-size:3.5rem;margin:15px 0}.description{text-align:justify;font-size:1rem;line-height:1.5rem}';
    $(document).ready(function() {
        @if(!empty($businessinfo)) 
            var wholehtml = $('.takehtml').html();
            $.ajax({
                //url : '{{ url("ajaxAppointmentForm") }}',
                method : "POST",
                data : {_token: '{{ csrf_token() }}', gjs_html: wholehtml, gjs_css: htmlcss },
                dataType : "JSON",
                success:function(data){
                    console.log(data.message);
                    $('.alert-info').html('<strong>Successfully saved!</strong> Click  <a href="{{ route("schedulepanel") }}"><strong>here</strong></a> to change the look of your form.');
                }
            });
        @else
            $('.alert-info').html('<strong>There is nothing to show you.</strong> Click  <a href="{{ url("/form/BuildingTypes") }}"><strong>here</strong></a> to add services.');
        @endif

        if($("#dontbreakdiv").length > 0) {
            $('.panel').html($('.NewForm').html());
            $('.NewForm').remove();

            $('.loader').fadeOut(1000);
        }
    });
</script>