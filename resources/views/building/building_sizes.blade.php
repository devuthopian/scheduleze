@extends('layouts.front')

@section('content')
	{!! Form::open([ 'route' => ['storebuildsizes'],'method' => 'post'] ) !!}
		<div class="frameadmin">
			<span class="head">
				Setting Building Types and Prices<br>
			</span>
			<span class="warning_red">Submit actions disabled for demo user</span><br>
			<span class="note">Order is the order the items appear in the popup menu, use radio button to set menu default.<!--<br>Cap is the total number of this class of service you wish to allow booked in a single calendar day.</span>--><p></p>						
				<table border="0" cellspacing="0" cellpadding="2">
					<tbody>
						<tr>
							<td>
								<span class="formlabel">Description</span><br>
							</td>
							<td>
								<span class="formlabel">Time Req'd</span><br>
							</td>
							<td>
								<span class="formlabel">Price</span><br>
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
							@php $i=0;  @endphp
							@forelse($BuildingSizes as $BuildType)
								<tr class="trtable_{{ $i }}">
									<td>
										<input type="text" name="desc[{{ $i }}]" size="32" value="{{ $BuildType->name }}" required>
										<input type="hidden" name="id[{{ $i }}]" value="{{ $BuildType->id }}">
									</td>
									<td>				
										{!! show_buffer($i, $BuildType->buffer) !!}
									</td>
									<td>
										<input type="text" name="price[{{ $i }}]" value="${{ $BuildType->price }}" size="5" required>
									</td>
									<td align="center">
										<input type="text" name="rank[{{ $i }}]" value="{{ $BuildType->rank }}" size="3" required>
										<input type="radio" value="{{ $i }}" name="selected[0]" @if($BuildType->selected == 1) checked @endif>
									</td>
									<td>
										<select name="forcecall[{{ $i }}]" size="1">
											<option value="1" @if($BuildType->status == 1) selected="" @endif>Book using size/age</option>
											<option value="2" @if($BuildType->status == 2) selected="" @endif>Book as standalone</option>
											<option value="0" @if($BuildType->status == 0) selected="" @endif>Require phone call</option>
											<option value="3" @if($BuildType->status == 3) selected="" @endif>Use as Label</option>
										</select>
									</td>
									<td>
										<a href='#' class='note_link' id="{{ $i }}" data-model="building_sizes" data-id="{{ $BuildType->id }}">Remove</a>
									</td>
								</tr>
								@php $i++; @endphp
							@empty
							    <tr class="trtable_0">
									<td><input type="text" name="desc[0]" size="32" value="" required>
									<input type="hidden" name="id[0]" value="0"></td>
									<td>				
										{!! show_buffer(0, 10800) !!}
									</td>
									<td>
										<input type="text" name="price[0]" value="$" size="5" required>
									</td>
									<td align="center">
										<input type="text" name="rank[0]" value="" size="3" required>
										<input type="radio" value="0" name="selected[0]">
									</td>
									<td>
										<select name="forcecall[0]" size="1">
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
							<td colspan="4"><input type="submit" name="submit" value="Save Building Types" class="submit">
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
				Building Type Strategy<br>
			</span>
			You must have a Building Types menu with at least one type of service, time and cost for Scheduleze to function properly.  Building Size popups and Building Age popups are optional, and can be configured to add additional time and cost to the basic Building Type selected by the client.<br><br>If you are not going to use price modifiers, you may wish to list various service combinations here and provide total prices for each.  This creates the simplest user interface for your clients and increases the likelihood of the client to book immediately on-line (simple forms look easier to complete).<br><br>However, if you are going to setup Building Age and Building Size popups as well, use this menu for basic Building Type only.  Provide the absolute minimum price and time for each service type as the modifier popups will add additional time and costs that you specify to this baseline cost for each Building Type.<br><br>
		</div>
		<div class="logo">
			<a href="index.php">
				<img src="/images/scheduleze-logo.gif" alt="Take command of your day" height="79" width="235" border="0">
			</a>
		</div>
		<div class="frame-closing"><br><br><br><br>
			<span class="note">Customer Support: <a href="mailto:support@scheduleze.com">support@scheduleze.com</a>
			</span>
		</div>
	{!! Form::close() !!}
@endsection
