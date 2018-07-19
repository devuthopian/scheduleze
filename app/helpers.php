<?php 

if (! function_exists('show_buffer')) {
    function show_buffer($variable, $default_option='10800', $max = '32400', $increment = '900')
    {
    	$html = "\t\t\t\t<select name=\"buffer[$variable]\" class=\"small_select\">\n";
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