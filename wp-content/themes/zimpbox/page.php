<?php
/**
 * Custom Page Template
 *
 * @package mevo
 * @since 1.0
 *
 */
global $mevo;
get_header(); ?>
	<div id="content-wrapper">
		<?php
	    if ( get_option('show_on_front') == 'page' && $mevo['site_type'] == 'onepage' ) {
	        get_template_part( 'page-format/page', 'onepage' );
	    } else {
	        get_template_part( 'page-format/page', 'multipage' );
	    }
	    ?>
	</div>
<?php get_footer(); ?>
