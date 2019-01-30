<div class="loader"></div>
<div class="header_section">
    <div class="head_left"> @guest<a href="{{ url('scheduling_solutions') }}"> @else <a href="#"> @endguest<img src="{{ url('images/logo.png') }}" alt="Take command of your day" class="logohead"></a></div>
    <div class="head_right">
        <div class="navigation">
            <nav id="app">
                <a href="#" class="n_toggle" @click="doSomething"><i class="fa fa-bars fa-2x"></i></a>
                <ul>
                    <li class="arrowicon">
                        <a href="{{ url('profile') }}">Profile</a>
                        <ul>
                            <li>
                                <a href="{{ url('backend/services/industries') }}">Industries</a>
                            </li>
                            <li>
                                <a href="{{ url('backend/services/helpers') }}">Helpers</a>
                            </li>
                            <li>
                                <a href="{{ url('backend/services/content') }}">Services Content</a>
                            </li>                    
                        </ul>
                    </li>
                    <li class="arrowicon">
                        <a href="{{ url('profile') }}">{{ ucfirst(Auth::guard('backend')->user()->name) }}</a>
                        <ul>
                            <li>
                                <a class="dropdown-item" href="{{ route('backend.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                            </li>
                        </ul>
                    </li>
                    <form id="logout-form" action="{{ route('backend.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </ul>
            </nav>
        </div>
    </div>
</div>


    <div class="col-sm-10">
        @if(session()->has('message'))
            <div class="alert alert-success" style="margin-top: 50px;">
                {!! session()->get('message') !!}
            </div>
        @endif
    </div>

    <div class="col-sm-10">
        @if(session()->has('warning'))
            <div class="alert alert-warning" style="margin-top: 50px;">
                {{ session()->get('warning') }}
            </div>
        @endif
    </div>
