@extends('layouts.includes.front.backend.front')
@section('content')
	@if ($errors->any())
	<div class="alert alert-danger">
		<ul>
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
	@endif
	<div class="clearfix"></div>
	<div class="set_recc_block">
		<div class="container">
			<div class="frameadmin" id="adminIndustries">
				<h3>{{ $page_name }}</h3>
				<h5>Please use this text area for helper text</h5>
				<form action="{{ url('backend/page/content/'.$raw_page) }}" method="POST">
					@csrf
					<textarea name="summernoteInput" class="summernote">@if(!empty($PageData)) {!! $PageData->content !!} @endif</textarea>
					<br>
					<input type="submit" name="submit" value="Save" class="submit btn btn-success bluebtn">
				</form>
			</div>
		</div>
	</div>
@endsection