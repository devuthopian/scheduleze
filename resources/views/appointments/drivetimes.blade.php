@extends('layouts.front')

@section('content')
	<div class="container">
		@php 
			$oldtimes = ""; 
			$time = 0;
			$oldt = array();
		@endphp
		@if (is_array($LocationTime) || is_object($LocationTime))
			@foreach ($LocationTime as $loc)		
				@php $oldtimes .= "<input type=\"hidden\" name=\"oldtimes[".$loc['start']."][".$loc['destination']."][0]\" value=\"$loc[time]\">";
				$oldtimes .= "<input type=\"hidden\" name=\"oldtimes[".$loc['start']."][".$loc['destination']."][1]\" value=\"$loc[id]\">";
				$oldt[$loc['start']][$loc['destination']] = $loc['time'];
				@endphp
			@endforeach
		@endif
		<table width="960" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td bgcolor="white">
					<form action="{{ route('StoreDriveTime') }}" method="post" name="FormName">
						@csrf
						<div class="frameadmin">
							<span class="head">
								Drive Time Details<br>
							</span>
							Please provide the approximate drive times between your service areas ~ Also see <a href="#">Zigzag Control</a><br>
						
							<table border="0" cellspacing="0" cellpadding="2">
								<tr>
									<td><span class="formlabel">From:</span><nobr>&nbsp;&nbsp;&nbsp;</nobr></td>
									<td><span class="formlabel">To:</span></td>
									<td><span class="formlabel">Drive Time:</span></td>
								</tr>
								@forelse ($Location as $loc)
									<?php $locs2 = array_slice($locs2, 1); ?>
									@foreach ($locs2 as $loc2)
										@if (count($oldt) > 1)
											<?php 
												$time = $oldt[$loc['id']][$loc2['id']];
											?>
										@endif
										<?php								
											$select = get_drivetime_popup($loc['id'], $loc2['id'], $time);
										?>
											<tr>
												<td><span class=\"\">{{ $loc['name'] }}</span><nobr>&nbsp;&nbsp;</nobr></td>
												<td><span class=\"\">{{ $loc2['name'].':' }}</span></td>
												<td>{!! $select !!}</td>
											</tr>
									@endforeach
								@empty

								@endforelse
								<tr>
									<td colspan="2">									
									<input type="hidden" name="action" value="drivetimes">
									<input type="submit" name="submit" value="Set Drivetimes &raquo;" class="submit"></td>
									<td></td>
								</tr>
								<tr>
									<td colspan="2"><br>
										<span class="note"><a href="#" class="note_link">&laquo; Return to Admin Home</a></span></td>
									<td></td>
								</tr>
							</table>
						</div>
					</form>
				</td>
			</tr>
		</table>
	</div>
@endsection