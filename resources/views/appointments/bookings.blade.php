@extends('layouts.front')

@section('content')

@php
	$i_name = '';
	
	if($id != 'all'){
		$i_name = get_field('users_details', 'name', $id);
		$i_last_name = get_field('users_details', 'lastname', $id);
	}else{
		$i_last_name = $id;
	}

	if(!empty(session('business_id'))){
		$business_infomation = get_business_information(session('business_id'));
	}

	if ($first == "") {
		$first = time();
		$last = $first + 1209500;
	}

	$engage = session('engage');
@endphp
@if(!empty($errors->first()))
    <div class="row col-lg-12">
        <div class="alert alert-warning">
            <span>{{ $errors->first() }}</span>
        </div>
    </div>
@endif
<div class="bookingmain">
	<div class="bookingcontainer">
		@if($form == 'AdvanceFilter')
			<form action="{{ url('/scheduleze/booking/appointment') }}" method="post">
		@else
			<form action="{{ url('/scheduleze/booking/'.$form.'') }}" method="post">
		@endif
			@csrf
			<input type="hidden" name="action" value="{{$form}}">

			{!! edit_filter($first, $id, $i_name, $last, $administration) !!}

			@if($form == 'appointment')
				@php
					$inc='book'; 
					$include = 'include blockouts';
					$url = url('/scheduleze/booking/all');
				@endphp
				<input type="hidden" name="inc" value="book">
			@elseif($form == 'all')
				@php
					$form = 'Appointments & Blockouts';
					$inc = 'all';
					$include = 'only bookings';
					$url = url('/scheduleze/booking/appointment');
				@endphp
				<input type="hidden" name="inc" value="all">
			@else
				@php 
				$inc='block';
				$include = 'include bookings';
				$url = url('/scheduleze/booking/appointment');
				@endphp
				<input type="hidden" name="inc" value="block">
			@endif
			<input type="hidden" name="order" value="type">
		</form>
	</div>
</div>
<div class="container">
	<div class="framecell">
		<div class="frameadmin">
			<div class="clearfix"></div>
        	<div class="col-sm-12">
				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bookclass table border table-responsive table-borderd table-striped select-default">
					<tr>
						<td bgcolor="white">
							<div class="frameadmin">
								<span class="head">{{ucfirst($form)}} for {{ $i_name }} {{ $i_last_name }} <a href="{{ $url }}" class="note"><nobr>{{ $include }}</nobr></a><br></span> 
								<div>
									Review, modify or remove your appointments
									<a href="{{ url('/scheduleze/dayticket/'.$id) }}" target="_blank" class="note">Print Tickets »</a>
								</div>
								<table cellpadding="3" cellspacing="0" border="0" width="100%" class="table border table-responsive table-borderd table-striped select-default">
									<form action="#" method="post" name="FormName">
										{!! display_for_edit($id, $first, $last, $order='', $inc, $tt, $flag) !!}
									</form>
								</table>
								<!-- <span class="note"><a href="index.php" class="note_link">&laquo; Return to Admin Home</a></span> -->
							</div>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- Modal -->
@if(count($Location) <= 0 && $engage == 1 || count($businesshours) <= 0 || count($LocationTime) <= 0 && $engage == 1 || count($BuildingTypes) <= 0)
	<div id="accountInfoBusiness" class="modal fade" role="dialog">
	    <div class="modal-dialog">

	        <!-- Modal content-->
	        <div class="modal-content">
	            <div class="modal-header">
	                <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
	            </div>
	            <div class="modal-body">
	                <div class="cls-error-msg">
	                    <span class="cls-option-heading">You scheduleze account will not function properly until these settings have been determined.</span>
	                    <ul class="cls-option">
	                    	@if(count($BuildingTypes) <= 0)
	                        	<li>You have not set the types and prices of services you offer.</li>
	                        @endif
	                        
							@if($engage == 1)
								@if(count($Location) <= 0)
	                           		<li>You have not set the location(s) you serve.</li>
	                           	@endif
	                            @if(count($LocationTime) <= 0)
	                            	<li>You have not set the driving distances between the location you serve.</li>
	                            @endif
	                        @endif

	                        @if(count($businesshours) <= 0)
	                        	<li>You have not set your business hours.</li>
	                        @endif
	                    </ul>
	                </div>
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-default accountInfo" data-dismiss="modal">Close</button>
	            </div>
	        </div>

	    </div>
	</div>
@endif
@endsection