@extends('layouts.front')

@section('content')
	{!! Form::open([ 'route' => ['storeIndustries'],'method' => 'post'] ) !!}
<div class="set_recc_block">
	<div class="container">
		<div class="frameadmin" id="adminIndustries">
			<h2>Industries</h2>
			<h5>Order is the order the items appear in the popup menu, use radio button to set menu default.</h5>				
				<table border="0" cellspacing="0" cellpadding="2" class="table table-responsive table-bordered">
					<tbody>
						<tr class="thead">
							<td>
								<span class="formlabel">Business </span><br>
							</td>
							<td>
								<span class="formlabel">Industry name </span><br>
							</td>
							<td>
								<span class="formlabel">Type Label </span><br>
							</td>
							<td>
								<span class="formlabel">Size Label </span><br>
							</td>
							<td>
								<span class="formlabel">Age Label </span><br>
							</td>
							<td>
								
							</td>
						</tr>
						<tbody class="txtIndustriesId"> 
							@php $i=0; @endphp
							@unless($BusinessTypes == '' || $BusinessTypes->isEmpty())
								@foreach($BusinessTypes as $BusinessType)
									<tr class="trtable_{{ $i }}">
										<input type="hidden" class="form-control" name="id[{{ $i }}]" value="{{ $BusinessType->id }}">
										<!-- <input type="hidden" class="form-control" name="slug[{{ $i }}]" value="{{ $BusinessType->agent_name }}"> -->
										<td>
											<input type="text" class="form-control" name="business[{{ $i }}]" value="@if($BusinessType->business) {{ $BusinessType->business }} @endif" size="5" required>
										</td>
										<td>
											<input type="text" class="form-control" name="name[{{ $i }}]" value="@if($BusinessType->agent_name) {{ $BusinessType->agent_name }} @endif" size="5" required>
										</td>
										<td>
											<input type="text" class="form-control" name="type_label[{{ $i }}]" value="@if($BusinessType->type_label) {{ $BusinessType->type_label }} @endif" size="5" required>
										</td>
										<td>
											<input type="text" class="form-control" name="size_label[{{ $i }}]" value="@if($BusinessType->size_label) {{ $BusinessType->size_label }} @endif" size="5" required>
										</td>
										<td>
											<input type="text" class="form-control" name="age_label[{{ $i }}]" value="@if($BusinessType->age_label) {{ $BusinessType->age_label }} @endif" size="5" required>
										</td>
										<td>
											<input type="text" class="form-control" name="addon_label[{{ $i }}]" value="@if($BusinessType->addon_label) {{ $BusinessType->addon_label }} @endif" size="5" required>
										</td>
										<td>
											<a href='#' class='note_link' id="{{ $i }}" data-model="BusinessTypes" data-id="{{ $BusinessType->id }}">Remove</a>
										</td>
									</tr>
									@php $i++; @endphp
								@endforeach
							@else
							    <tr class="trtable_0">
							    	<input type="hidden" class="form-control" name="id[0]" value="0">
									<td>
										<input type="text" class="form-control" name="name[0]" size="5" required>
									</td>
									<td>
										<a href='#' class='note_link' id="0" data-id="0">Remove</a>
									</td>
								</tr>
							@endunless
						</tbody>
						<span id="showtxt"></span>
						<tr>
							<td colspan="4"><input type="submit" name="submit" value="Save Industries" class="submit btn btn-success bluebtn">
								<!-- <input type="hidden" name="action" value="building_types"> -->
								<input type="hidden" name="trigger" value="2">&nbsp;&nbsp;
							</td>
						</tr>
						<tr>
							<a href="" class="add_columnfor" id="add_columnfor" @click="addIndustryColumn">Add Column</a>
						</tr>
					</tbody>
				</table>
			</span>
		</div>
	</div>
</div>	
	
	{!! Form::close() !!}
@endsection
