@extends('layouts.front')
@section('content')

<div class="container">
	<div class="framecell">
		<div class="frameadmin adding_blockout_cont">
			<div class="clearfix"></div>
        	<div class="head_admin">
	            <span class="head">
	            	Upload Email Attachment
	            	<br>
	            </span>
	            <br>
	            <form enctype="multipart/form-data" action="{{ url('/profile/Email/Attachment') }}" method="post">
	            	@csrf
	                <input type="hidden" name="booking" value="{{ session('business_id') }}">
	              	<span class="formlabel">Select Document to Attach</span>
	              	<div class="note">Name the file something short and clear, like &quot;ABC-Contract.pdf&quot;</div>
					<input type="file" name="userfile" size="24">
					<div class="note">PDF, Word, Powerpoint, JPEG image only, 2.0 megs max</div>
	                <span class="warning_green">Existing email attachment set to: {{ $name }}</span>
					<input type="hidden" name="trigger" value="1">
					<input type="hidden" name="action" value="email_attachment">
					<input type="submit" value="Upload Attachment">
	            	<div class="note">
	            		Uploading a new document will replace any existing email attachment document
	            	</div>
	            </form>
	        </div>
	    </div>
	</div>
</div>
@endsection
