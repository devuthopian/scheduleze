@extends('layouts.front')

@section('content')

@php
	$i_name = get_field('users_details', 'name', $id);
	$i_last_name = get_field('users_details', 'lastname', $id);

	if ($first == "") {
		$first = time();
		$last = $first + 1209500;
	}
@endphp
<div class="bookingmain">
	<div class="bookingcontainer">
		<form action="{{ route('BookingFilter') }}" method="post">
			@csrf
			<input type="hidden" name="action" value="bookings">
			{!! edit_filter($first, $id, $i_name, $last) !!}
			<input type="hidden" name="inc" value="all">
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
									<span class="head">Appointments for {{ $i_name }} {{ $i_last_name }}<br></span>
									<div>
										Review, modify or remove your appointments
										<a href="#" target="_blank" class="note">Print Tickets »</a>
									</div>
									<table cellpadding="3" cellspacing="0" border="0" width="100%" class="table border table-responsive table-borderd table-striped select-default">
										<form action="#" method="post" name="FormName">
											{!! display_for_edit($id, $first, $last, $order='', $inc='') !!}
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
</div>
@endsection