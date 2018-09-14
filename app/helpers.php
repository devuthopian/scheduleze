<?php 

if (! function_exists('show_buffer')) {
    function show_buffer($variable, $default_option='10800', $max = '32400', $increment = '900')
    {
    	$html = "\t\t\t\t<select name=\"buffer[$variable]\" class=\"small_select selectpicker form-control\">\n";
    	$i = 0;
		while ($i <= $max){
			if ($default_option == $i){
				$selected = "selected";
			} else {
				$selected = "";
			}
			if ($i < 5401){
				$time = round (($i/60));
				$spec = "min";
			} else {
				$time = round (($i/3600), 2);
				$spec = "hrs";
			}
			$html .= "\t\t\t\t\t<option value=\"$i\" $selected>$time $spec</option>\n";
			$i = $i + $increment;
		}
		$html .= "</select>";
		return $html;
    }
}

if (! function_exists('state')) {
    function state($selected = '')
    {
    	$html = "\t\t\t\t<select name=\"state\" id=\"business_state\" size=\"1\" class=\"smallselect\">\n";
    	$html .= "\t\t\t\t<div class=\"form-group has-error business_state\" id=\"business_city\" style=\"display: none;\"><span class=\"help-block\">Business State is Required</span></div>";
    	if(!empty($selected)){
    		$html .= "\t\t\t\t\t<option value=\".$selected.\">".$selected."</option>";
    	}else{
    		$html .= "\t\t\t\t\t<option value=\"\">Business State</option>";
    	}
    	$html .= "\t\t\t\t\t<option value=\"AK\">AK</option> <option value=\"AL\">AL</option> <option value=\"AR\">AR</option> <option value=\"AZ\">AZ</option> <option value=\"CA\">CA</option> <option value=\"CO\">CO</option> <option value=\"CT\">CT</option> <option value=\"DC\">DC</option> <option value=\"DE\">DE</option> <option value=\"FL\">FL</option> <option value=\"GA\">GA</option> <option value=\"HI\">HI</option> <option value=\"IA\">IA</option> <option value=\"ID\">ID</option> <option value=\"IL\">IL</option> <option value=\"IN\">IN</option> <option value=\"KS\">KS</option> <option value=\"KY\">KY</option> <option value=\"LA\">LA</option> <option value=\"MA\">MA</option> <option value=\"MD\">MD</option> <option value=\"ME\">ME</option> <option value=\"MI\">MI</option> <option value=\"MN\">MN</option> <option value=\"MO\">MO</option> <option value=\"MS\">MS</option> <option value=\"MT\">MT</option> <option value=\"NC\">NC</option> <option value=\"ND\">ND</option> <option value=\"NE\">NE</option> <option value=\"NH\">NH</option> <option value=\"NJ\">NJ</option> <option value=\"NM\">NM</option> <option value=\"NV\">NV</option> <option value=\"NY\">NY</option> <option value=\"OH\">OH</option> <option value=\"OK\">OK</option> <option value=\"OR\">OR</option> <option value=\"PA\">PA</option> <option value=\"RI\">RI</option> <option value=\"SC\">SC</option> <option value=\"SD\">SD</option> <option value=\"TN\">TN</option> <option value=\"TX\">TX</option> <option value=\"UT\">UT</option> <option value=\"VA\">VA</option> <option value=\"VT\">VT</option> <option value=\"WA\">WA</option> <option value=\"WI\">WI</option> <option value=\"WV\">WV</option> <option value=\"WY\">WY</option> <option value=\"\">--</option> <option value=\"AB\">AB</option> <option value=\"BC\">BC</option> <option value=\"MB\">MB</option> <option value=\"NB\">NB</option> <option value=\"NL\">NL</option> <option value=\"NT\">NT</option> <option value=\"NS\">NS</option> <option value=\"NU\">NU</option> <option value=\"ON\">ON</option> <option value=\"PE\">PE</option> <option value=\"QC\">QC</option> <option value=\"SK\">SK</option> <option value=\"YT\">YT</option>\n";
		$html .= "</select>";
		return $html;
    }
}


if (! function_exists('show_day_padding')) {
    function show_day_padding($default_option='-1', $max = '20', $increment = '1')
    {
    	$html = "\t\t\t\t<select name=\"padding_day\" class=\"small_select\">\n";
    	$html .= "\t\t\t\t\t<option value=\"0\" selected>pick</option>\n";
    	$i = 0;
		while ($i <= $max){
			if ($default_option == $i){
				$selected = "selected";
			} else {
				$selected = "";
			}
			$html .= "\t\t\t\t\t<option value=\"$i\" $selected>$i</option>\n";
			$i = $i + $increment;
		}
		$html .= "</select>";
		return $html;
    }
}

if (! function_exists('show_day_forward')) {
    function show_day_forward($default_option='-1', $max = '20', $increment = '1')
    {
    	$html = "\t\t\t\t<select name=\"day_forward\" class=\"small_select\">\n";
    	$html .= "\t\t\t\t\t<option value=\"0\" selected>pick</option>\n";
    	$i = 0;
		while ($i <= $max){
			if ($default_option == $i){
				$selected = "selected";
			} else {
				$selected = "";
			}
			$html .= "\t\t\t\t\t<option value=\"$i\" $selected>$i</option>\n";
			$i = $i + $increment;
		}
		$html .= "</select>";
		return $html;
    }
}

if(! function_exists('getallIndustries')){
	function getallIndustries(){
		return DB::table('business_types')->pluck('agent_name', 'id');
	}
}

if(! function_exists('getBusinessIndustry')){
	function getBusinessIndustry($id = ''){
		return DB::table('business_types')->where('id', $id)->first();
	}
}

if(! function_exists('buildType')){
	function buildType($id){
		array_shift($id);		
		unset($id['reference_id']);
		unset($id['businessId']);
       	unset($id[0]);
		$getall[] = '';
		foreach ($id as $key => $value) {
			if($value != null && $value != ''){

				if($key == 'addon'){
					foreach ($value as $k => $value){
						$addons = DB::table('addons')->select('name','price')->where([['id', '=', $value],['removed', '=', '0']])->first();				
						if(!empty($addons)){
							array_push($getall, $addons->name.' $'.$addons->price);
						}
					}
				}else{

					$getformdata = DB::table($key.'s')->select('name','price')->where([['id', '=', $value],['removed', '=', '0']])->first();
					if(!empty($getformdata) && $getformdata != null){
						$getall[] = $getformdata->name.' $'.$getformdata->price;
					}
				}
			}
		}		

		//return $getall;
	}
}

if(! function_exists('username')){
	function username($id){
		
		$getformdata = DB::table('users')->select('name')->where('id',$id)->get();
		return $getformdata[0]->name;
	}
}

if(! function_exists('getlocation')){
	function getlocation($id){
		
		$getformdata = DB::table('locations')->select('name','price')->where('id',$id)->first();
		return $getformdata->name.' + $'.$getformdata->price;;
	}
}

if(! function_exists('CountAppFormCost')){
	function CountAppFormCost($id){
		array_shift($id);
		unset($id['reference_id']);
		unset($id['businessId']);
       	unset($id[0]);
		$addons_price[] = '';
		$count = 0;

		foreach ($id as $key => $value) {
			if($value != null && $value != ''){
				if($key == 'addon'){
					foreach ($value as $k => $value){
						$addons_price[] = DB::table('addons')->select('price')->where([['id', '=', $value],['removed', '=', '0']])->first();
					}
				}else{
					$getformdata = DB::table($key.'s')->select('price')->where([['id', '=', $value],['removed', '=', '0']])->get();
					if($getformdata->count()){
						$price = $getformdata[0]->price;
						$count = $price + $count;
					}
				}
			}
		}
		//only for addons
		for ($i=0; $i < count($addons_price); $i++) {
			if(!empty($addons_price[$i])){
				$count = $count + $addons_price[$i]->price;
			}
		}

		return $count;
	}
}

if(! function_exists('hour_popup')){
	function hour_popup ($hour, $designate, $session) {
		$popup ="\t\t\t\t<select name=\"hour".$session."[".$designate."]\" class=\"smallselect\" required>\n";
		$popup .="\t\t\t\t<option value=\"\" selected></option>\n";
		for ($i=1; $i <= 12; $i++) {
			if($hour == $i || $hour == ''){
				$selected  = 'selected';
			}else{
				$selected  = '';
			}
			
			$popup .="\t\t\t\t<option value=\"$i\" $selected>$i</option>\n";
		}
		$popup .="\t\t\t\t</select>\n";
		return $popup;
	}
}

if(! function_exists('minute_popup')){
	function minute_popup ($minute, $designate, $session) {
		$popup ="\t\t\t\t<select name=\"minute".$session."[".$designate."]\" class=\"smallselect\">\n";
		$popup .="\t\t\t\t	<option value=\"$minute\" selected>$minute</option>\n";
		$popup .="\t\t\t\t	<option value=\"00\">00</option>\n";
		$popup .="\t\t\t\t	<option value=\"15\">15</option>\n";
		$popup .="\t\t\t\t	<option value=\"30\">30</option>\n";
		$popup .="\t\t\t\t	<option value=\"45\">45</option>\n";
		$popup .="\t\t\t\t</select>\n";
		return $popup;
	}
}

if(! function_exists('make_sql_value_insert')){
	function make_sql_value_insert ($sq, $table='', $type='insert', $column='', $where='') {
		$statement ='';
		foreach ($sq as $sql){
		    if ($sql == "NULL"){
		        $statement .= "$sql, ";
		    } else {
		        $statement .= "$sql, ";
		    }
		}
		$length = (strlen($statement));
		$len = $length - 2;
		$statement = substr($statement, 0, $len);
		return $statement;
	}
}

if(! function_exists('get_drivetime_popup')){
	function get_drivetime_popup ($location1, $location2, $time='0') {
		$do="selected";
		$none_select="selected";
		$select = "<select name=\"dt[$location1][$location2]\" size=\"1\" class=\"select_drivetime\">\n";
		$select .= "<option value=\"0\" selected>None</option>";
		if (strlen($time)>1) {
			$min = $time/60;
			$select .= "<option value=\"$time\" $do>$min min</option>\n";
			$do="";
		} elseif ($time == "0") {
			$none_select = " selected";
			$do="";
		}
		/*$output = $val / 60;
		for ($i= 1; $i <= 18; $i++) {
			if($val == $i || $val == ''){
				$selected  = 'selected';
			}else{
				$selected  = '';
			}
			
			$popup .="\t\t\t\t<option value=\"$val\" $selected>$output</option>\n";
		}*/
		$select .= "<option value=\"900\">15 min</option>
					<option value=\"1800\" $do>30 min</option>
					<option value=\"2700\">45 min</option>
					<option value=\"3600\">60 min</option>
					<option value=\"4500\">1:15</option>
					<option value=\"5400\">1:30</option>
					<option value=\"6300\">1:45</option>
					<option value=\"7200\">2 hours</option>
					<option value=\"8100\">2:15 hours</option>
					<option value=\"9000\">2:30 hours</option>
					<option value=\"9900\">2:45 hours</option>
					<option value=\"10800\">3 hours</option>
					<option value=\"14400\">4 hours</option>
					<option value=\"18000\">5 hours</option>
					<option value=\"21600\">6 hours</option>
					<option value=\"25200\">7 hours</option>
					<option value=\"28800\">8 hours</option>
					<option value=\"32400\">9 hours</option>
				</select>";
		return $select;
	}
}

if(! function_exists('edit_filter')){
	function edit_filter ($first, $id, $name, $last='0') {
		//inspectors popup
		$html = "<td class=\"display\"><div class=\"labelInsp\"><label>Inspector</label>";
		/*$html .= "<option value =\"$id\">$name</option>
		";
		$sql = "select * from inspectors where id != $id order by name";
		$result = $this->query($sql);
		while ($row=$this->pull_array($result)) {
			$html .= "<option value =\"$row[id]\">$row[name]</option>
			";
		}
		$html .= "</select></td>
		";*/
		$html .= get_inspector_popup("name", $id);
		//time popups
		$html .= "<td class=\"display\"><div class=\"labelstart\"><label>Start time</label>".get_time_popup ($first, $designate="", 1, 1, 1, 0, 0, 0, 'start');
		$html .="</div></td>";
		$html .="<td class=\"display\"><div class=\"labelend\"><label>End time</label>".get_time_popup ($last, $designate="1", 1, 1, 1, 0, 0, 0, 'end');
		$html .="</div></td>";
		$html .="<td class=\"display\"><br><input type=\"submit\" value=\"Filter\">";
		$html .="</td>";
		
		return $html;
	}
}

if(! function_exists('get_inspector_popup')){
	function get_inspector_popup($column='name', $id='', $bus='') {
		if ($bus == "") {
			$bus = session('business_id');
		}
		if(empty($id)){
			$id = session('id');
		}
		$permission = session('permission');
		if ($permission == 1) {
			$where = " where business = '".$bus."' and removed = '0'";
		} else {
			$where = " where business = '".$bus."' and removed = '0' and id = '".$id."'";
		}

		$rows = DB::select('select * from users_details '.$where.' order by permission DESC');
		$html = "\n\t\t\t<select name=\"users_details\" class=\"smallselect\">";

		foreach ($rows as $row) {
			if(empty($row->$column)){
				$users_row = DB::table('users')->where('id', $row->user_id)->first();
				$row->$column = $users_row->name;
			}
			if($row->user_id == $id){
				$select = "selected";
			} else {
				$select = "";
			}
			$html .= "\n\t\t\t\t<option value=\"".$row->user_id."\" $select>".$row->$column."</option>";
			
		}
		$html .= "\n\t\t\t</select></div>";
		return ($html);
	}
}

if(! function_exists('get_addon_checkboxes')){
	function get_addon_checkboxes($table, $returns='id', $label='name', $variable='addon', $insert='', $order='rank', $direction='ASC', $truncate_label='48', $default_id='', $columns='2', $cellpadding='2') {
		//if (strlen($insert)>4){
			//$insert .= " and ";
			$businessId = session('business_id');
			$whereArr = [['business', '=', $businessId], ['removed', '=', 0]];
		//}
		
		$rows = DB::table($table)->where($whereArr)->orderBy($order, $direction)->get()->toArray();
		//$sql = "select * from $table where ".$insert."business='$_SESSION[business]' and removed='0' order by $order $direction";
		//$rows = $this->pull_multi($sql);
		if (count($rows)>0){
			if ($columns != "0"){
				$count = count($rows);
				$per_column = ceil($count/$columns);
				$html = "<table cellpadding=\"$cellpadding\" cellspacing=\"0\" border=\"0\"><tr><td valign=\"top\">";
				$c = 0;
			}
			foreach ($rows as $row) {
				if(is_array($default_id) || isset($default_id)){

					if (in_array(parse_str($row->id), $default_id)){
						$selected = "checked"; 
					} else {
						$selected = ""; 
					}

				} else {
					if ($row->id == $default_id){ $selected = "checked"; } else { $selected = ""; }
				}
				if ($row->price > 0){
					$price = " - $".$row->price;
				} else {
					$price = "";
				}
				//$label_length = ($label_length + strlen($row[name]) + strlen($row[price]));
				//if ($label_length > 40){
				//	$br = "<br>";
				//	$label_length = 0;
				//} else {
					//$br = "";
				//	$br = "<br>";  //for new row, let's see if that looks better
				//}
				$c++;
				if ($per_column < $c){
					$c = 1;
					if ($columns != "0"){
						$html .="</td><td valign=\"top\">";
					}
				}
				$row->$label = truncate_string($row->$label, $truncate_label);
				$html .= ("\n\t\t\t\t\t\t<input type=\"checkbox\" name=\"$variable"."[]\" value=\"".$row->$returns."\" $selected><span class=\"note\"> ".$row->$label." ".$price." </span><br>");
			}
			if ($columns != "0"){
				$html .= "</td></tr></table>";
			}
			return ($html);
		} else {
			return false;
		}
	}
}

if(! function_exists('get_total_price')){
	function get_total_price($building_type, $building_size, $building_age, $location='', $addons=''){
		$prices = get_field("building_types", 'price', $building_type);
		if ($building_size > 0){
			$size_price = get_field("building_sizes", 'price', $building_size);
			$prices = $prices + $size_price;
		}
		if ($building_age > 0){
			$age_price = get_field("building_ages", 'price', $building_age);
			$prices = $prices + $age_price;
		}
		if ($location > 0){
			$location_price = get_field("locations", 'price', $location);
			$prices = $prices + $location_price;
		}
		if (is_array($addons) || isset($addons)){
			$adds = format_addons($addons);
			$prices = $prices + $adds['price'];
		}
		
		return $prices;
	}
}

if(! function_exists('truncate_string')){
	function truncate_string($string, $length){
		if (strlen($string) > $length){
			$headparts = explode(" ",$string);
			foreach($headparts as $headpart){
				$chr = ($chr+(strlen($headpart)));
				if($chr<$length){
					$shorthead .= ($headpart." ");
				}
			}
			$string = trim($shorthead);
			$string = ($string."...");
		}
		return $string;
	}
}

if(! function_exists('get_modifer_information')){
	function get_modifer_information($table, $modifer_id, $business){

		$modifer_info = DB::table($table)->select('name', 'buffer', 'price', 'status')->where([['id', '=', $modifer_id],['business', '=', $business],['removed', '=', '0']])->first();
		/*$sql = "select name, buffer, price, status from $table where id = '$modifer_id' and business='$business' and removed = '0'";
		$modifer_info = $this->pull_assoc($sql);*/
		return $modifer_info;
	}
}

if(! function_exists('get_proposed_inspection_information')){
	function get_proposed_inspection_information($business, $building_type, $building_size, $building_age, $addons, $location='none'){
		$building_info = get_modifer_information("building_types", $building_type, $business);

		$more_price[] = $building_info->price;
		$more_time[] = $building_info->buffer;
		$more_status[] = $building_info->status;
		$more_name = $building_info->name;

		if ($building_info->status != "2"){ //2 means to disregard additional popup selections for size and age
			$building_info = get_modifer_information("building_sizes", $building_size, $business);
			if(isset($building_info)){
				$more_price[] = $building_info->price;
				$more_time[] = $building_info->buffer;
				$more_status[] = $building_info->status;
				$more_name .= ", $building_info->name";

				if ($building_info->status != "2"){ //2 means to disregard additional popup selections for size and age
					$building_info = get_modifer_information("building_ages", $building_age, $business);
					if($building_info != null){
						$more_price[] = $building_info->price;
						$more_time[] = $building_info->buffer;
						$more_status[] = $building_info->status;
						$more_name .= ", $building_info->name";
					}
				}
			}
		}
		
		$addons_information[] = null;
		$information['total_price'] = null;
		$information['total_time'] = null;
		$information['status'] = null;

		if (is_array($addons) || !empty($addons)){
			foreach ($addons as $ddd){
				$addons_information[] = DB::table('addons')->where([['id', '=', $ddd],['business', '=', $business],['removed', '=', '0']])->first();
			}
			if (is_array($addons_information) || !empty($addons_information)){
				foreach($addons_information as $adz){
					$more_price[] = $adz['price'];
					$more_time[] = $adz['buffer'];
					$more_status[] = $adz['status'];
				}
			}
		}


		if (in_array("0", $more_status)){
			$information['status'] = 0;
		} else {

			$testing = array_search("2", $more_status);
			if ($testing){
				$information['status'] = $testing + 1;
			}
		}
		
		// location price addtion, subtraction
		if (is_numeric($location)){
			$more_price[] = get_field("locations", "price", $location);
		}
		
		foreach ($more_price as $m_price){
			$information['total_price'] = $information['total_price'] + $m_price;
		}
		foreach ($more_time as $m_time){
			$information['total_time'] = $information['total_time'] + $m_time;
		}
		
		return $information;
	}
}

if(! function_exists('get_zigpop')){
	function get_zigpop ($time='0') {
		$do = "selected";
		$select = "<select name=\"zigpop\" size=\"1\" class=\"select_drivetime\">\n";
		if (strlen($time)>1) {
			$min=$time/60;
			$select .= "<option value=\"$time\" $do>$min min</option>\n";
			$do="";
		}
		$select .= "
					<option value=\"900\">15 min</option>
					<option value=\"1800\" $do>30 min</option>
					<option value=\"2700\">45 min</option>
					<option value=\"3600\">60 min</option>
					<option value=\"4500\">1:15</option>
					<option value=\"5400\">1:30</option>
					<option value=\"6300\">1:45</option>
					<option value=\"7200\">2 hours</option>
					<option value=\"8100\">2:15 hours</option>
					<option value=\"9000\">2:30 hours</option>
					<option value=\"9900\">2:45 hours</option>
					<option value=\"10800\">3 hours</option>
				</select>";
		return $select;
	}
}

if(! function_exists('get_field')){
	function get_field($table, $field, $id) {
		if($table == 'users_details'){
			$get = DB::table($table)->select($field)->where('user_id', $id)->first();
		}else{
			$get = DB::table($table)->select($field)->where('id', $id)->first();
		}
		$return = stripslashes($get->$field);
		return $return;
	}
}

if(! function_exists('get_inspector_exceptions')){
	function get_inspector_exceptions($business, $building_type, $building_size, $building_age, $addons, $price){
		$working_inspectors = DB::table('users_details')->where([['business', '=', $business],['removed', '=', '0']])->get();
		
		// construct exception sql portion
		$skk = "(type = '1' and exception = '$building_type')";  //types check
		if ($building_size > 0){
			$skk .= " or (type = '2' and exception = '$building_size')";
		}
		if ($building_age > 0){
			$skk .= " or (type = '3' and exception = '$building_age')";
		}
		if (is_array($addons)){
			foreach ($addons as $adxn){
				$skk .= " or (type = '4' and exception = '$adxn')";
			}
		}
		
		$qualified_inspector = array();
		foreach ($working_inspectors as $a_inspector){

			$addons_information = DB::select('select count(*) as cexcp from exceptions where user_id = '.$a_inspector->user_id.' AND '.$skk.'');
			//$addons_information = DB::table('exceptions')->where([['user_id', '=', $a_inspector->id],$skk])->get();

			//dd($addons_information[0]->cexcp);
			if ($addons_information[0]->cexcp == 0){
				//if (($a_inspector[max_price] > 0) and ($a_inspector[max_price] > $price)){  //if there is a reasonable price cap, and that cap is over the actual price
					$qualified_inspector[] = $a_inspector;
				//}
			} else {
				//echo "knocking out $a_inspector[id]<br>";
				//echo "price: $price  max_price: $a_inspector[max_price]";
			}
		}
			
		return $qualified_inspector;  //returns full array with all inspector infromation [name] [public_name] etc.
	}
}

if(!function_exists('get_available_times_popup2')){
	function get_available_times_popup2($location, $proposed_size_duration, $user_id, $days_forward='12', $increment='3600', $starttime='0', $throttle='1', $business_wide = 'no', $show_endtimes = "0", $daily_cap_block = ''){
		// builds an array of all possible starttime stamps to propose, knocksout nights and any days provided in days off (numerical code 0-6 0 being sunday
		if ($days_forward == "0"){ $days_forward = 12; } //sensibilty check on days_ahead value

		$appointment_padding = get_field("users_details", "padding_day", $user_id);
		$allow_conflict = get_field("users_details", "allow_conflict", $user_id);

		if ($allow_conflict != 1){
			$allow_conflict = 0;
		}
		
		if (($appointment_padding < 1) || (!is_numeric($appointment_padding))){
			$appointment_padding = 1;
		}
		
		if ($starttime == "0"){
			$time = time();
			$one_day_forward = ($time + (86400 * $appointment_padding));
			$d = date ("n", $one_day_forward);
			$m = date ("j", $one_day_forward);
			$y = date ("y", $one_day_forward);
			$starttime = mktime(1,0,0,$d,$m,$y);
		}
		
		$business = session('business_id');

		$ahead = $days_forward*86400;
		$proposed_starttime = $starttime;
		$days_off_array = DB::table('daysoff')->where([['user_id', '=', $user_id],['removed', '=', '0']])->get();
		//$days_off_array = $this->pull_multi("select * from daysoff where user_id ='$user_id' and removed = '0'");
		//$bushrs = $this->pull_multi("select * from bushours where user_id = '$user_id' and removed = '0'");
		$bushrs = DB::table('bushour')->where([['user_id', '=', $user_id],['removed', '=', '0']])->get();
		if (count ($bushrs) < 2){
			//$bushrs = DB::table('bushour')->where([['business', '=', $business],['removed', '=', '0']])->orderBy('user_id', 'ASC')->limit(7)->get();
			//$bushrs = $this->pull_multi("select * from bushours where business = '$_SESSION[business]' and removed = '0' order by inspector ASC limit 7"); //get the 7 records in bushours that have the lowest inspector id, this should be the first, admin user
		}
		//$blockouts = $this->pull_multi("select id from bookings where inspector = '$inspector' and removed = '0' and type = '1' and (endtime >= $proposed_starttime and starttime <= $ahead+$proposed_starttime) order by starttime asc");
		$z = get_field('users_details','zigzag',$user_id);		
		$zamount=0;
		if ($z==1) {
			$zamount = get_field('users_details','zzamount',$user_id);
		}

		//pull master bookings and loctime arrays
		//$multi = $this->pull_multi("select * from bookings where user_id = '$user_id' and removed = '0' and type = '0' and (endtime >= $proposed_starttime and endtime <= $ahead+$proposed_starttime) order by starttime asc");

		$multi = DB::table('bookings')->where([['user_id', '=', $user_id],['removed', '=', '0'],['type','=','0']])->where([['endtime', '>=', $proposed_starttime],['starttime','<=',$ahead + $proposed_starttime]])->orderBy('starttime', 'asc')->get();

		if ($allow_conflict == 1){
			$multi = array();   //if conflicts are allowed, then we empty the array of existing appointments so that the engine is blind to them and will re-offer a time slot that has already been booked
		}

		$blockouts = DB::table('bookings')->where([['user_id', '=', $user_id],['removed', '=', '0'],['type','=','1']])->where([['endtime', '>=', $proposed_starttime],['starttime','<=',$ahead + $proposed_starttime]])->orderBy('starttime', 'asc')->get();

		//$blockouts = $this->pull_multi("select * from bookings where inspector = '$inspector' and removed = '0' and type = '1' and (endtime >= $proposed_starttime and starttime <= $ahead+$proposed_starttime) order by starttime asc");

		$loctime = DB::table('location_time')->where([['business', '=', $business],['removed', '=', '0']])->orderBy('start', 'asc')->get();
		//$loctime = $this->pull_multi("select * from location_time where business = '$business' and removed='0' order by start asc");
		$l = '';
		if (is_array($loctime)){
			foreach ($loctime as $loc) {
				$l[$loc['start']][$loc['destination']] = $loc['time'];
				
			}
		}
		$loctime = $l;
		unset($l);
		
		$c = 0;  //day loop counter
		$incray = array();
		//create increment array
		$add_few_final = $days_forward - 3;
		while ($c < $days_forward){
			$thisday = date ("w", $proposed_starttime);
			if (($c > 12) && ($c < $add_few_final) && ($throttle == 1)){  // added April 2005 -- signiifcantly reduces load by knocking out 3 of 4 days after 12 days of showing all available, the < few final, makes it sure to show the farthest out 3 days so there are some slots showing at the farthest time out into the future  (3 covers weekends)
				//print $n % $throttle."  ";
				if (($c % 4) == 0){
					array_push($incray,$proposed_starttime);
				}
			} else {
				array_push($incray,$proposed_starttime);
			}
			$proposed_starttime = $proposed_starttime + $increment;
			$newday = date ("w", $proposed_starttime);
			if ($thisday != $newday){
				// its a new day!  increment the day counter so at some point this tireless loop will stop.
				$c++;
			}
		}

		$conflict="";
		$day ='';
		$i = 0;  //APPROVED loop counter, used for array index
		$s = array();
		foreach ($incray as $starttime){
			
			$endtime = $starttime + $proposed_size_duration;
			$start_minute = date ("G:i", $starttime);
			$end_minute = date ("G:i", $endtime);
			$startweek = ceil(date ("j", $starttime) / 7);// = 1.14 ceilings to 2 so this is the second thursday of the month
			$endweek = ceil(date ("j", $endtime) / 7);// = 1.14 ceilings to 2 so this is the second thursday of the month
			$startday = date ("w", $starttime); //= 4  0 is sunday so thursday is 4
			$endday = date ("w", $endtime); //= 4  0 is sunday so thursday is 4
			//$status = "day: $startday   week:$startweek time = $start_minute - $end_minute";	
			if ($startday!=$endday) {
				$buffer=2400;
			} else {
				$buffer=0;
			}
			
				//service type/age/size daily cap check
				if (is_array($daily_cap_block)){
					$day_of_year_number = date("z", $starttime);
					foreach ($daily_cap_block as $knock_this_day){
						if ($knock_this_day == $day_of_year_number){
							$conflict = "yes";
						}
					}
				}
			
			
				//daysoff check
				if (count($days_off_array)>0) {
				foreach ($days_off_array as $re){
					
					if (($re->day == $startday) and (is_numeric(strpos($re->weeks, $startweek))) || (($re->day == $endday) && (is_numeric(strpos($re->weeks, $endweek))))){  ///the value of startweek occurs ever in $re[week]))
						//ok, we have a conflict by day, now check the time (more efficient than checking the time on each one.
						$start_hour_minute = date ("Gi", $starttime);
						$end_hour_minute = (date ("Gi", $endtime))+$buffer;
						
						if(($start_hour_minute >= $re->endtime) || ($end_hour_minute <= $re->starttime)){
							//$status = "<font color=\"black\">Day:$startday   Week:$startweek $re[starttime]-$re[endtime]</font>";
							//echo "<!--&nbsp;&nbsp;&nbsp;$status: $start_hour_minute:$re[endtime]:$end_hour_minute:$re[starttime]<br>\n-->";
							//all clear
							
						} else {
							//$status = "<font color=\"red\">Day:$startday   Week:$startweek $re[starttime]-$re[endtime]</font>";
							//echo "<!--$status: $start_hour_minute:$re[endtime]:$end_hour_minute:$re[starttime]<br>\n-->";
							$conflict="yes";
							//conflict
							//$status = "Recurring kill";
							//$color = "red";
						}
						
					}
				}
				}
				//check business hours
				if (($conflict!="yes") and (count($bushrs)>0)) {
					foreach ($bushrs as $hr) {
						if (($hr->day == $startday) || ($hr->day == $endday)){
						//ok, we have a conflict by day, now check the time (more efficient than checking the time on each one.
						$start_hour_minute = date ("Gi", $starttime);
						$end_hour_minute = (date ("Gi", $endtime))+$buffer;
							if(($start_hour_minute >= $hr->starttime) and ($end_hour_minute <= $hr->endtime)){
								//$status = "<font color=\"black\">Day:$startday   Week:$startweek $re[starttime]-$re[endtime]</font>";
								//echo "&nbsp;&nbsp;&nbsp;$status: $start_hour_minute:$re[endtime]:$end_hour_minute:$re[starttime]<br>";
								//all clear
								//echo date("g:i a, l, F j", $starttime)."<br>";
							} else {
								//$status = "Business hour kill";
								//$status = "<font color=\"black\">Day:$startday   Week:$startweek $re[starttime]-$re[endtime]</font>";
								//echo "$status: $start_hour_minute:$re[endtime]:$end_hour_minute:$re[starttime]<br>";
								//conflict
								//$color = "red";
								$conflict="yes";
							}
						}
					}
				}
				
				if (($conflict!="yes") && isset($blockouts)) {

					foreach ($blockouts as $block) {

						if (($block->starttime <= $endtime and $block->endtime >= ($starttime+1)) or ($block->starttime>=$starttime and $block->endtime<=$endtime)) {
							$conflict = "yes";							
							//$status = "Blockout kill";
							//$start_hour_minute = date ("Gi", $starttime);
							//$end_hour_minute = (date ("Gi", $endtime))+$buffer;
							//$startday = date("D m/d", $starttime);
							//$status = "<br><font color=\"white\">Day: $startday </font>";
							//print "$status: ".date("m/d", $block[starttime])." -- ".date("m/d", $block[endtime]);
						} else {
							//$status = "<font color=\"black\">Day:$startday   Week:$startweek $block[starttime]-$block[endtime]</font>";
							//echo "&nbsp;&nbsp;&nbsp;$status: $start_hour_minute:$block[endtime]:$end_hour_minute:$block[starttime]:$inspector<br>";
							//echo date("g:i a, l, F j", $starttime)."<br>";
							//all clear
						}
					}
				}
				
				
				
				
			if ($conflict!="yes") {
				$s[] = $starttime;
				$i++;
			} else {
				/*$this_day = date ("F d Y", $starttime);
				$beginday = date ("l", $starttime);
				$endday = date ("l", $endtime);
				echo "<!--\t\t<font color = \"red\">$status $start_minute $beginday - $end_minute $endday $this_day</font><br>\n-->";
				$status = "";
				*/
			}
			
			
			$conflict="";
			

		}
		
		//******* now that we have an array of all valid working times to consider, let's compare it to real appointments that are in the db
		//*******
	/*	if ($_SESSION[business] == 126){
		echo "<!--";
		foreach ($s as $sss){
			print "$sss  ".date("m/d  H:i:s", $sss)."<br>";
		}
		//
		echo "-->";
		//
	}*/
		$previous_proposed_start = "";
		$html = "\n\t\t<select name=\"starttime\">";
		if (is_array($s)){
			//$proposed_appointment_start = "";
			//print "<!--$proposed_size_duration-->";
			foreach ($s as $proposed_appointment_start){  // for every potential valid time
				// we don't want to show every hour of the day, just 9, 12, 3, 6 etc -- so once we have printed a time out, we need to not check for the next 3 hours
				//yet, we don't want to skip ahead if it's a new day
				$newday = date("w", $proposed_appointment_start);
				if ($day!=$newday) {
					$time_forward=0;
					$previous_proposed_start = "";
				} 
				if ($previous_proposed_start != ""){
						$difference = ($proposed_appointment_start - $previous_proposed_start);  //if times weren't knocked out be daysoff or dailycaps, then this should equal the increment, otherwise it will be a number greater than the increment.
						$divisor = (($difference/$increment)-1);  //should equal 1 - 1 in most cases, but if time has been dropped for a day off, this is the number of increments (15 min) times the difference, so we time forward 6 or 9 or whatever.
						//print "<!-- difference = $difference divisor = $divisor\n -->";
						if ($divisor > 1){
							$time_forward = $time_forward - $divisor;
						}
						//print "<!--". date("g:i a, l, F j", $proposed_appointment_start)." and time forward = $time_forward last print $t-->\n";
				}		
				$previous_proposed_start = $proposed_appointment_start;
	
				if ($time_forward > 1){
						$time_forward--;
				} else {
					$proposed_appointment_endtime = (($proposed_appointment_start + $proposed_size_duration)-1);
					$t = date("g:i a, l, F j", $proposed_appointment_start);
					//print "<!-- $t -->\n";
					unset($nextprev);
					$nextprev = find_prev($proposed_appointment_start, $proposed_appointment_endtime, $multi);

					//********** this broke if there was booking inside a blockout, as find_prev only returned the appointment immediately before and immediately following
					//********** this was a great idea as it reduced the ammount of computation handed to bookings_check however, since it only looked one back
					//********** and one forward, it was blind to a larger, older blockout, that had a smaller newer booking inside of it
					//if($this->bookings_check ($proposed_appointment_start, $proposed_appointment_endtime, $nextprev)) {				
					if(bookings_check ($proposed_appointment_start, $proposed_appointment_endtime, $multi)) {
						//echo "&nbsp;&nbsp;&nbsp;$t:$newday:$day<br>";
						$check = check_loc_buffer($proposed_appointment_start, $proposed_appointment_endtime, $nextprev, $loctime, $location, $zamount);

						if ($business_wide == "1"){
							session(['business_wide_start.'.$proposed_appointment_start => $inspector]); //by using the starttime as the key, we automatically end up with unique openings
							//$_SESSION['business_wide_start'][$proposed_appointment_start] = $inspector; 
						}
						if ($show_endtimes == "1"){
							$book = (date("g:ia - ", $proposed_appointment_start).date("g:ia, ", ($proposed_appointment_endtime+3)).date("l, F j", $proposed_appointment_start));
						} else {
							$book = date("g:i a, l, F j", $proposed_appointment_start);
						}
						if ($check == TRUE) {
							//$html.= "\n\t\t\t<option value=\"$proposed_appointment_start\">".$book.$show_endtime."</option>";
							$html.= "\n\t\t\t<option value=\"$proposed_appointment_start\">".$book."</option>";
							$time_forward = (($proposed_size_duration)/$increment);
							$day = $newday;
							//echo "&nbsp;&nbsp;&nbsp;$book: $newday:$day<br>";
							//echo "true: $check<br>";
							//echo "true: $inspector: $book<br>";
						} elseif (is_int($check)) {
							//$html.= "\n\t\t\t<option value=\"$proposed_appointment_start\">".$book.$show_endtime."</option>";
							$html.= "\n\t\t\t<option value=\"$proposed_appointment_start\">".$book."</option>";
							$time_forward = (($check + $proposed_size_duration)/$increment); 
							$day = $newday;
							//echo "is_int: $check<br>";
							//echo "is_int: $inspector: $book<br>";
						}
						/*
						else {
						//echo "nothing: $check<br>";
						//echo "false: $inspector: $t<br>";
						if ($check==FALSE){
							//echo "false<br>";
						}
						}
						*/
						
					}
					
					//echo "attempt: $inspector: $t<br>";
				}
			}
			$previous_proposed_start = $proposed_appointment_start;
		} else {
			$html .= "\n\t\t\t<option value=\"\">No openings within $days_forward days</option>";
		}
		$html .="\n\t\t</select>\n";
		return $html;
	}
}

if(! function_exists('find_prev')){
	function find_prev ($starttime,$endtime, $array) {  //depreciated as it was blind to small appoitments inside of larger blockouts
		$np = array();
		$prev = '';
		if (count($array)!=0) {
			foreach ($array as $ar) {
				//if ($endtime > $ar[starttime]) {  //untested
				if ($starttime > $ar->starttime) {
					$prev=$ar;
					/*if ($_SESSION[business] == 8){
						echo "<!-- $ar[id] starttime is less than the proposed starttime-->\n\n";
					}*/
					//cool
				} else {
					$np[0]=$prev;
					$np[1]=$ar;
					/*if ($_SESSION[business] == 8){
						echo "<!--\n\nreturning $prev[id] as the previous\nreturning $ar[id] as the next\n\n-->";
					}*/
					//echo "&nbsp;&nbsp;&nbsp;$prev[starttime]:$ar[starttime]";
					return $np;
				}
			}
		}
		$np[0]=$prev;
		return $np;
	}
}

if(! function_exists('bookings_check')){
	function bookings_check ($starttime, $endtime, $multi) {
		if (count($multi)==0) {
			/*if ($_SESSION[business] == 8){
			echo "<!-- returned true because of no bookings in the $multi array-->";
			}*/
			return true;
		}
				

		foreach ($multi as $array) {
			//if(is_array($array)) {
				/*if ($_SESSION[business] == 8){
					echo "<!--\n";
					echo "Proposed start ".date("g:i a, l, F j, Y", $starttime)." with id $array[id] start ".date("g:i a, l, F j, Y", $array[starttime])."\n";
					echo "Proposed end ".date("g:i a, l, F j, Y", $endtime)." with id $array[id] end ".date("g:i a, l, F j, Y", $array[endtime])."\n";
					//echo "$array[starttime] <= $endtime and $array[endtime] >= ($starttime+1)) or ($array[starttime]>=$starttime and $array[endtime]<=$endtime)\n";
					//echo "array[starttime] <= endtime and array[endtime] >= (starttime+1)) or (array[starttime]>=starttime and array[endtime]<=endtime)";
					//print_r($array);
					echo "-->\n\n";
				}*/
				//echo "<br>Time:".date("g:i a, l, F j, Y", $array[starttime]).":$array[starttime]:$starttime";
				if (($array->starttime <= $endtime and $array->endtime >= ($starttime+1)) or ($array->starttime>=$starttime and $array->endtime<=$endtime)) {
					//print "<!-- conflict on $array[id] Proposed start ".date("g:i a, l, F j, Y", $starttime)."\n-->";
					return false;
				}
			//}
		}
		return true;
	}
}

if(! function_exists('verify_time')){
	function verify_time ($starttime, $endtime, $inspector) {
		//mail("peter@advanced-design.com", "Scheduleze Verify Time inputs", "Starttime = $starttime\nEndtime = $endtime\nInspector = $inspector", "From: info@scheduleze.com\n");
		$row = DB::table('bookings')->where([['starttime', '<=', $endtime],['endtime', '>=', $starttime+1]])->orWhere([['starttime', '>=', $starttime],['endtime', '<=', $endtime]])->where([['user_id', '=', $inspector],['removed', '=', 0]])->orderBy('starttime', 'asc')->first();

		if(empty($row) && $row == null){
			$num = '';
		}else{
			$num = 1;
		}

		//$row = "select * from bookings where ((starttime <= $endtime and endtime >= ($starttime+1)) or (starttime>=$starttime and endtime<=$endtime)) and inspector=$inspector and removed='0' order by starttime asc limit 1";
		//$row = $this->pull_assoc($sql);
		//$num = $this->num_rows(); //echo "**$num<br>";
		
		$allow_conflict = get_field("users_details", "allow_conflict", $inspector);
		if ($allow_conflict == "1"){
			$num = "";  //destroy any sql discovered conflicts
		}		
		//if we didn't get valid values, then fail to verify
		/*if ($inspector < 10){
			$num = 1;
		}*/
		
		if ($endtime < 100){
			$num = 1;
		}
		
		if ($starttime < 100){
			$num = 1;
		}

		$rowendtime = !empty($row->endtime) ? $row->endtime : '';
		$rowstarttime = !empty($row->starttime) ? $row->starttime : '';
		
		
		if (($num == "") || ($rowendtime < $rowstarttime)) // if the endtime is less than the starttime then we have a reverse booking that is likely an accidental edit action on the part of the user, so proceed anyway.
		{
			return TRUE;
		} else {
			return FALSE; 
		}
	}
}

if(! function_exists('check_loc_buffer')){
	function check_loc_buffer($start, $end, $np, $loctime, $location, $zamount='0') {
		$buffer=0;
		//dd($np);
		$next = array();

		if(!empty($np)){
			/**********check prev***********/
			if (!is_array($np[0])) {
				//echo "No array: <br>";
			} else {
				$prev=$np[0];
				if ($prev['type']!=1) {
					//compute time buffer
					//get time from loctime array where start=prev[location] and destination=proposed_location
					$buffer = $loctime[$prev['location']][$location];
					if ($zamount>0) {
						if ($buffer>=$zamount) {
							$buffer = $buffer*2;
						}
					}
					if (($buffer) > (abs($prev['endtime']-$start+1))) {
						//echo "<br>here(prev):$prev[location]:$location:$buffer<br><br>";
						//$day = date("g:i a, l, F j", $start);
						
						return false;
					}
				}
			}

			$buffer=0;
			
			if (array_key_exists("1",$np)){
				if (!is_array($np[1])) {
					//echo "No array:end: $next[id]<br>";
					return true;
				} else {
					$next = $np[1];
				}
			}else{
				return true;
			}
		}
		if(!empty($next)){
			if ($next['type']==1) {
				//echo "Blockout:end: $next[id]<br>";
				return true;
			}
			//compute time buffer
			$buffer = $loctime[$location][$next['location']];
			//echo "<br>next:$buffer:$location:$next[location]";
			if (($buffer) > (abs($next['starttime']-$end-1))) {
				//echo "<br>here:$buffer";
				//$day = date("g:i a, l, F j", $start);
				return false; 
			} elseif (($buffer)==(abs($next['starttime']-$end-1))) {
				//echo "End:space:$next[inspector]: $next[id]<br>";
				return $buffer;
			} else {
				//echo "Passed all:$next[id]<br>";
				return true;
			}
		}
		return false;
	}
}

if(! function_exists('get_day_name')){
	function get_day_name ($weekday) {
		if ($weekday==0) {
			$dy = "Sunday";
		} elseif ($weekday==1) {
			$dy = "Monday";
		} elseif ($weekday==2) {
			$dy = "Tuesday";
		} elseif ($weekday==3) {
			$dy = "Wednesday";
		} elseif ($weekday==4) {
			$dy = "Thursday";
		} elseif ($weekday==5) {
			$dy = "Friday";
		} elseif ($weekday==6) {
			$dy = "Saturday";
		}
		return $dy;
	}
}

if(! function_exists('day_of_week_popup')){
	function day_of_week_popup ($weekday, $designate) {
		if (strlen($designate)>0) {
			$var = "weekday[".$designate."]";
		} else {
			$var = "weekday";
		}
		$popup = "<select name=\"$var\" class=\"smallselect\">\n";
		$popup .= "<option value=\"-1\">None</option>\n";
		$popup .= "<option value=\"0\">Sunday</option>\n";
		$popup .= "<option value=\"1\">Monday</option>\n";
		$popup .= "<option value=\"2\">Tuesday</option>\n";
		$popup .= "<option value=\"3\">Wednesday</option>\n";
		$popup .= "<option value=\"4\">Thursday</option>\n";
		$popup .= "<option value=\"5\">Friday</option>\n"; 
		$popup .= "<option value=\"6\">Saturday</option>\n";
		$popup .= "</select>\n";
		if (strlen($weekday)>0) {
			$popup = str_replace("$weekday\">","$weekday\" selected>",$popup);
		}
		
		return $popup;
	}
}

if(! function_exists('get_time_popup')){
	function get_time_popup ($time, $designate="", $year="", $month="", $day="", $minute="", $hour="", $am="", $session) {
		if ($time != 0){
			//$time = ($time + $GLOBALS[timezone]);
			// apply GLOBAL timezone on the output side, not the input side
		}
		$popups = '';
		$hr = '';
		if ($hour==1) {
			if ($time!=0) {
				$hr = date("g", $time);
			}
			$popups = hour_popup($hr, $designate, $session);
		}
		$min = '';
		if ($minute==1) {
			if ($time!=0) {
				$min = date("i", $time);
			}
			$popups .= minute_popup($min, $designate, $session);
		}
		$ampm = '';
		if ($am==1) {
			if ($time!=0) {
				$ampm = date("A", $time);
			}
			$popups .= am_popup($ampm, $designate, $session);
		}
		$month_num = '';
		$month_name = '';
		if ($month==1) {
			if ($time!=0) {	
				$month_num=date("m", $time);
				$month_name=date("M", $time);
			}
			$popups .= month_popup($month_num, $month_name, $designate, $session);
		}
		$day_num = '';
		if ($day==1) {
			if ($time!=0) {
				$day_num = date("j", $time);
			}
			$popups .= day_num_popup($day_num, $designate, $session);
		}
		$year_num = '';
		if ($year==1) {
			if ($time!=0) {
				$year_num = date("y", $time);
			}
			$popups .= year_popup($year_num, $designate, $session);
		}
		return $popups;
	}
}

if(! function_exists('year_popup')){
	function year_popup($year_num, $designate, $session){
		$popup ="\t\t\t\t<select name=\"year".$session."[".$designate."]\" class=\"smallselect\">\n";
		$start_year = (date("Y") - 10);
		$c = 0;
		while ($c <= 11){
			$this_year = $start_year + $c;
			$lean_date = substr($this_year, -2, 2);
			if ($year_num == $lean_date){
				$selected = " selected";
			} else {
				$selected = "";
			}
			$popup .="\t\t\t\t	<option value=\"$lean_date\"$selected>$lean_date</option>\n";
			$c++;
		}
		$popup .="\t\t\t\t</select>\n";
		return $popup;
	}
}

if(! function_exists('day_num_popup')){
	function day_num_popup ($day_num, $designate, $session) {
		$popup = "<select name=\"day".$session."[".$designate."]\" class=\"smallselect\">\n";
		for ($i=0; $i < 31; $i++) {
			if($i == $day_num){
				$selected = 'selected';
			}else{
				$selected = '';
			}
			$popup .= "<option value=\"$i\" $selected>$i</option>\n";
		}
		$popup .= "</select>\n"; 
		return $popup;		
	}
}

if(! function_exists('month_popup')){
	function month_popup ($month_num, $month_name, $designate, $session) {
			if (strlen($month_name)<2){
				$month_name = "Pick";
			}
		$popup = '';
		$popup .="\t\t\t\t<select name=\"month".$session."[".$designate."]\" class=\"smallselect\">\n";
		$popup .="\t\t\t\t	<option value=\"$month_num\" selected>$month_name</option>\n";
		$popup .="\t\t\t\t	<option value=\"01\">Jan</option>\n";
		$popup .="\t\t\t\t	<option value=\"02\">Feb</option>\n";
		$popup .="\t\t\t\t	<option value=\"03\">Mar</option>\n";
		$popup .="\t\t\t\t	<option value=\"04\">Apr</option>\n";
		$popup .="\t\t\t\t	<option value=\"05\">May</option>\n";
		$popup .="\t\t\t\t	<option value=\"06\">June</option>\n";
		$popup .="\t\t\t\t	<option value=\"07\">July</option>\n";
		$popup .="\t\t\t\t	<option value=\"08\">Aug</option>\n";
		$popup .="\t\t\t\t	<option value=\"09\">Sep</option>\n";
		$popup .="\t\t\t\t	<option value=\"10\">Oct</option>\n";
		$popup .="\t\t\t\t	<option value=\"11\">Nov</option>\n";
		$popup .="\t\t\t\t	<option value=\"12\">Dec</option>\n";
		$popup .="\t\t\t\t</select>\n";
		return $popup;
	}
}

if(! function_exists('am_popup')){
	function am_popup($am, $designate, $session) {
		$popup ="\t\t\t\t<select name=\"am".$session."[".$designate."]\" class=\"smallselect\">\n";
		$popup .="\t\t\t\t	<option value=\"$am\" selected>$am</option>\n";
		$popup .="\t\t\t\t	<option value=\"AM\">AM</option>\n";
		$popup .="\t\t\t\t	<option value=\"PM\">PM</option>\n";
		$popup .="\t\t\t\t</select>\n";
		return $popup;
	}
}

if(! function_exists('PanelTemplate')){
	function PanelTemplate($id) {
		$template = DB::table('panel_template')->where('user_id',$id)->first();
	    return $template;
	}
}

if(! function_exists('array_flatten')){
	function array_flatten($array) { 
		if (!is_array($array)) { 
			return FALSE; 
		} 
		$result = array(); 
		foreach ($array as $key => $value) { 
			if (is_array($value)) { 
		  		$result = array_merge($result, array_flatten($value)); 
			} 
			else { 
			  $result[$key] = $value; 
			}
		}
		return $result; 
	}
}

if(! function_exists('get_timezone')){
	function get_timezone($business = '0'){
		$business = $business == 0 ? session('business_id') : '';
		/*if ($business == 0){
			$business = session('business_id');
		}*/
		if(!empty($business)){
			$timezone = get_field("business", "timezone", $business);
		}

		return !empty($timezone) ? $timezone : '';
	}
}

if(! function_exists('display_for_edit')){
	function display_for_edit($id, $first, $last, $order='type', $inc='') {
		//get current time
		$last_end_day = '';
		$now = time();
		if ($order == "type"){
			$order = "type";
			$incdec = "asc";
		} else {
			$order = "id";
			$incdec = "desc";
		}

		$whereArr = array();

		if ( $inc == "block" && $first == "") {

			$whereArr = [['endtime', '>', $now], ['user_id', '=', $id], ['type', '=', 1], ['removed', '=', 0]];

		} 
		elseif($inc == "block" && !empty($first))
		{

			$whereArr = [['endtime', '>', $first], ['starttime', '<', $last], ['user_id', '=', $id], ['type', '=', 1], ['removed', '=', 0]];

		}
		elseif ( $inc=="book" && $first == "" ) {
			
			$whereArr = [['endtime', '>', $now], ['user_id', '=', $id], ['type', '=', 0], ['removed', '=', 0]];

		}
		elseif($inc == "book" && !empty($first))
		{

			$whereArr = [['endtime', '>', $first], ['starttime', '<', $last], ['user_id', '=', $id], ['type', '=', 0], ['removed', '=', 0]];

		}
		elseif($inc == "" && !empty($first))
		{

			$whereArr = [['endtime', '>', $first], ['starttime', '<', $last], ['user_id', '=', $id], ['removed', '=', 0]];

		}
		else {
			
			$whereArr = [['endtime', '>', $now], ['user_id', '=', $id], ['removed', '=', 0]];

		}

		$tt = DB::table('bookings')->where($whereArr)->orderBy($order, $incdec)->get();

		/*if (($first=="")) {
			
			$tt = DB::table('bookings')->where($whereArr)->orderBy($order, $incdec)->get();
		} else {

			$tt = DB::table('bookings')->where([['endtime', '>', $first],['starttime', '<', $last],['user_id', '=', $id],$inc,['removed', '=', 0]])->orderBy('starttime', 'asc')->get();
		}*/
		
		//
		/*$tt = $this->pull_multi($sql);*/
		$html = "<tr class=\"dark-table-heading\"><td bgcolor=\"F0F0F0\" class=\"display\"><b>Start &amp; End</b></td>\n
		<td bgcolor=\"F0F0F0\" class=\"display\"><b><!--<a href=\"index.php?action=blockouts&track=2&order=type&first=$first&last=$last&inspector=$id\"> Inspection-->Address</b></td>\n
			<td bgcolor=\"F0F0F0\" class=\"display\"><b>Agent/Notes</b></td>\n
			<td bgcolor=\"F0F0F0\" class=\"display\"><b>Price</b></td>\n
			<td bgcolor=\"F0F0F0\" class=\"display\"><b>Client/Type</b></td>\n
			<td bgcolor=\"F0F0F0\" class=\"display\"><b>Numbers</b></td>\n
			<td bgcolor=\"F0F0F0\" class=\"display\"><b>&nbsp;</b></td>\n";

		$h=0;
		//loop to create the display
		if (count($tt)>0) {
			foreach ($tt as $row) {
				$h++;
				if (($h%2)==0){
					$bgcolor="F0F0F0";
				} else {
					$bgcolor="FAFAFA";
				}
				
				// format the building type:
				$siz = get_full_description($row->building_type, $row->building_size, $row->building_age);				
				//format the times
				$start = date("g:ia", $row->starttime-1);
				$start_day = date(" D, M j", $row->starttime-1);
				$end = date("g:ia", $row->endtime+1);
				$end_day = date(" D, M j", $row->endtime+1);
				$this_end_day = date("j", $row->endtime+1);
				if ($last_end_day != $this_end_day){
					$full_day_label = date("l, F jS", $row->endtime);
					$start_of_day = get_todays_starttime($row->endtime);
					$html .= "
					<tr>
						<td colspan = \"7\" bgcolor=\"#FFCD49\"><b>".$full_day_label."</b>&nbsp;&nbsp;";
					$url = "https://needsecured.com/developer/scheduleze/public/scheduleze/dayticket/$row->user_id/1/$start_of_day";
					$html .= '<a href="'.$url.'" target="_blank" class="note">Print Day Ticket &#187;</a></td>
					</tr>';
					
				}

				
				if ($end_day == $start_day) {
					$hora = "<nobr>".$start." - ".$end."</nobr><br>".$start_day."<br><br>";
				} else {
					$hora = "<nobr>".$start."".$start_day."</nobr><br>".$end." ".$end_day."<br><br>";
				}
				
				if ($row->type !=1){
					$price = ("$".$row->price);
				} else {
					$price = "";
				}
				//create html
				$html .= "<tr>\n";
				$html .= "<td bgcolor=\"#$bgcolor\" class=\"display\">$hora</td>\n";
				if ($row->type == 1) {
					$notes = $row->notes;
					$html .= "<td bgcolor=\"#$bgcolor\" class=\"display\">Blockout</td>\n";
					$html .= "<td bgcolor=\"#$bgcolor\" class=\"display\">$notes</td>\n";

					$html .= "<td bgcolor=\"#$bgcolor\" class=\"display\">--</td>\n";
					$html .= "<td bgcolor=\"#$bgcolor\" class=\"display\"><nobr>--</nobr><br></td>\n";
					$html .= "<td bgcolor=\"#$bgcolor\" class=\"display\"><nobr>--</nobr><br><nobr></nobr></td>\n";

					$client_name = '';
					$dayphone = '';
					$homephone = '';
					$user_id = $row->user_id;
					$blockout_id = $row->id;
				} else {
					$location = $row->location;
					$inspection_address = $row->inspection_address;
					$user_notes = $row->user_notes;
					$notes = $row->notes;
					$agent_email = $row->agent_email;
					$agent_name = $row->agent_name;
					$agent_phone = $row->agent_phone;
					$email = $row->email;
					$firstname = $row->firstname;
					$lastname = $row->lastname;
					$id = $row->id;
					$user_id = $row->user_id;
					$homephone = $row->homephone;
					$dayphone = $row->dayphone;

					//$city = $this->get_field("location", "name", "$location");

					$city = DB::table('locations')->select('name')->where([['id', '=', $location],['removed', '=', 0]])->first();
					$html .= "<td bgcolor=\"#$bgcolor\" class=\"display\">$inspection_address<br>$city->name</td>\n";
					if ($user_notes !=""){ $user_notes = "<br>$user_notes"; }
					if ($notes !=""){ $user_notes .= "<br><b>$notes</b>"; }
					if($agent_email!=""){
						$agent_name = "<a href=\"mailto:$agent_email\" class=\"note_link\">$agent_name</a>";
					} else {
						$agent_name = $agent_name;
					}
					
					$html .= "<td bgcolor=\"#$bgcolor\" class=\"display\">$agent_name  $agent_phone $user_notes</td>\n";
				
					if(isset($email)){
						$client_name = "<a href=\"mailto:$email\" class=\"note_link\">$firstname $lastname</a>";
					} else {
						$client_name = $firstname." ".$lastname;
					}

					$html .= "<td bgcolor=\"#$bgcolor\" class=\"display\">$price</td>\n";
					$html .= "<td bgcolor=\"#$bgcolor\" class=\"display\"><nobr>$client_name</nobr><br>$siz</td>\n";
					$html .= "<td bgcolor=\"#$bgcolor\" class=\"display\"><nobr>$dayphone</nobr><br><nobr>$homephone</nobr></td>\n";
				}

				if ($row->type == "1"){
					//$url ='/scheduleze/blockout/EditBlockout/'.$blockout_id;
					$url ='/developer/scheduleze/public/scheduleze/blockout/EditBlockout/'.$blockout_id;
					$html .= "<td bgcolor=\"#$bgcolor\" class=\"display\"><nobr><a href=\"$url\" class=\"note_link\">Edit</a><span class\"note\">  </span><a href=\"delete/$blockout_id\"  class=\"note_link\">Remove</a></nobr></td>\n";
				} else {
					//$url = "https://needsecured.com/developer/scheduleze/public/scheduleze/booking/edit/$id";
					$html .= "<td bgcolor=\"#$bgcolor\" class=\"display\"><nobr><a href=\"form/edit/$id\" class=\"note_link\">Edit</a><span class\"note\">  </span><a href=\"delete/$id\"  class=\"note_link\">Remove</a></nobr></td>\n";
				}
				$html .= "</tr>\n";
				$last_end_day = date("j", $row->endtime);
				
			}
		}else{
			$html = '<tr><td class="display" style="text-align: center;">No Results Found</td>';
		}
		
		return $html;
	}
}

if(! function_exists('make_day_blocks')){
	function make_day_blocks ($start, $stop){
		$beginning = get_todays_starttime($start);
		$nextday = $beginning;
		while ($beginning < $stop){
			$end = $beginning + 86400;
			$day_edges[$beginning] = $end;
			$beginning = $beginning + 86400;
			if ($c > 60){
				break;
			}
			$c++;
		}
		return $day_edges;
	}
}

if(! function_exists('get_pricing_popup')){
	function get_pricing_popup($business, $table, $variable='', $class='', $default_override='') {
		if ($variable == ""){
			$variable = $table;
		}
		//$sql = "select * from $table where business = '$business' and removed = '0' order by rank ASC";

		$temp = DB::table($table)->where([['business', '=', $business],['removed', '=', 0]])->orderBy('rank','ASC')->get();
		//$temp = $this->pull_multi($sql);
		if (count($temp) > 0){
			if (count($temp) == "1") {
				session([$variable => $temp[0]->id]);
			}
			$html_parts = '';

			foreach ($temp as $row) {
				//$arrayName[] = $row->name;
				if (!is_numeric($default_override)){
					if ($row->selected == 1){ $selected = " selected"; } else { $selected = ""; }
				} else {
					if ($default_override == $row->id){ $selected = " selected"; } else { $selected = ""; }
				}
				
				$html_parts .= "\n\t\t\t\t<option value=\"\"$selected>$row->name</option>";
			}
			//return $arrayName;
			$html = "\n\t\t\t<select name=\"$variable\" class=\"$class\" required>";
			$html .= "\n\t\t\t<option value=\"0\">--Select--</option>";
			$html .= $html_parts;
			$html .= "\n\t\t\t</select>";
			return ($html);
		} else {
			return false;
		}
	}
}

if(! function_exists('get_location_popup')){
	function get_location_popup($default_id='', $class='small_select') {
		$rows = DB::table('locations')->where([['business', '=', session('business_id')],['removed', '=', 0]])->orderBy('name','ASC')->get();
		if (count($rows) > 0) {
			if (count($rows) == "1") {
				session(['location' => $rows[0]->id]);
				//$_SESSION[location] = $rows[0][id];
			}
			$html = "\n\t\t\t<select name=\"location\" class=\"$class\">";
				foreach ($rows as $row) {
					if ($row->id == $default_id){ $selected = "selected"; } else { $selected = ""; }
					$html .= "\n\t\t\t\t<option value=\"$row->id\"$selected>$row->name</option>";
				}
			$html .= "\n\t\t\t</select>";
			return ($html);
		} else {
			return false;
		}
	}
}

if(! function_exists('check_permission')){
	function check_permission($id) {  //assess inspector id relationships, NOT bookings or block ids etc.
		if (!is_numeric($id)){
			return true;
		}
		if($id == session('id')) {
			return true;
		} elseif(session('permission') != '1') { //everyone who passes this point is a master, now just check which business
			session(['warning' => "You do not have permission for this right now."]);
			auth()->logout();
			/*$this->logout_user();
			header("Location: index.php");
			exit();*/
		}
		$business_id = get_field("users_details", "business", $id);//get business of person in questio
		$my_business_id = get_field("users_details", "business", session('id'));
		if(($business_id == $my_business_id) && (session('permission') == 1)) {
			return true;
		} else {
			session(['warning' => "You do not have permission for this right now."]);
			auth()->logout();
			/*$this->logout_user();
			header("Location: index.php");
			exit();*/
		}
	}
}

if(! function_exists('display_dayticket')){
	function display_dayticket ($userid, $first='', $days='') {
			
		if (session('permission') != "1"){
			auth()->logout();
		}
		
		if (!is_numeric($userid)){
			if (is_numeric(session('affected_inspector'))){
				$userid = session('affected_inspector');
			} else {
				$userid = session('id');
			}
		}
		
		check_permission($userid);
		
		$this_business = get_field("users_details", "business", $userid);
		
		$show_email = get_field("business", "print_ticket_email", $this_business);
		
		//get current time
		/*if ($order == "type"){
			$order = "type";
			$incdec = "asc";
		} else {
			$order = "";
			$incdec = "desc";
		}
		
		if ($inc=="block") {
			$inc = " and type='1'";
		} elseif ($inc=="book") {
			$inc = " and type='0'";
		} else {
			$inc="";
		}*/
		
		$now = time();
		
		if ($first=="" || (!is_numeric($first))) {
			if (is_numeric(session('first_time'))){
				$first = session('first_time'); //use the value from the popup
			} else {
				$first = get_todays_starttime($now);
				session(['first_time' => $first]);
			}
		}
		
		if ($days == "" || (!is_numeric($days))){
			if (is_numeric(session('last_time'))){
				$last = session('last_time'); //use the value from the popup
			} else {
				$last = ($now + (7 * 86400));
				session(['last_time' => $last]);
			}
		} else {
			$last = ($first + ($days * 86400));
		}
		
		$first = $first - 1;
		$tt = DB::table('bookings')->where([['starttime', '>', $first],['starttime', '<', $last],['user_id', '=', $userid],['removed', '=', 0]])->orderBy('type', 'ASC')->orderBy('starttime', 'ASC')->get();
			
		//$sql = "select * from bookings where starttime > '$first' and starttime < '$last' and inspector = '$inspector'".$inc." and removed = '0' order by $order starttime asc";
		
		//echo $sql;
		
		//$this->peek_array($_SESSION);
		
		//$tt = $this->pull_multi($sql);
		$html = '';
		//loop to create the display
		if (count($tt)>0) {  //ok, we have a real array
		$html = "<table width=\"100%\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">\n";
		//$inspector_name = $this->get_field("users_details", "name", "$row[inspector]");
		$bgcolor = "FFFFFF";
			$bookings_total_count = 0;
			$total_earnings = 0;
			foreach ($tt as $row) {
				//$h++;

				if($row->location != 0)
					$city = get_field("locations", "name", $row->location);

				// format the building type:
				//format the times
				$start = date("g:ia", $row->starttime - 1);
				$start_day = date(" D, M j", $row->starttime - 1);
				$end = date("g:ia", $row->endtime + 1);
				$end_day = date(" D, M j", $row->endtime + 1);
				$this_end_day = date("j", $row->endtime + 1);
				$last_end_day = '';
				if ($last_end_day != $this_end_day){
					if ($start_day != $this_end_day){
						$add_end_time = date("l, F jS", $row->starttime + 1)." - ";
					} else {
						$add_end_time = "";
					}
					$full_day_label = $add_end_time.date("l, F jS", $row->endtime);
					$inspector_name = get_field('users_details', 'name', $userid);
					$inspector_lastname = get_field('users_details', 'lastname', $userid);
					$html .= "
					<tr>
						<td colspan=\"4\" bgcolor=\"black\"><span class=\"whitehead\">$full_day_label</span></td>
						<td bgcolor=\"black\"><span class=\"whitehead\">$inspector_name $inspector_lastname</span></td>
					</tr>\n";
				}
	
				
				//if ("$end_day"=="$start_day") {
					$hora = "<nobr><b>$start</b> - $end</nobr><span class=\"note\"><br>Appointment #$row->id</span>";
				//}
				
				if ($row->type == "1"){
					$html .= "
					<tr>
						<td colspan=\"2\" valign=\"top\" bgcolor=\"#cccccc\"><nobr><b>$start</b> - $end</nobr></td>
						<td valign=\"top\" bgcolor=\"#cccccc\">Blockout</td>
						<td colspan=\"2\" valign=\"top\" bgcolor=\"#cccccc\"><span class=\"note\">$row->notes</span></td>
					</tr>\n";
				} else {
					if ($show_email == "1"){
						$agent_email = $row->agent_email;
						$client_email = $row->email;
					}else{
						$agent_email = '';
						$client_email = '';
					}
					$bookings_total_count ++;
					if ($row->price != ""){ $price = "$".$row->price.""; $total_earnings = ($total_earnings + $row->price); }
					if ($row->user_notes !=""){ $row->user_notes = "<b>Note:</b> ".$row->user_notes."<br>"; }
					if ($row->notes !=""){ $row->notes = "<b>Memo:</b> ".$row->notes.""; }
					if ($row->entry_method !=""){ $row->entry_method = "<b>Entry:</b> ".$row->entry_method."<br>"; }
					if ($row->mls !=""){ $row->mls = "<br>MLS: ".$row->mls.""; }
					if ($row->agent_name!=""){ $agent_info = "<br><b>Agent: ".$row->agent_name."</b>";} else { $agent_info = ""; }
					if ($row->agent_phone!=""){ $agent_info .= "<br>".$row->agent_phone."";}
					if ($agent_email != "") { $agent_info .= " ".$agent_email; }
					if($row->listing_agent!=""){ $agent_info .= "<br><b>Listing: ".$row->listing_agent."</b>";}
					if($row->listing_phone!=""){ $agent_info .= "<br>".$row->listing_phone;}
					if($row->firstname != "" || $row->lastname != ""){ $client_info = "<b>".$row->firstname." ".$row->lastname."</b>"; } else { $client_info = ""; }
					if($row->dayphone != ""  || $row->homephone != ""){ $email_addon = "<br>"; $client_info .= "<br>".$row->dayphone." ".$row->homephone.""; }
					if ($client_email != "") { $client_info .= $email_addon.$client_email; }
					$siz = get_full_description($row->building_type, $row->building_size, $row->building_age);
					$addons = get_addon_information($row->id);

					//create html
					$html .= "<tr>\n";
					$html .= "<td bgcolor=\"#$bgcolor\" valign=\"top\">$hora</td>\n";
					$html .= "<td bgcolor=\"#$bgcolor\" align=\"right\" valign=\"top\">$price</td>\n";
					$html .= "<td bgcolor=\"#$bgcolor\" valign=\"top\">$row->inspection_address, $city<br>$siz<span class=\"note\">".$addons['services']."</span></td>\n";
					$html .= "<td bgcolor=\"#$bgcolor\" valign=\"top\"><span class=\"note\">$row->entry_method $row->user_notes $row->notes</span></td>\n";
					$html .= "<td bgcolor=\"#$bgcolor\" valign=\"top\"><span class=\"note\"><nobr>$client_info</nobr>$agent_info $row->mls</span></td>\n";
					$html .= "</tr>\n";
				}
				$last_end_day = date("j", $row->endtime + 1);
			}
			$timezone = get_field('business', 'timezone', $row->business);
			$generated_date = date ("g:ia l, F jS",($now + $timezone));
			$total_earnings = number_format($total_earnings);
			$bookings_name = '';
			if ($bookings_total_count > 1){
				//$bookings_name = "Bookings";
			} else {
				//$bookings_name = "Booking";
			}
			$html .= "
			<tr>
				<td valign=\"top\" bgcolor=\"$bgcolor\">$bookings_total_count $bookings_name Total</td>
				<td valign=\"top\" align=\"right\" bgcolor=\"$bgcolor\">$".$total_earnings."</td>
				<td colspan=\"3\" align=\"right\" valign=\"bottom\" bgcolor=\"$bgcolor\"><span class=\"note\">Generated at $generated_date by Scheduleze.com</span></td>
			</tr>\n";
			$html .= " ";
		}
		
		return $html;
	}
}

if(! function_exists('display_master_ticket')){
	function display_master_ticket ($first='', $days='') {
				
			if (session('permission') != "1"){
				auth()->logout();
			}
			
			/* this isn't currently being used, but might be useful // controls whether blockouts show on the ticket or not -- for now they show because the master inspector probably wants to know his people are doing in that day
			if ($inc=="block") {
				$inc = " and type='1'";
			} elseif ($inc=="book") {
				$inc = " and type='0'";
			} else {
				$inc="";
			}
			*/
			
			$now = time();
			
			if ($first=="" || (!is_numeric($first))) {
				if (is_numeric(session('first_time'))){
					$first = session('first_time'); //use the value from the popup
				} else {
					$tomorrow = $now + (8 * 3600);  //fast forward the starttime 8 hours so that a check at the end of the day yields tomorrows tickets, not today's (which are old hat)
					$first = get_todays_starttime($tomorrow);
					session(['first_time' => $first]);
				}
			}
			
			
			if ($days == "" || (!is_numeric($days))){
				if (is_numeric(session('last_time'))){
					$last = session('last_time'); //use the value from the popup
				} else {
					$last = ($now + (7 * 86400));
				}
			} else {
				$last = ($first + ($days * 86400));
				session(['last_time' => $last]);
			}
	
			$days_as_blocks = make_day_blocks($first, $last);
	
			$show_email = get_field("business", "print_ticket_email", session('business_id'));
	
			foreach ($days_as_blocks as $day_start => $day_end){
				
				$first = $day_start;
				$last = $day_end;
			
				$first = $first - 1;
				$tt = DB::table('bookings')->where([['starttime', '>', $first],['starttime', '<', $last],['business', '=', session('business_id')],['removed','=',0]])->orderBy('inspector','ASC')->orderBy('starttime','ASC')->get();
				//$sql = "select * from bookings where starttime > '$first' and starttime < '$last' and business = '$_SESSION[business]'".$inc." and removed = '0' order by inspector asc, starttime asc";
			
				//echo $sql;
				
				//$tt = $this->pull_multi($sql);
				
				//loop to create the display
				if (count($tt)>0) {  //ok, we have a real array
				$html = "\t<table width=\"720\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">\n";
				//$inspector_name = get_field("users_details", "name", $row->user_id);
				$bgcolor = "FFFFFF";
					foreach ($tt as $row) {
						$h++;
						$city = get_field("location", "name", "$row->location");
						// format the building type:
						//format the times
						$start = date("g:ia", $row->starttime - 1);
						$start_day = date(" D, M j", $row->starttime - 1);
						$end = date("g:ia", $row->endtime + 1);
						$end_day = date(" D, M j", $row->endtime + 1);
						$this_end_day = date("j", $row->endtime + 1);
						if ($last_end_day != "$this_end_day" || $this_inspector != $row->user_id){
							if ($start_day != $this_end_day){
								$add_end_time = " - ".date("l, F jS", $row->endtime + 1);
							} else {
								$add_end_time = "";
							}
							$full_day_label = date("l, F jS", $row->starttime ).$add_end_time;
							$inspector_name = get_field('users_details', 'name', $row->user_id);
							$inspector_lastname = get_field('users_details', 'lastname', $row->user_id);
							$this_inspector = $row->user_id;
							$html .= "
							<tr>
								<td colspan=\"3\" bgcolor=\"black\"><span class=\"whitehead\">".$inspector_name." ".$inspector_lastname."</span></td>
								<td colspan=\"2\" bgcolor=\"black\"><span class=\"whitehead\">".$full_day_label."</span></td>
							</tr>\n";
						}

						//if ("$end_day"=="$start_day") {
							$hora = "<nobr><b>".$start."</b> -". $end."</nobr><span class=\"note\"><br>Appointment #".$row->id."</span>";
						//}
						
						if ($row->type == "1"){
							$html .= "
						<tr>
							<td colspan=\"2\" valign=\"top\" bgcolor=\"#cccccc\"><nobr><b>".$start."</b> - ".$end."</nobr></td>
							<td valign=\"top\" bgcolor=\"#cccccc\">Blockout</td>
							<td colspan=\"2\" valign=\"top\" bgcolor=\"#cccccc\"><span class=\"note\">".$row->notes."</span></td>
						</tr>\n";
						} else {
							if ($show_email == "1"){
								$agent_email = $row->agent_email;
								$client_email = $row->email;
							}
							$bookings_total_count ++;
							if ($row->price != ""){ $price = "$".$row->price.""; $total_earnings = ($total_earnings + "$".$row->price); }
							if ($row->user_notes != ""){ $row->user_notes = "<b>Note:</b> ".$row->user_notes."<br>"; }
							if ($row->notes != ""){ $row->notes = "<b>Memo:</b> ".$row->notes.""; }
							if ($row->entry_method != ""){ $row->entry_method = "<b>Entry:</b> ".$row->entry_method."<br>"; }
							if ($row->mls != ""){ $row->mls = "<br>MLS: ".$row->mls.""; }
							if($row->agent_name != ""){ $agent_info = "<br><b>Agent: ".$row->agent_name."</b>";} else { $agent_info = ""; }
							if($row->agent_phone != ""){ $agent_info .= "<br>".$row->agent_phone."";}
							if ($agent_email != "") { $agent_info .= " ".$agent_email; }
							if($row->listing_agent != ""){ $agent_info .= "<br><b>Listing: ".$row->listing_agent."</b>";}
							if($row->listing_phone!= ""){ $agent_info .= "<br>".$row->listing_phone."";}
							if($row->firstname != "" || $row->lastname != ""){ $client_info = "<b>".$row->firstname." ".$row->lastname."</b>"; } else { $client_info = ""; }
							if($row->dayphone != ""  || $row->homephone != ""){ $email_addon = "<br>"; $client_info .= "<br>".$row->dayphone." ".$row->homephone.""; }
							if ($client_email != "") { $client_info .= $email_addon.$client_email; }
							$siz = get_full_description($row->building_type, $row->building_size,$row->building_age);
							$addons = get_addon_information($row->id);
						
							//create html
							$html .= "\t\t\t\t\t<tr>\n";
							$html .= "\t\t\t\t\t\t<td bgcolor=\"#".$bgcolor."\" valign=\"top\">".$hora."</td>\n";
							$html .= "\t\t\t\t\t\t<td bgcolor=\"#".$bgcolor."\" align=\"right\" valign=\"top\">".$price."</td>\n";
							$html .= "\t\t\t\t\t\t<td bgcolor=\"#".$bgcolor."\" valign=\"top\">".$row->inspection_address.", ".$city."<br>".$siz."<span class=\"note\">".$addons->services."</span></td>\n";
							$html .= "\t\t\t\t\t\t<td bgcolor=\"#".$bgcolor."\" valign=\"top\"><span class=\"note\">".$row->entry_method." ".$row->user_notes." ".$row->notes."</span></td>\n";
							$html .= "\t\t\t\t\t\t<td bgcolor=\"#".$bgcolor."\" valign=\"top\"><span class=\"note\"><nobr>".$client_info."</nobr>".$agent_info." ".$row->mls."</span></td>\n";
							$html .= "\t\t\t\t\t</tr>\n";
						}
						if ($row->type == 1){  //long blockouts would spawn a new day black divider unless we did this
							$last_end_day = date("j", $row->starttime + 1);
						} else {
							$last_end_day = date("j", $row->endtime + 1);
						}
					}
					$timezone = get_field('business', 'timezone', $row->business);
					$generated_date = date ("g:ia l, F jS",($now + $timezone));
					$total_earnings = number_format($total_earnings);
					if ($bookings_total_count > 1){
						//$bookings_name = "Bookings";
					} else {
						//$bookings_name = "Booking";
					}
					$html .= "
					<tr>
						<td valign=\"top\" bgcolor=\"".$bgcolor."\">".$bookings_total_count." ".$bookings_name." Total</td>
						<td valign=\"top\" align=\"right\" bgcolor=\"".$bgcolor."\">$".$total_earnings."</td>
						<td colspan=\"3\" align=\"right\" valign=\"bottom\" bgcolor=\"".$bgcolor."\"><span class=\"note\">Generated at ".$generated_date." by Scheduleze.com</span></td>
					</tr>\n";
					$html .= "<br><br>\n";
				}
				unset($bookings_total_count);
				unset($total_earnings);
			}
		return $html;
	}
}

if(! function_exists('get_addon_information')){
	function get_addon_information($booking){
		$addons = DB::table('addons_bookings')->where('booking', $booking)->get();
		$ads = format_addons($addons);
		return $ads;
	}
}

if(! function_exists('get_business_information')){
	function get_business_information($business){
		/*$sql = "select * from business where id = '$business' and removed = '0'";*/
		$row = DB::table('business')->where([['id', '=', $business],['removed', '=', 0]])->first();
		/*$row = $this->pull_assoc($sql);*/
		$html = "<span class=\"head\">".$row->name."</span>";
		$html .= "<div class=\"small_indent\"><span class=\"address\">";
		foreach ($row as $key => $rw){
			session(['business_information.'.$key => $rw]);
		}
		if (strlen($row->public_address)>3){
			$html .= $row->public_address."<br>";
		}
		if (strlen($row->public_phone) > 3){
			$html .= $row->public_phone;
			session(['business_information.phone' => $row->public_phone]);
		}
		$html .= "</span></div>";
		session(['business_card' => $html]);
		session(['agent_label' => get_field("business_types", "agent_name", session('business_information.type'))]);
		return $html;
	}
}

if(! function_exists('format_addons')){
	function format_addons($addons, $verbose = 'yes'){
		$adns = array();
		$adns['price'] = '';
		$adns['services'] = '';
		if (is_array($addons)){
			foreach ($addons as $addon) {
				$c++;
				if ($c > 1){
					$also_includes = " and ";
				} else {
					if ($verbose == "yes"){
						$also_includes = "<br>Includes ";
					}
				}
				if (is_array($addon)){
					$adns['price'] = ($adns['price'] + (get_field('addons', 'price', $addon->id)));  //depreciated
					$adns['services'] .= (($also_includes).(get_field('addons', 'name', $addon->id)));
				} else {
					$adns['price'] = ($adns['price'] + (get_field('addons', 'price', $addon)));  //depreciated
					$adns['services'] .= (($also_includes).(get_field('addons', 'name', $addon)));
				}
			}
		}
		return $adns;
	}
}

if(! function_exists('get_full_description')){
	function get_full_description($building_type, $building_size, $building_age){

		$type_name = DB::table('building_types')->select('name')->where([['id', '=', $building_type],['removed', '=', 0]])->first();

		//$type_name = $this->get_field("building_types", name, $building_type);
		if($type_name != null){
			$full_dec = $type_name->name;
			if ($building_size > 0){
				$size_name = DB::table('building_sizes')->select('name')->where([['id', '=', $building_size],['removed', '=', 0]])->first();
				if(isset($size_name)){
					//$size_name = $this->get_field("building_sizes", name, $building_size);
					$full_dec .=", ".$size_name->name."";
				}
			}
			if ($building_age > 0){
				$age_name = DB::table('building_ages')->select('name')->where([['id', '=', $building_age],['removed', '=', 0]])->first();
				//$age_name = $this->get_field("building_ages", name, $building_age);
				if(isset($age_name)){
					//$size_name = $this->get_field("building_sizes", name, $building_size);
					$full_dec .= ", ".$age_name->name."";
				}
			}
		}else{
			$full_dec = '---';
		}
		return $full_dec;
	}
}

if(! function_exists('get_todays_starttime')){
	function get_todays_starttime($time=''){
		if ($time == ""){
			$time = time();
		}
		$year_of_day = date("Y", $time);
		$month_of_day = date("n", $time);
		$day_of_day = date("j", $time);
		$start_of_day = mktime(0, 0, 0, $month_of_day, $day_of_day, $year_of_day);
		return $start_of_day;
	}
}
if(! function_exists('get_bus_users')){
	function get_bus_users(){
		$business = session('business_id');
		$users_details = DB::table('users_details')->select('user_id')->where('business', $business)->get()->toArray();
		return $users_details;
	}
}

if(! function_exists('get_subs_users')){
	function get_subs_users($i = 0){
		$business = session('business_id');
		$users_details = DB::table('users_details')->select('name','user_id','administrator')->where('business', $business)->get();
		$form = "<select name=\"selectedusers[$i][]\" class=\"form-control my_select_$i selectedbs\" size=\"1\" multiple style=\"display:none;\" data-main-id=\"$i\">";
		$form .="<option value=\"\" disabled></option>";
		foreach ($users_details as $value) {
			$username = $value->name;
			if(empty($username) || $username == null){
				$users = DB::table('users')->select('name','id')->where('id', $value->user_id)->first();
				$username = $users->name;
			}
			$form .= "<option value=\"$value->user_id\" data-in=\"$value->administrator\">$username</option>";
		}
		$form .= "</select>";
		return $form;
	}
}



if(! function_exists('handoff_file')){
	function handoff_file($file_id){
		
		$filename = get_field('reports', 'pdf', $file_id);
		
		$full_file= ('images/reports/'.$filename);
		if(!is_file($full_file)){  //if the file doesn't exist, error out
			session(['warning' => "Sorry that report no longer exists"]);
			return false;
		} else {
			
			$file_size = filesize($full_file);
			//echo "$file_size";
			//echo "$full_file";
			header('Content-Description: File Transfer');
			header("Content-Type: application/octet-stream\n");
			header("Content-Disposition: attachment; filename=\"$filename\"\n");
			header("Content-Transfer-Encoding: binary\n");
			header("Content-Length: $file_size\n");
		
			$ff=fopen("$full_file","r");
			fpassthru($ff);
			
			
			return true;
		}
	}
}

if(! function_exists('get_icon')){
	function get_icon($file_name){

		$extension = explode(".",$file_name);

		$num = (count($extension))-1;

		$icon = $extension[$num].".gif";

		$images = "images/icon_images/".$icon."";

		if(!file_exists($images)){
			$icon = "pdf.gif";
			//$icon="iconfiles/$icon";
		} else {
			$icon = $icon;
		}

		return $icon;
	}
}

if(! function_exists('view_for_reports')){
	function view_for_reports($userid, $first, $last, $order='') {
			
		if (session('permission') != 1){
			$userid = session('id');
		}
			
		//get current time
		$now = time();

		if ($order == "type"){
			$order = "type";
			$incdec = "asc";
		} else {
			$order = "id";
			$incdec = "desc";
		}

		if ( $first == "" ) {
			$whereArr = [['starttime', '>', $now], ['user_id', '=', $userid], ['type', '=', 0], ['removed', '=', 0]];
		} 
		else
		{
			$whereArr = [['starttime', '>', $first], ['starttime', '<', $last], ['user_id', '=', $userid], ['type', '=', 0], ['removed', '=', 0]];
		}

		$tt = DB::table('bookings')->where($whereArr)->orderBy($order, $incdec)->orderBy('starttime', 'asc')->get();		
		/*if (($first=="")) {
			$sql = "select * from bookings where starttime > $now and inspector = '$inspector' and removed = '0' and type ='0' order by $order starttime asc";
		} else {
			$sql = "select * from bookings where starttime > $first and starttime < $last and inspector = '$inspector' and type ='0' and removed = '0' order by $order starttime asc";
		}

		$tt = $this->pull_multi($sql);*/

		$html = "<tr><td bgcolor=\"FFCD49\" class=\"display\"><b>Start &amp; End</b></td>\n
		<td bgcolor=\"FFCD49\" class=\"display\"><b><!--<a href=\"admin_form.php?action=2&order=type&first=$first&last=$last&userid=$userid\">-->Address<!--</a>--></b></td>\n
		<td bgcolor=\"FFCD49\" class=\"display\"><b>Agent/Notes</b></td>\n
		<td bgcolor=\"FFCD49\" class=\"display\"><b>Price</b></td>\n
		<td bgcolor=\"FFCD49\" class=\"display\"><b>Client Name</b></td>\n
		<td bgcolor=\"FFCD49\" class=\"display\"><b>Numbers</b></td>\n
		<td bgcolor=\"FFCD49\" class=\"display\"><b>Action</b></td>\n
		<td bgcolor=\"FFCD49\" class=\"display\"><b>Viewed</b></td>\n
		";

		$h = 0;
		//loop to create the display
		if (count($tt)>0) {
			foreach ($tt as $row) {
				$h++;
				if (($h%2)==0){
					$bgcolor="F0F0F0";
				} else {
					$bgcolor="FAFAFA";
				}
				
				//format the times
				$start = date("g:ia", $row->starttime - 1);
				$start_day = date(" D, M j", $row->starttime - 1);
				$end = date("g:ia", $row->endtime);
				$end_day = date(" D, M j", $row->endtime);
				if ("$end_day"=="$start_day") {
					$hora = "$start-$end<br>$start_day";
				} else {
					$hora = "$start$start_day-<br>$end$end_day";
				}
				
				if ($row->type != 1){
					/*if (($row->military == 1) and ($row->size == 3)) {
						$price = "$".(get_field('sizes', 'price', $row->size))*9/10;
						
					} else {*/
						//$price = "$".get_field('sizes', 'price', $row->size);
					//}
						$price = "";
				} else {
					$price = "";
				}
			
				//create html
				$html .= "<tr>\n";
				$html .= "<td bgcolor=\"#$bgcolor\" class=\"display\">$hora</td>\n";
				if ($row->type == 1) {
					$html .= "<td bgcolor=\"#$bgcolor\" class=\"display\">Blockout</td>\n";
					$html .= "<td bgcolor=\"#$bgcolor\" class=\"display\">$row->notes</td>\n";
				} else {
					$city = get_field("locations", "name", $row->location);
					$html .= "<td bgcolor=\"#$bgcolor\" class=\"display\">$row->inspection_address<br>$city</td>\n";
					if ($row->user_notes != ""){ $row->user_notes = "<br>$row->user_notes"; }
					if ($row->notes != ""){ $row->user_notes .= "<br><b>$row->notes</b>"; }
					$html .= "<td bgcolor=\"#$bgcolor\" class=\"display\">$row->agent_name  $row->agent_phone $row->user_notes</td>\n";
				}
				if($row->email!=""){
					$client_name = "<a href=\"mailto:$row->email\">$row->firstname $row->lastname</a>";
				} else {
					$client_name = "$row->firstname $row->lastname";
				}
				$html .= "<td bgcolor=\"#$bgcolor\" class=\"display\">$price</td>\n";
				$html .= "<td bgcolor=\"#$bgcolor\" class=\"display\">$client_name</td>\n";
				$html .= "<td bgcolor=\"#$bgcolor\" class=\"display\"><nobr>$row->dayphone</nobr><br><nobr>$row->homephone</nobr></td>\n";
				
				//does the booking have a report?
				/*$sql = "select * from reports where booking='$row[id]' and removed=0";
				$report = $this->pull_array($sql);*/

				$report = DB::table("reports")->where([['booking', '=', $row->id],['removed', '=', 0]])->first();
				if (isset($report)) {
					//access reports table and give view link
					$html .= "<td bgcolor=\"#$bgcolor\" class=\"display\"><a target=\"_blank\" href=\"/viewreports/".$report->id."/".$report->code."\"><nobr>View Report</nobr></a></td>\n
					<td bgcolor=\"#$bgcolor\" class=\"display\" align=\"center\">$report->views</td>\n";
				} else {
					//give post link
					$html .= "<td bgcolor=\"#$bgcolor\" class=\"display\"><a href=\"documents/viewreport/".$row->id."\"><nobr>Post Report</nobr></a></td>\n
					<td bgcolor=\"#$bgcolor\" class=\"display\">&nbsp;</td>\n";
				}
				
				$html .= "</tr>\n";
				
			}
		}else{
			$html = '<tr><td class="display" style="text-align: center;">No Results Found</td></tr>';
		}
		return $html;
	}
}