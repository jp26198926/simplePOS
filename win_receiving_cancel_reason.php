<div class="modal fade" id="win_receiving_cancel_reason" data-keyboard="false" data-backdrop="static" tabindex="-1"  >
    <div class="modal-dialog " >
        <div class="modal-content">
            <div class="modal-header">				
				<h4 class="modal-title" style='font-weight: bold;'>
					<span class='fa fa-times-circle fa-fw text-danger'> </span>
					Cancel Transaction (Receiving)
				</h4>
				<input type='hidden' class='hidden_receiving_id' />
			</div>   
            <div class="modal-body">
				<div class='row'>
					<div class='col-md-12'>
						<label >Product : <span id='txt_product_info' style='font-weight:normal;'></span></label>						
					</div>
				</div>
				<div class='row'>
					<div class='col-md-12'>
						<label style='margin-top: 0.5em; font-weight: normal;'>Cancel Reason <span style='color:red'>*</span></label>
						<textarea id='txt_receiving_cancel_reason' class='form-control' rows='3' placeholder='Enter you reason here'></textarea>
					</div>
				</div>
				
            </div>
			<div class="modal-footer">
				<div class="buttons_show pull-right">
					<button type="button" id="btn_receiving_save_cancel" class="btn btn-success" ><span class='fa fa-check'></span> Save </button>
					<button type="button" class="btn btn-warning" data-dismiss="modal" ><span class='fa fa-times'> Close</button>  
				</div>
				
				<div class="pull-left error_show" style="display:none;">
					<div class="alert alert-danger  alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
						<i class="fa fa-times"></i> <span class="error_msg" ></span>
					</div>
				</div>
				
				<div class="pull-left success_show" style="display:none;">
					<div class="alert alert-success  alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
						<i class="fa fa-times"></i> <span class="success_msg" ></span>
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