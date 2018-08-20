@extends('layouts.front')

@section('content')

@php
	$i_name = get_field('users_details', 'name', $id);
	$i_last_name = get_field('users_details', 'lastname', $id);
@endphp

<div class="container">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bookclass">
		<tr>
			<td bgcolor="white">
				<div class="frameadmin">
					<span class="head">Appointments for {{ $i_name }} {{ $i_last_name }}<br></span>
					<table cellpadding="3" cellspacing="0" border="0" width="100%">
						<form action="#" method="post" name="FormName">
							@php
								$first = time();
								$last = $first+1209500;
							@endphp
							{!! display_for_edit($id, $first, $last, $order='', $inc='') !!}
						</form>
					</table>
								
					<span class="note"><a href="index.php" class="note_link">&laquo; Return to Admin Home</a></span>
				</div>
			</td>
		</tr>
	</table>
</div>
@endsection