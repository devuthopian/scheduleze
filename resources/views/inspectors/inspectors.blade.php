@extends('layouts.front')

@section('content')
<div class="set_recc_block">
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<h2>Select Inspector</h2>
			<h5>Bold Names indicate Administrator status</h5>
			<table border="0" cellspacing="4" cellpadding="0" class="table border table-responsive table-borderd table-striped select-default">
                <tbody>
                    <tr class="dark-table-heading">
                        <td>Inspector</td>
                        <td>
                        	<span class="formlabel">
                        		View
                        	</span>
                        </td>
                        <td>
                        	Action
                        </td>
                    </tr>
                    @foreach($userdetails as $details)
	                    <tr>
	                        <td>
	                        	<b>
	                        		{{ $details->name }}
	                        	</b>
	                        </td>
	                        <td>
	                        	<a href="{{ url('/scheduleze/booking/appointment/'.$details->user_id) }}">
	                        		Bookings
	                        	</a> | 
	                        	<a href="{{ url('/scheduleze/booking/blockouts/'.$details->user_id) }}">
	                        		Blockouts
	                        	</a>
	                        </td>
	                        <td>
	                        	<a href="{{ url('/profile/'.$details->user_id) }}">Edit</a> <!-- / <a href="#">Remove</a> -->
	                        </td>
	                    </tr>
	                @endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
</div>
@endsection