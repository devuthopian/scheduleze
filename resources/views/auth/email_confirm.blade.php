@extends('layouts.front')

@section('content')

<div class="container">
	<div class="framecell">
		<div class="frameadmin adding_blockout_cont">
			<div class="clearfix"></div>
			<div class="head_admin">
				@if(Session::has('confirmstatus'))
					<h1>Email Confirmation</h1>
			        <div class="alert alert-success">
			            <a class="close" data-dismiss="alert">×</a>
			            <strong>{!!Session::get('confirmstatus')!!}</strong> 
			        </div>
			    @endif				
			</div>
		</div>
	</div>
</div>

@endsection