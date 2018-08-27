@extends('layouts.front')

@section('content')
@if(!empty($errors->first()))
    <div class="row col-lg-12">
        <div class="alert alert-warning">
            <span>{{ $errors->first() }}</span>
        </div>
    </div>
@endif
<div class="container">
    <table width="960" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td bgcolor="white">
                <div class="frameadmin">
                <form action="{{ url('/scheduleze/booking/update/'.$groupdata['id']) }}" method="post" name="appointment">
                    @csrf
                    <span class="head">Edit Appointment Details<br>
                    </span>
                    <table border="0" cellspacing="0" cellpadding="5">
                        <tr>
                            <td colspan="2"><span class="formlabel">Appointment Street Address</span><br>
                                <input type="text" name="Inspection_Address" size="40" value="{{ $groupdata['booking']->inspection_address }}" required>
                            </td>
                            <td>
                                <span class="signuplabel">Location:<br>
                                {!! $groupdata['location_popup'] !!}</span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <span class="signuplabel">
                                    Type of appointment:<br>
                                    {!! $groupdata['type_pop'] !!} {!! $groupdata['size_pop'] !!} {!! $groupdata['age_pop'] !!}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td width="33%"><span class="signuplabel">First name</span><br>
                                <input type="text" name="Firstname" size="20" value="{{ $groupdata['booking']->firstname }}">
                            </td>
                            <td><span class="signuplabel">Last name</span><br>
                                <input type="text" name="Lastname" size="20" value="{{ $groupdata['booking']->lastname }}">
                            </td>
                            <td><span class="signuplabel"><?php //echo $_SESSION[agent_name]?></span><br>
                                {{ $groupdata['booking']->inspector_popup }}
                            </td>
                        </tr>
                        <tr>
                            <td><span class="signup_label_optional">Current Address</span><br>
                                <input type="text" name="Current_Address" size="20" value="{{ $groupdata['booking']->address }}">
                            </td>
                            <td><span class="signup_label_optional">City</span><br>
                                <input type="text" name="City" size="20" value="{{ $groupdata['booking']->city }}">
                            </td>
                            <td>
                                <span class="signup_label_optional">State, ZIP</span><br>
                                <select name="State" size="1" class="smallselect">
                                    <?php //if ($row[state]){echo "<option value=\"$row[state]\">$row[state]</option>";}?>
                                    <option value="AK">AK</option>
                                    <option value="AL">AL</option>
                                    <option value="AR">AR</option>
                                    <option value="AZ">AZ</option>
                                    <option value="CA">CA</option>
                                    <option value="CO">CO</option>
                                    <option value="CT">CT</option>
                                    <option value="DC">DC</option>
                                    <option value="DE">DE</option>
                                    <option value="FL">FL</option>
                                    <option value="GA">GA</option>
                                    <option value="HI">HI</option>
                                    <option value="IA">IA</option>
                                    <option value="ID">ID</option>
                                    <option value="IL">IL</option>
                                    <option value="IN">IN</option>
                                    <option value="KS">KS</option>
                                    <option value="KY">KY</option>
                                    <option value="LA">LA</option>
                                    <option value="MA">MA</option>
                                    <option value="MD">MD</option>
                                    <option value="ME">ME</option>
                                    <option value="MI">MI</option>
                                    <option value="MN">MN</option>
                                    <option value="MO">MO</option>
                                    <option value="MS">MS</option>
                                    <option value="MT">MT</option>
                                    <option value="NC">NC</option>
                                    <option value="ND">ND</option>
                                    <option value="NE">NE</option>
                                    <option value="NH">NH</option>
                                    <option value="NJ">NJ</option>
                                    <option value="NM">NM</option>
                                    <option value="NV">NV</option>
                                    <option value="NY">NY</option>
                                    <option value="OH">OH</option>
                                    <option value="OK">OK</option>
                                    <option value="OR">OR</option>
                                    <option value="PA">PA</option>
                                    <option value="RI">RI</option>
                                    <option value="SC">SC</option>
                                    <option value="SD">SD</option>
                                    <option value="TN">TN</option>
                                    <option value="TX">TX</option>
                                    <option value="UT">UT</option>
                                    <option value="VA">VA</option>
                                    <option value="VT">VT</option>
                                    <option value="WA">WA</option>
                                    <option value="WI">WI</option>
                                    <option value="WV">WV</option>
                                    <option value="WY">WY</option>
                                    <option value="">--</option>
                                    <option value="AB">AB</option>
                                    <option value="BC">BC</option>
                                    <option value="MB">MB</option>
                                    <option value="NB">NB</option>
                                    <option value="NL">NL</option>
                                    <option value="NT">NT</option>
                                    <option value="NS">NS</option>
                                    <option value="NU">NU</option>
                                    <option value="ON">ON</option>
                                    <option value="PE">PE</option>
                                    <option value="QC">QC</option>
                                    <option value="SK">SK</option>
                                    <option value="YT">YT</option>
                                </select>
                                <input type="text" name="ZIP" size="8" value="{{ $groupdata['booking']->zip }}">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="signuplabel">Contact Phone</span><br>
                                <input type="text" name="Phone" size="20" value="{{ $groupdata['booking']->dayphone }}">
                                <!--<select name="phone_name" class="smallselect">
                                    <?php //if ($row[phone_name]){echo "<option value=\"$row[phone_name]\">$row[phone_name]</option>";}?>
                                    <option value="Cell">Cell</option>
                                    <option value="Home">Home</option>
                                    <option value="Fax">Fax</option>
                                    <option value="Pager">Pager</option>
                                    <option value="Work">Work</option>
                                    <option value="Other">Other</option>
                                    <option value="N/A">N/A</option>
                                    </select>-->
                            </td>
                            <td>
                                <span class="signup_label_optional">Additional Phone</span><br>
                                <input type="text" name="phone2" size="20" value="{{ $groupdata['booking']->homephone }}"><!--<select name="phone2_name" class="smallselect">
                                    <?php //if ($row[phone2_name]){//echo "<option value=\"$row[phone2_name]\">$row[phone2_name]</option>";}?>
                                    <option value="Work">Work</option>
                                    <option value="Cell">Cell</option>
                                    <option value="Home">Home</option>
                                    <option value="Fax">Fax</option>
                                    <option value="Pager">Pager</option>
                                    <option value="Other">Other</option>
                                    <option value="N/A">N/A</option>
                                    </select>-->
                            </td>
                            <td><span class="signup_label_optional">Email</span><br>
                                <input type="text" name="Email" size="20" value="{{ $groupdata['booking']->email }}" maxlength="128">
                            </td>
                        </tr>
                        <?php //if ($_SESSION[show_agent_information]){?>
                        <tr>
                            <td valign="top"><span class="signup_label_optional">Agent Name</span><br>
                                <input type="text" name="agent_name" value="{{ $groupdata['booking']->agent_name }}" size="20">
                            </td>
                            <td valign="top"><span class="signup_label_optional">Agent Phone</span><br>
                                <input type="text" name="agent_phone" value="{{ $groupdata['booking']->agent_phone }}" size="20">
                            </td>
                            <td valign="top"><span class="signup_label_optional">Agent Email<br>
                                </span><input type="text" name="agent_email" value="{{ $groupdata['booking']->agent_email }}" size="20">
                            </td>
                        </tr>
                        <?//}?>
                        <?php //if ($_SESSION[business_information][require_listing_agent] == "1"){?>
                        <tr>
                            <td valign="top"><span class="signup_label_optional">Listing Agent Name</span><br>
                                <input type="text" name="Listing_Agent" value="{{ $groupdata['booking']->listing_agent }}" size="20">
                            </td>
                            <td valign="top"><span class="signup_label_optional">Listing Office</span><br>
                                <input type="text" name="Listing_Office" value="{{ $groupdata['booking']->listing_office }}" size="20">
                            </td>
                            <td valign="top"><span class="signup_label_optional">Listing Office Phone<br>
                                </span><input type="text" name="Listing_Phone" value="{{ $groupdata['booking']->listing_phone }}" size="20">
                            </td>
                        </tr>
                        <?//}?>
                        <tr>
                            <td valign="middle"><span class="signup_label_optional">Price Quoted</span><br>
                                <input type="text" name="price" value="${{ $groupdata['booking']->price }}" size="5" maxlength="244"><input type="checkbox" name="quote_override" value="1"><span class="note">Override Auto Pricing</span>
                            </td>
                            <?php //if ($_SESSION[show_agent_information]){?>
                            <td><span class="signup_label_optional">Method of Entry</span><br>
                                <input type="text" name="other_entry_method" value="{{ $groupdata['booking']->entry_method }}" size="20" maxlength="244">
                            </td>
                            <td valign="middle"><span class="signup_label_optional">MLS Number</span><br>
                                <input type="text" name="mls" value="{{ $groupdata['booking']->mls }}" size="20" maxlength="244">
                            </td>
                            <?//} else {?>
                            <td></td>
                            <td></td>
                            <?//}?>
                        </tr>
                        <tr>
                            <td colspan="3" valign="middle"><span class="signuplabel">Start:<br>
                                </span>{!! $groupdata['start_popup'] !!}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" valign="middle"><span class="signuplabel">End:<br>
                                </span>{!! $groupdata['end_popup'] !!}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" valign="middle"><span class="signup_label_optional">Internal Notes:<br>
                                <textarea name="notes" rows="4" cols="70">{{ $groupdata['booking']->notes }}</textarea></span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" valign="middle"><span class="signup_label_optional">Client Notes:<br>
                                <textarea name="user_notes" rows="4" cols="70">{{ $groupdata['booking']->user_notes }}</textarea></span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" valign="middle"><span class="signup_label_optional">Includes:<br>
                                </span>{!! $groupdata['add_on_checkboxes'] !!}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" valign="top">
                                <input type="hidden" name="trigger" value="1">
                                <input type="hidden" name="action" value="edit_booking"><input type="hidden" name="target" value="{{ $groupdata['id'] }}">
                                <input type="submit" name="submit" value="Edit Appointment &raquo;">
                                &nbsp;&nbsp;<input type="checkbox" name="send_again" value="1"><span class="note">Resend Email Receipts</span>
                            </td>
                            <td></td>
                        </tr>
                    </table>
                </form>
            </td>
        </tr>
    </table>
</div>
@endsection