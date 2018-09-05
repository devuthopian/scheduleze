@extends('layouts.front')

@section('content')

<?php

/*if ($_POST[trigger]==1) {
	if ($_POST[zigzag]==1) {
		$act = "Enabled";
		$sql[zigzag]=$_POST[zigzag];
		$sql[zzamount] = $_POST[zigpop];
	} else {
		$act = "Disabled";
		$sql[zigzag]=0;
		$sql[zzamount] =0;
	}
	
	$sql = $m->make_sql($sql, inspectors, update, id, $_SESSION[id]); 
	$m->query($sql);
	
	$_SESSION[warning] = "Zigzag Control $act";
	
}*/

?>
<div class="nsignup_cont">
   <div class="container">
      <form action="{{ url('/scheduleze/zigzag/') }}" method="post">
      	@csrf
         <div class="frame">
            <h3>Zigzag Control</h3>
            Stop running from one side of town to the other<br><br>
            <div class="indent">
               <input type="hidden" name="trigger" value="1">
               <input type="checkbox" name="zigzag" value="1" {{ $z }} > Prevent Zigzagging for trips over {!! $zigpop !!}	
               <h5>Instructs Scheduleze to favor nearby appointments but permit long drivetimes if no other
               appointments are scheduled later in that day. Recommended for heavily booked.</h5></p>
            </div>
            <input type="submit" class="submit" value="Set Zigzag">
      </form>
   </div>
</div>
@endsection