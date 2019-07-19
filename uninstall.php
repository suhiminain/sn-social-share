<?php
/**
* Plugin Name: SN Social Share
* Plugin URI: https://github.com/suhiminain/sn-social-share
* Description: simple social share icon for genesis framework
* Version: 1.0.0
* Author: Suhimi Nain
* Author URI: https://www.suhiminain.com/
*
* Text Domain: sn-social-share
* @license  http://www.opensource.org/licenses/gpl-license.php GPL-2.0+
**/

if(! defined('WP_UNINSTALL_PLUGIN')){
	die;
}

// Access the database via SQL
global $wpdb;

$wpdb->query( "DELETE FROM wp_options WHERE option_name LIKE 'sn_social_share%' ");

?>
