       
    $(document).on('keypress','#txt_newpass, #txt_re-newpass',function(e){
          if (e.which==13) {
              $('#user_changepass_save').trigger('click');
          }
          
      });
      
      $(document).on('click','#user_changepass_save',function(e){
          e.preventDefault();
          var id=$("#user_hidden_id").val();
          var pass=$("#txt_newpass").val();
          var repass=$("#txt_re-newpass").val();
          
          if (pass && repass) {
              if (pass===repass) {
                  
                  $(".buttons_show, .error_show, .modal-body").css("display","none");                    
                  $(".progress_show").css("display","block");
                  
                  $.post("db_user.php",{action:5,id:id,pass:pass,repass:repass},function(data){
                      $(".buttons_show, .modal-body").css("display","block");                    
                      $(".progress_show, .error_show").css("display","none");
                      
                      if(data.indexOf("<!DOCTYPE html>")>-1){
                          alert("Error: Session Time-Out, You must login again to continue.");
                          location.reload(true);                     
                      }else if (data.indexOf("Error: ")>-1) {
                          $(".error_show").css("display","block");
                          $(".error_msg").text(data);
                          $("#txt_newpass").select().focus();
                      }else{                          
                            
                          $("#win_user_changepass").modal('hide');
                            
                          $('[data-toggle="tooltip"]').tooltip({html:true});
                          
                      }
                  });
              }else{
                  $(".error_show").css("display","block");
                  $(".error_msg").text("Error: Password does not match!");
                  $("#txt_newpass").select().focus();
              }              
          }else{
              $(".error_show").css("display","block");
              $(".error_msg").text("Error: All fields are required!");
              $("#txt_newpass").select().focus();
          }
      });
    
      $(document).on("click",".changepass",function(e){
          e.preventDefault();
          var id = $(this).attr('id');
          
          $("#user_hidden_id").val(id);
          $("#win_user_changepass").modal();
      });
      
      $('#win_user_changepass').on('shown.bs.modal', function () {
          $('#txt_newpass').focus();
      })