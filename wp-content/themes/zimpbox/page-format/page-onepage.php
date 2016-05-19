<?php
/**
 * Onepage Template
 *
 * @package mevo
 * @since 1.0
 *
 */
global $mevo;

$args = array( 'post_type' => 'page', 'orderby' => 'menu_order', 'order' => 'ASC', 'posts_per_page' => -1 );
if ($mevo['onepage_type'] != 'all' && ! empty( $mevo['custom_page_list'] ) ) {
	$args = array( 'post_type' => 'page', 'orderby' => 'menu_order', 'post__in' => $mevo['custom_page_list'] );
}

$q = new WP_Query($args);

if ( $q->have_posts() ) : while (  $q->have_posts() ) :  $q->the_post(); ?>
	<div id="<?php echo esc_attr( $post->post_name );?>" class="container">
	    <?php the_content(); ?>
    </div>
<?php 
endwhile; endif; 
wp_reset_postdata();
?>