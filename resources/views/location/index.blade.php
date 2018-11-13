@extends('layouts.front')


@section('content')
	{!! Form::open([ 'route' => ['storelocation'],'method' => 'post'] ) !!}
<div class="set_recc_block">
	<div class="container">
		<div class="frameadmin" id="adminlocation">
			<h2>Locations</h2>
			<h5>Order is the order the items appear in the popup menu, use radio button to set menu default.<!--<br>Cap is the total number of this class of service you wish to allow booked in a single calendar day.</span>--></h5>				
				<table border="0" cellspacing="0" cellpadding="2" class="table table-responsive table-bordered">
					<tbody>
						<tr class="thead">
							<td>
								<span class="formlabel">Location name </span><br>
							</td>
							<td>                           
								<span class="formlabel">Cost +/-</span><br>
							</td>
							<td>
								
							</td>
						</tr>
						<tbody class="txtlocationId"> 
							@php $i=0; @endphp
							@unless($locations == '' || $locations->isEmpty())
								@foreach($locations as $location)
									<tr class="trtable_{{ $i }}">
										<input type="hidden" class="form-control" name="id[{{ $i }}]" value="{{ $location->id }}">
										<td>
											<input type="text" class="form-control" name="name[{{ $i }}]" value="{{ $location->name }}" size="5" required>
										</td>
										<td align="center">
											<input type="text" class="form-control" name="price[{{ $i }}]" value="{{ $location->price }}" size="3" required>
	                                    </td>
										<td>
											<a href='#' class='note_link' id="{{ $i }}" data-model="Location" data-id="{{ $location->id }}">Remove</a>
										</td>
									</tr>
									@php $i++; @endphp
								@endforeach
							@else
							    <tr class="trtable_0">
							    	<input type="hidden" class="form-control" name="id[0]" value="0">
									<td>
										<input type="text" class="form-control" name="name[0]" size="5" required>
									</td>
									<td align="center">
										<input type="text" class="form-control" name="price[0]" size="3" required>
                                    </td>
									<td>
										<a href='#' class='note_link' id="0" data-id="0">Remove</a>
									</td>
								</tr>
							@endunless
						</tbody>
						<span id="showtxt"></span>
						<tr>
							<td colspan="4"><input type="submit" name="submit" value="Save Location" class="submit btn btn-success bluebtn">
								<input type="hidden" name="action" value="building_types">
								<input type="hidden" name="trigger" value="2">&nbsp;&nbsp;
							</td>
						</tr>
						<tr>
							<a href="" class="add_columnfor_location" id="add_columnfor_location" @click="addcolumnlocation">Add Column</a>
						</tr>
					</tbody>
				</table>
			</span>
		</div>
		<!-- <div class="tip">
			<span class="subhead">
				Building Type Strategy<br>
			</span>
			You must have a Building Types menu with at least one type of service, time and cost for Scheduleze to function properly.  Building Size popups and Building Age popups are optional, and can be configured to add additional time and cost to the basic Building Type selected by the client.<br><br>If you are not going to use price modifiers, you may wish to list various service combinations here and provide total prices for each.  This creates the simplest user interface for your clients and increases the likelihood of the client to book immediately on-line (simple forms look easier to complete).<br><br>However, if you are going to setup Building Age and Building Size popups as well, use this menu for basic Building Type only.  Provide the absolute minimum price and time for each service type as the modifier popups will add additional time and costs that you specify to this baseline cost for each Building Type.<br><br>
		</div>
		<div class="logo">
			<a href="#">
				<img src="{{URL::asset('/images/logo.png')}}" alt="Take command of your day" height="79" width="235" border="0">
			</a>
		</div> -->
	</div>
</div>	
	
	{!! Form::close() !!}
@endsection
