@php     
    if(empty(session('business_id'))){
        $gjs = PanelTemplate($data['reference_id'], 'user_id');
    }
    else{
        $gjs = PanelTemplate(session('business_id'), 'business');
    }
    $userId = Auth::id();
@endphp
    <title>Scheduleze | Customer Scheduling Solutions</title>
    <meta name="keywords" content="Scheduleze | Customer Scheduling Solutions"/>
    <meta name="body" content="Scheduleze | Customer Scheduling Solutions"/>
    <meta name="description" content="Scheduleze | Customer Scheduling Solutions"/>
    <meta name="summary" content="Scheduleze | Customer Scheduling Solutions"/>
    <meta http-equiv="Bulletin-Text" content="Scheduleze | Customer Scheduling Solutions"/>
    <meta name="page-topic" content="Scheduleze | Customer Scheduling Solutions"/>
    <link rel="shortcut icon" href="{{ asset('images/favicon_icon.png') }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
    <div class="loader"></div>


{!! $gjs->gjs_html !!}
<style type="text/css">
    @if(!empty($gjs))
        {!! $gjs->gjs_css !!}
    @endif

    .header_section {
        float: unset !important;
        width: 96%;
    }

</style>
<div class="NewForm" style="display: none;">
    @if (is_array($PanelForm) || is_object($PanelForm))

        @foreach ($PanelForm as $pform)
        @endforeach
    @else
        @php
            $addons = array();
            $BuildType = $data['building_type'];
            $businessId = Session::get('business_id');

            if(!empty($data['building_size'])){
                $building_size = $data['building_size'];
            }else{
                $building_size = '';
            }

            if(!empty($data['building_age'])){
                $building_age = $data['building_age'];
            }else{
                $building_age = '';
            }

            $building_age = $data['building_age'];
            $location = !empty($data['location']) ? $data['location'] : '';
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

            $authorized_inspectors = get_inspector_exceptions($businessId, $BuildType, $building_size, $building_age, $addons, session('total_price'), $data['reference_id']);

            $increment = 900;

            if(!empty(session('engage'))) {
                $engage = session('engage');
            } else {
                $engage = get_field('users_details', 'engage', $data['reference_id']);
            }

            if(!empty(session('business_information.address'))) {
                $address = session('business_information.address');
                $city = session('business_information.city');
                $state = session('business_information.state');
                $zip = session('business_information.zip');
            } else {
                $address = get_field('business', 'address', $data['reference_id']);
                $city = get_field('business', 'city', $data['reference_id']);
                $state = get_field('business', 'state', $data['reference_id']);
                $zip = get_field('business', 'zip', $data['reference_id']);
            }
        @endphp
	    <table class="accent">
			<tbody>
				<tr>
					<td>
                        @if($engage == 1 && !empty($location))
                            <span class="grayhead"><b>Scheduling an inspection in {!! getlocation($location) !!}</b></span><br>
                        @else
                            <span class="grayhead"><b>Scheduling an Appointment in {{ $city }}</b></span><br>
                            at {{ $address }}, {{ $city }}, {{ $state }}, {{ $zip }}
                        @endif
						<span class="head"><h3></h3></span>
						<div class="small_indent"><span class="address"></span></div>
						@foreach($authorized_inspectors as $qualified_inspector)
						{!! Form::open([ 'route' => ['BookingForm'],'method' => 'post'] ) !!}
							<input type="hidden" name="inspector" value="{{ $qualified_inspector->user_id }}"><br>
                            @php 
                                $qualified_inspector_name = $qualified_inspector->name;
                            @endphp
                            @if(empty($qualified_inspector->name))
                                @php $qualified_inspector_name = username($qualified_inspector->user_id); @endphp
                            @endif
							<span class="subhead">Openings for {{ $qualified_inspector_name }}</span><br>
							@php print_r(get_available_times_popup2($location, $total_time, $qualified_inspector->user_id, $qualified_inspector->look_ahead, $increment, 0, $qualified_inspector->throttle)); @endphp
							<input type="submit" value="Reserve {{ $qualified_inspector_name }}"><br>
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

            $('.loader').fadeOut(1000);
        }

        
    });
</script>