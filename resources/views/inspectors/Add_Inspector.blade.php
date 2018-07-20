@extends('layouts.front')

@section('content')
    <div class="signup_section">
        <div class="signup_cont">
            <h3>New Inspector</h3>
            <form role="form" method="post" action="{{action('InspectorController@save_inspector')}}">
                {{ csrf_field() }}
                <div class="form-group has-feedback {{ $errors->has('firstname') ? ' has-error ' : '' }}">
                <div class="col-12">
                 {!! Form::label('firstname', trans('profile.firstname') , array('class' => 'col-12 control-label')); !!}
                {!! Form::text('firstname',NULL, array('id' => 'firstname', 'class' => 'form-control', 'placeholder' => trans('profile.firstname'))) !!}
                <span class="glyphicon {{ $errors->has('firstname') ? ' glyphicon-asterisk ' : ' ' }} form-control-feedback" aria-hidden="true"></span>
                @if ($errors->has('firstname'))
                <span class="help-block">
                    <strong>{{ $errors->first('firstname') }}</strong>
                </span>
                @endif
                </div>

                 <div class="col-12">
                 {!! Form::label('lastname', trans('profile.lastname') , array('class' => 'col-12 control-label')); !!}
                {!! Form::text('lastname',NULL, array('id' => 'lastname', 'class' => 'form-control', 'placeholder' => trans('profile.lastname'))) !!}
                <span class="glyphicon {{ $errors->has('lastname') ? ' glyphicon-asterisk ' : ' ' }} form-control-feedback" aria-hidden="true"></span>
                @if ($errors->has('lastname'))
                <span class="help-block">
                    <strong>{{ $errors->first('lastname') }}</strong>
                </span>
                @endif
                </div>


                    <div class="col-12">
               
                {!! Form::text('email',NULL, array('id' => 'email', 'class' => 'form-control', 'placeholder' => 'Email')) !!}
                <span class="glyphicon {{ $errors->has('email') ? ' glyphicon-asterisk ' : ' ' }} form-control-feedback" aria-hidden="true"></span>
                @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
                </div>


                 <div class="col-12">
                {!! Form::label('backupEmail', trans('profile.backupEmail') , array('class' => 'col-12 control-label')); !!}
                {!! Form::text('backupEmail',NULL, array('id' => 'backupEmail', 'class' => 'form-control', 'placeholder' => trans('profile.backupEmail'))) !!}
                <span class="glyphicon {{ $errors->has('backupEmail') ? ' glyphicon-asterisk ' : ' ' }} form-control-feedback" aria-hidden="true"></span>
                @if ($errors->has('backupEmail'))
                <span class="help-block">
                    <strong>{{ $errors->first('backupEmail') }}</strong>
                </span>
                @endif
                </div>


                 <div class="col-12">
                 {!! Form::label('username', trans('profile.username') , array('class' => 'col-12 control-label')); !!}
                {!! Form::text('username',NULL, array('id' => 'username', 'class' => 'form-control', 'placeholder' => trans('profile.username'))) !!}
                <span class="glyphicon {{ $errors->has('username') ? ' glyphicon-asterisk ' : ' ' }} form-control-feedback" aria-hidden="true"></span>
                @if ($errors->has('username'))
                <span class="help-block">
                    <strong>{{ $errors->first('username') }}</strong>
                </span>
                @endif
                </div>

                  <div class="col-12">
                    <input name="password" id="password" type="password" class="{{ $errors->has('password') ? ' is-invalid' : '' }} form-control" placeholder="Password"  autofocus>

                   @if ($errors->has('password'))
                       <span class="invalid-feedback">
                           <strong>{{ $errors->first('password') }}</strong>
                       </span>
                   @endif
                   
                   <!-- Confirm Password -->
                   <input name="password_confirmation" id="password-confirm" type="password" placeholder="Confirm Password" class="form-control"  autofocus>
                   </div>
                  <div class="col-12">
                   <div class="form-group">
                        {!! Form::Label('Days in Advance Padding', 'Days in Advance Padding') !!}
                        <br>
                       <span>How many days should the scheduler skip before offering your first appointment?</span>
                        {!! show_day_padding() !!}
                    </div>
                    </div>
                     <div class="col-12">
                   <div class="form-group">
                        {!! Form::Label('Days Forward', 'Days Forward') !!}
                        <br>
                         <span>Specify the total number of days to look forward for available appointment times.</span>
                        {!! show_day_forward() !!}
                    </div>
                    </div>
                    <div class="col-12">
                   <div class="form-group">
                        {!! Form::Label('Trim Day List', 'Trim Day List') !!}
                        <br>
                        <span>Throttle Schedule Openings (only show some available times after 10 days out).</span>
                        {{ Form::checkbox('throttle',1,NULL) }}
                    </div>
                    </div>
                       <div class="col-12">
                   <div class="form-group">
                        {!! Form::Label('Inspector Masking', 'Inspector Masking') !!}
                        <br>
                        <span>Hide this Inspector from public booking view..</span>
                        {{ Form::checkbox('throttle',1,null) }}
                    </div>
                    </div>
                       <div class="col-12">
                   <div class="form-group">
                        {!! Form::Label('User Privileges', 'User Privileges') !!}
                        <br>
                        <span>Is company administrator (can manage Inspectors for SV Inspection Service).</span>
                        {{ Form::checkbox('permission',1,NULL) }}
                    </div>
                    </div>
                </div>
                <div class="form-group">
                <div class="col-12 offset-sm-4">
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
@endsection
