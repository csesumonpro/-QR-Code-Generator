<?php
/**
 * @package Modern QRCode Generator
	@version 1.0
 */
//Activation and Deactivation function

	 function modern_qr_code_plugin_activation(){
		if(version_compare(get_bloginfo('version'),'4.0.0','<=')){
        wp_die('Please Update Your WordPress Version. Your need at least 4.0 or above for acyivate this plugin..!');
		}
	}
    function modern_qr_code_plugin_deactivation(){
        delete_option('rewrite_rules');
    }

?>