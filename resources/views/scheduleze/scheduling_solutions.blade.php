@extends('layouts.front')

@section('content')
@if(!empty($errors->first()))
    <div class="row col-lg-12">
        <div class="alert alert-warning">
            <span>{{ $errors->first() }}</span>
        </div>
    </div>
@endif
<div class="banner_section">
    <div class="container">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <div class="col-sm-6">
                        <h1><span>Your Service</span> Scheduling Solution...</h1>
                        <a href="#">Get Started</a>
                    </div>
                    <div class="col-sm-6">
                        <img src="{{ url('images/ban-thum.png') }}" alt="">
                    </div>
                </div>
                <div class="item">
                    <div class="col-sm-6">
                        <h1><span>Your Service</span> Scheduling Solution...</h1>
                        <a href="#">Get Started</a>
                    </div>
                    <div class="col-sm-6">
                        <img src="{{ url('images/ban-thum.png') }}" alt="">
                    </div>
                </div>
                <div class="item">
                    <div class="col-sm-6">
                        <h1><span>Your Service</span> Scheduling Solution...</h1>
                        <a href="#">Get Started</a>
                    </div>
                    <div class="col-sm-6">
                        <img src="{{ url('images/ban-thum.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="scheduling_solutions">
    <div class="container">
        <h2>Scheduling Solutions</h2>
        <p>Scheduleze allows your clients to book appointments in real time while keeping you off the cell phone and focused on being productive. Scheduleze factors in your <span>drive time</span>, handles secure <span>PDF file</span> distribution and <span>integrates gracefully</span> with existing websites.</p>
        <p>If you are a home inspector, realtor, personal trainer, home health provider, auto shop, handyman, appliance technician or similar business, Scheduleze is for you</p>
    </div>
</div>
<div class="four_icon_section">
    <div class="container">
        <div class="col-sm-3">
            <img src="{{ url('images/how-it-work-icon.jpg') }}" alt="">
            <h3>Show Me <br>How It Works</h3>
        </div>
        <div class="col-sm-3">
            <img src="{{ url('images/straight-control-icon.jpg') }}" alt="">
            <h3>Take me <br>Straight to The Controls </h3>
        </div>
        <div class="col-sm-3">
            <img src="{{ url('images/cost-icon.jpg') }}" alt="">
            <h3>How much <br>does it cost</h3>
        </div>
        <div class="col-sm-3">
            <img src="{{ url('images/scheduleze-icon.jpg') }}" alt="">
            <h3>Sign up for <br>Scheduleze now</h3>
        </div>
    </div>
</div>
<div class="choose_industry_section">
    <h2>Choose Your Industry</h2>
    <div class="container">
        <div class="col-sm-4">
            <div class="industry_cont">
                <img src="{{ url('images/home-inspector.jpg') }}" alt="">
                <h3>HOME INSPECTORS</h3>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="industry_cont">
                <img src="{{ url('images/photography.jpg') }}" alt="">
                <h3>photography</h3>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="industry_cont">
                <img src="{{ url('images/pet-grooming.jpg') }}" alt="">
                <h3>pet grooming</h3>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="industry_cont">
                <img src="{{ url('images/hair-saloon.jpg') }}" alt="">
                <h3>hair salon</h3>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="industry_cont">
                <img src="{{ url('images/spa.jpg') }}" alt="">
                <h3>Spas</h3>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="industry_cont">
                <img src="{{ url('images/oil-change.jpg') }}" alt="">
                <h3>oil change</h3>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            </div>
        </div>
        <div class="col-sm-12">
            <a href="#">VIEW MORE</a>
        </div>
    </div>
</div>
<!-- <div class="subscribe_newsletter">
    <div class="container">
        <div class="subscribe_left">
            <h2>Subscribe To Our Newsletter</h2>
            <p>Sign up here to get the latest news ,updatesand special offers delivered directly to your inbox</p>
        </div>
        <div class="subscribe_right">
            <span>
            <input type="text" placeholder="Email" name="">
            <input type="submit" name="" value="SUBSCRIBE">
            </span>
        </div>
    </div>
</div> -->
<div class="plan_price_section">
    <div class="container">
        <h2>Plan and Price</h2>
        <div class="plan_price_cont">
            <h3>Personal</h3>
            <h4>From <span>$99</span> Per Months</h4>
            <h5>01 PSD Pack</h5>
            <p>Curabitur ac lacus arcu. Sed vehicula lectus auctor viverra. Vehicula.</p>
            <h5>01 WordPress Install</h5>
            <p>Curabitur ac lacus arcu. Sed vehicula lectus auctor viverra. Vehicula.</p>
            <a href="#">Get Started Now</a>
        </div>
        <div class="plan_price_cont">
            <div class="recommend">RECOMMEND</div>
            <h3>Business</h3>
            <h4>From <span>$99</span> Per Months</h4>
            <h5>01 PSD Pack</h5>
            <p>Curabitur ac lacus arcu. Sed vehicula lectus auctor viverra. Vehicula.</p>
            <h5>01 WordPress Install</h5>
            <p>Curabitur ac lacus arcu. Sed vehicula lectus auctor viverra. Vehicula.</p>
            <a href="#">Get Started Now</a>
        </div>
        <div class="plan_price_cont">
            <h3>Ultimate</h3>
            <h4>From <span>$99</span> Per Months</h4>
            <h5>01 PSD Pack</h5>
            <p>Curabitur ac lacus arcu. Sed vehicula lectus auctor viverra. Vehicula.</p>
            <h5>01 WordPress Install</h5>
            <p>Curabitur ac lacus arcu. Sed vehicula lectus auctor viverra. Vehicula.</p>
            <a href="#">Get Started Now</a>
        </div>
    </div>
</div>
<div class="testimonial_section">
    <div class="container">
        <h2>WHAT OUR CLIENT SAYS</h2>
        <div id="testimonial" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#testimonial" data-slide-to="0" class="active"></li>
                <li data-target="#testimonial" data-slide-to="1" class=""></li>
                <li data-target="#testimonial" data-slide-to="2"></li>
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <div class="col-sm-4">
                        <img src="{{ url('images/testimonial_img.png') }}" alt="">
                    </div>
                    <div class="col-sm-8">
                        <div class="testi_text">
                            <p><span class="quote_left"><i class="fas fa-quote-left"></i></span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.<span class="quote_right"><i class="fas fa-quote-right"></i></span></p>
                            <h5>Clients Says</h5>
                            <p>Lorem Ipsum</p>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="col-sm-4">
                        <img src="{{ url('images/testimonial_img1.png') }}" alt="">
                    </div>
                    <div class="col-sm-8">
                        <div class="testi_text">
                            <p><span class="quote_left"><i class="fas fa-quote-left"></i></span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.<span class="quote_right"><i class="fas fa-quote-right"></i></span></p>
                            <h5>Clients Says</h5>
                            <p>Lorem Ipsum</p>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="col-sm-4">
                        <img src="{{ url('images/testimonial_img.png') }}" alt="">
                    </div>
                    <div class="col-sm-8">
                        <div class="testi_text">
                            <p><span class="quote_left"><i class="fas fa-quote-left"></i></span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.<span class="quote_right"><i class="fas fa-quote-right"></i></span></p>
                            <h5>Clients Says</h5>
                            <p>Lorem Ipsum</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection