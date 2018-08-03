@if(!empty($businessinfo))
	Book your inspection now with <br>
	@if(!empty($businessinfo))
		{{ $businessinfo->name }} <br>
		{{ $businessinfo->address }} {{ $businessinfo->city }} {{ $businessinfo->state }} <br>
		Phone: {{ $businessinfo->phone }} ~ {{ $businessinfo->public_phone }} <br>
	@endif

	<br>
	<div>
		<span>Select Building Type Here</span>
		<br>
		<select name="building_type" class="">
			@foreach($types as $type)
				<option value="{{$type->name}}" @if($type->selected == 1) selected @endif>{{$type->name}}</option>
			@endforeach
		</select>
		<select name="building_size" class="">
			@foreach($sizes as $size)
				<option value="{{$size->name}}" @if($size->selected == 1) selected @endif>{{$size->name}}</option>
			@endforeach
		</select>
		<select name="building_age" class="">
			@foreach($ages as $age)
				<option value="{{$age->name}}" @if($age->selected == 1) selected @endif>{{$age->name}}</option>
			@endforeach
		</select>
			
		</div>

		<p class="subhead">Please check all boxes that apply below:</p>
	</div>
@else
	<div>You need to add entry! </div>
@endif