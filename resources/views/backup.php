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