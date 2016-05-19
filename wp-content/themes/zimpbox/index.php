<?php
/**
 * Index
 *
 * @package mevo
 * @since 1.0
 *
 */
global $mevo;
$sidebar = ( ! empty( $mevo['sidebar'] ) && in_array( 'blog', $mevo['sidebar'] ) && is_active_sidebar( 'sidebar' ) ) ? true : false;
$content_class_size = ( $sidebar ) ? 9 : 12;
get_header();?>
<div id="content-wrapper" class="inner-page">
    <div class="container">
      <div class="wpb_wrapper"><h2 class="block-title" style="color: #000000;">Blog</h2></div>
        <?php if ( have_posts() ) : ?>
            <?php $comments_count = wp_count_comments( get_the_ID() ); ?>
            <div class="row">
                <div class="blog-wrapper col-xs-12 col-sm-<?php echo esc_attr( $content_class_size );?>">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <div <?php post_class('row'); ?>>
                            <div class="col-xs-12 col-sm-10">

                            </div>
                        </div>
                        <div class="blog-content">
                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
                            <div class="blog-title">
                                <a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
                                <!-- <div class="blog-date"><span><?php the_time( get_option('date_format') ); ?></span> / <?php echo esc_html( $comments_count->total_comments );?> <?php esc_html_e( 'COMMENTS', 'mevo' ); ?> / <?php echo esc_html( mevo_get_post_views( get_the_ID() ) ); ?> <?php esc_html_e( 'VIEWS', 'mevo' ); ?></div> -->
                            </div>
                            <?php the_excerpt(); ?>
                            <p>
                              <a href="<?php the_permalink(); ?>">LEIA A POSTAGEM COMPLETA</a>
                            </p>
                        </div>
                    <?php endwhile; ?>
                </div>
                <?php if( $sidebar ) { ?>
                    <div class="right-sidebar col-xs-12 col-sm-3">
                        <?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar('sidebar') ); ?>
                    </div>
                <?php } ?>
            </div>
        <?php
        $paginate_links = paginate_links();
        if ( $paginate_links ) { ?>
            <div id="pager">
                <?php print paginate_links(); ?>
            </div>
        <?php } ?>
        <?php else : ?>
            <div class="empty-post-list">
                <p><?php esc_html_e('Sorry, no posts matched your criteria.', 'mevo' ); ?></p>
                <?php get_search_form( true ); ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php get_footer(); ?>
