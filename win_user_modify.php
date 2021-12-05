<div class="modal fade" id="win_user_modify" data-keyboard="false" data-backdrop="static" >
    <div class="modal-dialog modal-lg" >
        <div class="modal-content">
            <div class="modal-header">				
				<h4 class="modal-title" style='font-weight: bold;'>
					<span class='fa fa-user'> </span>
					Update User
					<input type='hidden' class='user_hidden_id' />
				</h4>
				
			</div>   
            <div class="modal-body">
				<div class='row'>
					<div class='col-md-6'>
						<label style='margin-top: 0.5em;font-weight:normal;'>Username <span style='color:red'>*</span></label>
						<input type='text' id='txt_user_username_update' class='form-control txtuserupdate' />
					</div>
					<div class='col-md-6'>
						<label style='margin-top: 0.5em;font-weight:normal;'>Access Level <span style='color:red'>*</span></label>
						<select id='txt_user_access_update' class='form-control txtuserupdate'>
							<option value='0'> -- Select Access -- </option>
							<?php
								include('connect.php');
								$sql = "Select * from pos_access;";
								$exec = $mysqli->query($sql);
								if ($exec){
									while($row=$exec->fetch_object()){
										$aID = $row->id;
										$aAccess = $row->access_details;
										echo "<option value='{$aID}'>{$aAccess}</option>";
									}
								}else{
									echo "Error: " . $mysqli->error;
								}
								$mysqli->close();
							?>
						</select>
					</div>
				</div>
				
				<hr style='margin-top:0.8em' />
				<div class='row'>
					<div class='col-md-4'>
						<label style='margin-top: 0.5em;font-weight:normal;'>Lastname <span style='color:red'>*</span></label>
						<input type='text' id='txt_user_lname_update' class='form-control txtuserupdate' />
					</div>
					<div class='col-md-4'>
						<label style='margin-top: 0.5em;font-weight:normal;'>Firstname <span style='color:red'>*</span></label>
						<input type='text' id='txt_user_fname_update' class='form-control txtuserupdate' />
					</div>
					<div class='col-md-4'>
						<label style='margin-top: 0.5em;font-weight:normal;'>Middlename </label>
						<input type='text' id='txt_user_mname_update' class='form-control txtuserupdate' />
					</div>
				</div>
				<div class='row'>
					<div class='col-md-6'>
						<label style='margin-top: 0.5em;font-weight:normal;'>Email </label>
						<input type='text' id='txt_user_email_update' class='form-control txtuserupdate' />
					</div>
					<div class='col-md-6'>
						<label style='margin-top: 0.5em; font-weight:normal;'>Department <span style='color:red'>*</span></label>
						<select id='txt_user_dept_update' class='form-control txtuserupdate'>
							<option value='0'> -- Select Department -- </option>
							<?php
								include('connect.php');
								$sql = "Select * from pos_dept;";
								$exec = $mysqli->query($sql);
								if ($exec){
									while($row=$exec->fetch_object()){
										$dID = $row->id;
										$dept = $row->dept_name;
										echo "<option value='{$dID}'>{$dept}</option>";
									}
								}else{
									echo "Error: " . $mysqli->error;
								}
								$mysqli->close();
							?>
						</select>
					</div>
				</div>
            </div>
			<div class="modal-footer">
				
				<div class="buttons_show pull-right">
					<button type="button" id="btn_user_update" class="btn btn-success" ><span class='fa fa-check'></span> Save </button>
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