jQuery('#customer-form').on('submit', function(e){
    var name = jQuery("#name").val();
    var phone = jQuery("#phone").val();
    var email = jQuery("#email").val();
    var budget = jQuery("#budget").val();
    var message = jQuery("#message").val();
    var ajaxurl = jQuery("#ajaxurl").val();
    jQuery.ajax({ 
         data: {action: 'add_customer', name:name, phone:phone, email:email, budget:budget, message:message},
         type: 'post',
         url: ajaxurl,
         success: function(data) {
            if(data.success == true){
                jQuery('.res-message').html(data.data);
                jQuery('#customer-form')[0].reset();
            }

        }
    });
    return false;
});