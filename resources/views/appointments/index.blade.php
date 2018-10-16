<div class="loader"></div>
<style type="text/css">
	.loader {
		position: fixed;
		left: 0;
		top: 0;
		z-index: 999;
		width: 100%;
		height: 100%;
		overflow: visible;
		background: #fff url('/images/Preloader_2.gif') no-repeat center center;
	}
</style>
<link rel="stylesheet" href="{{ URL::asset('css/panelstyle.css') }}">
<link rel="shortcut icon" href="{{ asset('images/favicon_icon.png') }}" type="image/x-icon" />
<!-- <a href="{{ URL::previous() }}" class="gobutton">Go Back</a> -->
<hr>
<div class="takehtml">
	<div id="dontbreakdiv" class="dontbdiv">
		<div class="panel">
			@if(!empty($Inspector))
				@php 
					$countInspector = count($Inspector);
					if($countInspector > 1){
						$form = 'BookingAvailable';
					}else{
						$form = 'BookingForm';
					}

				@endphp

			@endif
			@if(!empty($businessinfo))
			{!! Form::open([ 'route' => [$form],'method' => 'post', 'id' => 'txtForm'] ) !!}
				Book your inspection now <br>

				<br>
				<input type="hidden" name="reference_id" value="{{ $id }}">
				<input type="hidden" name="businessId" value="{{ $businessid }}">
				<p class="bgtitle">Select Building Type Here</p>

				@if(count($types) > 0)
					<select name="building_type" class="" required>
						<option value="">--Select--</option>
						@foreach($types as $type)
							<option value="{{$type->id}}" @if($type->selected == 1) selected @endif>{{$type->name}}</option>
						@endforeach
					</select>
				@endif

				@if(count($sizes) > 0)
					<select name="building_size" class="">
						<option value="">--Select--</option>
						@foreach($sizes as $size)
							<option value="{{$size->id}}" @if($size->selected == 1) selected @endif>{{$size->name}}</option>
						@endforeach
					</select>
				@endif

				@if(count($ages) > 0)
					<select name="building_age" class="">
						<option value="">--Select--</option>
						@foreach($ages as $age)
							<option value="{{$age->id}}" @if($age->selected == 1) selected @endif>{{$age->name}}</option>
						@endforeach
					</select>
					@endif

				<p class="subhead">Please check all boxes that apply below:</p>
				@php $i=0; @endphp
				@foreach($addons as $addon)
					<input type="checkbox" name="addon[{{$i}}]" id="{{ $addon->id }}" value="{{ $addon->id }}">{{ $addon->name }} - ${{ $addon->price }}
					@php $i++; @endphp
				@endforeach

				<p class="subhead">Select Location<br>
										
				<select name="location" class="small_select" required>
					<option value="">--Select--</option>
					@foreach ($Location as $id => $name)
						<option value="{{ $id }}">{{ $name }}</option>
					@endforeach
				</select>
				<input type="submit" value="Find Appointment »"></p>
			{!! Form::close() !!}
			@endif
		</div>
	</div>
</div>
<div class="alert-info" style="display: none;">
</div>

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript">
	var htmlcss = '.gjs-cv-canvas{top:0;width:100%;height:100%}.panel{width: 100%;max-width: fit-content;border-radius:3px;padding:30px 20px;margin:150px auto 0;background-color:#FFFFFF;box-shadow:0 3px 10px 0 rgba(0,0,0,0.25);color:rgb(0, 0, 0);font:caption;font-weight:100;border-style: solid;}.welcome{text-align:center;font-weight:100;margin:0}.logo{width:70px;height:70px;vertical-align:middle}.logo path{pointer-events:none;fill:none;stroke-linecap:round;stroke-width:7;stroke:#fff}.big-title{text-align:center;font-size:3.5rem;margin:15px 0}.description{text-align:justify;font-size:1rem;line-height:1.5rem}';
	$(document).ready(function() {
		@if(!empty($businessinfo))
			var wholehtml = $('.takehtml').html();

			$.ajax({
	            url : '{{ url("ajaxappointment") }}',
	            method : "POST",
	            data : {_token: '{{ csrf_token() }}', gjs_html: wholehtml, gjs_css: htmlcss },
	            dataType : "JSON",
	            success:function(data){
	                console.log(data.message);
	                if(data.message == 'Successfully Saved!'){
	                	var referrer =  document.referrer;
	                	//$('.loader').fadeOut(1000); 
	                	if(referrer.indexOf('Location') >= 0){
	                		window.location.replace('http://scheduleze20.com/rick/scheduleze/DriveTime');
	                	}else{
	                		window.location.replace('http://scheduleze20.com/rick/scheduleze/booking/appointment');
	                	}

	                	//$('.alert-info').html('<a href="{{ URL::previous() }}"><strong>Ok</strong></a>');
	                }else{
	                	$('.alert-info').show();
	                	$('.alert-info').html('<a href="{{ URL::previous() }}"><strong>Something went wrong.</strong></a>');
	                }
	            }
	        });
	    @else
	        $('.alert-info').show();
	    	$('.alert-info').html('<strong>There is nothing to show you.</strong> Click  <a href="{{ url("/form/BuildingTypes") }}"><strong>here</strong></a> to add services.');
	    @endif
	});
</script>
<style type="text/css">
	@if(!empty($template))
		{!! $template->gjs_css !!}
	@endif
</style>
