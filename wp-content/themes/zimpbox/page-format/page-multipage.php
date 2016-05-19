<?php
/**
 * Custom Multypage Template
 *
 * @package mevo
 * @since 1.0
 *
 */
while ( have_posts() ) : the_post();
	$content = get_the_content();
	if ( ! stristr( $content, 'vc_' ) ) {
		mevo_set_post_views( get_the_ID() );
		$comments_count = wp_count_comments( get_the_ID() );
		?>
		<div class="block">
            <div class="container">
                <div class="row">
                    <div class="blog-wrapper col-xs-12 col-sm-12">
                        <div class="row">
                            <div class="col-xs-12 col-sm-10">
                                <div class="blog-title">
                                    <h2><?php the_title(); ?></h2>
                                    <div class="blog-date"><span><?php the_time( get_option('date_format') ); ?></span> / <?php echo esc_html( $comments_count->total_comments );?> <?php esc_html_e( 'COMMENTS', 'mevo' ); ?> / <?php echo esc_html( mevo_get_post_views( get_the_ID() ) ); ?> <?php esc_html_e( 'VIEWS', 'mevo' ); ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="blog-content">
                            <?php the_post_thumbnail(); ?>
                            <?php the_content(); ?>
                            <?php wp_link_pages('before=<div class="post-nav"> <span>' . esc_html__( 'Page', 'mevo' ) . ': </span> &after=</div>'); ?>
                        </div>
                        <?php if ( comments_open() || get_comments_number() ) { ?>
                            <div class="comment-block">
                                <?php comments_template( '', true ); ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
	<?php } else { ?>
        <div class="container">
    		<?php the_content(); ?>
        </div>
	<?php }
endwhile;
?>
