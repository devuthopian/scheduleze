@extends('layouts.front')

@section('content')

@php
	if ($form == 'AddBlockout'){

		$do = "Adding Blockout";
		$submit_label = "Add Blockout";
		$checked = "checked";
		$message = "Check &quot;same day&quot; to disregard second month/day/year menus";
		$default_time = ((time()) + get_timezone(session('business_id')));
		$default_endtime = ($default_time + 3600);
		$id = session('id');
		session(['affected_inspector' => $id]);

	} else {
		$do = "Editing Blockout";
		$submit_label = "Edit Blockout";
		$message = "Check &quot;same day&quot; to disregard second month/day/year menus";
		$sql = "select starttime, endtime, notes, user_id from bookings where id = '$_GET[edit]'";
		$row = $l->pull_assoc($sql);
		session(['affected_inspector' => $row->user_id]);
		check_permission($row->user_id);
		$default_time = $row[starttime];
		$default_endtime = $row[endtime];
	}

	if (is_numeric(session('affected_inspector'))){
		$inspector = session('affected_inspector');
	} else {
		$inspector = session('id');
	}

	$i_name = get_field('users_details', 'name', $id);
	$i_last_name = get_field('users_details', 'lastname', $id);

	$inspector_popup = get_inspector_popup('name', session('affected_inspector'));
	$inspector_name = get_field('users_details', 'name', session('affected_inspector'));

	$start_popup = get_time_popup ($default_time, $designate="", 1, 1, 1, 1, 1, 1 ,'starttime');
	$end_popup = get_time_popup ($default_endtime, $designate="1", 1, 1, 1, 1, 1, 1, 'endtime');

	if ($first == "") {
		$first = time();
		$last = $first + 1209500;
	}

@endphp
<!-- <div class="bookingmain">
	<div class="bookingcontainer">
		<form action="{{ url('/scheduleze/'.$form.'') }}" method="post">
			@csrf
			<input type="hidden" name="action" value="{{$form}}">
			{!! edit_filter($first, $id, $i_name, $last) !!}
			@if($form == 'bookings')
				@php $inc='book'; @endphp
				<input type="hidden" name="inc" value="book">
			@else
				@php $inc='block'; @endphp
				<input type="hidden" name="inc" value="block">
			@endif
			<input type="hidden" name="order" value="type">
		</form>
	</div>
</div> -->
<div class="container">
	<div class="framecell">
		<div class="frameadmin">
			<div class="clearfix"></div>
        	<div class="col-sm-12">
				<div class="frameadmin">
					<span class="head">
						{{ $do }}<br>
					</span>{{ $message }}<br>
					<?php //echo "$filter"; ?>					
						<form action="{{ url('/scheduleze/blockout/store') }}" method="post" name="FormName">
							@csrf
							<input type="hidden" name="trigger" value="1">
							<input type="hidden" name="action" value="set_blockout">
							<input type="hidden" name="target" value="@if(isset($blockId)) {{ $blockId }} @endif">
							
							<div>
								<label>Inspector:&nbsp;</label>
								{!! $inspector_popup !!}
							</div>
							<div>
								<label>Start:&nbsp;</label>
									{!! $start_popup !!}
								<input type="checkbox" name="sameday" value="1" {{ $checked }}>&nbsp;Same day
							</div>
							<div>
								<label>End:&nbsp;</label>
								{!! $end_popup !!}
							</div>
							<div>
								<label>Notes:</label>
								<textarea name="notes"  rows="3" cols="68">
									@if(isset($row)) {{ $row->notes }} @endif
								</textarea>
							</div>
							<div>								
								<input type="submit" value="<?php echo $submit_label?> &raquo;">&nbsp;&nbsp;
								<input type="checkbox" value="1" name="send_email">
								<span class="note">Send Email Notice to <?php echo $inspector_name?></span>
							</div>
						</form>
					<span class="note"><a href="index.php" class="note_link">&laquo; Return to Admin Home</a></span>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection