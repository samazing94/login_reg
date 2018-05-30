@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Dashboard</div>

				<div class="card-body">
					@if (session('status'))
						<div class="alert alert-success">
							{{ session('status') }}
						</div>
					@endif
					<h1> Hello, {{ Auth::user()->username}} </h1>
					<p>You are logged in!</p>
					<table id="pageTable" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>User</th>
									<th>Name</th>
									<th>Email</th>
								</tr>
							</thead>

							<tbody>
								<tr>
									<td>
										{{ Auth::user()->username }}
									</td>
									<td>
										{{ Auth::user()->name }}
									</td>
									<td>
										{{ Auth::user()->email }}
									</td>
								</tr>
							</tbody>
						</table>
						<a href="{{ url('dt') }}">Check list of other users</a>
					</div>
				</section>
			</div>
@endsection
@section('scripts')
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/jquery.dataTables.bootstrap.min.js') }}"></script>
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
