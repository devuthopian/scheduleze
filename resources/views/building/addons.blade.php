@extends('layouts.front')

@section('content')
	{!! Form::open([ 'route' => ['storebuild'],'method' => 'post'] ) !!}
<div class="building">
	<div class="container">
		<div class="frameadmin">
			<span class="head">
				<h1>Add-on Service Options</h1>
			</span>
			<span class="warning_red">Submit actions disabled for demo user</span><br>
			<span class="note">Order is the order the items appear in the popup menu, use radio button to set menu default.<!--<br>Cap is the total number of this class of service you wish to allow booked in a single calendar day.</span>--><p></p>
				<input type="hidden" name="txtform" value="{{$name}}">				
				<table border="0" cellspacing="0" cellpadding="2" class="table table-responsive table-bordered">
					<tbody>
						<tr class="thead">
							<td>
								<span class="formlabel">Service Description</span><br>
							</td>
							<td>
								<span class="formlabel">Time Req'd</span><br>
							</td>
							<td>
								<span class="formlabel">Price($)</span><br>
							</td>
							<td>
								<span class="formlabel">Order&nbsp;</span><br>
							</td>
							<td>
								<span class="formlabel">Status</span><br>
							</td>
							<td>
								
							</td>
						</tr>
						<tbody class="txtBuildId">
							@php $i=0; @endphp
							@forelse($Building as $BuildType)
								<tr class="trtable_{{ $i }}">
									<td>
										<input class="form-control" type="text" name="desc[{{ $i }}]" size="32" value="{{ $BuildType->name }}" required>
										<input class="form-control" type="hidden" name="id[{{ $i }}]" value="{{ $BuildType->id }}">
									</td>
									<td>				
										{!! show_buffer($i, $BuildType->buffer) !!}
									</td>
									<td>
										<input type="text" class="form-control" name="price[{{ $i }}]" value="{{ $BuildType->price }}" size="5" required>
									</td>
									<td align="center">
										<input type="text" class="form-control" name="rank[{{ $i }}]" value="{{ $BuildType->rank }}" size="3" required>
									</td>
									<td>
										<select name="forcecall[{{ $i }}]" size="1" class="form-control">
											<option value="1" @if($BuildType->status == 1) selected="" @endif>Book using size/age</option>
											<option value="2" @if($BuildType->status == 2) selected="" @endif>Book as standalone</option>
											<option value="0" @if($BuildType->status == 0) selected="" @endif>Require phone call</option>
											<option value="3" @if($BuildType->status == 3) selected="" @endif>Use as Label</option>
										</select>
									</td>
									<td>
										<a href='#' class='note_link' id="{{ $i }}" data-model="{{$name}}" data-id="{{ $BuildType->id }}">Remove</a>
									</td>
								</tr>
								@php $i++; @endphp
							@empty
							    <tr class="trtable_0">
									<td><input class="form-control" type="text" name="desc[0]" size="32" value="" required>
									<input class="form-control" type="hidden" name="id[0]" value="0"></td>
									<td>				
										{!! show_buffer(0, 10800) !!}
									</td>
									<td>
										<input class="form-control" type="text" name="price[0]" value="" size="5" required>
									</td>
									<td align="center">
										<input class="form-control" type="text" name="rank[0]" value="" size="3" required>
									</td>
									<td>
										<select name="forcecall[0]" size="1" class="form-control">
											<option value="1" selected="">Book using size/age</option>
											<option value="2">Book as standalone</option>
											<option value="0">Require phone call</option>
											<option value="3">Use as Label</option>
										</select>
									</td>
									<td>
										<a href='#' class='note_link' id="0" data-id="">Remove</a>
									</td>
								</tr>
							@endforelse
						</tbody>
						<span id="showtxt"></span>
						<tr>
							<td colspan="4"><input type="submit" name="submit" value="Save Building Types" class="submit btn btn-success bluebtn">
								<input type="hidden" name="action" value="building_types">
								<input type="hidden" name="trigger" value="2">&nbsp;&nbsp;
							</td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<a href="#" class="add_column" id="add_column">Add Column</a>
						</tr>
					</tbody>
				</table>
			</span>
		</div>
		<div class="tip">
			<span class="subhead">
				Add-on Services<br>
			</span>
			Use this page to create a list of services which clients may wish to choose <b>in addition</b> to services they choose from the primary Building Type menu created on the Building Type page.  Do not use this list for services which are standalone, or independent of other services you offer.  Stand alone services belong in <a href="#" class="note">Building Type popup.</a><br><br><br><br>
		</div>
		<div class="logo">
			<a href="#">
				<img src="{{URL::asset('/images/logo.png')}}" alt="Take command of your day" height="79" width="235" border="0">
			</a>
		</div>
		<div class="frame-closing"><br><br>
			<span class="note">Customer Support: <a href="mailto:support@scheduleze.com">support@scheduleze.com</a>
			</span>
		</div>
	</div>
</div>
	{!! Form::close() !!}
@endsection
