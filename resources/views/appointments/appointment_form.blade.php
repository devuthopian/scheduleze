<link rel="stylesheet" href="{{ URL::asset('css/panelstyle.css') }}">
<a href="{{ URL::previous() }}" class="gobutton">Go Back</a>
<hr>
<div class="takehtml">
    <div id="dontbreakdiv">
        <div class="panel">
            @if (is_array($PanelForm) || is_object($PanelForm))

                @foreach ($PanelForm as $pform)
                @endforeach
            @else
                @php $BuildType = $data['building_type']; @endphp
                <table class="accent" bgcolor="white" width="650">
                    <tbody>
                        <tr>
                            <td bgcolor="white">
                                <form action="appointment.php" method="post" name="appointment" onsubmit="return checkrequired(this)">
                                    <table border="0" cellspacing="0" cellpadding="5">
                                        <tbody>
                                            <tr>
                                                <td colspan="3">
                                                    <span class="head">Appointment Details </span><span class="warning"></span>
                                                    <br>
                                                    <span class="note">	@php $tot = buildType($data); @endphp @for($i=0;$i<count($tot);$i++) {{ $tot[$i] }} @endfor <br>Total Cost: ${!! CountAppFormCost($data) !!}</span>
                                                    <input type="hidden" name="full_description" value="">
                                                    <input type="hidden" name="addons_description" value="">
                                                    <input type="hidden" name="total_price" value="500">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    <!--<form action="appointment.php" method="post" name="pick_inspector">-->
                                                    <input type="hidden" name="inspector" value="60">
                                                    <input type="hidden" name="location" value="1164">
                                                    <input type="hidden" name="building_type" value="625">
                                                    <input type="hidden" name="business" value="105"><span class="subhead">Click menu to view all openings for {!! username($data['reference_id']) !!}</span>
                                                    <br>
                                                    <select name="starttime">
                                                        <option value="1534435200">9:00 am, Thursday, August 16</option>
                                                        <option value="1534521600">9:00 am, Friday, August 17</option>
                                                        <option value="1534532400">12:00 pm, Friday, August 17</option>
                                                        <option value="1534543200">3:00 pm, Friday, August 17</option>
                                                        <option value="1534608000">9:00 am, Saturday, August 18</option>
                                                        <option value="1534618800">12:00 pm, Saturday, August 18</option>
                                                        <option value="1534953600">9:00 am, Wednesday, August 22</option>
                                                        <option value="1534964400">12:00 pm, Wednesday, August 22</option>
                                                        <option value="1534975200">3:00 pm, Wednesday, August 22</option>
                                                        <option value="1535040000">9:00 am, Thursday, August 23</option>
                                                        <option value="1535126400">9:00 am, Friday, August 24</option>
                                                        <option value="1535137200">12:00 pm, Friday, August 24</option>
                                                        <option value="1535148000">3:00 pm, Friday, August 24</option>
                                                        <option value="1535212800">9:00 am, Saturday, August 25</option>
                                                        <option value="1535223600">12:00 pm, Saturday, August 25</option>
                                                        <option value="1535558400">9:00 am, Wednesday, August 29</option>
                                                        <option value="1535569200">12:00 pm, Wednesday, August 29</option>
                                                        <option value="1535580000">3:00 pm, Wednesday, August 29</option>
                                                        <option value="1535644800">9:00 am, Thursday, August 30</option>
                                                        <option value="1535731200">9:00 am, Friday, August 31</option>
                                                        <option value="1535742000">12:00 pm, Friday, August 31</option>
                                                        <option value="1535752800">3:00 pm, Friday, August 31</option>
                                                        <option value="1535817600">9:00 am, Saturday, September 1</option>
                                                        <option value="1535828400">12:00 pm, Saturday, September 1</option>
                                                    </select>
                                                    <br><span class="note">Don't see a time that fits your schedule?  Please call 907-223-4958.
                										</span></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"><span class="formlabel">Inspection {!! getlocation($data['location']) !!}</span>
                                                    <br>
                                                    <input type="text" name="requiredInspection_Address" size="40" value="">
                                                    <br>
                                                    <!--<span class="note">Home/Condo 2501-3500 sq. ft. ($475)<br>
                											 Total Cost: $500</span>--></td>
                                            </tr>
                                            <tr>
                                                <td><span class="signuplabel">First name</span>
                                                    <br>
                                                    <input type="text" name="requiredFirstname" size="20" value="">
                                                </td>
                                                <td><span class="signuplabel">Last name</span>
                                                    <br>
                                                    <input type="text" name="requiredLastname" size="20" value="">
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
                                                <td><span class="signuplabel">Email</span>
                                                    <br>
                                                    <input type="text" name="requiredEmail" size="20" value="" maxlength="128">
                                                </td>
                                                <td><span class="signuplabel">Phone</span>
                                                    <br>
                                                    <input type="text" name="requiredPhone" size="9" value="">
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

                                                    <input type="text" name="Agent_Name" value="" size="20">
                                                </td>
                                                <td valign="top"><span class="signup_label_optional">Agent Phone</span>
                                                    <br>
                                                    <input type="text" name="Agent_Phone" value="" size="20">
                                                </td>
                                                <td valign="top"><span class="signup_label_optional">Agent Email<br>
                											</span>
                                                    <input type="text" name="Agent_Email" value="" size="20">
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
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript">
    var htmlcss = '.gjs-cv-canvas{top:0;width:100%;height:100%}.panel{width:90%;max-width:700px;border-radius:3px;padding:30px 20px;margin:150px auto 0;background-color:#d983a6;box-shadow:0 3px 10px 0 rgba(0,0,0,0.25);color:rgba(255,255,255,0.75);font:caption;font-weight:100}.welcome{text-align:center;font-weight:100;margin:0}.logo{width:70px;height:70px;vertical-align:middle}.logo path{pointer-events:none;fill:none;stroke-linecap:round;stroke-width:7;stroke:#fff}.big-title{text-align:center;font-size:3.5rem;margin:15px 0}.description{text-align:justify;font-size:1rem;line-height:1.5rem}';
    $(document).ready(function() {
        @if(!empty($businessinfo)) 
            var wholehtml = $('.takehtml').html();
            $.ajax({
                //url : '{{ url("ajaxappointment") }}',
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
    });
</script>
<style type="text/css">
    @if(!empty($template))
        {!! $template->gjs_css !!}
    @endif
</style>