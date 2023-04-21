<?php 
add_action( 'add_meta_boxes', 'load_meta_box' );
function load_meta_box(){
    add_meta_box( 'cmb_meta', __( 'Customer Detail', 'lead-generation' ), 'cmb_meta_callback', 'lg-customers' );
}

// The metabox content
function cmb_meta_callback($post){
    wp_nonce_field( basename( __FILE__ ), 'lg_post_class_nonce' ); ?>
    <p>
        <label for="lg-post-class"><?php _e( "Phone Number", 'lead-generation' ); ?></label>
        <br />
        <input class="widefat" type="text" name="phone_number" id="lg-post-class" value="<?php echo esc_attr( get_post_meta( $post->ID, 'phone_number', true ) ); ?>" />
    </p>
    <p>
        <label for="lg-post-class"><?php _e( "Email Address", 'lead-generation' ); ?></label>
        <br />
        <input class="widefat" type="email" name="email_address" id="lg-post-class" value="<?php echo esc_attr( get_post_meta( $post->ID, 'email_address', true ) ); ?>" />
    </p>
    <p>
        <label for="lg-post-class"><?php _e( "Desired Budget", 'lead-generation' ); ?></label>
        <br />
        <input class="widefat" type="text" name="desired_budget" id="lg-post-class" value="<?php echo esc_attr( get_post_meta( $post->ID, 'desired_budget', true ) ); ?>" />
    </p>
    <p>
        <label for="lg-post-class"><?php _e( "Message", 'lead-generation' ); ?></label>
        <br />
        <textarea class="widefat" rows="5" name="message"><?php echo esc_attr( get_post_meta( $post->ID, 'message', true ) ); ?></textarea>
    </p><?php 
}

add_action( 'save_post', 'customer_save_post_class_meta' );
function customer_save_post_class_meta($post_id){
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	global $post;
    if(isset($post->post_type)){
        if( $post->post_type == "lg-customers" ) {
        	if (isset( $_POST ) ) {
    		    update_post_meta($post->ID, 'phone_number', $_POST['phone_number']);
    		    update_post_meta($post->ID, 'email_address', $_POST['email_address']);
    		    update_post_meta($post->ID, 'desired_budget', $_POST['desired_budget']);
    		    update_post_meta($post->ID, 'message', $_POST['message']);
    		}
    	}
    }
}