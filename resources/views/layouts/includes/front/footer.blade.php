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
        @guest
            <div class="footer_bottom">
                
                    <div class="col-sm-4">
                        <h3>Contact <br> Scheduleze</h3>
                        <p>Thanks for your interest in Scheduleze. Please contact us<br>
                            at one of these cell-phone free email addresses.
                        </p>
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
                @php 
                    $strchr = substr(strrchr(url()->current(),"/"),1); 
                @endphp

                @if($strchr != 'login' && $strchr != 'account_info')
                    <div class="col-sm-4" id="signup">
                        <h3>Try it now free for <br>30 days</h3>
                        @php $allindustries = getallIndustries() @endphp
                        <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                            @csrf
                            <select name="txtIndustries" required>
                                <option value="-1">Select Industrial</option>
                                @foreach($allindustries as $key => $industries)
                                    <option  value="{{ $key }}">{{ $industries }}</option>
                                @endforeach
                            </select>
                            <input id="email" type="email" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Business Email" required>
                            <!-- <input type="text" placeholder="Business Email"> -->
                            <input type="submit" value="TRY IT NOW" name="">
                        </form>
                    </div>
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
                        <form action="#" method="POST">
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
                            {!!
                                Form::button('Search', array(
                                    'class'             => 'btn btn-success gmailbtn',
                                    'type'              => 'submit',
                                ))
                            !!}
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

    <div class="copyright_section">
        <div class="container">
            <div class="copright_left">&copy; copyright all rights reserved</div>
            <div class="copright_right" bgcolor="#dfa427">
                <a href="mailto:support@scheduleze.com" class="bottom">support@scheduleze.com</a>
            </div>
        </div>
    </div>
</div>