@extends('layouts.front')



@section('content')

    <div class="signup_section">

        <div class="signup_cont nsignup_cont">
            <div class="container">
            <h3>Personal Profile</h3>

                {!! Form::model($UserData, array('action' => array('ProfileController@updateUserAccount'), 'method' => 'POST','id'=>'Userdata')) !!}

                {{ csrf_field() }}
                <div class="has-feedback {{ $errors->has('firstname') ? ' has-error ' : '' }}">

                    <div class="col-12">
                        <div class="form-group">
                            <!-- {!! Form::label('firstname', trans('profile.firstname') , array('class' => 'col-12 control-label')); !!} -->

                            {!! Form::text('firstname',$UserData['name'], array('id' => 'firstname', 'class' => 'form-control', 'placeholder' => trans('profile.firstname'))) !!}

                            <input type="hidden" name="userid" value="{{$UserData['user_id']}}">

                            <span class="glyphicon {{ $errors->has('firstname') ? ' glyphicon-asterisk ' : ' ' }} form-control-feedback" aria-hidden="true"></span>

                            @if ($errors->has('firstname'))

                            <span class="help-block">
                                <strong>{{ $errors->first('firstname') }}</strong>
                            </span>

                            @endif
                        </div>
                    </div>



                 <div class="col-12">
                    <div class="form-group">
                        <!-- {!! Form::label('lastname', trans('profile.lastname') , array('class' => 'col-12 control-label')); !!} -->

                        {!! Form::text('lastname',$UserData['lastname'], array('id' => 'lastname', 'class' => 'form-control', 'placeholder' => trans('profile.lastname'))) !!}

                        <span class="glyphicon {{ $errors->has('lastname') ? ' glyphicon-asterisk ' : ' ' }} form-control-feedback" aria-hidden="true"></span>

                        @if ($errors->has('lastname'))

                        <span class="help-block">
                            <strong>{{ $errors->first('lastname') }}</strong>
                        </span>

                        @endif
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <!-- {!! Form::label('backupEmail', trans('profile.backupEmail') , array('class' => 'col-12 control-label')); !!} -->

                        {!! Form::text('backupEmail',$UserData['email2'], array('id' => 'backupEmail', 'class' => 'form-control', 'placeholder' => trans('profile.backupEmail'))) !!}

                        <span class="glyphicon {{ $errors->has('backupEmail') ? ' glyphicon-asterisk ' : ' ' }} form-control-feedback" aria-hidden="true"></span>

                        @if ($errors->has('backupEmail'))

                        <span class="help-block">
                            <strong>{{ $errors->first('backupEmail') }}</strong>
                        </span>

                        @endif
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <!-- {!! Form::label('username', trans('profile.username') , array('class' => 'col-12 control-label')); !!} -->

                        {!! Form::text('username',$UserData->user->name, array('id' => 'username', 'class' => 'form-control', 'placeholder' => trans('profile.username'))) !!}

                        <span class="glyphicon {{ $errors->has('username') ? ' glyphicon-asterisk ' : ' ' }} form-control-feedback" aria-hidden="true"></span>

                        @if ($errors->has('username'))

                        <span class="help-block">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>

                        @endif
                    </div>
                </div>

                 <div class="col-12">
                    <div class="form-group">
                        <input name="password" id="password" type="password" class="{{ $errors->has('password') ? ' is-invalid' : '' }} form-control" placeholder="Password"  autofocus>

                       @if ($errors->has('password'))

                           <span class="invalid-feedback">
                               <strong>{{ $errors->first('password') }}</strong>
                           </span>
                       @endif
                    </div> 
                </div>

                <!-- Confirm Password -->
                <div class="col-12">
                    <div class="form-group">
                       <input name="password_confirmation" id="password-confirm" type="password" placeholder="Confirm Password" class="form-control"  autofocus>
                    </div>
                </div>

                  <div class="col-12">
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
                        {!! Form::Label('Inspector Masking', 'Inspector Masking') !!} <br>
                        <span>Hide this Inspector from public booking view..</span>
                        {{ Form::checkbox('throttle',1,$UserData->last_login) }}
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        {!! Form::Label('User Privileges', 'User Privileges') !!}
                        <br>
                        <span>Is company administrator (can manage Inspectors for SV Inspection Service).</span>
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

