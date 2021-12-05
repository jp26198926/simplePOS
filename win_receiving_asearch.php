<div class="modal fade" id="win_receiving_asearch" data-keyboard="false" data-backdrop="static" tabindex="-1"  >
    <div class="modal-dialog modal-lg" >
        <div class="modal-content">
            <div class="modal-header">				
				<h4 class="modal-title" style='font-weight: bold;'>
					<span class='fa fa-search-plus fa-fw'> </span>
					Advanced Search (Receiving)
				</h4>
				<input type='hidden' class='hidden_product_id' />
			</div>   
            <div class="modal-body">
				<div class='row'>
					<div class='col-md-6'>
						<label style='margin-top: 0.5em; font-weight: normal;'>Product Code</label>
						<input type='text' id='txt_receiving_asearch_code' class='form-control txt-receiving-asearch' />
					</div>
					<div class='col-md-6'>
						<label style='margin-top: 0.5em; font-weight: normal;'>Product Name</label>
						<input type='text' id='txt_receiving_asearch_name' class='form-control txt-receiving-asearch'  />
					</div>
				</div>	
				<div class='row'>
					<div class='col-md-4'>
						<label style='margin-top: 0.5em; font-weight: normal;'>Date From</label>
						<input type='text' id='txt_receiving_asearch_dtfrom'  class='datepicker form-control txt-receiving-asearch' readonly />
					</div>
					<div class='col-md-4'>
						<label style='margin-top: 0.5em; font-weight: normal;'>Date To</label>
						<input type='text' id='txt_receiving_asearch_dtto'  class='datepicker form-control txt-receiving-asearch' readonly />
					</div>
					<div class='col-md-4'>
						<label style='margin-top: 0.5em;font-weight: normal;'>Supplier</label>	
						<input type='text' id='txt_receiving_asearch_supplier' class='form-control txt-receiving-asearch'  />
					</div>	
				</div>	
            </div>
			<div class="modal-footer">
				<div class="buttons_show pull-right">
					<button type="button" id="btn_receiving_asearch" class="btn btn-success" ><span class='fa fa-search'></span> Search </button>
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