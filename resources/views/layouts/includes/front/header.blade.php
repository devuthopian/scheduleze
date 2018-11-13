<div class="loader"></div>
<div class="header_section">
    <div class="head_left"> @guest<a href="{{ url('scheduling_solutions') }}"> @else <a href="#"> @endguest<img src="{{ url('images/logo.png') }}" alt="Take command of your day" class="logohead"></a></div>
    <div class="head_right">
        <div class="navigation">
            @guest
                <nav>
                    <a href="#" class="n_toggle"><i class="fa fa-bars fa-2x"></i></a>
                    <ul>
                        <li><a href="{{ url('/#signup') }}">Scheduling Solution</a></li>
                        <li><a href="{{ url('success_stories#signup') }}">Success Stories</a></li>
                        <li><a href="{{ url('demo#signup') }}">Demo</a></li>
                        <li><a href="{{ url('/faq#signup') }}">FAQ</a></li>
                        <!--<li><a href="#">Support</a></li> -->
                        <li><a href="{{ url('contact#signup') }}">Contact</a></li>
                        @php 
                            $strchr = substr(strrchr(url()->current(),"/"),1); 
                        @endphp

                        @if($strchr != 'login' && $strchr != 'account_info')
                            <li class="try_it_now"><a href="#signup">Try It Now</a></li>
                            <li class="login"><a href="{{ route('login') }}">Login</a></li>
                        @endif
                    </ul>
                </nav>
            @else
                @php 
                    $hashvalue = session('hashvalue');
                    $permission = session('permission');
                    $id = Auth::user()->id;
                    $now = time();
                    $tomorrow = time() + 86400;
                    $tomorrow = get_todays_starttime($tomorrow);
                    $first = get_todays_starttime($now);
                    $getbusindus = getBusinessIndustry(session('indus_id'));
                    $administration = get_field('users_details', 'administrator', $id);
                    $day = 10;
                @endphp
                <nav id="app">
                    <a href="#" class="n_toggle" @click="doSomething"><i class="fa fa-bars fa-2x"></i></a>
                    <ul>
                        @guest
                            <li>
                                <a href="{{ url('scheduling_solutions') }}">Home</a>
                            </li>
                        @endguest
                        <li class="arrowicon">
                            <a href="#" @click="doSomethinginmenu">Appointments</a>
                            <ul >
                                <li>
                                    <a href="{{ url('/scheduleze/booking/appointment') }}">Bookings</a>
                                </li>
                                <li>
                                    @if(!empty($hashvalue))
                                        <a href="{{ url('template/'.$hashvalue) }}" target="_blank">Add Appointment</a>
                                    @else
                                        <a href="{{ url('scheduleze/appointments') }}" target="_blank">Add Appointment</a>
                                    @endif
                                </li>
                                <li>
                                    @if($administration == 1)
                                        <a href="{{ url('/scheduleze/dayticket/all/') }}">All Tickets</a>
                                    @else
                                        <a href="{{ url('/scheduleze/dayticket/'.$id.'/'.$first) }}">My Tickets</a>
                                    @endif
                                </li>
                                <li>
                                    <a href="{{ url('/scheduleze/dayticket/'.$id) }}">My Today</a>
                                </li>
                                <li>
                                    <a href="{{ url('/scheduleze/dayticket/'.$id.'/'.$tomorrow) }}">My Tomorrow </a>
                                </li>
                                <li>
                                    <a href="{{ url('/scheduleze/mapmyday') }}">Map My Today</a>
                                </li>
                                <li>
                                    <a href="#" data-toggle="modal" data-target="#myModal">Search</a>
                                </li>
                            </ul>
                        </li>                        
                        <li class="arrowicon">
                            <a href="#" @click="doSomethinginmenu">Blockouts</a>
                            <ul >
                                <li>
                                    <a href="{{ url('/scheduleze/booking/blockouts') }}">Blockouts</a>
                                </li>
                                <li>
                                    <a href="{{ url('/scheduleze/blockout/AddBlockout') }}">Add Blockout</a>
                                </li>
                                <li>
                                    <a href="{{ route('Reoccurrence') }}">Recurring</a>
                                </li>
                                <li>
                                    <a href="{{ url('scheduleze/BusinessHours') }}">Business Hours</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('Document') }}">Document</a>
                        </li>
                        @if($permission == 1 || $administration == 1)
                            <li class="arrowicon">
                                <a href="{{ url('/form/BuildingTypes') }}"  @click="doSomethinginmenu">{{ __('nav.services') }}</a>
                                <ul >
                                    <li>
                                        <a href="{{ url('/form/BuildingTypes') }}">{{ $getbusindus->type_label }}</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/form/BuildingSizes') }}">{{ $getbusindus->size_label }}</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/form/BuildingAges') }}">{{ $getbusindus->age_label }}</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/form/Addons') }}">{{ $getbusindus->addon_label }}</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="arrowicon">
                                <a href="{{ route('Location') }}"  @click="doSomethinginmenu">Locations</a>
                                <ul >
                                    <li>
                                        <a href="{{ route('Location') }}">Add/Remove Location</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('Drivetime') }}">Drivetimes</a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        <li class="arrowicon">
                            <a href="#"  @click="doSomethinginmenu">Users</a>
                            <ul >
                                <li>
                                    <a href="{{ route('Inspectors') }}">Inspectors</a>
                                </li>
                                @if($permission == 1 || $administration == 1)
                                    <li>
                                        <a href="{{ route('AddInspector') }}">Add Inspector</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                        <li class="arrowicon">
                            <a href="{{ url('profile') }}"  @click="doSomethinginmenu">Profile</a>
                            <ul>
                                <li>
                                    <a href="{{ url('profile') }}">User Profile</a>
                                </li>
                                <li>
                                    <a href="{{ url('business_info') }}">Business Profile</a>
                                </li>
                                @if($administration == 1)
                                    <li>
                                        <a href="{{ url('services/content') }}">Services Content</a>
                                    </li>
                                @endif
                                <li>
                                    <a href="{{ url('/profile/Email/Attachment') }}">Email Attachment</a>
                                </li>
                                <li>
                                    <a href="#">Recurring Payment</a>
                                </li>
                                @if($permission == 1 || $administration == 1)
                                    <li>
                                        <a href="{{ route('schedulepanel') }}">{{ __('nav.SchedulePanel') }}</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('ZigZag') }}">ZigZag</a>
                        </li>
                        <li class="arrowicon">
                            <a href="{{ url('profile') }}">{{ ucfirst(Auth::user()->name) }}</a>
                            <ul>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <!-- <li class="nav-item dropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li> -->
                    </ul>
                </nav>
            @endguest
        </div>
    </div>
</div>


    <div class="col-sm-10">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {!! session()->get('message') !!}
            </div>
        @endif
    </div>

    <div class="col-sm-10">
        @if(session()->has('warning'))
            <div class="alert alert-warning">
                {{ session()->get('warning') }}
            </div>
        @endif
    </div>

    @guest
    @else
        <?php if(empty(session('business_id'))){ ?>
            <div class="col-sm-10">            
                <div class="alert alert-warning">
                    You need to fill business info before proceeding to something else. It will help us to cooperate with you! <span class="breadcrumb"> Profile > Business Profile </span>
                </div>
            </div>
        <?php } ?>
    @endguest
