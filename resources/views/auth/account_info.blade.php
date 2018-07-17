@extends('layouts.front')

@section('content')
<!-- MultiStep Form -->
<div class="signup_section">
<div class="container">
    <div class="row">
    <div class="col-md-8 col-md-offset-2">
        <form action="{{ route('account_info_save') }}"  id="msform" method="POST" >
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
            <input name="user_token" type="hidden" value="{{ $_GET['token'] }}"/>
            <!-- progressbar -->
            <ul id="progressbar">
                <li class="active">Personal Details</li>
                <li>Additional Information</li>
                <li>Account Setup</li>
            </ul>
            <!-- fieldsets -->
            <fieldset>
                <h2 class="fs-title">Personal Details</h2>
                <br>
                <input type="text" name="business_name" placeholder="Business Name"/>
                <input type="text" name="contact_firstname" placeholder="Contact Firstname"/>
                <input type="text" name="contact_lastname" placeholder="Contact Lastname"/>
                <input type="text" name="business_address" placeholder="Business Address"/>
                <input type="text" name="business_city" placeholder="Business City"/>
                 <div class="col-md-8">
                <select name="business_state" size="1"  class="form-control">
                <option value="">Business State</option>
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
                </select>
            </div>
             <div class="col-md-4">
                <input type="text" name="business_zip" placeholder="ZIP"/>
              </div>
                <input type="text" name="business_phone" placeholder="Business Phone"/>
                <input type="button" name="next" class="next action-button" value="Next"/>
            </fieldset>
            <fieldset>
                <h2 class="fs-title">Additional Information</h2><br>
                <input type="text" name="additional_phone" placeholder="Additional Phone"/>
                <select name="timezone" class="form-control">
                <option value="Timezone">Select Timezone</option>
                <option value="Eastern">Eastern</option>
                <option value="Central">Central</option>
                <option value="Mountain">Mountain</option>
                <option value="Pacific">Pacific</option>
                <option value="Alaska">Alaska</option>
                <option value="Hawaii">Hawaii</option>
                <option value="Other">Other</option>
                </select>
                <br>
                <input type="text" name="business_website" placeholder="Business Website"/>
                <input type="text" name="requested_email" placeholder="Requested email"/>
                <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                <input type="button" name="next" class="next action-button" value="Next"/>
            </fieldset>
            <fieldset>
                <h2 class="fs-title">Create your account</h2>
                <h3 class="fs-subtitle">Fill in your credentials</h3>
                <input type="text" name="Username" placeholder="Username"/>
                <input type="password" name="pass" placeholder="Password"/>
                <input type="password" name="cpass" placeholder="Confirm Password"/>
                <select name="use_scheduleze" class="form-control">
                <option value="I am not sure, please contact me to discuss options">I am not sure, please contact me to discuss options</option>
                <option value="saab">I'd like to use Scheduleze on-the-fly web page to take bookings</option>
                <option value="opel">I would like to use Scheduleze on my existing website</option>
                <option value="audi">I would like to have my own site for use with Scheduleze   </option>
                <option value="audi"> I don't currently have a website, contact me about options </option>



                </select>
                <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                <input type="submit" name="submit" class="submit action-button" value="Submit"/>
            </fieldset>
        </form>
     
        <!-- /.link to designify.me code snippets -->
    </div>
</div>
</div>
    </div>
<!-- /.MultiStep Form -->
@endsection
@section('page_scripts')
<script src="{{ asset('js/auth/account_info.js') }}" defer></script>
@endsection