@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" />
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Dashboard</div>

				<div class="card-body">
					<div class="row">
						<table class="table table-bordered" id="pageTable">
							<thead>
								<tr>
									<th>Name</th>
									<th>Created At</th>
									<th>Updated At</th>
									<th>Actions</th>
								</tr>
							</thead>

								<tbody>
									@foreach ($users as $user)
									<tr>
										<td>
											{{ $user->name }}
										</td>
										<td>
											{{ $user->created_at }}
										</td>
										<td>
											{{ $user->updated_at }}
										</td>
										<td>
											<button class="edit-modal btn btn-info"
											data-info="{{ $user->id }},{{ $user->name }}, {{ $user->password }}, {{$user->email}}">
											<span class="glyphicon glyphicon-edit"></span> Edit
											</button>
											<button class="delete-modal btn btn-danger"
												data-info="{{ $user->id }},{{ $user->name }}, {{ $user->password }}, {{$user->email}}">
											<span class="glyphicon glyphicon-trash"></span> Delete
											</button>
										</td>
									</tr>
									@endforeach
								</tbody>
						</table>
					</div>
					<!-- x -->
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
										<div class="form-group">
											<label class="control-label col-sm-2" for="id">ID</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="id" disabled>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-2" for="name">Name</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="name">
											</div>
										</div>
										<p class="lname_error error text-center alert alert-danger hidden"></p>
										<div class="form-group">
											<label class="control-label col-sm-2" for="email">Email</label>
											<div class="col-sm-10">
												<input type="email" class="form-control" id="email">
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
					<!-- x -->
				</div>
			</div>
		</div>
	</div>
</div>
@stop
@section('scripts')
<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src ="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"></script>
<script src ="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css"></script>
<script>
	jQuery(function($) {
	//initiate dataTables plugin
	var myTable = 
	$('#pageTable')
	//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
	.DataTable( {
		bAutoWidth: false,
		"aoColumns": [
			null,
			null,
			null,
			null
		],
		"aaSorting": [],
		
		
		//"bProcessing": true,
		//"bServerSide": true,
		//"sAjaxSource": "http://127.0.0.1/table.php"   ,

		//,
		//"sScrollY": "200px",
		//"bPaginate": false,

		//"sScrollX": "100%",
		//"sScrollXInner": "120%",
		//"bScrollCollapse": true,
		//Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
		//you may want to wrap the table inside a "div.dataTables_borderWrap" element

		//"iDisplayLength": 50


			select: {
				style: 'multi'
			}
		});
	    
	});

</script>

