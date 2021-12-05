<div class="modal fade" id="win_price_add" data-keyboard="false" data-backdrop="static" tabindex="-1"  >
    <div class="modal-dialog modal-md" >
        <div class="modal-content">
            <div class="modal-header">				
				<h4 class="modal-title" style='font-weight: bold;'>
					<span class='fa fa-cube'> </span>
					Add / Set Price
				</h4>
				<input type='hidden' class='hidden_product_id' />
				<input type='hidden' class='hidden_buyer_id' />
			</div>   
            <div class="modal-body">
				<div class='row'>
					<div class='col-md-6'>
						<label style='margin-top: 0.5em; font-weight: normal;'>Product Code</label>
						<input type='text' id='txt_price_productcode' class='form-control' disabled />
					</div>
					<div class='col-md-6'>
						<label style='margin-top: 0.5em; font-weight: normal;'>Product Name</label>
						<input type='text' id='txt_price_productname' class='form-control' disabled />
					</div>	
				</div>
				
				<div class='row'>
					<div class='col-md-6'>
						<label style='margin-top: 0.5em; font-weight: normal;'>Buyer Type</label>
						<input type='text' id='txt_price_buyer' class='form-control' disabled />
					</div>
					
					<div class='col-md-6'>
						<label style='margin-top: 0.5em; font-weight: normal;'>Amount <span style='color:red'>*</span></label>						
						<div class="input-group">
							<input type='text' id='txt_price_amount' placeholder='0.00' class='form-control text-right txt-price numeric' />
							<span class="input-group-addon">/ <span id='txt_price_uom'></span></span>							
						</div>
					</div>					
				</div>
            </div>
			<div class="modal-footer">
				<div class="buttons_show pull-right">
					<button type="button" id="btn_price_save" class="btn btn-success" ><span class='fa fa-check'></span> Save </button>
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