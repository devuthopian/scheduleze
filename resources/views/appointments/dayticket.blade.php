<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>

	<head>
		<meta http-equiv="content-type" content="text/html;charset=ISO-8859-1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Scheduleze Dayticket</title>
		<style>
						
			p, th, td, li { color: #000000; font-weight: normal; font-size: 15px; font-family: Arial, Tahoma, Verdana, Sans Serif; }

			.indent { margin-left: 2em;  }
			.small_indent { margin-left: 1em;  }

			.head { color: #000000; font: bold 17px Arial, Tahoma, Verdana, Sans Serif; }
			.whitehead { color: #FFFFFF; font: bold 16px Arial, Tahoma, Verdana, Sans Serif; }
			.subhead { color: #000000; font: bold 14px/15px Arial, Tahoma, Verdana, Sans Serif; }
			.display { color: #000000; font: normal 14px/15px Arial, Tahoma, Verdana, Sans Serif; }
			
			.warning_red { color: #CC0000; font-weight: bold; }
			.warning_green { color: #006636; font-weight: bold; }
			.warning_red_small { color: #CC0000; font-weight: bold; font-size: 14px; }
			
			.note { color: #000000; font-weight: normal; font-size: 15px; }

				
			ul { list-style: none; }
			ul.index { list-style: none; margin-left: 0; padding-left: 3em; text-indent: -.9em; }
			li { color: #666666; }
			li.feature { color: #999999; font-weight: bold; }


				
		</style>
	</head>
		@php $html = display_dayticket($userid, $start, $days); @endphp
	<body bgcolor="#ffffff">
		{!! $html !!}
	</body>
</html>