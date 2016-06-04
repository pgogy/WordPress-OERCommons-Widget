<?php

/*
Plugin Name: OER Commons Widget
Description: Facilitates the display of OER Commons Content, developed as part of the World War One Continuations and Beginnings project at the University of Oxford
Version: 0.3
Author: pgogy
Author URI: http://www.pgogy.com
Plugin URI: http://www.pgogy.com/code/groups/wordpress/oer-commons-widget/
*/
 
require_once( 'oer_commons_widget_ajax.php' ); 

add_action("wp_head","oer_commons_widget_add_scripts");		
	
function oer_commons_widget_add_scripts(){
	
	?><script type='text/javascript' src='<?PHP echo site_url(); ?>/wp-includes/js/jquery/jquery.js'></script>
	<link rel="stylesheet" href="<?PHP echo plugins_url("/css/oer_commons_widget.css" , __FILE__ ); ?>" />
	<script type="text/javascript" language="javascript" src="<?PHP echo plugins_url("/js/oer_commons_widget.js" , __FILE__ ); ?>"></script>
	<script type="text/javascript" language="javascript">
	var ajaxurl = '<?PHP echo site_url(); ?>/wp-admin/admin-ajax.php';	
	</script>
	<?PHP
	
}
 

function oer_commons_widget() {
	require_once( 'oer_commons_widget_class.php' );
	register_widget( 'oer_commons_widget' );
}
add_action( 'widgets_init', 'oer_commons_widget', 1 );


?>