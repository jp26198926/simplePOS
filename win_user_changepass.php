<div class="modal fade" id="win_user_changepass" data-keyboard="false" data-backdrop="static" >
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">				
				<h4 class="modal-title" style='font-weight: bold;'>
					<span class='fa fa-user'> </span>
					Change Password
					<input type='hidden' id='user_hidden_id' />
				</h4>
				
			</div>   
            <div class="modal-body">
				<div class='row'>
					<div class='col-md-6'>
						<label style='font-weight:normal;'>New Password</label>
						<input type='password' id='txt_newpass' class='form-control' />
					</div>
					<div class='col-md-6'>
						<label style='font-weight:normal;'>Re-Enter Password</label>
						<input type='password' id='txt_re-newpass' class='form-control' />
					</div>
				</div>
            </div>
			<div class="modal-footer">				
				<div class="buttons_show pull-right">
					<button type="button" id="user_changepass_save" class="btn btn-success" ><span class='fa fa-check'></span> Save </button>
					<button type="button" class="btn btn-warning" data-dismiss="modal" ><span class='fa fa-times'> Cancel</button>  
				</div>
				
				<div class="pull-left error_show" style="display:none;">
					<div class="alert alert-danger  alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
						<i class="fa fa-times"></i> <span class="error_msg" ></span>
					</div>
				</div>
				
				<div  class="progress progress_show" style="display:none;">
                    <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
                        Request is being processed... Please wait!
                    </div>
                </div>
				
			</div>
        </div>
    </div>
</div>