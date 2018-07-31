@if(!empty($template))
	{!! $template->gjs_html !!}
	<style type="text/css">
		{!! $template->gjs_css !!}
	</style>
@else
	<p>Nothing to show!</p>
@endif
