@extends('layouts.front')



@section('content')

    <div class="signup_section">

        <div class="signup_cont nsignup_cont">
            <div class="container">
            <h3>Personal Profile</h3>

                {!! Form::model($UserData, array('action' => array('ProfileController@updateUserAccount'), 'method' => 'POST','id'=>'Userdata')) !!}

                {{ csrf_field() }}
                <div class="has-feedback {{ $errors->has('firstname') ? ' has-error ' : '' }}">

                    <div class="textfield_left">
                        <div class="form-group">
                            {!! Form::label('firstname', trans('profile.firstname') , array('class' => 'formlabel')); !!} 

                            {!! Form::text('firstname',$UserData['name'], array('id' => 'firstname', 'class' => 'form-control', 'placeholder' => trans('profile.firstname'), 'title' => 'Firstname')) !!}

                            <input type="hidden" name="userid" value="{{$UserData['user_id']}}">

                            <span class="glyphicon {{ $errors->has('firstname') ? ' glyphicon-asterisk ' : ' ' }} form-control-feedback" aria-hidden="true"></span>

                            @if ($errors->has('firstname'))

                            <span class="help-block">
                                <strong>{{ $errors->first('firstname') }}</strong>
                            </span>

                            @endif
                        </div>
                    </div>



                 <div class="textfield_right">
                    <div class="form-group">
                        {!! Form::label('lastname', trans('profile.lastname') , array('class' => 'formlabel')); !!}

                        {!! Form::text('lastname',$UserData['lastname'], array('id' => 'lastname', 'class' => 'form-control', 'placeholder' => trans('profile.lastname'), 'title' => 'Lastname')) !!}

                        <span class="glyphicon {{ $errors->has('lastname') ? ' glyphicon-asterisk ' : ' ' }} form-control-feedback" aria-hidden="true"></span>

                        @if ($errors->has('lastname'))

                        <span class="help-block">
                            <strong>{{ $errors->first('lastname') }}</strong>
                        </span>

                        @endif
                    </div>
                </div>

                <div class="textfield_left typeWorkPerfomed">
                    <div class="form-group">
                        {!! Form::label('typework', 'Type Of Work Performed', array('class' => 'formlabel')); !!}

                        @php
                            if(!empty(session('CustomIndustryName')) || session('CustomIndustryName') != null) {
                                $IndusName = session('CustomIndustryName');
                            } else {
                                $IndusName = session('IndustryName');
                            }
                        @endphp

                        {!! Form::text('typework', $IndusName, array('id' => 'typework', 'class' => 'form-control small_select', 'placeholder' => 'Type Of Work Performed', 'title' => 'Type of work')) !!}

                        <!-- <select name="typework" id='typework' class='small_select'>
                            <option value="-1">Select Industrial</option>
                            @foreach($allindustries as $key => $industries)
                                <option value="{{ $key }}" @if(session('IndustryName') == $industries) selected @endif>{{ $industries }}</option>
                            @endforeach
                        </select> -->

                        <!-- {!! Form::text('typework', $UserData['typework'], array('id' => 'typework', 'class' => 'form-control', 'placeholder' => 'Type Of Work Performed', 'title' => 'typework')) !!} -->

                        <span class="glyphicon {{ $errors->has('typework') ? ' glyphicon-asterisk ' : ' ' }} form-control-feedback" aria-hidden="true"></span>

                        @if ($errors->has('typework'))

                        <span class="help-block">
                            <strong>{{ $errors->first('typework') }}</strong>
                        </span>

                        @endif
                    </div>
                </div>

                <div class="textfield_right joinemail">
                    <div class="form-group">
                        {!! Form::label('backupEmail', 'Primary Email / Backup Email' , array('class' => 'formlabel')); !!}

                     <div class="mail_confirm">   {!! Form::text('Email', $UserData->user->email, array('id' => 'Email', 'class' => 'form-control', 'placeholder' => 'Email', 'title' => 'Email')) !!} <span class="slashspan">/</span> {!! Form::text('backupEmail', $UserData['email2'], array('id' => 'backupEmail', 'class' => 'form-control', 'placeholder' => trans('profile.backupEmail'), 'title' => 'Backup Email')) !!}
                     </div>

                        <span class="glyphicon {{ $errors->has('backupEmail') ? ' glyphicon-asterisk ' : ' ' }} form-control-feedback" aria-hidden="true"></span>

                        @if ($errors->has('backupEmail'))

                        <span class="help-block">
                            <strong>{{ $errors->first('backupEmail') }}</strong>
                        </span>

                        @endif
                    </div>
                </div>

                <div class="textfield_left">
                    <div class="form-group">
                        {!! Form::label('username', 'Username' , array('class' => 'formlabel')); !!}

                        {!! Form::text('username', $UserData->user->name, array('id' => 'username', 'class' => 'form-control', 'placeholder' => trans('profile.username'), 'title' => 'Username')) !!}

                        <span class="glyphicon {{ $errors->has('username') ? ' glyphicon-asterisk ' : ' ' }} form-control-feedback" aria-hidden="true"></span>

                        @if ($errors->has('username'))

                        <span class="help-block">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>

                        @endif
                    </div>
                </div>

                 <div class="textfield_right">
                    <div class="form-group">
                            {!! Form::label('password', 'Password' , array('class' => 'formlabel')); !!}
                        <input name="password" id="password" type="password" class="{{ $errors->has('password') ? ' is-invalid' : '' }} form-control" placeholder="Password" autofocus title="Password">

                       @if ($errors->has('password'))

                           <span class="invalid-feedback">
                               <strong>{{ $errors->first('password') }}</strong>
                           </span>
                       @endif
                    </div> 
                </div>

                <!-- Confirm Password -->
                <div class="textfield_left">
                    <div class="form-group">
                    {!! Form::label('password_confirmation', 'Confirm Password', array('class' => 'formlabel')); !!}

                       <input name="password_confirmation" id="password-confirm" type="password" placeholder="Confirm Password" class="form-control" autofocus title="Confirm Password">
                    </div>
                </div>

                  <div class="textfield_right">
                   <div class="form-group">
                        {!! Form::Label('Days in Advance Padding', 'Days in Advance Padding') !!}
                        <br>
                       <span>How many days should the scheduler skip before offering your first appointment?</span>
                        {!! show_day_padding($UserData->padding_day) !!}

                    </div>

                </div>


                <div class="col-12">
                    <div class="form-group">
                        {!! Form::Label('Days Forward', 'Days Forward') !!}
                        <br>
                         <span>Specify the total number of days to look forward for available appointment times.</span>
                        {!! show_day_forward($UserData->look_ahead) !!}
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        {!! Form::Label('Trim Day List', 'Trim Day List') !!}
                        <br>
                        <span>Throttle Schedule Openings (only show some available times <br>after 10 days out).</span>
                        {{ Form::checkbox('throttle',1,$UserData->throttle) }}
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        {!! Form::Label('Inspector Masking', $IndusName.' Masking') !!} <br>
                        <span>Hide this {{ $IndusName }} from public booking view..</span>
                        {{ Form::checkbox('throttle',1,$UserData->last_login) }}
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        {!! Form::Label('User Privileges', 'User Privileges') !!}
                        <br>
                        <span>Is company administrator (can manage {{ $IndusName }} for SV Inspection Service).</span>
                        {{ Form::checkbox('permission',1,$UserData->permission) }}
                    </div>
                </div>

            </div>

            <div class="col-12 offset-sm-4">
                <div class="form-group">
                    {!! Form::button(trans('profile.submitButton'),

                     array(

                        'class'             => 'btn btn-success gmailbtn',

                        'type'              => 'submit',

                    )) !!}
                </div>
            </div>

            {!! Form::close() !!}
        </div>
        </div>
    </div>

@endsection

