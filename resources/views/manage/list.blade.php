@extends('layout')

@section('title')

	{{ $title }}

@endsection

@section('content')

	<!-- display user list -->
	<div class="table-responsive text-center">
		<table class="table table-borderless" id="table">

			<thead>
				<tr>
					<th class="text-center">ID</th>
					<th class="text-center">Name</th>
					<th class="text-center">Created At</th>
					<th class="text-center">Updated At</th>
					<th class="text-center">Actions</th>
				</tr>
			</thead>

			@foreach($users as $user)

			<tr class="user{{$user->id}}">
				<td>{{$user->id}}</td>
				<td class="name">{{$user->name}}</td>
				<td>{{$user->created_at}}</td>
				<td class="updated_at">{{$user->updated_at}}</td>
				<td>
					<button class="edit-modal btn btn-info" value="{{$user->id}},{{$user->name}}">
						<span class="glyphicon glyphicon-edit"></span> Edit
					</button>
					<button class="delete-modal btn btn-danger" value="{{$user->id}},{{$user->name}}">
						<span class="glyphicon glyphicon-trash"></span> Delete
					</button>
				</td>
			</tr>

			@endforeach

		</table>
	</div>

	<!-- modal content -->
	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"></h4>
				</div>

				<div class="modal-body">

					<form class="form-horizontal" role="form">
						<div class="form-group">
							<label class="control-label col-sm-2" for="id">ID</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="fid" disabled>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="name">Name</label>
							<div class="col-sm-10">
								<input type="name" class="form-control" id="name">
							</div>
						</div>
					</form>

					<div class="deleteContent">
						Are you Sure you want to delete <span class="dname"></span> ? <span
						class="hidden did"></span>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn actionBtn" data-dismiss="modal">
							<span id="footer_action_button" class='glyphicon'> </span>
						</button>
						<button type="button" class="btn btn-warning" data-dismiss="modal">
							<span class='glyphicon glyphicon-remove'></span> Close
						</button>
					</div>

				</div>

			</div>
		</div>
	</div>

@endsection

@section('script')

	var table = $('#table').DataTable();
	
	$(document).on('click', '.edit-modal', function() {
		$('#footer_action_button').text("Update");
		$('#footer_action_button').addClass('glyphicon-check');
		$('#footer_action_button').removeClass('glyphicon-trash');
		$('.actionBtn').addClass('btn-success');
		$('.actionBtn').removeClass('btn-danger');
		$('.actionBtn').removeClass('delete');
		$('.actionBtn').addClass('edit');
		$('.modal-title').text('Edit');
		$('.deleteContent').hide();
		$('.form-horizontal').show();
		var stuff = $(this).val().split(',');
		fillmodaluser(stuff)
		$('#myModal').modal('show');
	});

	$(document).on('click', '.delete-modal', function() {
		$('#footer_action_button').text(" Delete");
		$('#footer_action_button').removeClass('glyphicon-check');
		$('#footer_action_button').addClass('glyphicon-trash');
		$('.actionBtn').removeClass('btn-success');
		$('.actionBtn').addClass('btn-danger');
		$('.actionBtn').removeClass('edit');
		$('.actionBtn').addClass('delete');
		$('.modal-title').text('Delete');
		$('.deleteContent').show();
		$('.form-horizontal').hide();
		var stuff = $(this).val().split(',');
		console.log($(this).val('info'));
		$('.did').text(stuff[0]);
		$('.dname').html(stuff[1]);
		$('#myModal').modal('show');
	});

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
	});

	$('.modal-footer').on('click', '.edit', function() {

		$.ajax({
			type: 'post',
			url: "{{ url('/manage/update') }}",
			data: {
				'id'  : $('#fid').val(),
				'name': $('#name').val()
			},
			success: function(response) {
				$('.user' + response.id).find('.name').text(response.name);
				$('.user' + response.id).find('.updated_at').text(response.updated_at);
			}
		});
	});

	$('.modal-footer').on('click', '.delete', function() {
	
		$.ajax({
			type: 'post',
			url: "{{ url('/manage/delete') }}",
			data: {
				'id': $('.did').text()
			},
			success: function(response) {
				table
					.row( $('.user' + response.id) )
					.remove()
					.draw();
			}
		});
	});

	function fillmodaluser(details){
		$('#fid').val(details[0]);
		$('#name').val(details[1]);
	}

@endsection