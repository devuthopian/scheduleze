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

if(! function_exists('hour_popup')){
	function hour_popup ($hour, $designate) {
		$popup ="\t\t\t\t<select name=\"hour[".$designate."]\" class=\"smallselect\" required>\n";
			$popup .="\t\t\t\t<option value=\"\" selected></option>\n";
			$popup .="\t\t\t\t<option value=\"12\">12</option>\n";
			$popup .="\t\t\t\t<option value=\"1\">1</option>\n";
			$popup .="\t\t\t\t<option value=\"2\">2</option>\n";
			$popup .="\t\t\t\t<option value=\"3\">3</option>\n";
			$popup .="\t\t\t\t<option value=\"4\">4</option>\n";
			$popup .="\t\t\t\t<option value=\"5\">5</option>\n";
			$popup .="\t\t\t\t<option value=\"6\">6</option>\n";
			$popup .="\t\t\t\t<option value=\"7\">7</option>\n";
			$popup .="\t\t\t\t<option value=\"8\">8</option>\n";
			$popup .="\t\t\t\t<option value=\"9\">9</option>\n";
			$popup .="\t\t\t\t<option value=\"10\">10</option>\n";
			$popup .="\t\t\t\t<option value=\"11\">11</option>\n";
		$popup .="\t\t\t\t</select>\n";
		return $popup;
	}
}

if(! function_exists('minute_popup')){
	function minute_popup ($minute, $designate) {
		$popup ="\t\t\t\t<select name=\"minute".$designate."\" class=\"smallselect\">\n";
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
	function am_popup($am, $designate) {
		$popup ="\t\t\t\t<select name=\"am".$designate."\" class=\"smallselect\">\n";
		$popup .="\t\t\t\t	<option value=\"$am\" selected>$am</option>\n";
		$popup .="\t\t\t\t	<option value=\"AM\">AM</option>\n";
		$popup .="\t\t\t\t	<option value=\"PM\">PM</option>\n";
		$popup .="\t\t\t\t</select>\n";
		return $popup;
	}
}