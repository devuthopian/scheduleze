@extends('layouts.front')

@section('content')
<div class="set_recc_block">
<div class="container">
            <form action="{{ url('/scheduleze/BusinessHours') }}" method="post">
            	@csrf
            	<div class="set_recc_cont">
	                <h2>Business hours for {{ Auth::user()->name }}</h2>
	                <h4>Please specify any business hours for</h4>
	            </div>
	            <div class="set_recc_cont">
	            	<div class="select_field">
		                {!! get_inspector_popup("name", $id) !!}

		                <input type="submit" name="Submit" class="submit" value="Switch">
		                <input type="hidden" name="action" value="business_hours" class="form-control">
		            
	            </div>
            </form>
            <div class="clearfix"></div>
            <div>
	            <form action="{{ route('StoreBusinessHours') }}" method="post">
	            	@csrf
	                Please select your normal working hours for each day
	                <h5>Specify reoccurring blockouts, like the second Tuesday of each month on your <a href="{{ route('Reoccurrence') }}" class="note_link">Reoccurring Blockouts</a> page.</h5>
		                <input type="hidden" name="trigger" value="1">
		                <input type="hidden" name="action" value="business_hours">
	                <br>
	                <table border="0" cellspacing="4" cellpadding="0" class="table border table-responsive table-borderd table-striped select-default">
	                    <tbody>
	                        <tr class="dark-table-heading">
	                            <td>&nbsp;</td>
	                            <td><span class="formlabel">Open</span></td>
	                            <td><span class="formlabel">Close</span></td>
	                            <td>&nbsp;</td>
	                        </tr>
	                            @forelse($businesshours as $key => $hours)
	                                <?php
	                                    if ($hours['endtime']==000) {
	                                        $start=1200;
	                                        $ams="AM";
	                                        $end=1200;
	                                        $ame="AM";
	                                        $ch="checked";
	                                    } else {
	                                        $ch= '';
	                                        /***display format code***/
	                                        if ($hours['starttime']==0) {
	                                            $start=1200;
	                                            $ams="AM";
	                                        } elseif ($hours['starttime']==1200) {
	                                            $start=1200;
	                                            $ams="PM";
	                                        } elseif ($hours['starttime']>1159) {
	                                            $ams="PM";
	                                            $start = $hours['starttime']-1200;                                            
	                                        } else {
	                                            $ams="AM";
	                                            $start = $hours['starttime'];
	                                        }
	                                        
	                                        if ($hours['endtime']==2359) {
	                                            $end=1200;
	                                            $ame="AM";
	                                        } elseif ($hours['endtime']==1200) {
	                                            $end=1200;
	                                            $ame="PM";
	                                        } elseif ($hours['endtime']<1200) {
	                                            $ame="AM";
	                                            $end = $hours['endtime'];
	                                        } else {
	                                            $ame="PM";
	                                            $end = $hours['endtime']-1200;
	                                        }
	                                        /***end display format***/
	                                    }

	                                    // get the minutes
	                                    $minute_start = substr($start, -2);
	                                    $minute_end = substr($end, -2);
	                                    
	                                    //ditch the extra zeros
	                                    $start = substr($start,0,-2);
	                                    $end = substr($end,0,-2);
	                                    
	                                    if ($start == "00"){
	                                        $start = 12;
	                                        $ams = "AM";
	                                    }
	                                    
	                                    if ($end == "00"){
	                                        $end = 12;
	                                        $ame = "AM";
	                                    }

	                                    
	                                ?>
	                                <tr>
	                                    <td>{!! get_day_name($key) !!}</td>
	                                    <td>{!! hour_popup($start, $key, 'open').''.minute_popup($minute_start, $key, 'open', 0).''.am_popup($ams, $key, 'open', 0) !!}</td>
	                                    <td>{!! hour_popup($end, $key, 'close').''.minute_popup($minute_end, $key, 'close', 0).''.am_popup($ame, $key, 'close', 0) !!}</td>
	                                    <td class="text-right"><input type="checkbox" name="closed[{{$key}}]" {{$ch}}>Close All day</td>
	                                </tr>
	                            @empty
		                            @for($i=0;$i<7;$i++)
		                                <tr>
		                                    <td>{!! get_day_name($i) !!}</td>
		                                    <td>{!! hour_popup('',$i, 'open').''.minute_popup('',$i, 'open', 1).''.am_popup('',$i, 'open', 1) !!}</td>
		                                    <td>{!! hour_popup('',$i, 'close').''.minute_popup('',$i, 'close', 1).''.am_popup('',$i, 'close', 0) !!}</td>
		                                    <td class="text-right"><input type="checkbox" name="closed[{{$i}}]">Close All day</td>
		                                </tr>
		                            @endfor
	                            @endforelse
	                        </tr>
	                    </tbody>
	                </table>
	                <br>
	                <input type="submit" class="submit" name="Submit" value="Update Business Hours">
	            </form>
        	</div>
    <!-- <div class="col-sm-12">
	    <a href="../index.php"><img src="../images/scheduleze-logo.gif" alt="Take command of your day" width="244" height="79" align="right" border="0" class="logo"></a>
	</div> -->
 </div>
</div>
@endsection