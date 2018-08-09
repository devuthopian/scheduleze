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
    function state()
    {
    	$html = "\t\t\t\t<select name=\"state\" size=\"1\" class=\"smallselect\">\n";
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
		return DB::table('industries')->pluck('page_name', 'id');
	}
}

if(! function_exists('buildType')){
	function buildType($id){
		array_shift($id);
		foreach ($id as $key => $value) {
			if($key != 'reference_id'){
				$getformdata = DB::table($key.'s')->select('name','price')->where('id',$id)->get();
				if($getformdata->count()){
					$getall[] = $getformdata[0]->name.' $'.$getformdata[0]->price;
				}
			}
		}
		return $getall;
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
		
		$getformdata = DB::table('locations')->select('name','price')->where('id',$id)->get();
		return $getformdata[0]->name.' + $'.$getformdata[0]->price;;
	}
}

if(! function_exists('CountAppFormCost')){
	function CountAppFormCost($id){
		array_shift($id);
		$count = 0;
		foreach ($id as $key => $value) {
			if($key != 'reference_id'){
				$getformdata = DB::table($key.'s')->select('price')->where('id',$value)->get();
				if($getformdata->count()){
					$price = $getformdata[0]->price;
					$count = $price + $count;
				}
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