@extends('layouts.front')

@section('content')
<div class="container">
	<div class="row">
		<div class="bookingmain">
			<div class="bookingcontainer">
				<form action="{{ url('/scheduleze/documents') }}" method="post">
					@csrf
					{!! edit_filter($first, $id, session('username'), $last) !!}
					<input type="hidden" name="track" value="1">
					<input type="hidden" name="trigger" value="2">
				</form>
			</div>
		</div>
		<div class="col-sm-12">
			<h3>
				View/Post Documents
			</h3>
			<div class="clearfix"></div>
			<span>
				Upload or view a document
			</span>
			<div class="clearfix"></div>
			<h3>
				Inspections
			</h3>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bookclass table border table-responsive table-borderd table-striped select-default">
				{!! view_for_reports($id, $first, $last, $order='') !!}
			</table>
		</div>
	</div>
</div>
@endsection