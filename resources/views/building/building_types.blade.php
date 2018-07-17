@extends('layouts.front')

@section('content')
	{!! Form::open([ 'route' => ['storebuildtype'],'method' => 'post'] ) !!}
		<div class="frameadmin">
			<span class="head">
				Setting Building Types and Prices<br>
			</span>
			<span class="warning_red">Submit actions disabled for demo user</span><br>
			<span class="note">Order is the order the items appear in the popup menu, use radio button to set menu default.<!--<br>Cap is the total number of this class of service you wish to allow booked in a single calendar day.</span>--><p></p>						
				<table border="0" cellspacing="0" cellpadding="2">
					<tbody>
						<tr>
							<td>
								<span class="formlabel">Description</span><br>
							</td>
							<td>
								<span class="formlabel">Time Req'd</span><br>
							</td>
							<td>
								<span class="formlabel">Price</span><br>
							</td>
							<td>
								<span class="formlabel">Order&nbsp;</span><br>
							</td>
							<td>
								<span class="formlabel">Status</span><br>
							</td>
							<td>
								
							</td>
						</tr>
						<tbody class="txtBuildId">
							<tr class="trtable[0]">
								<td><input type="text" name="desc[0]" size="32" value=""></td>
								<td>				
									<select name="buffer[0]" class="small_select">
										<option value="0">0 min</option>
										<option value="900">15 min</option>
										<option value="1800">30 min</option>
										<option value="2700">45 min</option>
										<option value="3600">60 min</option>
										<option value="4500">75 min</option>
										<option value="5400">90 min</option>
										<option value="6300">1.75 hrs</option>
										<option value="7200">2 hrs</option>
										<option value="8100">2.25 hrs</option>
										<option value="9000">2.5 hrs</option>
										<option value="9900">2.75 hrs</option>
										<option value="10800">3 hrs</option>
										<option value="11700">3.25 hrs</option>
										<option value="12600">3.5 hrs</option>
										<option value="13500">3.75 hrs</option>
										<option value="14400">4 hrs</option>
										<option value="15300">4.25 hrs</option>
										<option value="16200">4.5 hrs</option>
										<option value="17100">4.75 hrs</option>
										<option value="18000">5 hrs</option>
										<option value="18900">5.25 hrs</option>
										<option value="19800">5.5 hrs</option>
										<option value="20700">5.75 hrs</option>
										<option value="21600">6 hrs</option>
										<option value="22500">6.25 hrs</option>
										<option value="23400">6.5 hrs</option>
										<option value="24300">6.75 hrs</option>
										<option value="25200">7 hrs</option>
										<option value="26100">7.25 hrs</option>
										<option value="27000">7.5 hrs</option>
										<option value="27900">7.75 hrs</option>
										<option value="28800">8 hrs</option>
										<option value="29700">8.25 hrs</option>
										<option value="30600">8.5 hrs</option>
										<option value="31500">8.75 hrs</option>
										<option value="32400">9 hrs</option>
									</select>
								</td>
								<td>
									<input type="text" name="price[0]" value="$" size="5">
								</td>
								<td align="center">
									<input type="text" name="rank[0]" value="" size="3">
									<input type="radio" value="0" name="selected">
								</td>
								<td>
									<select name="forcecall[0]" size="1">
										<option value="1" selected="">Book using size/age</option>
										<option value="2">Book as standalone</option>
										<option value="0">Require phone call</option>
										<option value="3">Use as Label</option>
									</select>
								</td>
								<td>
									<!-- <a href="#" class="note_link">Remove</a> -->
								</td>
							</tr>
						</tbody>
						<tr>
							<td colspan="4"><input type="submit" name="submit" value="Save Building Types" class="submit">
								<input type="hidden" name="action" value="building_types">
								<input type="hidden" name="trigger" value="2">&nbsp;&nbsp;
							</td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<a href="#" class="add_column" id="add_column">Add Column</a>
						</tr>
					</tbody>
				</table>
			</span>
		</div>
		<div class="tip">
			<span class="subhead">
				Building Type Strategy<br>
			</span>
			You must have a Building Types menu with at least one type of service, time and cost for Scheduleze to function properly.  Building Size popups and Building Age popups are optional, and can be configured to add additional time and cost to the basic Building Type selected by the client.<br><br>If you are not going to use price modifiers, you may wish to list various service combinations here and provide total prices for each.  This creates the simplest user interface for your clients and increases the likelihood of the client to book immediately on-line (simple forms look easier to complete).<br><br>However, if you are going to setup Building Age and Building Size popups as well, use this menu for basic Building Type only.  Provide the absolute minimum price and time for each service type as the modifier popups will add additional time and costs that you specify to this baseline cost for each Building Type.<br><br>
		</div>
		<div class="logo">
			<a href="index.php">
				<img src="/images/scheduleze-logo.gif" alt="Take command of your day" height="79" width="235" border="0">
			</a>
		</div>
		<div class="frame-closing"><br><br><br><br>
			<span class="note">Customer Support: <a href="mailto:support@scheduleze.com">support@scheduleze.com</a>
			</span>
		</div>
	{!! Form::close() !!}
@endsection
