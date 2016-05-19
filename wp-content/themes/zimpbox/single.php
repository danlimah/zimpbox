<?php
/**
* Single post
*
* @package mevo
* @since 1.0
*
*/
global $mevo;
$sidebar = ( ! empty( $mevo['sidebar'] ) && in_array( 'post', $mevo['sidebar'] ) && is_active_sidebar( 'sidebar' ) ) ? true : false;
$content_class_size = ( $sidebar ) ? 9 : 12;
$blog_url = home_url( '/' );

if( get_option( 'show_on_front' ) == 'page' ) {
    $blog_url = get_permalink( get_option( 'page_for_posts' ) );
}

get_header();

while ( have_posts() ) : the_post();
    mevo_set_post_views( get_the_ID() );
    $comments_count = wp_count_comments( get_the_ID() );
?>
    <div id="content-wrapper" class="inner-page">
        <div class="block">
            <div class="container">
                <?php if( $mevo['single_breadcrumbs'] ) { ?>
                <ul class="breadcrumbs">
                    <li><a href="<?php echo esc_url( $blog_url );?>"><?php esc_html_e( 'blog', 'mevo' ); ?></a></li>
                    <li><?php the_title(); ?></li>
                </ul>
                <?php } ?>
                <div class="row">
                    <div class="blog-wrapper col-xs-12 col-sm-<?php echo esc_attr( $content_class_size );?>">
                        <div class="row">
                            <div class="col-xs-12 col-sm-10">

                            </div>
                        </div>
                        <div class="blog-content">
                            <?php the_post_thumbnail(); ?>
                            <div class="blog-title">
                                <h2><?php the_title(); ?></h2>
                                <div class="blog-date"><span><?php the_time( get_option('date_format') ); ?></span><?php //echo esc_html( $comments_count->total_comments );?> <?php //esc_html_e( 'COMMENTS', 'mevo' ); ?> <?php //echo esc_html( mevo_get_post_views( get_the_ID() ) ); ?> <?php //esc_html_e( 'VIEWS', 'mevo' ); ?></div>
                            </div>
                            <?php the_content(); ?>
                            <?php wp_link_pages('before=<div class="post-nav"> <span>' . esc_html__( 'Page:' ,'mevo') . '</span> &after=</div>'); ?>
                            <?php $tags = get_the_tags(); if( ! empty( $tags ) ) { ?>

                            <?php } ?>
                            <div>

                            </div>

                        </div>
                      
                    </div>
                    <?php if( $sidebar ) { ?>
                    <div class="right-sidebar col-xs-12 col-sm-3">
                        <?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar('sidebar') ); ?>
                    </div>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php endwhile; ?>
<?php get_footer(); ?>
