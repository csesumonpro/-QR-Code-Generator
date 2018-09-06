<?php
/**
 * @package Modern QRCode Generator
	@version 1.0
 */
/*
Plugin Name: Modern QR Code Generator
Plugin URI: http://www.sumin-it.com/qr-code-generator
Description: Generate a QR code for any web site link or any url.
Version: 1.0
Author: Sumon Sarker
Author URI: http://www.sumon-it.com/
License: GPLv2 or later
Text Domain: qrcode
*/

//Make Sure the plugins Runs Only WordPress
if(!function_exists('add_action')){
    echo "Hi there! please run only WordPress.........";
    exit;
}

//IF SomeOne Directly access plugin file
if(!defined('ABSPATH')){
    exit;
}
//Require All of necessary File

require_once (plugin_dir_path(__FILE__).'inc/modern_qr_code_plugin_activation_deactivation.php');
require_once (plugin_dir_path(__FILE__).'class/ModernQrCode.php');

if ( !defined( 'QR_MODE_NUL' ) ){
    require_once (plugin_dir_path(__FILE__).'inc/main/qrlib.php');
}
//Hook
register_activation_hook( __FILE__, 'modern_qr_code_plugin_activation');
register_deactivation_hook( __FILE__,  'modern_qr_code_plugin_deactivation');

//Register Modern Qr Code Widget
add_action( 'widgets_init', function(){
	register_widget( 'ModernQrCode' ); // ModernQrCode =>class name
});
