@extends('layouts.front')

@section('content')
<div class="container">

                <div class="framecell">
                    <div class="frameadmin">
                        <form action="#" method="post">
                            <span class="head">Business hours for {{ Auth::user()->name }}</span>
                            <br> Please specify any business hours for
                            <select name="inspector" class="smallselect">
                                <option value="60" selected="">{{ Auth::user()->name }}</option>
                            </select>
                            <input type="submit" name="Submit" class="submit" value="Switch">
                            <input type="hidden" name="action" value="business_hours">
                        </form>
                        <form action="#" method="post">
                            Please select your normal working hours for each day
                            <br><span class="note">Specify reoccurring blockouts, like the second Tuesday of each month on your <a href="#" class="note_link">Reoccurring Blockouts</a> page.</span>
                            <br>
                            <input type="hidden" name="trigger" value="1">
                            <input type="hidden" name="action" value="business_hours">
                            <br>
                            <table border="0" cellspacing="4" cellpadding="0">
                                <tbody>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td><span class="formlabel">Open</span></td>
                                        <td><span class="formlabel">Close</span></td>
                                        <td>&nbsp;</td>
                                    </tr>
                                   	 	@for($i=0;$i<7;$i++)
                                   	 		<tr>
	                                    		<td>{!! get_day_name($i) !!}</td>
	                                    		<td>{!! hour_popup('',$i).''.minute_popup('',$i).''.am_popup('',$i) !!}</td>
	                                    		<td>{!! hour_popup('',$i).''.minute_popup('',$i).''.am_popup('',$i) !!}</td>
	                                    		<td><input type="checkbox" name="txtclosedday">Close All day</td>
	                                    	</tr>
                                    	@endfor
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <input type="submit" class="submit" name="Submit" value="Update Business Hours">
                        </form>
                        <br>
                        <br>
                        <br>
                    </div>
                </div>
                <div class="logo">
                    <a href="index.php"><img src="/images/scheduleze-logo.gif" alt="Take command of your day" width="244" height="79" border="0"></a>
                </div>
 
</div>
@endsection