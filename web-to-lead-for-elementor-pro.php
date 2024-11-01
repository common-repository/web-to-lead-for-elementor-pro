<?php
/*
Plugin Name: Web-to-Lead for Elementor Pro
Plugin URI: https://github.com/studiocotton/web-to-lead-for-elementor-pro
Description: Adds Web-to-Lead to your Actions After Submit in the Elementor Pro Form widget.
Version: 1.0.0
Author: Studio Cotton
Author URI: https://studiocotton.co.uk
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: web-to-lead-for-elementor-pro
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

add_action( 'elementor_pro/forms/actions/register', function( $form_actions_registrar ) {
    require_once( __DIR__ . '/includes/class-web-to-lead-for-elementor-pro.php' );
    $form_actions_registrar->register( new \WTLEP_Web_To_Lead_Elementor_Pro() );
} );
