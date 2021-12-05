<div class="modal fade" id="win_transaction_cancel" data-keyboard="false" data-backdrop="static" tabindex="-1"  >
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">				
				<h4 class="modal-title" style='font-weight: bold;'>
					<span class='fa fa-briefcase fa-fw'> </span>
					Cancel Transaction
				</h4>
				<input type='hidden' class='hidden_tran_id' />
				
			</div>   
            <div class="modal-body">
				<div class='row'>
					<div class='col-md-12'>
						<span class='fa fa-question-circle fa-fw fa-2x'></span>
						Are you sure you want to cancel the Receipt #: <span class='tran_receipt' style='color:red; font-weight: bold;'></span> ?
					</div>
				</div>
				<div class='row' style='margin-top: 0.5em;'>
					<div class='col-md-3 text-right'>
						<span>Reason<span class='asterisk'></span>:</span>
					</div>
					<div class='col-md-9'>
						<textarea id='tran_cancel_reason' class='form-control' placeholder='Provide Reason'>
							
						</textarea>
					</div>
				</div>	
            </div>
			<div class="modal-footer">
				<div class="buttons_show pull-right">
					<button type="button" id="btn_transaction_cancel" class="btn btn-success" ><span class='fa fa-check'></span> Confirm </button>
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