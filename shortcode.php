<?php 

function customer_form_shortcode($atts) { 
    $wporg_atts = shortcode_atts(
		array(
			'name_label' =>  'Name',
      'phone_label' => 'Phone Number',
      'email_address_label' => 'Email Address',
      'desired_budget_label' => 'Desired Budget',
      'message_label' => 'Message',
      'name_maxlength' => '',
      'phone_maxlength' => '',
      'email_maxlength' => '',
      'desired_budget_maxlength' => '',
      'message_maxlength' => '',
      'rows' => '',
      'cols' => ''
		), $atts
	);
	$return = '<form id="customer-form" class="customer-form" method="post">
      <input type="hidden" id="ajaxurl" value="'.admin_url('admin-ajax.php').'">
      <div class="res-message"></div>
      <div class="form-group">
        <label for="name">'.$wporg_atts['name_label'].'</label> 
        <input type="text" class="form-control" id="name" maxlength="'.$wporg_atts['name_maxlength'].'" required>
      </div>
      <div class="form-group">
        <label for="phone">'.$wporg_atts['phone_label'].'</label>
        <input type="text" class="form-control" id="phone" maxlength="'.$wporg_atts['phone_maxlength'].'" required>
      </div>
      <div class="form-group">
        <label for="email">'.$wporg_atts['email_address_label'].'</label>
        <input type="email" class="form-control" id="email" maxlength="'.$wporg_atts['email_maxlength'].'" required>
      </div>
      <div class="form-group">
        <label for="budget">'.$wporg_atts['desired_budget_label'].'</label>
        <input type="text" class="form-control" id="budget" maxlength="'.$wporg_atts['desired_budget_maxlength'].'" required>
      </div>
      <div class="form-group">
        <label for="message">'.$wporg_atts['message_label'].'</label>
        <textarea class="form-control" id="message" name="message" maxlength="'.$wporg_atts['message_maxlength'].'" rows="'.$wporg_atts['rows'].'" cols="'.$wporg_atts['cols'].'" required></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>';

  return $return;
}
add_shortcode('customer-form', 'customer_form_shortcode'); 