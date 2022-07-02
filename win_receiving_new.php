<div class="modal fade" id="win_receiving_new" data-keyboard="false" data-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style='font-weight: bold;'>
                    <span class='fa fa-download fa-fw'> </span>
                    New Stock (Receiving)
                </h4>
                <input type='hidden' class='hidden_product_id' />
            </div>
            <div class="modal-body">
                <div class='row'>
                    <div class='col-md-6'>
                        <label style='margin-top: 0.5em; font-weight: normal;'>Product Code <span
                                style='color:red'>*</span></label>
                        <input type='text' id='txt_receiving_code' class='form-control txt-receiving' />
                    </div>
                    <div class='col-md-6'>
                        <label style='margin-top: 0.5em; font-weight: normal;'>Date Received <span
                                style='color:red'>*</span></label>
                        <input type='text' id='txt_receiving_dt' class='datepicker form-control' readonly />
                    </div>
                </div>
                <div class='row'>
                    <div class='col-md-12'>
                        <label style='margin-top: 0.5em; font-weight: normal;'>Product Name <span
                                style='color:red'>*</span></label>
                        <input type='text' id='txt_receiving_name' class='form-control txt-receiving' disabled />
                    </div>

                </div>

                <div class='row'>
                    <div class='col-md-4'>
                        <label style='margin-top: 0.5em; font-weight: normal;'>
                            Quantity
                            <span style='color:red'>*</span>
                        </label>
                        <div class="input-group">
                            <input type='text' id='txt_receiving_qty' placeholder='0.00'
                                class='form-control text-right txt-receiving numeric' />
                            <span class="input-group-addon">
                                <span id='txt_receiving_uom'></span>
                            </span>
                        </div>
                    </div>
                    <div class='col-md-4'>
                        <label style='margin-top: 0.5em; font-weight: normal;'>
                            Price (per Item)
                        </label>
                        <div class="input-group">
                            <input type='text' id='txt_receiving_price' placeholder='0.00'
                                class='form-control text-right txt-receiving numeric' />
                        </div>
                    </div>
                    <div class='col-md-4'>
                        <label style='margin-top: 0.5em; font-weight: normal;'>
                            Total
                        </label>
                        <div class="input-group">
                            <input type='text' id='txt_receiving_total' placeholder='0.00'
                                class='form-control text-right txt-receiving numeric' disabled />
                        </div>
                    </div>
                </div>

                <div class='row'>
                    <div class='col-md-12'>
                        <label style='margin-top: 0.5em;font-weight: normal;'>
                            Supplier
                            <span style='color:red'>*</span>
                        </label>

                        <select id='txt_receiving_supplier' class='form-control'>
                            <option value='0'> -- Supplier -- </option>
                            <?php
								include('connect.php');
								$sql = "Select id, supplier from pos_supplier order by supplier;";
								$exec = $mysqli->query($sql);
								if ($exec){
									while($row=$exec->fetch_object()){
										$id = $row->id;
										$supplier = $row->supplier;										
										echo "<option value='{$id}'>{$supplier}</option>";
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
                    <button type="button" id="btn_receiving_save" class="btn btn-success"><span
                            class='fa fa-check'></span> Save </button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal"><span class='fa fa-times'>
                            Close</button>
                </div>

                <div class="pull-left error_show" style="display:none;">
                    <div class="alert alert-danger  alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                        <i class="fa fa-times"></i> <span class="error_msg"></span>
                    </div>
                </div>

                <div class="pull-left success_show" style="display:none;">
                    <div class="alert alert-success  alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                        <i class="fa fa-times"></i> <span class="success_msg"></span>
                    </div>
                </div>

                <div class="progress progress_show" style="display:none;">
                    <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar"
                        aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
                        Request is being processed... Please wait!
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>