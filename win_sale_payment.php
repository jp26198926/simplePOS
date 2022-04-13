<div class="modal" id="win_sale_payment" data-keyboard="true" data-backdrop="static" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" style='font-weight: bold;'>
					<span class='fa fa-shopping-cart  fa-fw'> </span>
					Payment
				</h4>
			</div>
			<div class="modal-body">
				<div class='row'>
					<div class="col-sm-12 text-center mb-4 fa-2x">
						<?php
						include('connect.php');
						$sql = "SELECT * FROM pos_payment_type WHERE status_id=1 ORDER BY payment_type;";
						$pop = $mysqli->query($sql);
						if ($pop) {
							while ($row = $pop->fetch_object()) {
								$id = $row->id;
								$type = $row->payment_type;

								echo "
										<div class='radio radio-inline' >
											<input type='radio' name='radio_payment_type' id='payment_type_{$id}' value='{$id}'>
											<label id='payment_type_label_{$id}' for='payment_type_{$id}'>
												{$type}
											</label>
										</div>
									";
							}
						} else {
							echo "Error: " . $mysqli->error;
						}
						$mysqli->close();
						?>

					</div>
				</div>
				<div class="row">
					<div class="col-sm-5 text-right fa-2x">
						Amount Due
					</div>
					<div class="col-sm-7 text-right fa-2x">
						<input type='text' id='txt_amount_due' class='numeric form-control text-right' placeholder="0.00" disabled />
					</div>
				</div>
				<div class="row" id="container_tender" style="display:none">
					<div class="col-sm-5 text-right fa-2x">
						Tender
					</div>
					<div class="col-sm-7 text-right fa-2x">
						<input type='text' id='txt_cash' class='numeric form-control text-right' placeholder="0.00" value="0.00" />
					</div>
				</div>

				<div class="row text-danger" id="container_change" style="display:none">
					<div class="col-sm-5 text-right fa-2x">
						Change
					</div>
					<div class="col-sm-7 text-right fa-2x">
						<span class="sign"><?= trim($app_currency) ? strtoupper($app_currency[0]) : ""; ?> </span><span id='lbl_change'>0.00</span>
					</div>
				</div>

				<div class="row" id="container_reference" style="display:none">
					<div class="col-sm-5 text-right fa-2x">
						Reference
					</div>
					<div class="col-sm-7 text-right fa-2x">
						<textarea id='txt_reference' class='form-control'></textarea>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="buttons_show pull-right">
					<button type="button" id="btn_sale_save" class="btn btn-success" style="display:none"><span class='fa fa-check'></span> Save </button>
					<button type="button" class="btn btn-warning" data-dismiss="modal"><span class='fa fa-times'> Cancel</button>
				</div>

				<div class="pull-left error_show" style="display:none;">
					<div class="alert alert-danger  alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
						<i class="fa fa-times"></i> <span class="error_msg"></span>
					</div>
				</div>

				<div class="progress progress_show" style="display:none;">
					<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
						Request is being processed... Please wait!
					</div>
				</div>

			</div>
		</div>
	</div>
</div>