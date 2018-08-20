@php 
    $gjs = PanelTemplate(session('id'));
@endphp
{!! $gjs->gjs_html !!}
<div class="NewForm">
    @if (is_array($PanelForm) || is_object($PanelForm))

        @foreach ($PanelForm as $pform)
        @endforeach
    @else
        @php
            $addons = array();
            $BuildType = $data['building_type'];
            $businessId = Session::get('business_id');
            $building_size = $data['building_size'];
            $building_age = $data['building_age'];
            $location = $data['location'];
            if(array_key_exists('addons', $data)){
                $addons = $data['addons'];
            }
            $inspection_information = get_proposed_inspection_information($businessId, $BuildType, $building_size, $building_age, $addons, $location);
            if ($inspection_information['status'] == "0"){
            }

            session(['total_price' => $inspection_information['total_price']]);

            $total_time = $inspection_information['total_time'];
            if ($total_time < 1800){
                session(['total_time' => 10800]);
                $total_time = 10800;
            } else {
                session(['total_time' => $total_time]);
            }

            if ($inspection_information['status'] == "1"){  //building_type had a status of two, zero out the other fields
                $building_size = '';
                $building_age = '';
            } elseif ($inspection_information['status'] == "2"){ //building size status had a value of 2 so disregard the age input
                $building_age = '';
            }

            $authorized_inspectors = get_inspector_exceptions($businessId, $BuildType, $building_size, $building_age, $addons, session('total_price'));

            $increment = 900;
        @endphp
	    <table class="accent" width="650">
			<tbody>
				<tr>
					<td>
						<span class="grayhead"><b>Scheduling an inspection in {!! getlocation($data['location']) !!}</b></span><br>
						<span class="head"><h3>{{ Auth::user()->name }}</h3></span>
						<div class="small_indent"><span class="address"></span></div>
						@foreach($authorized_inspectors as $qualified_inspector)
						{!! Form::open([ 'route' => ['BookingForm'],'method' => 'post'] ) !!}
							<input type="hidden" name="inspector" value="{{ $qualified_inspector->user_id }}"><br>
							<span class="subhead">Openings for {{ $qualified_inspector->name }}</span><br>
							@php print_r(get_available_times_popup2($location, $total_time, $qualified_inspector->user_id, $qualified_inspector->look_ahead, $increment, 0, 0)); @endphp
							<input type="submit" value="Reserve {{ $qualified_inspector->name }}"><br>
						{!! Form::close() !!}
						@endforeach
					</td>
				</tr>
			</tbody>
		</table>
	@endif
</div>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        if($("#dontbreakdiv").length > 0) {
            $('.panel').html($('.NewForm').html());
            $('.NewForm').remove();
        }
    });
</script>
<style type="text/css">
    @if(!empty($gjs))
        {!! $gjs->gjs_css !!}
    @endif
</style>