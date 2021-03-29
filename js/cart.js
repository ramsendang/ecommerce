function manageCart(pid,type){
    if(type=='update'){
        var qty = jQuery("#"+pid+'qty').val();
    }else{
        var qty = jQuery("#qty").val();
    }
    
    jQuery.ajax({
        url:'set_cart.php',
        type: 'POST',
        data: 'pid='+pid+'&qty='+qty+'&type='+type,
        success: function(result){
            if(type=='update' || type=='remove'){
                window.location.href=window.location.href;
            }
            jQuery('.htc__qua').html(result);
        }
    });
}

