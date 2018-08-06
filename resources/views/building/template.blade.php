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