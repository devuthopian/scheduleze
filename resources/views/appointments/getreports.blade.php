@extends('layouts.front')

@section('content')
<div class="container">
	<div class="row">
		<table width="778" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td class="framecell" bgcolor="white">
				<div class="frame">
				<span class="head">Download PDF Inspection Report<br></span>
				<?php echo $html;?>
				<br><br><br><br><br><br></div>
				<div class="logo">
				<a href="index.php"><img src="/images/scheduleze-logo.gif" alt="Take command of your day" width="235" height="79" border="0"></a>
				</div>
				<div class="frame-closing">If you have problems viewing this report, please contact us. 
				<br>Call <?php echo $phone; ?> or email <a href="mailto:$email"><?php echo $email; ?></a>.<!--<br>Questions? <a href="mailto:info@scheduleze.com">info@scheduleze.com</a>--></div>
				</td>
			</tr>
		</table>
	</div>
</div>
@endsection