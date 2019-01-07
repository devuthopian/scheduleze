@guest
<div class="footer_section">
    @else
    <div class="footer_section loguser">
        @endguest
        <div class="container">
            <!-- <div class="footer_top">
                <div class="footer_top_cont">
                    <img src="{{ url('images/footer_icon1.png') }}" alt="">
                    <p>Snailmail Address:<br>
                        Scheduleze ,PO Box 670382<br>
                        Chugiak, Alaska 99567
                    </p>
                </div>
                <div class="footer_top_cont">
                    <img src="{{ url('images/footer_icon1.png') }}" alt="">
                    <p>Sometimes you just want a <br>'real' person::<br> 907.223.4958  </p>
                </div>
                <div class="footer_top_cont">
                    <img src="{{ url('images/footer_icon1.png') }}" alt="">
                    <p>Email:<br> General Email:<br> info@scheduleze.com </p>
                </div>
            </div> -->
            @php 
                $strchr = substr(strrchr(url()->current(),"/"),1); 
            @endphp
            @guest
            @if($strchr != 'ConfirmStatus')
            <div class="footer_bottom">

                <div class="col-sm-4">
                    <h3>Contact <br> Scheduleze</h3>
                    <p>Thanks for your interest in Scheduleze. Please contact us<br>
                        at one of these cell-phone free email addresses.
                    </p>
                    <span><a href="#" data-toggle="modal" data-target="#myModalTerms">B2B Inquiries</a></span>
                </div>

                <div class="col-sm-4">
                    <div class="quick_links">
                        <h3>Quick <br> Links</h3>
                        <ul>
                            <li><a href="{{ url('/') }}">Scheduling Solutions</a></li>
                            <li><a href="{{ url('success_stories') }}">Success  Stories</a></li>
                            <li><a href="{{ url('demo') }}">Video</a></li>
                            <li><a href="{{ url('scheduling_faq') }}">FAQ</a></li>
                            <li><a href="{{ url('contact') }}">Contact</a></li>
                            <li><a href="{{ route('login') }}">Client Login</a></li>
                        </ul>
                    </div>
                </div>
            @endif
                

                @if($strchr != 'login' && $strchr != 'account_info' && $strchr != 'ConfirmStatus')
                    <div class="col-sm-4" id="signup">
                        <h3>Try it now free for <br>30 days</h3>
                        @php
                            $allindustries = getallIndustries();
                            $allEngage = getAllEngage();
                            $get_all_usernames = get_all_usernames('users', 'name');
                            $get_key_usernames = array_values(array_filter($get_all_usernames));
                            $key_username = implode(",", $get_key_usernames);
                        @endphp
                        <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}" id="PostForm" class="form" @submit.prevent="validateBeforeSubmit">
                            @csrf

                            <!-- Industries Dropdown -->
                            <select name="txtIndustries" v-validate="'excluded:-1'" data-vv-as="selected">
                                <option value="-1">Select Industrial</option>
                                @foreach($allindustries as $key => $industries)
                                    <option  value="{{ $key }}">{{ $industries }}</option>
                                @endforeach
                            </select>
                            <i v-show="errors.has('txtIndustries')" class="fa fa-warning"></i>
                            <span v-show="errors.has('txtIndustries')" class="help is-danger">@{{ errors.first('txtIndustries') }}</span>

                            <!-- Engage Dropdown -->
                            <select name="txtEngage" v-validate="'excluded:-1'" data-vv-as="selected">
                                <option value="-1">How do you engage your Customers?</option>
                                @foreach($allEngage as $key => $engage)
                                    <option  value="{{ $key }}">{{ $engage }}</option>
                                @endforeach
                            </select>
                            <i v-show="errors.has('txtEngage')" class="fa fa-warning"></i>
                            <span v-show="errors.has('txtEngage')" class="help is-danger">@{{ errors.first('txtEngage') }}</span>

                            <input type="text" name="email" v-validate="'required|email'" :class="{'input': true, 'is-danger': errors.has('email') }" placeholder="Business Email" />
                            <i v-show="errors.has('email')" class="fa fa-warning"></i>
                            <span v-show="errors.has('email')" class="help is-danger">@{{ errors.first('email') }}</span>

                            <input type="text" name="name" v-validate="'required|alpha|excluded:{{ $key_username }}'" :class="{'input': true, 'is-danger': errors.has('name')}" placeholder="Username">
                            <i v-show="errors.has('name')" class="fa fa-warning"></i>
                            <span v-show="errors.has('name')" class="help is-danger">@{{ errors.first('name') }}</span>
                            <!--  <signupform-component></signupform-component> -->

                            <p>Before you can complete your registration, you must accept our <a href="{{ url('terms_policy') }}" target="_blank" title="Terms of Service">Terms of Service</a>.</p>
                            <div class="bussthree_cont">
                                <div class="form-group">
                                    <input name="term_checkbox" type="checkbox" id="agree_term" value="check" @click="clickagreementcheck">
                                    <label for="agree_term" class="control-label">I accept the Terms of Service</label>
                                </div>
                            </div>
                            <input class="btn cls-agree-btn" type="submit" value="TRY IT NOW" disabled name="">
                        </form>
                    </div>
                    <script src="{{ asset('js/app.js') }}" defer></script>
                @endif

            </div>
            @endguest
        </div>

        <!-- Popup for search menu -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Search Appointments</h4>
                    </div>
                    <div class="modal-body">
                        <div class="signup_cont nsignup_cont">
                            <div class="container">
                                <form action="{{ url('/scheduleze/booking/AdvanceFilter') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            {!! Form::label('address', 'Address', array('class' => 'control-label')); !!}
                                            <input type="text" name="txtAddress">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            {!! Form::label('client_name', 'Client Name', array('class' => 'control-label')); !!}
                                            <input type="text" name="txtClientName">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            {!! Form::label('agent_name', 'Agent Name', array('class' => 'control-label')); !!}
                                            <input type="text" name="txtAgentName">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            {!! Form::label('keyword', 'Keyword', array('class' => 'control-label')); !!}
                                            <input type="text" name="txtKeyword">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            {!!
                                            Form::button('Search', array(
                                            'class'             => 'btn btn-success gmailbtn',
                                            'type'              => 'submit',
                                            ))
                                            !!}
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

        <div id="myModalTerms" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">We look forward to hearing about future business opportunities; however, our #1 priority is to our subscribers. Please send us your message in the space provided; we will cheerfully reply as time permits. Thank you</h4>
                    </div>
                    <form action="{{ url('/b2b') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div>
                                <div class="container">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            {!! Form::label('email', 'Your Email', array('class' => 'control-label')); !!}
                                            <input type="email" name="txtEmail" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            {!! Form::label('name', 'Your Name', array('class' => 'control-label')); !!}
                                            <input type="text" name="txtName" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            {!! Form::label('message', 'Message', array('class' => 'control-label')); !!}
                                            <textarea class="form-control" name="textareaMessage" rows="5" required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" name="txtSubmit" class="btn" value="Send" style="width: auto;">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
        
            </div>
        </div>

        <div class="copyright_section">
            <div class="container">
                <div class="copright_left">&copy; copyright all rights reserved</div>
                <div class="copright_right" bgcolor="#dfa427">
                    <a href="mailto:support@scheduleze.com" class="bottom">support@scheduleze.com</a>
                </div>
            </div>
        </div>
    </div>