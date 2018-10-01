@extends('layouts.front')

@section('content')
<div class="all_faq_list_cont">
		<div class="container">
			<div class="box box-primary box-solid">
				<div class="box-header with-border">
					<h3>
						<span><i class="fa fa-table"></i> List All Faqs</span>
					</h3>
				</div>

				<div class="box-body">

					<table id="tbl-list" data-server="false" class="dt-table table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
                            <th>Question</th>
                            <th>Answer</th>
                            <th>Category</th>
                            <th>Totals</th>
                            <th>Updated</th>
                            <th>Action</th>
						</tr>
						</thead>
						<tbody>
						@foreach ($items as $item)
							<tr>
                                <td>{{ $item->question }}</td>
                                <td>{!! $item->answer_summary !!}</td>
                                <td>{!! $item->category->name !!}</td>
                                <td>
                                    <span title="Total Reads" data-toggle="tooltip" class="label label-info"><i class="fa fa-eye"></i> {{ $item->total_read }}</span>
                                    <span title="Helpful Yes" data-toggle="tooltip" class="label label-success"><i class="fa fa-thumbs-up"></i> {{ $item->helpful_yes }}</span>
                                    <span title="Helpful No" data-toggle="tooltip" class="label label-danger"><i class="fa fa-thumbs-up"></i> {{ $item->helpful_no }}</span>
                                </td>
                                <td>{{ date_format($item->updated_at, "Y/m/d H:i:s") }}</td>
                                <td>
                                	<button data-url="{{ url('/faqs/'.$item->id.'') }}/show" class="btn btn-info common" id="show">Show</button>

                                	<button data-url="{{ url('/faqs/'.$item->id.'') }}/edit" class="btn commonedit" data-toggle="modal" data-target="#myModal" id="edit">Edit</button>

                                	<button data-url="{{ url('/faqs/'.$item->id.'') }}/delete" class="btn btn-danger deletecommon" data-toggle="modal" data-target="#myModal" id="delete">Delete</button>

                                </td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<script src="{{ asset('js/jquery.min.js') }}"></script>
	<script type="text/javascript">
		$(document).ready(function(e){
			$('.common, .commonedit').click(function(event) {
				event.preventDefault();
				var url = $(this).attr('data-url');
				var btnId = $(this).attr('id');
				$('.loader').fadeIn(400);
				var token = $('meta[name="csrf-token"]').attr('content');
				$.ajax({
					url: url,
					method : "POST",
					data : {_token: $('meta[name="csrf-token"]').attr('content')},
					dataType : "JSON",
					success:function(data) {
						$('.loader').fadeOut();
						console.log(data);
						
						alert(btnId);
						if(btnId == 'edit'){
							
							$('#myeditmode').modal('show');
							$('.modal-title-edit').text('Edit '+data.question);
							$('.modal-body-edit').prepend('<form method="POST" action="#">'+'<input type="hidden" value="'+token+'">');
							$('.QuestionClass').html(data.question);
							$('.AnswerClass').html(data.answer);
							$('#myModal').modal('toggle');
						}else{
							
							$('#myModal').modal('show');
							$('.modal-title').text(data.question);
							$('.bodycontent').text(data.answer);
							$('.total_read').text(' '+data.total_read);
							$('.helpful_yes').text(' '+data.helpful_yes);
							$('.helpful_no').text(' '+data.helpful_no);
							$('#myeditmode').modal('toggle');
						}
					}
				});
			});
		});
	</script>

@endsection

<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Modal Header</h4>
			</div>
			<div class="modal-body">
				<p class="bodycontent"></p>
				<div class="totalread">
					<span title="Total Reads" data-toggle="tooltip" class="label label-info"><i class="fa fa-eye total_read"></i></span>
	                <span title="Helpful Yes" data-toggle="tooltip" class="label label-success"><i class="fa fa-thumbs-up helpful_yes"></i></span>
	                <span title="Helpful No" data-toggle="tooltip" class="label label-danger"><i class="fa fa-thumbs-up helpful_no"></i></span>
               	</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div id="myeditmode" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title-edit">Modal Header</h4>
			</div>
			<div class="modal-body-edit">
				<form method="POST" action="#">
					@csrf
					<div>
						<textarea class="QuestionClass"></textarea>
					</div>
					<div>
						<textarea class="AnswerClass"></textarea>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>