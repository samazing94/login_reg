<!DOCTYPE html>
<html>
<head>
<title>Laravel</title>
<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1">

<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script
	src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet"
	href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet"
	href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
<script
	src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<style>
</style>
<body>
	<div class="container ">
	
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
					<td >{{$user->id}}</td>
					<td>{{$user->name}}</td>
					<td>{{$user->created_at}}</td>
					<td>{{$user->updated_at}}</td>
					<td><button class="edit-modal btn btn-info"
							value="{{$user->id}},{{$user->name}}">
							<span class="glyphicon glyphicon-edit"></span> Edit
						</button>
						<button class="delete-modal btn btn-danger"
							value="{{$user->id}},{{$user->name}}">
							<span class="glyphicon glyphicon-trash"></span> Delete
						</button></td>
				</tr>
				@endforeach
			</table>
		</div>
	</div>
	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" role="form">
						{!! csrf_field() !!}
							<div class="form-group">
								<input type="hidden" name="_token" value="{{ Session::token() }}">
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
	<script>
  $(document).ready(function() {
	$('#table').DataTable();
} );
  </script>

	<script>
	
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
		console.log($(this).val());
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

function fillmodaluser(details){
	$('#fid').val(details[0]);
	$('#name').val(details[1]);
}

	$('.modal-footer').on('click', '.edit', function() {
		
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			type: 'post',
			url: '../public/editItem',
			user: {
				'_token': $('input[name=_token]').val(),
				'id': $("#fid").val(),
				'name': $('#name').val()
			},
			success: function(user) {
				if (user.errors){
					$('#myModal').modal('show');
					if(user.errors.name) {
						$('.name_error').removeClass('hidden');
						$('.name_error').text("Name can't be empty !");
					}
					if(user.errors.email) {
						$('.email_error').removeClass('hidden');
						$('.email_error').text("Email must be a valid one !");
					}
				}
				 else {
					 
					 $('.error').addClass('hidden');
				$('.user' + users.id).replaceWith("<tr class='users" + users.id + "'><td>" +users.id + "</td><td>" + users.name+"</td><td>" + "</td><td>" + "</td><td><button class='edit-modal btn btn-info' user-info='" + users.id+","+users.name+"'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' user-info='" + users.id+","+users.name+"' ><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");

				 }}
		});
	});
	$('.modal-footer').on('click', '.delete', function() {
	
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
	
		$.ajax({
			type: 'post',
			url: '../public/deleteItem',
			  headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			user: {
				'_token': $('input[name=_token]').val(),
				'id': $('.did').text()
			},
			success: function(user) {
				$('.user' + $('.did').text()).remove();
			}
		});
	});
</script>

</body>
</html>

