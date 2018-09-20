@extends('layouts.front')
@section('content')

<div class="signup_section">

	<div class="signup_cont nsignup_cont">

		<div class="container">

			<div class="framecell">
				<div class="frameadmin set_recc_block">
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
					@php $allindustries = getallIndustries() @endphp
					<form method="POST" action="{{ url('/services/content') }}">
						@csrf
						<div class="set_recc_cont">	     
							<h2>Set Service Content</h2>
							<h4>Please specify any business hours for</h4>
						</div>
						<div class="set_recc_cont">
							<div class="select_field">
								<select name="txtIndustries" class="smallselect" required>
									<option value="-1">Select Industrial</option>
									@foreach($allindustries as $key => $industries)
									<option value="{{ $key }}" @if($BusinessTypes->id == $key) selected @endif>{{ $industries }}</option>
									@endforeach
								</select>
							</div>
							<input type="submit" name="Submit" class="submit" value="Switch">
						</div>
					</form>
					<form method="POST" action="{{ url('/services/storeServiceContent') }}">
						@csrf
						<input type="hidden" name="txtBusinessType" value="{{ $BusinessTypes->id }}">
						<div class="textfield_full">
							<div class="bussthree_cont">
								<div class="form-group col-md-12">
									<label for="business_name" class="control-label">{{ $BusinessTypes->type_label }}</label>
									<textarea name="building_type" rows="4" cols="68">@if(!empty($ServiceContent)) ? {{ $ServiceContent->type_content }} : '' @endif</textarea>
								</div>
							</div>

							<div class="bussthree_cont">
								<div class="form-group">
									<label for="business_name" class="control-label">{{ $BusinessTypes->size_label }}</label>
									<textarea name="building_size" rows="4" cols="68">@if(!empty($ServiceContent)) ? {{ $ServiceContent->size_content }} : '' @endif</textarea>
								</div>
							</div>

							<div class="bussthree_cont">
								<div class="form-group">
									<label for="business_name" class="control-label">{{ $BusinessTypes->age_label }}</label>
									<textarea name="building_age" rows="4" cols="68">@if(!empty($ServiceContent)) ? {{ $ServiceContent->age_content }} : '' @endif</textarea>
								</div>
							</div>

							<div class="bussthree_cont">
								<div class="form-group">
									<label for="business_name" class="control-label">{{ $BusinessTypes->addon_label }}</label>
									<textarea name="add_on_service" rows="4" cols="68">@if(!empty($ServiceContent)) ? {{ $ServiceContent->add_on_service_content }} : '' @endif</textarea>
								</div>
							</div>

							<div class="textfield_full">
								<div class="form-group">
									<input type="submit" name="submit" value="Save Service Content" class="submit btn btn-success bluebtn">
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
