<?php

if(! defined('WP_UNINSTALL_PLUGIN')){
	die;
}

// Access the database via SQL
global $wpdb;

$wpdb->query( "DELETE FROM wp_options WHERE option_name LIKE 'sn_social_share%' ");

?>
