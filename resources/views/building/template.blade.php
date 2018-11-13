<!-- <link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet">

<link rel="shortcut icon" href="{{ asset('images/favicon_icon.png') }}" type="image/x-icon" /> -->

<!-- <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}"> -->

<!-- <link rel="stylesheet" href="{{ URL::asset('css/tooltip.css') }}"> -->
<title>Scheduleze | Customer Scheduling Solutions</title>
<meta name="keywords" content="Scheduleze | Customer Scheduling Solutions"/>
<meta name="body" content="Scheduleze | Customer Scheduling Solutions"/>
<meta name="description" content="Scheduleze | Customer Scheduling Solutions"/>
<meta name="summary" content="Scheduleze | Customer Scheduling Solutions"/>
<meta http-equiv="Bulletin-Text" content="Scheduleze | Customer Scheduling Solutions"/>
<meta name="page-topic" content="Scheduleze | Customer Scheduling Solutions"/>
<link rel="shortcut icon" href="{{ asset('images/favicon_icon.png') }}" type="image/x-icon" />







@if (!empty($template))

@php $userId = Auth::id(); @endphp



	<link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">

    <div class="loader"></div>


	<div class="container">

		<div class="row">

			{!! $template->gjs_html !!}

		</div>

	</div>

		<style type="text/css">

			{!! $template->gjs_css !!}



			.header_section {

			    float: unset !important;
			    width: 96%;

			}

		</style>

	@else

		<p>Nothing to show!</p>

	@endif

	<script src="{{ URL::asset('js/jquery-3.2.1.min.js') }}"></script>

	<script type="text/javascript">

		$(document).ready(function() {

			/* Act on the event */

			$("input[name*='_token']").val('{{ csrf_token() }}');



			@if(count($inspectors) > 1)

				$('#txtForm').attr('action', '{{ url("/scheduling/bookingavailable") }}');

			@else

				$('#txtForm').attr('action', '{{ url("/scheduling/bookingform") }}');

			@endif



			$('.loader').fadeOut(1000);

		});

		

	</script>