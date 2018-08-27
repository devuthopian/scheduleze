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
<table width="100%" border="0" cellspacing="0" cellpadding="0">
   <tr>
      <td class="framecell" bgcolor="white">
         <form action="{{ url('/scheduleze/zigzag/') }}" method="post">
         	@csrf
            <div class="frame">
               <span class="head">Zigzag Control<br>
               </span>
               Stop running from one side of town to the other<br><br>
               <div class="indent">
                  <input type="hidden" name="trigger" value="1">
                  <input type="checkbox" name="zigzag" value="1" {{ $z }} > Prevent Zigzagging for trips over {!! $zigpop !!}	
                  <br><span class="note">Instructs Scheduleze to favor nearby appointments but permit long drivetimes if no other
                  appointments are scheduled later in that day. Recommended for heavily booked.</span></p>
               </div>
               <input type="submit" class="submit" value="Set Zigzag">
         </form>
         <br><br><br><br><br><br>
         <span class="note"><a href="index.php" class="note_link">&laquo; Return to Admin Home</a></span><br><br>
         </div>
         </form>
      </td>
   </tr>
</table>
@endsection