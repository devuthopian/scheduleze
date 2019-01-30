<div class="loader"></div>

<div class="header_section">

    <div class="head_left"> @guest<a href="{{ url('scheduling_solutions') }}"> @else <a href="#"> @endguest<img src="{{ url('images/logo.png') }}" alt="Take command of your day" class="logohead"></a></div>

    <div class="head_right">

        <div class="navigation">

            @php 

                $strchr = substr(strrchr(url()->current(),"/"),1);

            @endphp

            @guest

                <nav>

                    <a href="#" class="n_toggle"><i class="fa fa-bars fa-2x"></i></a>

                    @if($strchr != 'backend')

                        <ul>

                            <li><a href="{{ url('/#signup') }}">Scheduling Solution</a></li>

                            <li><a href="{{ url('success_stories#signup') }}">Success Stories</a></li>

                            <li><a href="{{ url('demo#signup') }}">Demo</a></li>

                            <li><a href="{{ url('/faq#signup') }}">FAQ</a></li>

                            <!--<li><a href="#">Support</a></li> -->

                            <li><a href="{{ url('contact#signup') }}">Contact</a></li>

                            @if($strchr != 'login' && $strchr != 'account_info')

                                <li class="try_it_now"><a href="#signup">Try It Now</a></li>

                                <li class="login"><a href="{{ route('login') }}">Login</a></li>

                            @endif

                        </ul>

                    @endif

                </nav>

            @else

                @php 



                    //session part

                    $hashvalue = session('hashvalue');

                    $permission = session('permission');

                    $engage = session('engage');


                    $id = Auth::user()->id;

                    $now = time();

                    $tomorrow = time() + 86400;

                    $tomorrow = get_todays_starttime($tomorrow);

                    $first = get_todays_starttime($now);

                    $getbusindus = getBusinessIndustry(session('indus_id'));

                    $administration = get_field('users_details', 'administrator', $id);

                    $day = 10;

                    if(!empty(session('CustomIndustryName')) || session('CustomIndustryName') != null) {
                        $IndusName = session('CustomIndustryName');
                    } else {
                        $IndusName = session('IndustryName');
                    }

                @endphp

                @if($strchr != 'backend')

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
                                        <a href="" title="Help" data-toggle="modal" class="ajaxLink" data-id="bookings" data-name="Bookings">
                                            <i class="fas fa-question-circle"></i>
                                        </a>

                                    </li>

                                    <li>

                                        @if(!empty($hashvalue))

                                            <a href="{{ url('template/'.$hashvalue) }}" target="_blank">Add Appointment</a>

                                        @else

                                            <a href="{{ url('scheduleze/appointments') }}" target="_blank">Add Appointment</a>

                                        @endif
                                        <a href="" title="Help" data-toggle="modal" class="ajaxLink" data-id="add_appointments" data-name="Add Appointments">
                                            <i class="fas fa-question-circle"></i>
                                        </a>

                                    </li>

                                    <li>

                                        @if($administration == 1)

                                            <a href="{{ url('/scheduleze/dayticket/all/') }}">All Tickets</a>

                                        @else

                                            <a href="{{ url('/scheduleze/dayticket/'.$id.'/'.$first) }}">My Tickets</a>

                                        @endif

                                        <a href="" title="Help" data-toggle="modal" class="ajaxLink" data-id="all_tickets" data-name="All Tickets">
                                            <i class="fas fa-question-circle"></i>
                                        </a>

                                    </li>

                                    <li>

                                        <a href="{{ url('/scheduleze/dayticket/'.$id) }}">My Today</a>
                                        <a href="" title="Help" data-toggle="modal" class="ajaxLink" data-id="my_today" data-name="My Today">
                                            <i class="fas fa-question-circle"></i>
                                        </a>

                                    </li>

                                    <li>

                                        <a href="{{ url('/scheduleze/dayticket/'.$id.'/'.$tomorrow) }}">My Tomorrow </a>
                                        <a href="" title="Help" data-toggle="modal" class="ajaxLink" data-id="my_tomorrow" data-name="My Tomorrow">
                                            <i class="fas fa-question-circle"></i>
                                        </a>

                                    </li>

                                    <li>

                                        <a href="{{ url('/scheduleze/mapmyday') }}">Map My Today</a>
                                        <a href="" title="Help" data-toggle="modal" class="ajaxLink" data-id="map_my_day" data-name="Map My Day">
                                            <i class="fas fa-question-circle"></i>
                                        </a>

                                    </li>

                                    <li>

                                        <a href="#" data-toggle="modal" data-target="#myModal">Search</a>
                                        <a href="" title="Help" data-toggle="modal" class="ajaxLink" data-id="search" data-name="Search">
                                            <i class="fas fa-question-circle"></i>
                                        </a>

                                    </li>

                                </ul>

                            </li>                        

                            <li class="arrowicon">

                                <a href="#" @click="doSomethinginmenu">Blockouts</a>

                                <ul >

                                    <li>

                                        <a href="{{ url('/scheduleze/booking/blockouts') }}">Blockouts</a>
                                        <a href="" title="Help" data-toggle="modal" class="ajaxLink" data-id="blockouts" data-name="Blockouts">
                                            <i class="fas fa-question-circle"></i>
                                        </a>

                                    </li>

                                    <li>

                                        <a href="{{ url('/scheduleze/blockout/AddBlockout') }}">Add Blockout</a>
                                        <a href="" title="Help" data-toggle="modal" class="ajaxLink" data-id="add_blockouts" data-name="Add Blockouts">
                                            <i class="fas fa-question-circle"></i>
                                        </a>

                                    </li>

                                    <li>

                                        <a href="{{ route('Reoccurrence') }}">Recurring</a>
                                        <a href="" title="Help" data-toggle="modal" class="ajaxLink" data-id="recurring" data-name="Recurring">
                                            <i class="fas fa-question-circle"></i>
                                        </a>

                                    </li>

                                    <li>

                                        <a href="{{ url('scheduleze/BusinessHours') }}">Business Hours</a>
                                        <a href="" title="Help" data-toggle="modal" class="ajaxLink" data-id="business_hours" data-name="Business Hours">
                                            <i class="fas fa-question-circle"></i>
                                        </a>

                                    </li>

                                </ul>

                            </li>

                            <li>

                                <a href="{{ route('Document') }}">Document</a>
                                <a href="" title="Help" data-toggle="modal" class="ajaxLink" data-id="document" data-name="Document">
                                    <i class="fas fa-question-circle"></i>
                                </a>

                            </li>

                            @if($permission == 1 || $administration == 1)

                                <li class="arrowicon">

                                    <a href="{{ url('/form/Types') }}"  @click="doSomethinginmenu">{{ __('nav.services') }}</a>

                                    <ul >

                                        <li>

                                            <a href="{{ url('/form/Types') }}">{{ $getbusindus->type_label }}</a>
                                            <a href="" title="Help" data-toggle="modal" class="ajaxLink" data-id="service_types" data-name="Service Type">
                                                <i class="fas fa-question-circle"></i>
                                            </a>

                                        </li>

                                        <li>

                                            <a href="{{ url('/form/Sizes') }}">{{ $getbusindus->size_label }}</a>
                                            <a href="" title="Help" data-toggle="modal" class="ajaxLink" data-id="service_sizes" data-name="Service Sizes">
                                                <i class="fas fa-question-circle"></i>
                                            </a>

                                        </li>

                                        <li>

                                            <a href="{{ url('/form/Ages') }}">{{ $getbusindus->age_label }}</a>
                                            <a href="" title="Help" data-toggle="modal" class="ajaxLink" data-id="service_ages" data-name="Service Ages">
                                                <i class="fas fa-question-circle"></i>
                                            </a>

                                        </li>

                                        <li>

                                            <a href="{{ url('/form/Addons') }}">{{ $getbusindus->addon_label }}</a>
                                            <a href="" title="Help" data-toggle="modal" class="ajaxLink" data-id="addon_services" data-name="Addon Services">
                                                <i class="fas fa-question-circle"></i>
                                            </a>

                                        </li>

                                    </ul>

                                </li>

                                @if($engage == 1)

                                    <li class="arrowicon">

                                        <a href="{{ route('Location') }}"  @click="doSomethinginmenu">Locations</a>
                                        <!-- <a href="" title="Help" data-toggle="modal" class="ajaxLink" data-id="locations" data-name="Locations">
                                            <i class="fas fa-question-circle"></i>
                                        </a> -->

                                        <ul >

                                            <li>

                                                <a href="{{ route('Location') }}">Add/Remove Location</a>
                                                <a href="" title="Help" data-toggle="modal" class="ajaxLink" data-id="add_locations" data-name="Add Location">
                                                    <i class="fas fa-question-circle"></i>
                                                </a>

                                            </li>

                                            <li>

                                                <a href="{{ route('Drivetime') }}">Drivetimes</a>
                                                <a href="" title="Help" data-toggle="modal" class="ajaxLink" data-id="drivetimes" data-name="Drivetimes">
                                                    <i class="fas fa-question-circle"></i>
                                                </a>

                                            </li>

                                        </ul>

                                    </li>

                                @endif

                            @endif

                            <li class="arrowicon">

                                <a href="#"  @click="doSomethinginmenu">Users</a>

                                <ul >

                                    <li>

                                        <a href="{{ route('Inspectors') }}">{{ $IndusName }}</a>
                                        <a href="" title="Help" data-toggle="modal" class="ajaxLink" data-id="users" data-name="Users">
                                            <i class="fas fa-question-circle"></i>
                                        </a>

                                    </li>

                                    @if($permission == 1 || $administration == 1)

                                        <li>

                                            <a href="{{ route('AddInspector') }}">Add {{ $IndusName }}</a>
                                            <a href="" title="Help" data-toggle="modal" class="ajaxLink" data-id="add_users" data-name="Add Users">
                                                <i class="fas fa-question-circle"></i>
                                            </a>

                                        </li>

                                    @endif

                                </ul>

                            </li>

                            <li class="arrowicon">

                                <a href="{{ url('profile') }}"  @click="doSomethinginmenu">Profile</a>

                                <ul>

                                    <li>

                                        <a href="{{ url('profile') }}">User Profile</a>
                                        <a href="" title="Help" data-toggle="modal" class="ajaxLink" data-id="user_profile" data-name="User Profile">
                                            <i class="fas fa-question-circle"></i>
                                        </a>

                                    </li>

                                    <li>

                                        <a href="{{ url('business_info') }}">Business Profile</a>
                                        <a href="" title="Help" data-toggle="modal" class="ajaxLink" data-id="business_profile" data-name="Busniess Profile">
                                            <i class="fas fa-question-circle"></i>
                                        </a>

                                    </li>

                                    <!-- @if($administration == 1)

                                        <li>

                                            <a href="{{ url('services/content') }}">Services Content</a>

                                        </li>

                                        <li>

                                            <a href="{{ url('services/industries') }}">Industries</a>

                                        </li>

                                    @endif -->

                                    <li>

                                        <a href="{{ url('/profile/Email/Attachment') }}">Email Attachment</a>
                                        <a href="" title="Help" data-toggle="modal" class="ajaxLink" data-id="email_attachment" data-name="Email Attachment">
                                            <i class="fas fa-question-circle"></i>
                                        </a>

                                    </li>

                                    <li>

                                        <a href="#">Recurring Payment</a>
                                        <a href="" title="Help" data-toggle="modal" class="ajaxLink" data-id="recurring_payment" data-name="Recurring Payment">
                                            <i class="fas fa-question-circle"></i>
                                        </a>

                                    </li>

                                    @if($permission == 1 || $administration == 1)

                                        <li>

                                            <a href="{{ route('schedulepanel') }}">{{ __('nav.SchedulePanel') }}</a>
                                            <a href="" title="Help" data-toggle="modal" class="ajaxLink" data-id="setup_landing_page" data-name="Setup Landing Page">
                                                <i class="fas fa-question-circle"></i>
                                            </a>

                                        </li>

                                    @endif

                                </ul>

                            </li>

                            <li>

                                <a href="{{ route('ZigZag') }}">ZigZag</a>
                                <a href="" title="Help" data-toggle="modal" class="ajaxLink" data-id="zigzag" data-name="Zigzag">
                                    <i class="fas fa-question-circle"></i>
                                </a>

                            </li>
                            

                            <li class="arrowicon">
                                @php 
                                    $userName = get_field("users_details", "name", Auth::user()->id);
                                    if(empty($userName)) {
                                        $username = Auth::user()->name;
                                    } else {
                                        $username = $userName;
                                    }
                                @endphp

                                <a href="{{ url('profile') }}">{{ ucfirst($username) }}</a>

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

                @endif

            @endguest

        </div>

    </div>

</div>

    <div class="col-sm-10 statusMess">

        @if(session()->has('message'))

            <div class="alert alert-success statusMess"  style="margin-top: 50px;">

                {!! session()->get('message') !!}

            </div>

        @endif

    </div>



    <div class="col-sm-10">

        @if(session()->has('warning'))

            <div class="alert alert-warning"  style="margin-top: 50px;">

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

