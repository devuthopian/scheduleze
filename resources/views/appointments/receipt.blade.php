<div class="container">

  	<div class="jumbotron">

		<div class="frame">

			<div class="head">

				<h3>

					{!! $business_name !!} Receipt #{{ $id }}

				</h3>

				{{ $row->firstname }}, thank you for scheduling {!! $business_name !!}

			</div>

			<br><br>

				<div class="right">

				{{ $paypal_link }}

				</div>

				{!! $list !!}

				<br><br><br>

		</div>

	</div>



	<?php

		//$user_logo = session('user_logo');

		//$userid = session('id');

		$image = '';
		if(!empty($user_logo)) {

			$image = 'public/attachments/logo/'.$aUserID.'/'.$user_logo;

		}

	?>



	<div class="logo">

		<img src="{{ url($image) }}" alt="Take command of your day" width="244" height="auto" border="0">

	</div>

	<div class="frame-closing">

		<?php $business_phone = preg_replace("/^(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3", $business_phone); ?>

		<br>Questions? Call {{ $business_phone }} @if(!empty($business_email)) or Email <a href="mailto:<?=$business_email?>">{{ $business_email }} @endif</a><br><br>

				<span class="note">Booked on {{ $date_added }} ~ </span>

		<span class="note">Printed on {{ $date_printed }}</span>

	</div>

</div>



<style type="text/css">

	.head{

		font-size: 20px;

	}

	.italianinspect{

		font-style: italic;

		font-weight: normal;

	}

	.middleinfo {

		padding: 20px;

		background: #eee;

	}

	.inspectAdd {

		color: #070707;

	}

	h3{

		color: #045293;

	}

	.indent {

		padding-left: 20px;

	}

</style>