<div class="modal fade" id="win_sale_discount" data-keyboard="true" data-backdrop="static" tabindex="-1"  >
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">				
				<h4 class="modal-title" style='font-weight: bold;'>
					<span class='fa fa-shopping-cart  fa-fw'> </span>
					Sale Discount
				</h4>				
			</div>   
            <div class="modal-body">
				<div class='row'>
					<div class='col-md-6'>
						<label style='margin-top: 0.5em;font-weight: normal;'>Discount Type  <span style='color:red'>*</span></label>
						<select id='txt_sale_discount_type' class='form-control'>
							<option value='0'>No Discount</option>
							<?php
								include('connect.php');
								$sql = "SELECT * FROM pos_transaction_discount ORDER BY discount_type;";
								$pop = $mysqli->query($sql);
								if ($pop){
									while($row=$pop->fetch_object()){
										$id = $row->id;
										$type = $row->discount_type;
										
										echo "<option value='{$id}'>{$type}</option>";										
									}
								}else{
									echo "Error: " . $mysqli->error;
								}
								$mysqli->close();
							?>
						</select>
					</div>
					<div class='col-md-6'>
						<label style='margin-top: 0.5em;font-weight: normal;'>Value  <span style='color:red'>*</span></label>
						<div class="input-group">
							<input type='text' id='txt_sale_discount_value' placeholder='0.00' class='text-right form-control text-right numeric'  />												
						</div>
					</div>
				</div>
				<div class='row'>					
					<div class='col-md-12'>						
						<div class="input-group">
							<span class="input-group-addon text-success">TOTAL DISCOUNT ( <span class="sign">K </span>)</span>
							<input type='text' id='txt_sale_discount_total' placeholder='0.00' class='text-right form-control text-right numeric' disabled='disabled' />														
						</div>
					</div>
				</div>	
            </div>
			<div class="modal-footer">
				<div class="buttons_show pull-right">
					<button type="button" id="btn_sale_discount_save" class="btn btn-success" ><span class='fa fa-check'></span> Save </button>
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