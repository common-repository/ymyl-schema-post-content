<?php

if ( !defined( 'WP_UNINSTALL_PLUGIN' ) )

	exit();



function delete_ymyl_schema_post_plugin() {

	delete_option( 'ymyl-schema-post-plugin' );

}



delete_ymyl_schema_post_plugin();

