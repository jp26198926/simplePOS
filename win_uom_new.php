<div class="modal fade" id="win_uom_new" data-keyboard="false" data-backdrop="static" tabindex="-1"  >
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">				
				<h4 class="modal-title" style='font-weight: bold;'>
					<span class='fa fa-random fa-fw'> </span>
					New Unit of Measurement (UOM)
				</h4>
				
			</div>   
            <div class="modal-body">
				<div class='row'>
					<div class='col-md-4'>
						<label style='margin-top: 0.5em; font-weight: normal;'>UOM (3 chars max)<span style='color:red'>*</span></label>
						<input type='text' id='txt_uom_abbrevation' placeholder='Ex: kg, pc, etc..' class='txt-uom txt-upper form-control' />
					</div>
					<div class='col-md-8'>
						<label style='margin-top: 0.5em;font-weight: normal;'>Description  <span style='color:red'>*</span></label>
						<input type='text' id='txt_uom_description' placeholder='Ex: Kilogram, Piece, etc..' class='form-control' />
					</div>
				</div>				
            </div>
			<div class="modal-footer">
				<div class="buttons_show pull-right">
					<button type="button" id="btn_uom_save" class="btn btn-success" ><span class='fa fa-check'></span> Save </button>
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