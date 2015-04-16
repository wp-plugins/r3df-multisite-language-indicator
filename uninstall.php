<?php

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

$options = get_option( 'r3df_multisite_language_indicator' );

if ( $options && is_multisite() ) {
	// Delete widget settings option from options table
	if ( $options['cleanup_on_deactivate'] ) {
		foreach ( wp_get_sites() as $site ) {
			switch_to_blog( $site['blog_id'] );
			delete_option( 'r3df_multisite_language_indicator' );
			restore_current_blog();
		}
	}
} elseif ( $options ) {
	// Delete widget settings option from options table
	if ( $options['cleanup_on_deactivate'] ) {
		delete_option( 'r3df_multisite_language_indicator' );
	}
}
