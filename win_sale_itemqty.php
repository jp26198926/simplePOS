<div class="modal fade" id="win_sale_itemqty" data-keyboard="true" data-backdrop="static" tabindex="-1"  >
    <div class="modal-dialog modal-sm" >
        <div class="modal-content">
            <div class="modal-header">				
				<h4 class="modal-title" style='font-weight: bold;'>
					<span class='fa fa-shopping-cart  fa-fw'> </span>
					Update QTY
				</h4>
				<input type='hidden' class='hidden_sale_itemid' />
			</div>   
            <div class="modal-body">				
				<div class='row'>					
					<div class='col-md-12'>
						<label style='margin-top: 0.5em;font-weight: normal;'>Quantity  <span style='color:red'>*</span></label>
						<div class="input-group">
							<input type='text' id='txt_sale_itemqty' placeholder='0.00' class='form-control text-right numeric'  />
							<span class="input-group-addon">/ <span id='lbl_sale_itemuom'></span></span>							
						</div>
					</div>
				</div>	
            </div>
			<div class="modal-footer">
				<div class="buttons_show pull-right">
					<button type="button" id="btn_sale_itemqty_save" class="btn btn-success" ><span class='fa fa-check'></span> Save </button>
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