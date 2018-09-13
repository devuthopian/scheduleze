@extends('layouts.front')

@section('content')

@php
	$i_name = get_field('users_details', 'name', $id);
	$i_last_name = get_field('users_details', 'lastname', $id);
	$business_infomation = get_business_information(session('business_id'));

	if ($first == "") {
		$first = time();
		$last = $first + 1209500;
	}
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
		<form action="{{ url('/scheduleze/booking/'.$form.'') }}" method="post">
			@csrf
			<input type="hidden" name="action" value="{{$form}}">
			{!! edit_filter($first, $id, $i_name, $last) !!}
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
								<span class="head">{{ucfirst($form)}} for {{ $i_name }} {{ $i_last_name }}<br></span>
								<div>
									Review, modify or remove your appointments
									<a href="{{ url('/scheduleze/dayticket/'.$id) }}" target="_blank" class="note">Print Tickets »</a>
								</div>
								<a href="{{ $url }}" class="note"><nobr>{{ $include }}</nobr></a>
								<table cellpadding="3" cellspacing="0" border="0" width="100%" class="table border table-responsive table-borderd table-striped select-default">
									<form action="#" method="post" name="FormName">
										{!! display_for_edit($id, $first, $last, $order='', $inc) !!}
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
@endsection