<link rel="stylesheet" href="{{ URL::asset('css/panelstyle.css') }}">
<link rel="shortcut icon" href="{{ asset('images/favicon_icon.png') }}" type="image/x-icon" />
<!-- <a href="{{ URL::previous() }}" class="gobutton">Go Back</a> -->
<hr>
<div class="takehtml">
	<div id="dontbreakdiv">
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
				Book your inspection now with <br>
				@if(!empty($businessinfo))
					{{ $businessinfo->name }} <br>
					{{ $businessinfo->address }} {{ $businessinfo->city }} {{ $businessinfo->state }} <br>
					Phone: {{ $businessinfo->phone }} ~ {{ $businessinfo->public_phone }} <br>
				@endif

				<br>
				<input type="hidden" name="reference_id" value="{{ $id }}">
				<input type="hidden" name="businessId" value="{{ $businessid }}">
				<p class="bgtitle">Select Building Type Here</p>
				<select name="building_type" class="" required>
					<option value="">--Select--</option>
					@foreach($types as $type)
						<option value="{{$type->id}}" @if($type->selected == 1) selected @endif>{{$type->name}}</option>
					@endforeach
				</select>
				<select name="building_size" class="">
					<option value="">--Select--</option>
					@foreach($sizes as $size)
						<option value="{{$size->id}}" @if($size->selected == 1) selected @endif>{{$size->name}}</option>
					@endforeach
				</select>
				<select name="building_age" class="">
					<option value="">--Select--</option>
					@foreach($ages as $age)
						<option value="{{$age->id}}" @if($age->selected == 1) selected @endif>{{$age->name}}</option>
					@endforeach
				</select>


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
<div class="alert-info">
</div>

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript">
	var htmlcss = '.gjs-cv-canvas{top:0;width:100%;height:100%}.panel{width:90%;max-width:700px;border-radius:3px;padding:30px 20px;margin:150px auto 0;background-color:#d983a6;box-shadow:0 3px 10px 0 rgba(0,0,0,0.25);color:rgba(255,255,255,0.75);font:caption;font-weight:100}.welcome{text-align:center;font-weight:100;margin:0}.logo{width:70px;height:70px;vertical-align:middle}.logo path{pointer-events:none;fill:none;stroke-linecap:round;stroke-width:7;stroke:#fff}.big-title{text-align:center;font-size:3.5rem;margin:15px 0}.description{text-align:justify;font-size:1rem;line-height:1.5rem}';
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
	                $('.alert-info').html('<a href="{{ URL::previous() }}"><strong>Ok</strong></a>');
	            }
	        });
	    @else
	    	$('.alert-info').html('<strong>There is nothing to show you.</strong> Click  <a href="{{ url("/form/BuildingTypes") }}"><strong>here</strong></a> to add services.');
	    @endif
	});
</script>
<style type="text/css">
	@if(!empty($template))
		{!! $template->gjs_css !!}
	@endif
</style>
