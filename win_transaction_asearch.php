<div class="modal fade" id="win_transaction_asearch" data-keyboard="false" data-backdrop="static" tabindex="-1"  >
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">				
				<h4 class="modal-title" style='font-weight: bold;'>
					<span class='fa fa-search-plus fa-fw'> </span>
					Advanced Search (Transaction)
				</h4>
				<input type='hidden' class='hidden_transaction_id' />
			</div>   
            <div class="modal-body">
				<div class='row'>
					<div class='col-md-6'>
						<label style='margin-top: 0.5em; font-weight: normal;'>Receipt #</label>
						<input type='text' id='txt_transaction_asearch_receipt' class='form-control txt-transaction-asearch' />
					</div>
					<div class='col-md-6'>
						<label style='margin-top: 0.5em; font-weight: normal;'>Cashier</label>
						<input type='text' id='txt_transaction_asearch_cashier' class='form-control txt-transaction-asearch'  />
					</div>
				</div>	
				<div class='row'>
					<div class='col-md-4'>
						<label style='margin-top: 0.5em; font-weight: normal;'>Date From</label>
						<input type='text' id='txt_transaction_asearch_dtfrom'  class='datepicker form-control txt-transaction-asearch' readonly />
					</div>
					<div class='col-md-4'>
						<label style='margin-top: 0.5em; font-weight: normal;'>Date To</label>
						<input type='text' id='txt_transaction_asearch_dtto'  class='datepicker form-control txt-transaction-asearch' readonly />
					</div>
					<div class='col-md-4'>
						<label style='margin-top: 0.5em;font-weight: normal;'>Status</label>	
						<select type='text' id='txt_transaction_asearch_status' class='form-control txt-transaction-asearch'>
							<option value='0' >ALL</option>
							<?php
								include('connect.php');
								
								$sql = "SELECT * FROM pos_transaction_status ORDER BY status;";
								$pop = $mysqli->query($sql);
								if ($pop){
									while($row=$pop->fetch_object()){
										$id = $row->id;
										$status = $row->status;
										
										echo "<option value='{$id}'>{$status}</option>";
									}
								}
								
								$mysqli->close();
							?>
						</select>
					</div>	
				</div>	
            </div>
			<div class="modal-footer">
				<div class="buttons_show pull-right">
					<button type="button" id="btn_transaction_asearch" class="btn btn-success" ><span class='fa fa-search'></span> Search </button>
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