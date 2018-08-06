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
		@php $i=0; @endphp
		@foreach($addons as $addon)
			<input type="checkbox" name="addon[{{$i}}]" id="{{ $addon->id }}">{{ $addon->name }} - ${{ $addon->price }}
			@php $i++; @endphp
		@endforeach

		<p class="subhead">Select Location<br>
								
		<select name="location" class="small_select">
			@foreach ($Location as $id => $name) {
				<option value="{{ $id }}">{{ $name }}</option>
			@endforeach
		</select>
		<input type="submit" value="Find Appointment »"></p>
	</div>
@else
	<div>You need to add entry! </div>
@endif