<?php

// If uninstall is not called from WordPress, exit
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit();
}
 
$option_name[] = 'xchanger_source';
$option_name[] = 'xchanger_class';
 
foreach($option_name as $key=>$val) {
delete_option( $val );
}

// For site options in Multisite
//delete_site_option( $option_name );  
 
// Drop a custom db table
//global $wpdb;
//$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}mytable" );