<div class="modal fade" id="win_transaction_details" data-keyboard="false"  tabindex="-1"  >
    <div class="modal-dialog modal-lg" >
        <div class="modal-content">
            <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" style='font-weight: bold;'>
					<span class='fa fa-briefcase fa-fw'> </span>
					Transaction Details
				</h4>
				<input type='hidden' class='hidden_tran_id' />
				
			</div>   
            <div class="modal-body">
				<div class='row'>
					<div class='col-sm-6'>
						<div class='row'>
							<div class='col-sm-4 text-right'><label>Receipt No.</label></div>
							<div class='col-sm-8 text-left'>	
								<span id="tran_details_receipt">000000</span>
							</div>
						</div>
						<div class='row'>
							<div class='col-sm-4 text-right'><label>DateTime</label></div>
							<div class='col-sm-8 text-left'>	
								<span id="tran_details_dt">YYYY-MM-DD HH:MM:SS</span>
							</div>
						</div>
						<div class='row'>
							<div class='col-sm-4 text-right'><label>Cashier</label></div>
							<div class='col-sm-8 text-left'>	
								<span id="tran_details_cashier">User User</span>
							</div>
						</div>
						<div class='row'>
							<div class='col-sm-4 text-right'><label>Status</label></div>
							<div class='col-sm-8 text-left'>	
								<span id="tran_details_status">Status</span>
							</div>
						</div>
						<div class='row'>
							<div class='col-sm-4 text-right'><label>Remarks</label></div>
							<div class='col-sm-8 text-left'>	
								<span id="tran_details_remarks">Remarkssdfa sdfasfas fas fasdf asdf asdfa sdf adsf asdf asdfa sfasd fasdf asdfasdfasdfasdfadf</span>
							</div>
						</div>
					</div>
					
					<div class='col-sm-6'>
						<div class='row'>
							<div class='col-sm-6 text-right'><label>Sub-Total</label></div>
							<div class='col-sm-6 text-right'>	
								<span id="tran_details_subtotal">0.00</span>
							</div>	
						</div>
						<div class='row'>
							<div class='col-sm-6 text-right'><label>Discount Type</label></div>
							<div class='col-sm-6 text-right'>	
								<span id="tran_details_discounttype">0.00</span>
							</div>	
						</div>
						<div class='row'>
							<div class='col-sm-6 text-right'><label>Discount Value</label></div>
							<div class='col-sm-6 text-right'>	
								<span id="tran_details_discountqty">0.00</span>
							</div>	
						</div>
						<div class='row'>
							<div class='col-sm-6 text-right'><label>Total Discount</label></div>
							<div class='col-sm-6 text-right'>	
								<span id="tran_details_discount">0.00</span>
							</div>	
						</div>
						<div class='row'>
							<div class='col-sm-6 text-right'><label>Amount Due</label></div>
							<div class='col-sm-6 text-right'>	
								<span id="tran_details_amountdue">0.00</span>
							</div>	
						</div>
						<div class='row'>
							<div class='col-sm-6 text-right'><label>Cash</label></div>
							<div class='col-sm-6 text-right'>	
								<span id="tran_details_cash">0.00</span>
							</div>
						</div>
						<div class='row'>
							<div class='col-sm-6 text-right'><label>Change</label></div>
							<div class='col-sm-6 text-right'>	
								<span id="tran_details_change">0.00</span>
							</div>	
						</div>
					</div>
				</div>
				<div class='row' style='max-height:30em; overflow-y:scroll;'>
					<table id='transaction_details_list' class='table table-striped table-bordered table-hover'>
						<thead>
							<tr>
								<th>#</th>
								<th>Qty</th>
								<th>Item</th>
								<th>Buyer Type</th>
								<th>Price</th>
								<th>Discount</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody>
							
						</tbody>
					</table>
				</div>
            </div>
			<div class="modal-footer">
				<div class="buttons_show pull-right">					
					<button type="button" class="btn btn-warning" data-dismiss="modal" ><span class='fa fa-times'> Close</button>  
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