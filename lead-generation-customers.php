<?php 
/**
 * Lead Generation
 *
 * @package       LeadGeneration
 * @author        Developer
 * @version       1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:   Lead Generation
 * Plugin URI:    
 * Description:   
 * Version:       1.0.0
 * Author:        Developer
 * Author URI:    
 * Text Domain:   lead-generation
 * Domain Path:   /languages 
 * License:       GPLv2
 * License URI:   https://www.gnu.org/licenses/gpl-2.0.html
 *  
*/

/* Exit if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) exit;

define( 'LG_PLUGIN', __FILE__ );
define( 'LG_PLUGIN_BASENAME', plugin_basename( LG_PLUGIN ) );
define( 'LG_PLUGIN_URL', plugins_url('', __FILE__) );
define( 'LG_PLUGIN_BASE_PATH', plugin_dir_path(__FILE__) );

if( !class_exists( 'leadGeneration' ) ) {   
    class LeadGeneration {
        //Load actions
        public function __construct() {
            //add_action('plugins_loaded', array($this, 'lead_generation_load_textdomain') );
            add_action( 'init', array($this, 'customers_register_post_type') );
            add_action( 'wp_enqueue_scripts', array($this, 'admin_scripts') );
            add_action( 'wp_ajax_nopriv_add_customer', array( $this, 'add_customer' ) );
            add_action( 'wp_ajax_add_customer', array( $this, 'add_customer' ) );
        }

        public function admin_scripts() {
            wp_enqueue_style('theme-override', LG_PLUGIN_URL . '/css/custom.css', array(), '0.1.0', 'all');
            wp_enqueue_script( 'custom', LG_PLUGIN_URL . '/js/custom.js', array( 'jquery' ), null, true );
        }

        /* The code for Load text-domain */
        public function lead_generation_load_textdomain() {
            $result = load_plugin_textdomain( 'lead-generation', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
        }

        // customers post type
        public function customers_register_post_type() {
            $labels = array( 
                'name' => __( 'Customers' , 'lead-generation' ),
                'singular_name' => __( 'Customer' , 'lead-generation' ),
                'add_new' => __( 'New Customer' , 'lead-generation' ),
                'add_new_item' => __( 'Add New Customer' , 'lead-generation' ),
                'edit_item' => __( 'Edit Customer' , 'lead-generation' ),
                'new_item' => __( 'New Customer' , 'lead-generation' ),
                'view_item' => __( 'View Customer' , 'lead-generation' ),
                'search_items' => __( 'Search Customers' , 'lead-generation' ),
                'not_found' =>  __( 'No Customers Found' , 'lead-generation' ),
                'not_found_in_trash' => __( 'No Customers found in Trash' , 'lead-generation' ),
            );

            $args = array(
                'labels' => $labels,
                'has_archive' => true,
                'public' => true,
                'hierarchical' => false,
                'supports' => array(
                    'title'
                ),
                'rewrite'   => array( 'slug' => 'lgcustomers' ),
                'show_in_rest' => false
            );

            register_post_type( 'lg-customers', $args );
        }


        //Add Customer
        public function add_customer()
        {
            $data = $_POST;

            $wordpress_post = array(
                'post_title' => $data['name'],
                'post_status' => 'private',
                'post_type' => 'lg-customers'
            );
             
            $post_id = wp_insert_post( $wordpress_post );
            add_post_meta($post_id, 'phone_number', $data['phone']);
            add_post_meta($post_id, 'email_address', $data['email']);
            add_post_meta($post_id, 'desired_budget', $data['budget']);
            add_post_meta($post_id, 'message', $data['message']);

            wp_send_json_success( __( 'Successfully added customer!', 'lead-generation' ) );
        }
    }
}

global $LeadGeneration;
$LeadGeneration = new LeadGeneration();

require_once LG_PLUGIN_BASE_PATH.'post-metabox.php';
require_once LG_PLUGIN_BASE_PATH.'shortcode.php';