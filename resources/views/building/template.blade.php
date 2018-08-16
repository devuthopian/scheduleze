@if(!empty($template))
<div class="container">
	<div class="row">
		{!! $template->gjs_html !!}
	</div>
</div>
	<style type="text/css">
		{!! $template->gjs_css !!}
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
			$('#txtForm').attr('action', '{{ url("/scheduleze/bookingavailable") }}');
		@else
			$('#txtForm').attr('action', '{{ url("/scheduleze/bookingform") }}');
		@endif
	});
	
</script>