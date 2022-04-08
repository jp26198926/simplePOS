<div class="modal fade" id="win_product_asearch" data-keyboard="false" data-backdrop="static" tabindex="-1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" style='font-weight: bold;'>
					<span class='fa fa-search-plus'> </span>
					Advance Search Product
				</h4>
			</div>
			<div class="modal-body">
				<div class='row'>
					<div class='col-md-6'>
						<label style='margin-top: 0.5em; font-weight: normal;'>Product Code</label>
						<input type='text' id='txt_product_code_asearch' class='form-control txt-product-asearch' />
					</div>
					<div class='col-md-6'>
						<label style='margin-top: 0.5em; font-weight: normal;'>Product Name</label>
						<input type='text' id='txt_product_name_asearch' class='form-control txt-product-asearch' />
					</div>
				</div>
				<div class='row'>
					<div class='col-md-6'>
						<label style='margin-top: 0.5em;font-weight: normal;'>UOM</label>
						<select id='txt_product_uom_asearch' class='form-control txt-product-asearch'>
							<option value='0'> -- UOM -- </option>
							<?php
							include('connect.php');
							$sql = "Select * from pos_uom order by uom;";
							$exec = $mysqli->query($sql);
							if ($exec) {
								while ($row = $exec->fetch_object()) {
									$id = $row->id;
									$uom = $row->uom;
									$des = $row->description;
									echo "<option value='{$id}'>{$uom} - {$des}</option>";
								}
							} else {
								echo "Error: " . $mysqli->error;
							}
							$mysqli->close();
							?>
						</select>
					</div>
					<div class='col-md-6'>
						<label style='margin-top: 0.5em;font-weight: normal;'>Category </label>
						<select id='txt_product_category_asearch' class='form-control txt-product-asearch'>
							<option value=''> -- All -- </option>
							<?php
							include('connect.php');
							$sql = "Select * from pos_category order by category;";
							$exec = $mysqli->query($sql);
							if ($exec) {
								while ($row = $exec->fetch_object()) {
									$id = $row->id;
									$category = $row->category;
									echo "<option value='{$id}'>{$category}</option>";
								}
							} else {
								echo "Error: " . $mysqli->error;
							}
							$mysqli->close();
							?>
						</select>
					</div>
				</div>

				<div class='row'>
					<div class='col-md-6'>
						<label style='margin-top: 0.5em; font-weight: normal;'>Product Price</label>
						<input type='text' id='txt_product_price_asearch' class='form-control txt-product-asearch' />
					</div>

					<div class='col-md-6'>
						<label style='margin-top: 0.5em;font-weight: normal;'>Status</label>
						<select id='txt_product_status_asearch' class='form-control txt-product-asearch'>
							<option value='0'> -- UOM -- </option>
							<?php
							include('connect.php');
							$sql = "Select * from pos_product_status order by status;";
							$exec = $mysqli->query($sql);
							if ($exec) {
								while ($row = $exec->fetch_object()) {
									$id = $row->id;
									$status = $row->status;
									echo "<option value='{$id}'>{$status}</option>";
								}
							} else {
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
					<button type="button" id="btn_product_asearch" class="btn btn-success"><span class='fa fa-check'></span> Search </button>
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