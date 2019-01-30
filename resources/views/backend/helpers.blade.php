@extends('layouts.includes.front.backend.front')
@section('content')

@if ($errors->any())
<div class="alert alert-danger">
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif
<div class="clearfix"></div>

<div class="choose_industry_section">
	<h2>Menu Items:</h2>
	<h4>Click any one to edit the popup</h4>
	<div class="container pagination-container">
		<div class="col-sm-4 hover08 column">
			<div class="industry_cont" data-page="1">
				<a href="{{ url('backend/services/helpers/bookings') }}" target="_blank">
					<figure><img src="{{ url('images/ibooking.png') }}" alt=""></figure>
					<h3>Bookings</h3>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
				</a>
			</div>
		</div>
		<div class="col-sm-4 hover08 column">
			<div class="industry_cont" data-page="1">
				<a href="{{ url('backend/services/helpers/add_appointments') }}" target="_blank">
					<figure><img src="{{ url('images/iappointment.png') }}" alt=""></figure>
					<h3>Add Appointment</h3>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
				</a>
			</div>
		</div>
		<div class="col-sm-4 hover08 column">
			<div class="industry_cont" data-page="1">
				<a href="{{ url('backend/services/helpers/all_tickets') }}" target="_blank">
					<figure><img src="{{ url('images/iticket.png') }}" alt=""></figure>
					<h3>All Tickets</h3>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
				</a>
			</div>
		</div>
		<div class="col-sm-4 hover08 column">
			<div class="industry_cont" data-page="1">
				<a href="{{ url('backend/services/helpers/my_today') }}" target="_blank">
					<figure><img src="{{ url('images/itoday.png') }}" alt=""></figure>
					<h3>My Today</h3>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
				</a>
			</div>
		</div>
		<div class="col-sm-4 hover08 column">
			<div class="industry_cont" data-page="1">
				<a href="{{ url('backend/services/helpers/my_tomorrow') }}" target="_blank">
					<figure><img src="{{ url('images/itomorrow.png') }}" alt=""></figure>
					<h3>My Tomorrow</h3>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
				</a>
			</div>
		</div>
		<div class="col-sm-4 hover08 column">
			<div class="industry_cont" data-page="1">
				<a href="{{ url('backend/services/helpers/map_my_day') }}" target="_blank">
					<figure><img src="{{ url('images/imapmyday.png') }}" alt=""></figure>
					<h3>Map My Day</h3>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
				</a>
			</div>
		</div>
		<div class="col-sm-4 hover08 column">
			<div class="industry_cont" data-page="2" style="display:none;">
				<a href="{{ url('backend/services/helpers/search') }}" target="_blank">
					<figure><img src="{{ url('images/isearch.png') }}" alt=""></figure>
					<h3>Search</h3>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
				</a>
			</div>
		</div>
		<div class="col-sm-4 hover08 column">
			<div class="industry_cont" data-page="2" style="display:none;">
				<a href="{{ url('backend/services/helpers/blockouts') }}" target="_blank">
					<figure><img src="{{ url('images/iblockout.png') }}" alt=""></figure>
					<h3>Blockouts</h3>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
				</a>
			</div>
		</div>
		<div class="col-sm-4 hover08 column">
			<div class="industry_cont" data-page="2" style="display:none;">
				<a href="{{ url('backend/services/helpers/add_blockouts') }}" target="_blank">
					<figure><img src="{{ url('images/iAddBlockout.png') }}" alt=""></figure>
					<h3>Add Blockouts</h3>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
				</a>
			</div>
		</div>
		<div class="col-sm-4 hover08 column">
			<div class="industry_cont" data-page="2" style="display:none;">
				<a href="{{ url('backend/services/helpers/recurring') }}" target="_blank">
					<figure><img src="{{ url('images/irecurringAppointment.png') }}" alt=""></figure>
					<h3>Recurring</h3>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
				</a>
			</div>
		</div>
		<div class="col-sm-4 hover08 column">
			<div class="industry_cont" data-page="2" style="display:none;">
				<a href="{{ url('backend/services/helpers/business_hours') }}" target="_blank">
					<figure><img src="{{ url('images/iBusinessHours.png') }}" alt=""></figure>
					<h3>Business Hours</h3>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
				</a>
			</div>
		</div>
		<div class="col-sm-4 hover08 column">
			<div class="industry_cont" data-page="2" style="display:none;">
				<a href="{{ url('backend/services/helpers/document') }}" target="_blank">
					<figure><img src="{{ url('images/iDocument.png') }}" alt=""></figure>
					<h3>Document</h3>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
				</a>
			</div>
		</div>
		<div class="col-sm-4 hover08 column">
			<div class="industry_cont" data-page="3" style="display:none;">
				<a href="{{ url('backend/services/helpers/service_types') }}" target="_blank">
					<figure><img src="{{ url('images/iservices.png') }}" alt=""></figure>
					<h3>Service Types</h3>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
				</a>
			</div>
		</div>
		<div class="col-sm-4 hover08 column">
			<div class="industry_cont" data-page="3" style="display:none;">
				<a href="{{ url('backend/services/helpers/service_sizes') }}" target="_blank">
					<figure><img src="{{ url('images/iSizes.png') }}" alt=""></figure>
					<h3>Service Sizes</h3>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
				</a>
			</div>
		</div>
		<div class="col-sm-4 hover08 column">
			<div class="industry_cont" data-page="3" style="display:none;">
				<a href="{{ url('backend/services/helpers/service_ages') }}" target="_blank">
					<figure><img src="{{ url('images/iAges.png') }}" alt=""></figure>
					<h3>Service Ages</h3>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
				</a>
			</div>
		</div>
		<div class="col-sm-4 hover08 column">
			<div class="industry_cont" data-page="3" style="display:none;">
				<a href="{{ url('backend/services/helpers/addon_services') }}" target="_blank">
					<figure><img src="{{ url('images/iAddon.png') }}" alt=""></figure>
					<h3>Addon Services</h3>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
				</a>
			</div>
		</div>
		<div class="col-sm-4 hover08 column">
			<div class="industry_cont" data-page="3" style="display:none;">
				<a href="{{ url('backend/services/helpers/users') }}" target="_blank">
					<figure><img src="{{ url('images/iuser.png') }}" alt=""></figure>
					<h3>Users/Inspectors</h3>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
				</a>
			</div>
		</div>
		<div class="col-sm-4 hover08 column">
			<div class="industry_cont" data-page="3" style="display:none;">
				<a href="{{ url('backend/services/helpers/add_users') }}" target="_blank">
					<figure><img src="{{ url('images/iadd-user.png') }}" alt=""></figure>
					<h3>Add User/Inspector</h3>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
				</a>
			</div>
		</div>
		<div class="col-sm-4 hover08 column">
			<div class="industry_cont" data-page="4" style="display:none;">
				<a href="{{ url('backend/services/helpers/user_profile') }}" target="_blank">
					<figure><img src="{{ url('images/iprofile.png') }}" alt=""></figure>
					<h3>User Profile</h3>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
				</a>
			</div>
		</div>
		<div class="col-sm-4 hover08 column">
			<div class="industry_cont" data-page="4" style="display:none;"">
				<a href="{{ url('backend/services/helpers/business_profile') }}" target="_blank">
					<figure><img src="{{ url('images/ibusiness.png') }}" alt=""></figure>
					<h3>Business Profile</h3>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
				</a>
			</div>
		</div>
		<div class="col-sm-4 hover08 column">
			<div class="industry_cont" data-page="4" style="display:none;">
				<a href="{{ url('backend/services/helpers/email_attachment') }}" target="_blank">
					<figure><img src="{{ url('images/iattach.png') }}" alt=""></figure>
					<h3>Email Attachment</h3>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
				</a>
			</div>
		</div>
		<div class="col-sm-4 hover08 column">
			<div class="industry_cont" data-page="4" style="display:none;">
				<a href="{{ url('backend/services/helpers/recurring_payment') }}" target="_blank">
					<figure><img src="{{ url('images/ipayment.png') }}" alt=""></figure>
					<h3>Recurring Payment</h3>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
				</a>
			</div>
		</div>
		<div class="col-sm-4 hover08 column">
			<div class="industry_cont" data-page="4" style="display:none;">
				<a href="{{ url('backend/services/helpers/setup_landing_page') }}" target="_blank">
					<figure><img src="{{ url('images/iSettings.png') }}" alt=""></figure>
					<h3>Setup Landing Page</h3>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
				</a>
			</div>
		</div>
		<div class="col-sm-4 hover08 column">
			<div class="industry_cont" data-page="4" style="display:none;">
				<a href="{{ url('backend/services/helpers/zigzag') }}" target="_blank">
					<figure><img src="{{ url('images/iZigzag.png') }}" alt=""></figure>
					<h3>Zigzag</h3>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
				</a>
			</div>
		</div>

		<div class="col-sm-4 hover08 column">
			<div class="industry_cont" data-page="5" style="display:none;">
				<a href="{{ url('backend/services/helpers/locations') }}" target="_blank">
					<figure><img src="{{ url('images/ilocation.png') }}" alt=""></figure>
					<h3>Locations</h3>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
				</a>
			</div>
		</div>
		<div class="col-sm-4 hover08 column">
			<div class="industry_cont" data-page="5" style="display:none;">
				<a href="{{ url('backend/services/helpers/add_locations') }}" target="_blank">
					<figure><img src="{{ url('images/iaddLocation.png') }}" alt=""></figure>
					<h3>Add Locations</h3>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
				</a>
			</div>
		</div>
		<div class="col-sm-4 hover08 column">
			<div class="industry_cont" data-page="5" style="display:none;">
				<a href="{{ url('backend/services/helpers/drivetimes') }}" target="_blank">
					<figure><img src="{{ url('images/iDrivetimes.png') }}" alt=""></figure>
					<h3>Drivetimes</h3>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
				</a>
			</div>
		</div>
		<div class="pagination pagination-centered pagination-large" style="bottom:0;">
	       	<ul class="page_control pagination">
				<!-- <li data-page="-" ><a href="#" >&lt;</a></li> -->
				<li data-page="1" class="active">
					<a href="#">1</a>
				</li>
				<li data-page="2" class=""><a href="#" >2</a></li>
				<li data-page="3" class=""><a href="#" >3</a></li>
				<li data-page="4" class=""><a href="#" >4</a></li>
				<li data-page="5" class=""><a href="#" >5</a></li>
				<!-- <li data-page="+"><a href="#" >&gt;</a></li> -->
	      	</ul>
	   	</div>
	</div>
</div>
@endsection