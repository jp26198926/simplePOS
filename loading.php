<div class="modal fade" id="loading" data-keyboard="false" data-backdrop="static" style='z-index: 100028;' >
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">				
                <h4 class="modal-title" style='font-weight: bold;'>
                <span class='fa fa-refresh'> </span>                        
                    Loading...
                </h4>
            </div>   
            <div class="modal-body">
                
                <div class="progress">
                    <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
                        Request is being processed... Please wait!
                    </div>
                </div>
                
                <div>
                    <?php
                        include('qoutes.php');
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>