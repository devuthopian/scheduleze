@extends('layouts.front')



@section('content')

<!-- MultiStep Form -->
<div class="col-sm-10">
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <!-- <li>{{ $error }}</li> -->
                @endforeach
                <p>Please fill up the form</p>
            </ul>
        </div>
    @endif
</div>
<div class="signup_section account_info_token_sec">

    <div class="container">

        <div class="row">

            <div class="col-md-8 col-md-offset-2" id="signup">

                <form action="{{ route('account_info_save') }}" id="msform" method="POST">

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



                        <input type="text" name="business_name" id="business_name" title="Business Name" v-validate="'required'" data-vv-as="Business Name" :class="{'input': true, 'is-danger': errors.has('business_name') }" placeholder="Business Name"/>

                        <i v-show="errors.has('business_name')" class="fa fa-warning"></i>

                        <span v-show="errors.has('business_name')" class="help is-danger">@{{ errors.first('business_name') }}</span>



                        <input type="text" name="contact_firstname" id="contact_firstname" title="Firstname" v-validate="'required'" data-vv-as="Firstname" :class="{'input': true, 'is-danger': errors.has('contact_firstname') }" placeholder="Contact Firstname"/>

                        <i v-show="errors.has('contact_firstname')" class="fa fa-warning"></i>

                        <span v-show="errors.has('contact_firstname')" class="help is-danger">@{{ errors.first('contact_firstname') }}</span>



                        <input type="text" name="contact_lastname" id="contact_lastname" title="Lastname" v-validate="'required'" data-vv-as="Lastname" :class="{'input': true, 'is-danger': errors.has('contact_lastname') }" placeholder="Contact Lastname"/>

                        <i v-show="errors.has('contact_lastname')" class="fa fa-warning"></i>

                        <span v-show="errors.has('contact_lastname')" class="help is-danger">@{{ errors.first('contact_lastname') }}</span>



                        <input type="text" name="business_address" id ="business_address" title="Business Address" v-validate="'required'" data-vv-as="Address" :class="{'input': true, 'is-danger': errors.has('business_address') }" placeholder="Business Address"/>

                        <i v-show="errors.has('business_address')" class="fa fa-warning"></i>

                        <span v-show="errors.has('business_address')" class="help is-danger">@{{ errors.first('business_address') }}</span>



                        <input type="text" name="business_city" id="business_city" title="Business City" v-validate="'required'" data-vv-as="City" :class="{'input': true, 'is-danger': errors.has('business_city') }" placeholder="Business City"/>

                        <i v-show="errors.has('business_city')" class="fa fa-warning"></i>

                        <span v-show="errors.has('business_city')" class="help is-danger">@{{ errors.first('business_city') }}</span>



                        <div class="col-md-8">

                            {!! state() !!}

                            <div class="form-group has-error business_state" style="display: none;">

                                <span class="help-block ">Business state is Required</span>

                            </div>

                        </div>



                        <div class="col-md-4">

                            <input type="text" name="business_zip" id="business_zip" v-validate="'required'" data-vv-as="Zip" :class="{'input': true, 'is-danger': errors.has('business_zip') }" title="ZIP" placeholder="ZIP"/>

                            <i v-show="errors.has('business_zip')" class="fa fa-warning"></i>

                            <span v-show="errors.has('business_zip')" class="help is-danger">@{{ errors.first('business_zip') }}</span>

                        </div>



                        <input type="text" name="business_phone" id="business_phone" title="Business Phone" v-validate.continues="'required|numeric'" data-vv-as="Phone" :class="{'input': true, 'is-danger': errors.has('business_phone') }" placeholder="Business Phone"/>

                        <i v-show="errors.has('business_phone')" class="fa fa-warning"></i>

                        <span v-show="errors.has('business_phone')" class="help is-danger">@{{ errors.first('business_phone') }}</span>

                        <br>

                        <input type="button" name="next" class="next action-button FirstNext" :disabled="errors.any()" value="Next"/>

                    </fieldset>

                    <fieldset>

                        <h2 class="fs-title">Additional Information</h2>

                        <br>

                        <input type="text" name="additional_phone" id="additional_phone" title="Additional Phone" placeholder="Additional Phone"/>



                        <select name="timezone" id="timezone" class="form-control" v-validate="'excluded:Timezone'" data-vv-as="selected">

                            <option value="Timezone">Select Timezone</option>

                            <option value="Eastern">Eastern</option>

                            <option value="Central">Central</option>

                            <option value="Mountain">Mountain</option>

                            <option value="Pacific">Pacific</option>

                            <option value="Alaska">Alaska</option>

                            <option value="Hawaii">Hawaii</option>

                            <option value="Other">Other</option>

                        </select>

                        <i v-show="errors.has('timezone')" class="fa fa-warning"></i>

                        <span v-show="errors.has('timezone')" class="help is-danger">@{{ errors.first('timezone') }}</span>

                        <br>



                        <input type="text" name="business_website" id="business_website" title="Business Website" placeholder="Business Website"/>



                        <input type="text" name="requested_email" id="requested_email" v-validate.continues="'required|email'" :class="{'input': true, 'is-danger': errors.has('requested_email') }" data-vv-as="Business Email" title="Business Email" placeholder="Business email" />

                        <i v-show="errors.has('requested_email')" class="fa fa-warning"></i>

                        <span v-show="errors.has('requested_email')" class="help is-danger">@{{ errors.first('requested_email') }}</span>



                        <br>

                        <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>

                        <input type="button" name="next" class="next action-button SecondNext" value="Next" :disabled="errors.any()"/>

                    </fieldset>

                    <fieldset>

                        <h2 class="fs-title">Create your account</h2>

                        <h3 class="fs-subtitle">Fill in your credentials</h3>

                        <input type="text" name="Username" id="Username" title="Username" v-validate.continues="'required|alpha'" :class="{'input': true, 'is-danger': errors.has('Username') }" placeholder="Username" value="{{ $username->name }}" />

                        <i v-show="errors.has('Username')" class="fa fa-warning"></i>

                        <span v-show="errors.has('Username')" class="help is-danger">@{{ errors.first('Username') }}</span>



                        <input type="password" name="pass" id="pass" v-validate="'required|min:5'" :class="{'is-danger': errors.has('pass')}" title="Password" placeholder="Password" ref="pass" data-vv-as="Password"/>

                        <i v-show="errors.has('pass')" class="fa fa-warning"></i>

                        <span v-show="errors.has('pass')" class="help is-danger">@{{ errors.first('pass') }}</span>



                        <input type="password" v-validate="'required|confirmed:pass'" name="cpass" id="cpass" :class="{'is-danger': errors.has('cpass')}" title="Confirm Password" placeholder="Confirm Password" data-vv-as="Confirmed Password"/>

                         <i v-show="errors.has('cpass')" class="fa fa-warning"></i>

                        <span v-show="errors.has('cpass')" class="help is-danger">@{{ errors.first('cpass') }}</span>



                        <select name="use_scheduleze" class="form-control">

                            <option value="I am not sure, please contact me to discuss options">I am not sure, please contact me to discuss options</option>

                            <option value="saab">I'd like to use Scheduleze on-the-fly web page to take bookings</option>

                            <option value="opel">I would like to use Scheduleze on my existing website</option>

                            <option value="audi">I would like to have my own site for use with Scheduleze   </option>

                            <option value="audi"> I don't currently have a website, contact me about options </option>

                        </select>

                        <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>

                        <input type="submit" name="submit" class="submit action-button" value="Submit" :disabled="errors.any()"/>

                    </fieldset>

                </form>

                <!-- /.link to designify.me code snippets -->

            </div>

        </div>

    </div>

</div>

<script src="{{ asset('js/app.js') }}"></script>

<!-- /.MultiStep Form -->

@endsection

@section('page_scripts')

<script src="{{ asset('js/auth/account_info.js') }}" defer></script>

@endsection