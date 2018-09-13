<div class="container">
  	<div class="jumbotron">
		<div class="frame">
			<div class="head">
				<h3>
					{!! $business_name !!} Receipt #{{ $id }}
				</h3>
				{{ $row->firstname }}, thank you for scheduling an inspection!
			</div>
			<br><br>
				<div class="right">
				{{ $paypal_link }}
				</div>
				{!! $list !!}
				<br><br><br>
		</div>
	</div>

	<div class="logo">
		<img src="{{ asset('/images/logo.png') }}" alt="Take command of your day" width="244" height="79" border="0">
	</div>
	<div class="frame-closing">	
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