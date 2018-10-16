@extends('layouts.front')



@section('content')



<div class="signup_section">



    <div class="signup_cont nsignup_cont">
        
        <div class="container">

           <div class="sign_up_inner_cont">
            <h3>Business Profile</h3>

            @if(session('administrator') == 0)
                @php 
                    $behaviour = 'disabled';
                    
                @endphp
            @else
                @php 
                    $behaviour = '';
                    
                @endphp
            @endif

            {!! Form::model($UserBusinessData, array('action' => array('ProfileController@updateUserBusinessAccount'), 'method' => 'POST', 'id'=>'Userdata')) !!}



            {{ csrf_field() }}







            <div class="textfield_full">
                <div class="bussthree_cont">

                    <div class="form-group">

                        {!! Form::label('business_name', trans('profile.business_name') , array('class' => 'control-label')); !!}
                        {!! Form::text('business_name',$UserBusinessData['name'], array('id' => 'business_name', 'class' => 'form-control', 'placeholder' => trans('profile.business_name'))) !!}



                        <span class="glyphicon {{ $errors->has('firstname') ? ' glyphicon-asterisk ' : ' ' }} form-control-feedback" aria-hidden="true"></span>

                        @if ($errors->has('business_name'))

                        <span class="help-block">

                            <strong>{{ $errors->first('business_name') }}</strong>

                        </span>

                        @endif

                    </div>

                </div>



                <div class="bussthree_cont">

                    <div class="form-group">

                       {!! Form::label('business_fname', trans('profile.business_fname') , array('class' => 'control-label')); !!}



                       {!! Form::text('business_fname',$UserBusinessData['contact_firstname'], array('id' => 'lastname', 'class' => 'form-control', 'placeholder' => trans('profile.business_fname'))) !!}



                       <span class="glyphicon {{ $errors->has('business_fname') ? ' glyphicon-asterisk ' : ' ' }} form-control-feedback" aria-hidden="true"></span>



                       @if ($errors->has('business_fname'))



                       <span class="help-block">

                        <strong>{{ $errors->first('business_fname') }}</strong>

                    </span>



                    @endif

                </div>

            </div>







            <div class="bussthree_cont">

                <div class="form-group">

                    {!! Form::label('business_lname', trans('profile.business_lname') , array('class' => 'control-label')); !!}



                    {!! Form::text('business_lname',$UserBusinessData['contact_lastname'], array('id' => 'business_lname', 'class' => 'form-control', 'placeholder' => trans('profile.business_lname'))) !!}



                    <span class="glyphicon {{ $errors->has('business_lname') ? ' glyphicon-asterisk ' : ' ' }} form-control-feedback" aria-hidden="true"></span>

                    @if ($errors->has('business_lname'))

                    <span class="help-block">

                        <strong>{{ $errors->first('business_lname') }}</strong>

                    </span>

                    @endif



                </div>

            </div>
        </div>


        <div class="textfield_full">
            <div class="bussthree_cont">

                <div class="form-group">



                   {!! Form::label('business_address', trans('profile.business_address') , array('class' => 'control-label')); !!}



                   {!! Form::text('business_address',$UserBusinessData['address'], array('id' => 'businesss_address', 'class' => 'form-control', 'placeholder' => trans('profile.business_address'))) !!}



                   <span class="glyphicon {{ $errors->has('business_address') ? ' glyphicon-asterisk ' : ' ' }} form-control-feedback" aria-hidden="true"></span>



                   @if ($errors->has('business_address'))



                   <span class="help-block">



                    <strong>{{ $errors->first('business_address') }}</strong>



                </span>



                @endif

            </div>

        </div>







        <div class="bussthree_cont">

            <div class="form-group">



               {!! Form::label('business_city', trans('profile.business_city') , array('class' => 'control-label')); !!}



               {!! Form::text('business_city',$UserBusinessData['city'], array('id' => 'businesss_city', 'class' => 'form-control', 'placeholder' => trans('profile.business_city'))) !!}



               <span class="glyphicon {{ $errors->has('business_city') ? ' glyphicon-asterisk ' : ' ' }} form-control-feedback" aria-hidden="true"></span>



               @if ($errors->has('business_city'))



               <span class="help-block">



                <strong>{{ $errors->first('business_city') }}</strong>



            </span>



            @endif

        </div>

    </div>







    <div class="bussthree_cont">

        <div class="form-group">



            {!! Form::label('business_state', trans('profile.business_state') , array('class' => 'control-label')); !!}



            {!! state($UserBusinessData['state']) !!}



            @if ($errors->has('business_state'))



            <span class="help-block">



                <strong>{{ $errors->first('business_state') }}</strong>



            </span>



            @endif

        </div>

    </div>
</div>


<div class="textfield_full">
    <div class="bussthree_cont">

        <div class="form-group">

            {!! Form::label('business_zip', trans('profile.business_zip') , array('class' => 'control-label')); !!}



            {!! Form::text('business_zip',$UserBusinessData['zip'], array('id' => 'businesss_city', 'class' => 'form-control', 'placeholder' => trans('profile.business_zip'))) !!}



            <span class="glyphicon {{ $errors->has('business_zip') ? ' glyphicon-asterisk ' : ' ' }} form-control-feedback" aria-hidden="true"></span>



            @if ($errors->has('business_zip'))



            <span class="help-block">

                <strong>{{ $errors->first('business_zip') }}</strong>

            </span>

            @endif

        </div>

    </div>



    <div class="bussthree_cont">

        <div class="form-group">



            {!! Form::label('business_phone', trans('profile.business_phone') , array('class' => 'control-label')); !!}



            {!! Form::text('business_phone',$UserBusinessData['phone'], array('id' => 'business_phone', 'class' => 'form-control', 'placeholder' => trans('profile.business_phone'))) !!}



            <span class="glyphicon {{ $errors->has('business_phone') ? ' glyphicon-asterisk ' : ' ' }} form-control-feedback" aria-hidden="true"></span>



            @if ($errors->has('business_phone'))



            <span class="help-block">

                <strong>{{ $errors->first('business_phone') }}</strong>

            </span>



            @endif

        </div>

    </div>







    <div class="bussthree_cont">

        <div class="form-group">

            {!! Form::label('business_additional_phone', trans('profile.business_additional_phone') , array('class' => 'control-label')); !!}



            {!! Form::text('business_additional_phone',$UserBusinessData['phone2'], array('id' => 'business_additional_phone', 'class' => 'form-control', 'placeholder' => trans('profile.business_additional_phone'))) !!}



            <span class="glyphicon {{ $errors->has('business_phone') ? ' glyphicon-asterisk ' : ' ' }} form-control-feedback" aria-hidden="true"></span>



            @if ($errors->has('business_additional_phone'))



            <span class="help-block">

                <strong>{{ $errors->first('business_additional_phone') }}</strong>

            </span>

            @endif

        </div>

    </div>
</div>



<div class="textfield_full">
    <div class="bussthree_cont">

        <div class="form-group">

            {!! Form::label('business_timezone', trans('profile.business_timezone') , array('class' => 'control-label')); !!}

            <select name="business_timezone">

                <option value="">Select Timezone</option>

                <option value="1" @if($UserBusinessData['timezone'] == 1) selected @endif>Eastern</option>

                <option value="2" @if($UserBusinessData['timezone'] == 2) selected @endif>Central</option>

                <option value="3" @if($UserBusinessData['timezone'] == 3) selected @endif>Mountain</option>

                <option value="4" @if($UserBusinessData['timezone'] == 4) selected @endif>Pacific</option>

                <option value="5" @if($UserBusinessData['timezone'] == 5) selected @endif>Alaska</option>

                <option value="6" @if($UserBusinessData['timezone'] == 6) selected @endif>Hawaii</option>

                <option value="7" @if($UserBusinessData['timezone'] == 7) selected @endif>Other</option>

            </select>

            @if ($errors->has('business_timezone'))

            <span class="help-block">

                <strong>{{ $errors->first('business_timezone') }}</strong>

            </span>



            @endif

        </div>

    </div>











    <div class="bussthree_cont">

        <div class="form-group">

            {!! Form::label('business_email', trans('profile.business_email') , array('class' => 'control-label')); !!}



            {!! Form::email('business_email',$UserBusinessData['email'], array('id' => 'business_email', 'class' => 'form-control', 'placeholder' => trans('profile.business_email'), 'required')) !!}



            <span class="glyphicon {{ $errors->has('business_email') ? ' glyphicon-asterisk ' : ' ' }} form-control-feedback" aria-hidden="true"></span>



            @if ($errors->has('business_email'))



            <span class="help-block">



                <strong>{{ $errors->first('business_email') }}</strong>



            </span>



            @endif

        </div>

    </div>







    <div class="bussthree_cont">

        <div class="form-group">

            {!! Form::label('business_website', trans('profile.business_website') , array('class' => 'control-label')); !!}



            {!! Form::text('business_website',$UserBusinessData['website'], array('id' => 'business_email', 'class' => 'form-control', 'placeholder' => trans('profile.business_website'))) !!}



            <span class="glyphicon {{ $errors->has('business_website') ? ' glyphicon-asterisk ' : ' ' }} form-control-feedback" aria-hidden="true"></span>



            @if ($errors->has('business_website'))



            <span class="help-block">



                <strong>{{ $errors->first('business_website') }}</strong>



            </span>



            @endif

        </div>

    </div>
</div>






<div class="textfield_full">
    <div class="bussthree_cont">

        <div class="form-group">

            {!! Form::label('business_paypal_email', trans('profile.business_paypal_email') , array('class' => 'control-label')); !!}



            {!! Form::email('business_paypal_email',$UserBusinessData['paypal_email'], array('id' => 'business_paypal_email', 'class' => 'form-control', 'placeholder' => trans('profile.business_paypal_email'))) !!}



            <span class="glyphicon {{ $errors->has('business_paypal_email') ? ' glyphicon-asterisk ' : ' ' }} form-control-feedback" aria-hidden="true"></span>



            @if ($errors->has('business_paypal_email'))



            <span class="help-block">

                <strong>{{ $errors->first('business_paypal_email') }}</strong>

            </span>



            @endif

        </div>

    </div>



    <div class="bussthree_cont">

        <div class="form-group">

            {!! Form::label('business_public_email', trans('profile.business_public_email') , array('class' => 'control-label')); !!}



            {!! Form::email('business_public_email',$UserBusinessData['public_email'], array('id' => 'business_public_email', 'class' => 'form-control', 'placeholder' => trans('profile.business_public_email'))) !!}



            <span class="glyphicon {{ $errors->has('business_public_email') ? ' glyphicon-asterisk ' : ' ' }} form-control-feedback" aria-hidden="true"></span>



            @if ($errors->has('business_public_email'))



            <span class="help-block">

                <strong>{{ $errors->first('business_public_email') }}</strong>

            </span>



            @endif

        </div>

    </div>



    <div class="bussthree_cont">

        <div class="form-group">

            {!! Form::label('business_secondary_email', trans('profile.business_secondary_email') , array('class' => 'control-label')); !!}



            {!! Form::email('business_secondary_email',$UserBusinessData['email2'], array('id' => 'business_secondary_email', 'class' => 'form-control', 'placeholder' => trans('profile.business_secondary_email'))) !!}



            <span class="glyphicon {{ $errors->has('business_secondary_email') ? ' glyphicon-asterisk ' : ' ' }} form-control-feedback" aria-hidden="true"></span>



            @if ($errors->has('business_secondary_email'))



            <span class="help-block">



                <strong>{{ $errors->first('business_secondary_email') }}</strong>



            </span>



            @endif

        </div>

    </div>
</div>


<div class="textfield_full">
    <div class="bussthree_cont">

        <div class="form-group">

            {!! Form::label('no_cancel_within', trans('profile.no_cancel_within') , array('class' => 'control-label')); !!}



            <select name="no_cancel_within" class="smallselect">



                <option value="24">24 hours</option>  



                <option value="">Choose</option>



                <option value="2">2 hours</option>



                <option value="12">12 hours</option>



                <option value="24">24 hours</option>



                <option value="36">36 hours</option>



                <option value="48">48 hours</option>



                <option value="72">72 hours</option>



                <option value="96">96 hours</option>



            </select>



            @if ($errors->has('no_cancel_within'))



            <span class="help-block">



                <strong>{{ $errors->first('no_cancel_within') }}</strong>



            </span>



            @endif



        </div>

    </div>

    <div class="bussthree_cont">

        <div class="form-group">

            {!! Form::label('enotice_days_before', trans('profile.enotice_days_before') , array('class' => 'control-label')); !!}

            <select name="enotice_days_before" class="smallselect">

                <option value="0">None</option>

                <option value="1">24-48 hours</option>

                <option value="2">48-72 hours</option>

                <option value="3">72+ hours</option>

            </select>

            @if ($errors->has('enotice_days_before'))

            <span class="help-block">

                <strong>{{ $errors->first('enotice_days_before') }}</strong>

            </span>

            @endif

        </div>

    </div>

    <div class="bussthree_cont">

        <div class="form-group">

            {!! Form::label('include_event_ics', trans('profile.include_event_ics') , array('class' => 'control-label')); !!}

            <select name="include_event_ics" class="smallselect">

                <option value="0">None</option>

                <option value="1">Client Only</option>

                <option value="2">Inspector Only</option>

                <option value="4">Everyone</option>

            </select>

            @if ($errors->has('include_event_ics'))

            <span class="help-block">

                <strong>{{ $errors->first('include_event_ics') }}</strong>

            </span>

            @endif

        </div>

    </div>
</div>

<div class="textfield_full">
    <div class="bussthree_cont">

        <div class="form-group">
            {{ Form::checkbox('offer_cancellation',1,$UserBusinessData['offer_cancellation']) }}
            {!! Form::label('offer_cancellation', trans('profile.offer_cancellation') , array('class' => 'control-label')); !!}

        </div>

    </div>


    <div class="bussthree_cont">

        <div class="form-group">
            {{ Form::checkbox('offer_paypal_account',1,$UserBusinessData['paypal']) }}
            {!! Form::label('business_offer_paypal_account', trans('profile.business_offer_paypal_account') , array('class' => 'control-label')); !!}

        </div>
    </div>



    

    <div class="bussthree_cont">
        <div class="form-group">
            {{ Form::checkbox('require_inspection_zip',1,$UserBusinessData['require_inspection_zip']) }}
            {!! Form::label('require_inspection_zip', trans('profile.require_inspection_zip') , array('class' => 'control-label')); !!}
        </div>

    </div>
</div>



<div class="textfield_full">
    <div class="bussthree_cont">
        <div class="form-group">
            {{ Form::checkbox('print_ticket_email',1,$UserBusinessData['print_ticket_email']) }}
            {!! Form::label('print_ticket_email', trans('profile.print_ticket_email') , array('class' => 'control-label')); !!}

        </div>

    </div>



    <div class="bussthree_cont">

        <div class="form-group">
            {{ Form::checkbox('require_agent',1,$UserBusinessData['require_agent']) }}
            {!! Form::label('require_agent', trans('profile.require_agent') , array('class' => 'control-label')); !!}

            
        </div>

    </div>



    <div class="bussthree_cont">

        <div class="form-group">
            {{ Form::checkbox('require_listing_agent',1,$UserBusinessData['require_listing_agent']) }}
            {!! Form::label('require_listing_agent', trans('profile.require_listing_agent') , array('class' => 'control-label')); !!}

        </div>

    </div>
</div>



<div class="textfield_full">

    <div class="form-group">
        {{ Form::checkbox('agent_company_label',1,$UserBusinessData['agent_company_label']) }}
        {!! Form::label('agent_company_label', trans('profile.agent_company_label') , array('class' => 'control-label')); !!}

    </div>

</div>



<div class="textfield_full">

    <div class="form-group">


        {!! Form::button(trans('profile.updatebusinessButton'),



        array(



        'class'             => 'btn btn-success gmailbtn',



        'type'              => 'submit',

        $behaviour



        )) !!}



    </div>



</div>



{!! Form::close() !!}



</div>
</div>

</div>

</div>







@endsection