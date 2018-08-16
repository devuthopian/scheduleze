@extends('layouts.front')

@section('content')
<div class="container">
	<table width="960" border="0" cellspacing="0" cellpadding="0" style="margin: 0 auto;">
		<tr>
			<td bgcolor="white">
				<div class="frameadmin">
					<span class="head"><br></span>
					<table cellpadding="3" cellspacing="0" border="0">
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