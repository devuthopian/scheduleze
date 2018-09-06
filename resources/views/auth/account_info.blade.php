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
                        <li class="active">Business Details</li>
                        <li>Additional Information</li>
                        <li>Account Setup</li>
                    </ul>
                    <!-- fieldsets -->
                    <fieldset>
                        <h2 class="fs-title">Business Details</h2>
                        <br>
                        <input required type="text" name="business_name" id="business_name" title="Business Name" placeholder="Business Name"/>
                        <div class="form-group has-error business_name" style="display: none;">
                            <span class="help-block ">Business Name is Required</span>
                        </div>
                        <input type="text" name="contact_firstname" id="contact_firstname" title="Firstname" placeholder="Contact Firstname"/>
                        <div class="form-group has-error contact_firstname" style="display: none;">
                            <span class="help-block ">Contact First-name is Required</span>
                        </div>
                        <input type="text" name="contact_lastname" id="contact_lastname" title="Lastname" placeholder="Contact Lastname"/>
                        <div class="form-group has-error contact_lastname" style="display: none;">
                            <span class="help-block ">Contact Last-name is Required</span>
                        </div>
                        <input type="text" name="business_address" id ="business_address" title="Business Address" placeholder="Business Address"/>
                        <div class="form-group has-error business_address" style="display: none;">
                            <span class="help-block ">Business Address is Required</span>
                        </div>
                        <input type="text" name="business_city" id="business_city" title="Business City" placeholder="Business City"/>
                        <div class="form-group has-error business_city" style="display: none;">
                            <span class="help-block ">Business City is Required</span>
                        </div>
                        <div class="col-md-8">
                            {!! state() !!}
                            <div class="form-group has-error business_state" style="display: none;">
                                <span class="help-block ">Business state is Required</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="business_zip" id="business_zip" title="ZIP" placeholder="ZIP"/>
                            <div class="form-group has-error business_zip" style="display: none;">
                                <span class="help-block ">Business zip is Required</span>
                            </div>
                        </div>
                        <input type="text" name="business_phone" id="business_phone" title="Business Phone" placeholder="Business Phone"/>
                        <div class="form-group has-error business_phone" style="display: none;">
                            <span class="help-block ">Business Phone is Required</span>
                        </div>
                        <input type="button" name="next" class="next action-button" value="Next"/>
                    </fieldset>
                    <fieldset>
                        <h2 class="fs-title">Additional Information</h2>
                        <br>
                        <input type="text" name="additional_phone" id="additional_phone" title="Additional Phone" placeholder="Additional Phone"/>
                        <div class="form-group has-error additional_phone" style="display: none;">
                            <span class="help-block ">Additional Phone is Required</span>
                        </div>
                        <select name="timezone" id="timezone" class="form-control">
                            <option value="Timezone">Select Timezone</option>
                            <option value="Eastern">Eastern</option>
                            <option value="Central">Central</option>
                            <option value="Mountain">Mountain</option>
                            <option value="Pacific">Pacific</option>
                            <option value="Alaska">Alaska</option>
                            <option value="Hawaii">Hawaii</option>
                            <option value="Other">Other</option>
                        </select>
                        <div class="form-group has-error timezone" style="display: none;">
                            <span class="help-block ">Timezone is Required</span>
                        </div>
                        <br>
                        <input type="text" name="business_website" id="business_website" title="Business Website" placeholder="Business Website"/>
                        <div class="form-group has-error business_website" style="display: none;">
                            <span class="help-block ">Additional Phone is Required</span>
                        </div>
                        <input type="email" name="requested_email" id="requested_email" title="Business Email" placeholder="Business email" />
                        <div class="form-group has-error requested_email" style="display: none;">
                            <span class="help-block ">Email is Required</span>
                        </div>
                        <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                        <input type="button" name="next" class="next action-button" value="Next"/>
                    </fieldset>
                    <fieldset>
                        <h2 class="fs-title">Create your account</h2>
                        <h3 class="fs-subtitle">Fill in your credentials</h3>
                        <input required type="text" name="Username" id="Username" title="Username" placeholder="Username"/>
                        <div class="form-group has-error Username" style="display: none;">
                            <span class="help-block ">Username is Required</span>
                        </div>
                        <input required type="password" name="pass" id="pass" min="5" title="Password" placeholder="Password"/>
                        <div class="form-group has-error pass" style="display: none;">
                            <span class="help-block ">Password is Required</span>
                        </div>
                        <input required type="password" name="cpass" id="cpass" title="Confirm Password" placeholder="Confirm Password"/>
                        <div class="form-group has-error cpass" style="display: none;">
                            <span class="help-block ">Password must match</span>
                        </div>
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