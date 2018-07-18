<div class="head_top_bar">
  <div class="container">
   <ul>
     <li><a href="{{ url('register') }}">Signup</a></li>
     <li><a href="#">Newsletter</a></li>
   </ul>
  </div>
</div>

<div class="header_section">
  <div class="container">
      <div class="head_left">
        <a href="{{ url('/') }}">
          <img src="images/logo.png" alt="">
        </a>
      </div>
      <div class="head_right">
         <div class="navigation">
            <nav> 
              <a href="#" class="n_toggle"><i class="fa fa-bars fa-2x"></i></a>
              <ul>
                <li><a href="{{ url('scheduling_solutions') }}">Scheduling Solutions</a></li>
                <li><a href="{{ url('success_stories') }}">Success  Stories</a></li>
                <li><a href="{{ url('demo') }}">Demo</a></li>
                <li><a href="{{ url('faq') }}">FAQ</a></li>
                <li>
                    <a href="{{ route('buildingtypes') }}">{{ __('nav.services') }}</a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ route('buildingtypes') }}">{{ __('nav.buildtype') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('buildingsizes') }}">{{ __('nav.buildsizes') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('storebuildtype') }}">{{ __('nav.buildages') }}</a>
                        </li>
                    </ul>
                </li>
                <li><a href="{{ url('contact') }}">Contact</a></li>
                <li><a href="#">Client Login</a></li>         
              </ul>         
            </nav>
        </div>
    </div>
  </div>
</div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif