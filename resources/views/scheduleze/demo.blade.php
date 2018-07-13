@extends('layouts.front')

@section('content')
	<div class="banner_section">
     	<div class="container">
      		<h4><span>Book your inspection now with</span></h4>
       		<h2> SV Inspection Service</h2> 
       		<p>12345 Maple Avenue <br> Phone: 404-354-1234 ~ Cell: 404-355-2957</p>     
     	</div>
   	</div>

   	<div class="content_section">
     <div class="container">
      <div class="content_left">
       <h3>Building Information</h3>        
       <div class="form_cont">
         	<select name="building_type" class="">
	            <option value="">Condominum</option>
	            <option value="">Duplex</option>
         	</select>
         	<select name="building_size" class="">
	            <option value="">Under 1500 Sq. Ft.</option>
	            <option value="">1501-2500 Sq. Ft.</option>
	            <option value="">2501-3500 Sq. Ft.</option>
	            <option value="">3501 Sq Ft. and Up</option>
          	</select>
          	<select name="building_age" class="">
            	<option value="">New</option>
	            <option value="">1980-2008</option>
	            <option value="">1960-1979</option>
	            <option value="">1940-1959</option>
	            <option value="">1939 and older</option>
          	</select>
          		<input type="checkbox" name="" value="" /><span>radon with home inspection - $135</span> 
          		<input type="checkbox" name="" value=""><span">pest inspection - $25</span>
          		
          		<h3>Location</h3>
          		<input type="submit" value="Find Appointment">          
	       		</div>     
	        		<ul>
			          <li>Also se the <a href="#">Administration Suite Demo »</a></li>
			          <li>Questions? Call Phone: 404-354-1234 ~ Cell: 404-355-2957 or</li>
			          <li>email <a href="mailto:peter@advanced-design.com">peter@advanced-design.com</a></li>
	        		</ul>
	      		</div>
		      	<div class="content_right">
		       		<h2>About Scheduleze</h2> 
			        <ul>
			          	<li><a href="#">Can I use Scheduleze on my website?</a></li>
			          	<li><a href="#">I don't have a website, what now?</a></li>
			          	<li><a href="#">How much does Scheduleze cost?</a></li>
			          	<li><a href="#">What's included with my sign up fee?</a></li>
		         	 	<li><a href="#">Is Scheduleze expandable?</a></li>
			          	<li><a href="#">Sign up for Scheduleze now »</a></li>         
			        </ul> 
		      	</div>     
     		</div>
   		</div>
@endsection