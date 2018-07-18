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
            
               @guest
                      <nav> 
                      <a href="#" class="n_toggle"><i class="fa fa-bars fa-2x"></i></a>
                      <ul>
                      <li><a href="{{ url('scheduling_solutions') }}">Scheduling Solutions</a></li>
                      <li><a href="{{ url('success_stories') }}">Success  Stories</a></li>
                      <li><a href="{{ url('demo') }}">Demo</a></li>
                      <li><a href="{{ url('faq') }}">FAQ</a></li>
                      <li><a href="{{ url('contact') }}">Contact</a></li>
                      </ul>         
                      </nav>
                        @else
                            <nav> 
                      <a href="#" class="n_toggle"><i class="fa fa-bars fa-2x"></i></a>
                      <ul>
                      <li><a href="{{ url('scheduling_solutions') }}">Home</a></li>
                      <li>
                       <a href="#">Appointments</a>
                       <ul class="dropdown-menu">
                           <li>
                               <a href="#">Add Appointment</a>
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
                               <a href="#">Business Hours</a>
                           </li>
                       </ul>
                    </li>
                        <li>
                       <a href="#">Services</a>
                       <ul class="dropdown-menu">
                           <li>
                               <a href="#">Building Types</a>
                           </li>
                           <li>
                               <a href="#">Building Sizes</a>
                           </li>
                           <li>
                               <a href="#">Building Ages</a>
                           </li>
                             <li>
                               <a href="#">Add-on Services</a>
                           </li>
                       </ul>
                    </li>
                          <li>
                       <a href="#">Locations</a>
                       <ul class="dropdown-menu">
                           <li>
                               <a href="#">Drivetimes</a>
                           </li>
                          
                       </ul>
                    </li>
                      <li><a href="#">ZigZag</a></li>
                          <li>
                       <a href="#">Users</a>
                       <ul class="dropdown-menu">
                           <li>
                               <a href="#">Add Inspector</a>
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
                               <a href="#">Business Profile</a>
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
                       </ul>
                    </li>                     
                  
                      </ul>         
                      </nav>
                        @endguest
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