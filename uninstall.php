<?php

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

$options = get_site_option( 'r3df_multisite_language_indicator_global' );

if ( $options && is_multisite() ) {
	// Delete widget settings option from options table
	if ( $options['cleanup_on_deactivate'] ) {
		foreach ( wp_get_sites() as $site ) {
			delete_blog_option( $site['blog_id'], 'r3df_multisite_language_indicator' );
		}
	}
	// Delete the user settings
	global $wpdb;
	$wpdb->query( $wpdb->prepare( "DELETE FROM $wpdb->usermeta WHERE meta_key = %s", 'r3df_multisite_language_indicator' ) );
}
