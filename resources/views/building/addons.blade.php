@extends('layouts.front')

@section('content')
<div class="load" style="display: none;"></div>
<script src="{{ URL::asset('js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ URL::asset('js/materialize.js') }}"></script>
<link href="{{ asset('css/materialize.css') }}" rel="stylesheet">
	{!! Form::open([ 'route' => ['storebuild'],'method' => 'post'] ) !!}
<div class="building building_cont">
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
						<tr class="dark-table-heading">
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
								Available Users
							</td>
							<td>
								
							</td>
						</tr>
						<tbody class="txtBuildId">
							<input type="hidden" id="txtypol" value="{{ $users_details }}">
							@php $i=0; @endphp
							@unless($Building->isEmpty())
								@foreach($Building as $BuildType)
									<tr class="trtable_{{ $i }}">
										<td>
											<input class="form-control" type="text" name="desc[{{ $i }}]" size="32" value="{{ $BuildType->name }}" required>
											<input class="form-control" type="hidden" id="buildId" name="id[{{ $i }}]" value="{{ $BuildType->id }}">
										</td>
										<td>				
											{!! show_buffer($BuildType->id, $BuildType->buffer) !!}
										</td>
										<td>
											<input type="text" class="form-control" name="price[{{ $i }}]" value="{{ $BuildType->price }}" size="5" required>
										</td>
										<td align="center">
											<input type="text" class="form-control" name="rank[{{ $i }}]" value="{{ $BuildType->rank }}" size="3" required>
										</td>
										<td>
											<select name="forcecall[{{ $i }}]" size="1" class="form-control">
												<option value="0" @if($BuildType->status == 0) selected="" @endif>Book on-line</option>
												<option value="1" @if($BuildType->status == 1) selected="" @endif>Require phone call</option>
											</select>
										</td>
										<td>
											{!! get_subs_users($i) !!}
										</td>
										<td>
											<a href='#' class='note_link' id="{{ $BuildType->id }}" data-model="{{$name}}" data-id="{{ $BuildType->id }}">Remove</a>
										</td>
									</tr>
									<script type="text/javascript">
									    jQuery(document).ready(function($) {
									        $('.my_select_{{ $i }}').formSelect();
									        $('.my_select_{{ $i }} option:not(:disabled)').not(':selected').prop('selected', true);

										    $('.dropdown-content.multiple-select-dropdown input[type="checkbox"]:not(:checked)').not(':disabled').prop('checked', 'checked');

										    var values = $('.dropdown-content.multiple-select-dropdown input[type="checkbox"]:checked').not(':disabled').parent().map(function() {
										    	if($(this).attr('data-in') == 1){
										    		return $(this).html('<b>'+$(this).text()+'</b>');
										    	}else{
										        	return $(this).text();
										    	}
										    }).get();

										    $('input.select-dropdown').val(values.join(', '));
										    
										    $(".my_select_{{ $i }} option").each(function()
											{
											    if($(this).attr('data-in') == 1){
											    	$(this).html('<b>'+$(this).text()+'</b>');
											    }
											});
									    });
									</script>	
									@php $i++; @endphp
								@endforeach
							@else
							    <tr class="trtable_0">
									<td><input class="form-control" type="text" name="desc[0]" size="32" value="" required>
									<input class="form-control" type="hidden" id="buildId" name="id[0]" value="0"></td>
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
											<!-- <option value="1" selected="">Book using size/age</option> -->
											<option value="0">Book on-line</option>
											<option value="1">Require phone call</option>
											<!-- <option value="3">Use as Label</option> -->
										</select>
									</td>
									<td>
										{!! get_subs_users(0) !!}
									</td>
									<td>
										<a href='#' class='note_link' id="0" data-id="">Remove</a>
									</td>
								</tr>
								<script type="text/javascript">

								    jQuery(document).ready(function($) {

								        $('.my_select_0').formSelect();

								        $('.my_select_0 option:not(:disabled)').not(':selected').prop('selected', true);

									    $('.dropdown-content.multiple-select-dropdown input[type="checkbox"]:not(:checked)').not(':disabled').prop('checked', 'checked');

									    var values = $('.dropdown-content.multiple-select-dropdown input[type="checkbox"]:checked').not(':disabled').parent().map(function() {

									        return $(this).text();

									    }).get();

									    $('input.select-dropdown').val(values.join(', '));

									    $(".my_select_0 option").each(function()
										{
										    if($(this).attr('data-in') == 1){
										    	$(this).html('<b>'+$(this).text()+'</b>');
										    }
										});


								    });

								</script>
							@endunless
						</tbody>
						<span id="showtxt"></span>
						<tr>
							<td colspan="8"><input type="submit" name="submit" value="Save Addon" class="submit btn btn-success bluebtn">
								<input type="hidden" name="action" value="building_types">
								<input type="hidden" name="trigger" value="2">&nbsp;&nbsp;
							</td>
						</tr>
						<tr>
							<a href="#" class="add_column columnaddons" id="add_column">Add Column</a>
						</tr>
					</tbody>
				</table>
			</span>
		</div>
		<div class="tip">
			<span class="subhead">
				Add-on Services<br>
			</span>
			@if(!empty($ServiceContent->add_on_service_content))
				{!! $ServiceContent->add_on_service_content !!}
			@else
				Use this page to create a list of services which clients may wish to choose <b>in addition</b> to services they choose from the primary Building Type menu created on the Building Type page.  Do not use this list for services which are standalone, or independent of other services you offer.  Stand alone services belong in <a href="#" class="note">Building Type popup.</a><br><br><br><br>
			@endif
		</div>
	</div>
</div>
	<script type="text/javascript">
		jQuery(document).ready(function($) {

			$('.dropdown-content.multiple-select-dropdown input[type="checkbox"]:not(:checked)').not(':disabled').prop('checked', 'checked');

	        @foreach($exception as $excep)
	        	$('.my_select_{{ $excep->exception }} option[value="{{ $excep->user_id }}"]').prop('selected', false);
	        	$('.my_select_{{ $excep->exception }}').formSelect();
	        @endforeach


	        $('.add_column').click(function(event) {
	        	setTimeout(function(){
		        	var newcolid = $('.newcol:last').attr('data-main-id');
		        	$('.my_select_'+newcolid).formSelect();

		        	$('.my_select_'+newcolid+' option:not(:disabled)').not(':selected').prop('selected', true);

				    $('.dropdown-content.multiple-select-dropdown input[type="checkbox"]:not(:checked)').not(':disabled').prop('checked', 'checked');

				    var values = $('.dropdown-content.multiple-select-dropdown input[type="checkbox"]:checked').not(':disabled').parent().map(function() {

				        return $(this).text();

				    }).get();

				    $('input.select-dropdown').val(values.join(', '));

		        	$(".my_select_"+newcolid+" option").each(function()
					{
					    if($(this).attr('data-in') == 1){
					    	$(this).html('<b>'+$(this).text()+'</b>');
					    }
					});
		        }, 500);
	        });

			$('.selectedbs').change(function() {
				var exception = $(this).attr('data-main-id');
				var user_id = [];
		        $.each($(".my_select_"+exception+" option:not(:selected)"), function(){     
		            user_id.push($(this).val());
		        });

		        var user_id = user_id.filter(function(v){return v!==''});
				var type = '{{$name}}';

				$.ajax({
	                url : '{{ url("/storeException") }}',
	                method : "POST",
	                async: false,
	                data : {user_id: user_id, _token: $('meta[name="csrf-token"]').attr('content'), exception: exception, type: type},
	                dataType : "JSON",
	                success:function(data){
	                	if(data.success == 'true'){
	                    	//alert('Saved successfully');
	                	}
	                },
	                error: function(XMLHttpRequest, textStatus, errorThrown) { 
				        alert("Status: " + textStatus); alert("Error: " + errorThrown); 
				    }
	            });
			});

		});
	</script>
	{!! Form::close() !!}
@endsection