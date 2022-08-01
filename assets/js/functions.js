    function showError(title,msg) {
        var txt =  "<div class='alert alert-danger role='alert'>";           
            txt += "  <strong><i class='fa fa-ban fa-2x'></i></strong> " + msg;
            txt += "</div>",
      
        BootstrapDialog.show({
            title: "<b style='color: grey;'>" + title + "</b>",
            message: txt, 
            type: BootstrapDialog.TYPE_WARNING, 
            closable: true, // <-- Default value is false
            buttons: [{                    
                label: 'OK',
                cssClass: 'btn-success', 
                autospin: false,
                action: function(dialogRef){    
                    dialogRef.close();
                }
            }]
        });
    }
    
    function showLock(title,msg) {
        var txt =  "<div class='alert alert-danger role='alert'>";           
            txt += "  <strong><i class='fa fa-ban fa-2x'></i></strong> " + msg;
            txt += "</div>",
      
        BootstrapDialog.show({
            title: "<b style='color: grey;'>" + title + "</b>",
            message: txt, 
            type: BootstrapDialog.TYPE_WARNING,
            closable: false
        });
    }  
    
    function getQoutes() {
          $.get("db_qoutes.php",function(data){
              if (data.indexOf("Error: ")>-1) {
                      
              }else{                      
                  data1 = data.split(":~:|:~:")[0];
                  data2 = data.split(":~:|:~:")[1];
                  data3 = data.split(":~:|:~:")[2];
                      
                  qoutes1 = data1.split(":~|~:")[0];
                  author1 = data1.split(":~|~:")[1];
                  qoutes2 = data2.split(":~|~:")[0];
                  author2 = data2.split(":~|~:")[1];
                  qoutes3 = data3.split(":~|~:")[0];
                  author3 = data3.split(":~|~:")[1];
                      
                  $(".qoutes_msg1").text(qoutes1);
                  $(".qoutes_author1").text(author1);
                  $(".qoutes_msg2").text(qoutes2);
                  $(".qoutes_author2").text(author2);
                  $(".qoutes_msg3").text(qoutes3);
                  $(".qoutes_author3").text(author3);                      
              }
          });
    }
    
    function str_pad(str, max, string_pad) {
        str = str.toString();
        return str.length < max ? str_pad(string_pad + str, max, string_pad) : str;
    }
    
    
    
    $(document).ready(function(){
      
        $('#quote-carousel').carousel({
            pause: true,
            interval: 4000,
        });
          
        getQoutes();
          
        setInterval(function() {
               getQoutes();
               current_product();
        }, 10000); //1 seconds
    });
    
    $(document).on('keyup','.txt-upper',function(e){
        $(this).val($(this).val().toUpperCase());
    })
    
    $(document).on('keypress','.numeric', function(e){       
          if ((e.which < 48 && e.which != 46) || e.which > 57) {
              return false;
          }else if (e.which == 46){
              if ($(this).val().indexOf('.') > -1) {
                  return false;
              }
          }
    });
      
    $(document).on('blur','.numeric',function(e){
        e.preventDefault();
        if ($(this).val().length == 0) {
            $(this).val('0.00');
        }
    });

    $(document).on('keypress','.numeric-with-negative', function(e){       
        if ((e.which < 48 && e.which != 46 && e.which != 45) || e.which > 57) {
            return false;
        }else if (e.which == 46){ //decimal
            if ($(this).val().indexOf('.') > -1) {
                return false;
            }
        }else if (e.which == 45){ //negative
            if ($(this).val().indexOf('-') > -1) {
                return false;
            }
        }
    });
      
    $(document).on('blur','.numeric-with-negative',function(e){
        e.preventDefault();
        if ($(this).val().length == 0) {
            $(this).val('0.00');
        }
    });
    
    function number_format(n, currency) {
      return currency + " " + n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
    }
    
    function computeDiscount(type,value,qty,price,total) {
        var discount_total = 0;
        switch (type) {
            case 0: //no discount
              value = 0;
              discount_total = 0;
              break;
            
            case 1: //percentage
              discount_total = (parseFloat(value)/100) * parseFloat(total);
              break;
            
            case 2: //unit price
              discount_total = (parseFloat(total) - (parseFloat(value) * parseFloat(qty)));
              break;
            
            case 3: //total price
              discount_total = value;
              break;
        }
        return discount_total;
    }
    
    $('[data-toggle="tooltip"]').tooltip({html:true});