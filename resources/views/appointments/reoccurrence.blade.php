@extends('layouts.front')

@section('content')
<div class="container">
	<table width="960" border="0" cellspacing="0" cellpadding="0" style="margin: 0 auto;">
    <tbody>
        <tr>
            <td bgcolor="white" valign="top">
                <div class="frameadmin">
                    <form class="recurring-form" action="#" method="post">
                        <div class="col-md-5">
                            <input type="hidden" name="action" value="reoccurrence">
                            <span class="head">Set Recurring Blockouts</span>
                            <br> Please specify any reoccurring time off for
                        </div>
                        <div class="col-md-5">
                            <select name="inspector" class="smallselect">
                                <option value="60" selected="">Richard</option>
                            </select>
                            <input type="submit" name="Submit" class="submit" value="Switch">
                            <br><span class="note">(For example, Sundays, every week, or the second Tuesday of each month)</span>
                        </div>
                    </form>
                    <form action="{{ route('occurrenceoff') }}" method="post">
                        @csrf
                        @forelse($Daysoff as $key => $off)
                            <?php 
                                $j = strlen($off['weeks']);
                                while ($j>0) {
                                    $j--;
                                    $g = $off['weeks'][$j];
                                    if ($g>0) {
                                        $ch[$g]="checked";
                                    }
                                }

                                $starttime = $off['starttime'];
                                if ($starttime == "0"){
                                    $starttime = "0000";
                                }
                                if (strlen($starttime) == 4){
                                    $hour = $starttime[0].$starttime[1];
                                    $minute = $starttime[2].$starttime[3];
                                } else {
                                    $hour = $starttime[0];
                                    $minute = $starttime[1].$starttime[2];
                                }
                                
                                $default_start_time = mktime("$hour", "$minute", "0");

                                $endtime = $off['endtime'];
                                if ($endtime == "0"){
                                    $endtime = "0000";
                                }
                                if (strlen($endtime) == 4){ 
                                    $hour = $endtime[0].$endtime[1];
                                    $minute = $endtime[2].$endtime[3];
                                } else {
                                    $hour = $endtime[0];
                                    $minute = $endtime[1].$endtime[2];
                                }

                                if ($minute == "59"){
                                    $minute = "00";
                                    $hour = $hour+1;
                                }
                                $default_end_time = mktime("$hour", "$minute", "0");
                            ?>
                            <table class="content-table">
                                    <thead>
                                        <tr>
                                            <th>Day:</th>
                                            <th>Start</th>
                                            <th>End:</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{!! day_of_week_popup($off['day'],$key.'reoc') !!}</td>
                                            <td class="start">
                                                @php $default_time = mktime("12", "0", "0"); @endphp
                                                {!! get_time_popup($default_time, $key, 0, 0, 0, 1, 1, 1, 'start') !!}
                                            </td>
                                            <td class="end">
                                                {!! get_time_popup($default_time, $key, 0, 0, 0, 1, 1, 1, 'end') !!}
                                            </td>
                                            <td>
                                                <span class="note">&nbsp;&nbsp;
                                                    <div>
                                                        <input type="checkbox" name="weeks[{{$key}}][1]" checked="">
                                                        <label>1st&nbsp;</label>
                                                    </div>
                                                    <div>
                                                        <input type="checkbox" name="weeks[{{$key}}][2]" checked=""><label>2nd&nbsp;</label>
                                                    </div>
                                                    <div>
                                                        <input type="checkbox" name="weeks[{{$key}}][3]" checked=""><label>3rd&nbsp;</label>
                                                    </div>
                                                    <div>
                                                        <input type="checkbox" name="weeks[{{$key}}][4]" checked=""><label>4rd&nbsp;</label>
                                                    </div>
                                                    <div>
                                                        <input type="checkbox" name="weeks[{{$key}}][5]" checked=""><label>5th&nbsp;week(s)</label>
                                                    </div>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                            </table>
                        @empty
                            @for($i=0;$i<10;$i++)
                                <table class="content-table">
                                <thead>
                                        <tr>
                                            <th>Day:</th>
                                            <th>Start</th>
                                            <th>End</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{!! day_of_week_popup('-1',$i.'reoc') !!}</td>                     
                                            <td class="start">
                                                @php $default_time = mktime("12", "0", "0"); @endphp
                                                {!! get_time_popup($default_time, $i, 0, 0, 0, 1, 1, 1, 'start') !!}
                                            </td>
                                            <td class="end">
                                                {!! get_time_popup($default_time, $i, 0, 0, 0, 1, 1, 1, 'end') !!}
                                            </td>
                                            <td>
                                                <span class="note">
                                                    <div>
                                                        <input type="checkbox" name="weeks[{{$i}}][1]" checked=""><label>1st&nbsp;</label>
                                                    </div>
                                                    <div>
                                                        <input type="checkbox" name="weeks[{{$i}}][2]" checked=""><label>2st&nbsp;</label>
                                                    </div>
                                                    <div>
                                                        <input type="checkbox" name="weeks[{{$i}}][3]" checked=""><label>3st&nbsp;</label>
                                                    </div>
                                                    <div>
                                                        <input type="checkbox" name="weeks[{{$i}}][4]" checked=""><label>4st&nbsp;</label>
                                                    </div>
                                                    <div>
                                                        <input type="checkbox" name="weeks[{{$i}}][5]" checked=""><label>5th&nbsp;week(s)</label>
                                                    </div>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            @endfor
                        @endforelse
                        @if(empty($key) || $key == '')
                            <?php $key = 7; ?>
                        @endif
                        @if($key != 7)
                            @for($i=$key;$i<7;$i++)
                                <table class="content-table">
                                    <thead>
                                        <tr>
                                            <th>Day:</th>
                                            <th>Start</th>
                                            <th>End</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{!! day_of_week_popup('-1',$i.'reoc') !!}</td>                     
                                            <td class="start">@php $default_time = mktime("12", "0", "0"); @endphp
                                                {!! get_time_popup($default_time, $i, 0, 0, 0, 1, 1, 1, 'start') !!}
                                            </td>
                                            <td class="end">
                                                {!! get_time_popup($default_time, $i, 0, 0, 0, 1, 1, 1, 'end') !!}
                                            </td>
                                            <td>
                                                <span class="note">
                                                    <div>
                                                        <input type="checkbox" name="weeks[{{$i}}][1]" checked=""><label>1st&nbsp;</label>
                                                        <input type="checkbox" name="weeks[{{$i}}][2]" checked=""><label>2st&nbsp;</label>
                                                        <input type="checkbox" name="weeks[{{$i}}][3]" checked=""><label>3st&nbsp;</label>
                                                        <input type="checkbox" name="weeks[{{$i}}][4]" checked=""><label>4st&nbsp;</label>
                                                        <input type="checkbox" name="weeks[{{$i}}][5]" checked=""><label>5st&nbsp;week(s)</label>
                                                    </div>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </span>
                            @endfor
                        @endif
                        <input type="hidden" name="reoccur" value="1">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="action" value="reoccurrence">
                        <input type="submit" name="Submit" class="submit" value="Set Time off for Richard »">
                    </form>
                    <br>
                    <span class="note"><a href="index.php" class="note_link">« Return to Admin Home</a></span>
                    <br>
                    <br>
                    <br>
                    <br>
                    <span class="note">Customer Support: <a href="mailto:support@scheduleze.com">support@scheduleze.com</a>
               <a href="../index.php"><img src="../images/scheduleze-logo.gif" alt="Take command of your day" width="244" height="79" align="right" border="0" class="logo"></a>
               </span>
                </div>
            </td>
        </tr>
    </tbody>
</table>
</div>
@endsection