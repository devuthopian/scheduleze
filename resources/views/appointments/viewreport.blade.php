@extends('layouts.front')

@section('content')
<div class="container">
	<div class="row">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td class="framecell" bgcolor="white">
				<div class="frame">
				<span class="head">Download PDF Inspection Report<br></span>
				<span class="subhead">Posted on $date</span><br>
				<br>
				<div class="indent">
					<img src="{{ url('images/icon_images') }}/{!! get_icon($row->pdf) !!}" border="0" align="top">
					<a href="{{ url('/viewreports/'.$id.'/'.$code.'') }}">
						<b>Download PDF Report Now &#187;&nbsp;</b>
					</a>
				</div>
				@if (strlen($row->summary) > 1)
			        <br><br><span class="formlabel">Summary</span><br>{{ $row->summary }}</span><br>
			    @endif

			    @if (strlen($row->memo) > 1)
			        <br>
			        <span class="formlabel">
			        	Memo
			        </span>&nbsp;&nbsp;
			        <span class="note">
			        	(Only available to logged in inspectors)
			        </span><br>{{ $row->memo }}</span><br>
			    @endif
				<br><br><br><br><br><br></div>			
			</tr>
		</table>	
	</div>
</div>
@endsection