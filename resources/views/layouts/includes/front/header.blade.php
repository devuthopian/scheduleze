<div class="header_section">
    <div class="head_left"><a href="{{ url('scheduling_solutions') }}"><img src="{{ url('images/logo.png') }}" alt="" class="logohead"></a></div>
    <div class="head_right">
        <div class="navigation">
            @guest
                <nav>
                    <a href="#" class="n_toggle"><i class="fa fa-bars fa-2x"></i></a>
                    <ul>
                        <li><a href="{{ url('scheduling_solutions') }}">Scheduling Solutions</a></li>
                        <li><a href="{{ url('success_stories') }}">Success  Stories</a></li>
                        <li><a href="{{ url('demo') }}">Demo</a></li>
                        <li><a href="#">Plans/Prices</a></li>
                        <li><a href="#">Support</a></li>
                        <li><a href="{{ url('contact') }}">Contact</a></li>
                        <li class="try_it_now"><a href="#signup">Try It Now</a></li>
                        <li class="login"><a href="{{ route('login') }}">Login</a></li>
                    </ul>
                </nav>
                @else
                @php $hashvalue = session('hashvalue'); @endphp
                <nav>
                    <a href="#" class="n_toggle"><i class="fa fa-bars fa-2x"></i></a>
                    <ul>
                        <li>
                            <a href="{{ url('scheduling_solutions') }}">Home</a>
                        </li>
                        <li>
                            <a href="#">Appointments</a>
                            <ul class="dropdown-menu">
                                <li>
                                    @if(!empty($hashvalue))
                                        <a href="{{ url('template/') }}/{{$hashvalue}}">Add Appointment</a>
                                    @else
                                        <a href="{{ url('scheduleze/appointments') }}">Add Appointment</a>
                                    @endif
                                </li>
                                <li>
                                    <a href="#">My Tickets</a>
                                </li>
                                <li>
                                    <a href="#">My Today</a>
                                </li>
                                <li>
                                    <a href="#">My Tomorrow </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">Blockouts</a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="#">Add Blockout</a>
                                </li>
                                <li>
                                    <a href="#">Recurring</a>
                                </li>
                                <li>
                                    <a href="{{ url('scheduleze/BusinessHours') }}">Business Hours</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ url('/form/BuildingTypes') }}">{{ __('nav.services') }}</a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ url('/form/BuildingTypes') }}">{{ __('nav.buildtype') }}</a>
                                </li>
                                <li>
                                    <a href="{{ url('/form/BuildingSizes') }}">{{ __('nav.buildsizes') }}</a>
                                </li>
                                <li>
                                    <a href="{{ url('/form/BuildingAges') }}">{{ __('nav.buildages') }}</a>
                                </li>
                                <li>
                                    <a href="{{ url('/form/Addons') }}">{{ __('nav.Addons') }}</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('Location') }}">Locations</a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('Location') }}">Add/Remove Location</a>
                                </li>
                                <li>
                                    <a href="#">Drivetimes</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">ZigZag</a>
                        </li>
                        <li>
                            <a href="#">Users</a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('AddInspector') }}">Add Inspector</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ url('profile') }}">Profile</a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ url('profile') }}">User Profile</a>
                                </li>
                                <li>
                                    <a href="{{ url('business_info') }}">Business Profile</a>
                                </li>
                                <li>
                                    <a href="#">Headers/Footers</a>
                                </li>
                                <li>
                                    <a href="#">Email Attachment</a>
                                </li>
                                <li>
                                    <a href="#">Recurring Payment</a>
                                </li>
                                <li>
                                    <a href="{{ route('schedulepanel') }}">{{ __('nav.SchedulePanel') }}</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </nav>
                @endguest
        </div>
    </div>
</div>