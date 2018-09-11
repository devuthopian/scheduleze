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

                @if($name == 'BuildingSizes')

                    <h1>Setting Building Sizes</h1>

                @elseif($name == 'BuildingTypes')

                    <h1>Setting Building Types and Prices</h1>

                @else($name == 'BuildingAges')

                    <h1>Setting Building Ages</h1>

                @endif

				

			</span>

			<span class="note">Order is the order the items appear in the popup menu, use radio button to set menu default.<!--<br>Cap is the total number of this class of service you wish to allow booked in a single calendar day.</span>--><p></p>

				<input type="hidden" name="txtform" value="{{$name}}">

				<table border="0" cellspacing="0" cellpadding="2" class="table table-responsive table-bordered">

					<tbody>

						<tr class="dark-table-heading">

							<td>

								<span class="formlabel">Description</span><br>

							</td>

							<td>

                                @if($name == 'BuildingAges' || $name == 'BuildingSizes'  )

								    <span class="formlabel">Add'l Time</span><br>

                                @else

                                    <span class="formlabel">Time Req'd</span><br>

                                @endif

							</td>

							<td>

								<span class="formlabel">Price($)</span><br>

							</td>

							<td>

								<span class="formlabel">Order&nbsp;</span><br>

							</td>

                            <!-- <td>

                            </td> -->

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

							@php 

								$i=0;

							@endphp							

							@forelse($Building as $BuildType)

								<tr class="trtable_{{ $i }}">

									<td>

										<input class="form-control" type="text" name="desc[{{ $i }}]" size="32" value="{{ $BuildType->name }}" required>

										<input type="hidden" class="form-control" id="buildId" name="id[{{ $i }}]" value="{{ $BuildType->id }}">

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

                                   <!--  <td>

										<input type="radio" value="{{ $BuildType->id }}" name="selected[0]" @if($BuildType->selected == 1) checked @endif>

									</td> -->

									<td>

										<select name="forcecall[{{ $i }}]" class="form-control" size="1">

											<option value="1" @if($BuildType->status == 1) selected="" @endif>Book using size/age</option>

											<option value="2" @if($BuildType->status == 2) selected="" @endif>Book as standalone</option>

											<option value="0" @if($BuildType->status == 0) selected="" @endif>Require phone call</option>

											<option value="3" @if($BuildType->status == 3) selected="" @endif>Use as Label</option>

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

									        return $(this).text();

									    }).get();

									    $('input.select-dropdown').val(values.join(', '));
										

								        $(".my_select_{{ $i }} option").each(function()
										{
										    if($(this).attr('data-in') == 1){
										    	$(this).html('<b>'+$(this).text()+'</b>');
										    	var getadmin = $(this).text();

										    	/*if($('.dropdown-content.multiple-select-dropdown span').not(':disabled').text() == getadmin){
										    		$('.dropdown-content.multiple-select-dropdown span').not(':disabled').html('<b>'+$(this).text()+'</b>');
										    	}*/
										    }
										});

								    });

								</script>						

								@php $i++; @endphp

							@empty

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

                                    <!-- <td>

                                        <input  type="radio" value="0" name="selected[0]">

                                    </td> -->

									<td>

										<select class="form-control" name="forcecall[0]" size="1">

											<option value="1" selected="">Book using size/age</option>

											<option value="2">Book as standalone</option>

											<option value="0">Require phone call</option>

											<option value="3">Use as Label</option>

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

							@endforelse

						</tbody>

						<span id="showtxt"></span>

						<tr>

							<td colspan="8"><input type="submit" name="submit" value="Save Building Types" class="submit btn btn-success bluebtn">

								<input type="hidden" name="action" value="building_types">

								<input type="hidden" name="trigger" value="2">&nbsp;&nbsp;

							</td>

						</tr>

						<tr>

							<a href="#" class="add_column" id="add_column">Add Column</a>

						</tr>

					</tbody>

				</table>

			</span>

		</div>

		<div class="tip">

			

				@if($name == 'BuildingSizes')
					<span class="subhead">
						Building Sizes Strategy
					</span>

					The fewer ranges here the better. Simpler forms encourage people to complete them. Provide additional costs and additional time required for each range or "0" if there is no additional impacts for that Building Size over your primary service cost/time which you established in your Building Types menu.

                @elseif($name == 'BuildingTypes')
					<span class="subhead">
						Building Types and Prices Strategy
					</span>

					You must have a Building Types menu with at least one type of service, time and cost for Scheduleze to function properly.  Building Size popups and Building Age popups are optional, and can be configured to add additional time and cost to the basic Building Type selected by the client.<br><br>If you are not going to use price modifiers, you may wish to list various service combinations here and provide total prices for each.  This creates the simplest user interface for your clients and increases the likelihood of the client to book immediately on-line (simple forms look easier to complete).<br><br>However, if you are going to setup Building Age and Building Size popups as well, use this menu for basic Building Type only.  Provide the absolute minimum price and time for each service type as the modifier popups will add additional time and costs that you specify to this baseline cost for each Building Type.<br><br>

                @else($name == 'BuildingAges')
					<span class="subhead">
						Building Ages Strategy
					</span>

					The simpler you make users' booking experience, the more bookings you will receive. In general, a few range selections work better than many specific choices.

					Provide additional costs and additional time required for each range or "0" if there is no additional impacts for that option over your baseline cost/time which you established in your Building Types menu.

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