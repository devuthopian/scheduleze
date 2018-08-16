@extends('layouts.front')

@section('content')
<div class="container">

    <div class="framecell">
        <div class="frameadmin">
            <form action="#" method="post" style=" margin-top:120px;">
            	<div class="col-sm-4">
	                <span class="head">Business hours for {{ Auth::user()->name }}</span>
	                <br> Please specify any business hours for
	            </div>
	            <div class="col-sm-4 adminsubmitbar">
	            	<div class="form-group">
		                <select name="inspector" class="smallselect form-control">
		                    <option value="60" selected="">{{ Auth::user()->name }}</option>
		                </select>

		                <input type="submit" name="Submit" class="submit btn btn-default" value="Switch">
		                <input type="hidden" name="action" value="business_hours" class="form-control">
		            </div>
	            </div>
            </form>
            <div class="clearfix"></div>
            <div class="col-sm-12">
	            <form action="{{ route('StoreBusinessHours') }}" method="post">
	            	@csrf
	                Please select your normal working hours for each day
	                <br><span class="note">Specify reoccurring blockouts, like the second Tuesday of each month on your <a href="#" class="note_link">Reoccurring Blockouts</a> page.</span>
	                <br>
		                <input type="hidden" name="trigger" value="1">
		                <input type="hidden" name="action" value="business_hours">
	                <br>
	                <table border="0" cellspacing="4" cellpadding="0" class=" table border table-responsive table-borderd table-striped select-default">
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
	                                    <td>{!! hour_popup($start, $key, 'open').''.minute_popup($minute_start, $key, 'open').''.am_popup($ams, $key, 'open') !!}</td>
	                                    <td>{!! hour_popup($end, $key, 'close').''.minute_popup($minute_end, $key, 'close').''.am_popup($ame, $key, 'close') !!}</td>
	                                    <td class="text-right"><input type="checkbox" name="closed[$loop->iteration]" {{$ch}}>Close All day</td>
	                                </tr>
	                            @empty
	                            @for($i=0;$i<7;$i++)
	                                <tr>
	                                    <td>{!! get_day_name($i) !!}</td>
	                                    <td>{!! hour_popup('',$i, 'open').''.minute_popup('',$i, 'open').''.am_popup('',$i, 'open') !!}</td>
	                                    <td>{!! hour_popup('',$i, 'close').''.minute_popup('',$i, 'close').''.am_popup('',$i, 'close') !!}</td>
	                                    <td class="text-right"><input type="checkbox" name="closed[$i]">Close All day</td>
	                                </tr>
	                            @endfor
	                            @endforelse
	                        </tr>
	                    </tbody>
	                </table>
	                <br>
	                <input type="submit" class="submit btn btn-primary" name="Submit" value="Update Business Hours">
	            </form>
        	</div>
            <br>
            <br>
            <br>
        </div>
    </div>
    <div class="col-sm-12 align-center take-command">
	    <div class="logo">
	        <a href="index.php" class="btn btn-primary">
	        	<img src="/images/scheduleze-logo.gif" alt="Take command of your day" border="0">
	        </a>
	    </div>
	</div>
 
</div>
@endsection