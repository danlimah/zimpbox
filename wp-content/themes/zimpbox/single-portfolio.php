<?php
/**
* Single post
*
* @package mevo
* @since 1.0
*
*/
global $mevo;
$portfolio_page_url = '<a href="' . esc_url( $mevo['portfolio_page_url'] ) . '">' . esc_html__( 'Work', 'mevo' ) . '</a>';

get_header();

while ( have_posts() ) : the_post();
    mevo_set_post_views( get_the_ID() );
    $comments_count = wp_count_comments( get_the_ID() );
?>
    <div id="content-wrapper" class="inner-page">
        <div class="block">
            <div class="container">
                <?php if( ! empty( $mevo['portfolio_page_url'] ) ) { ?>
                    <ul class="breadcrumbs">
                        <li><?php print $portfolio_page_url;?></li>
                        <li><?php esc_html_e( 'single item', 'mevo');?></li>
                    </ul>
                <?php } ?>
                <div class="row">
                    <div class="blog-wrapper col-xs-12 col-sm-12">
                        <div class="row">
                            <div class="col-xs-12 col-sm-10">
                                <div class="blog-title">
                                    <h2><?php the_title(); ?></h2>
                                    <?php
                                        $cats = array();
                                        $terms = get_the_terms( $post->ID , 'portfolio-category' );
                                        if( ! empty( $terms ) ) { ?>
                                            <div class="blog-date"><span>
                                            <?php foreach ( $terms as $term ) {
                                                $cats[] = $term->name;
                                        } 
                                        $cats = implode(' / ', $cats);
                                        echo esc_html( $cats );
                                        ?>
                                        </span></div>
                                    <?php } ?>
                                </div>                            
                            </div>
                        </div>
                        <div class="blog-content">
                            <?php the_post_thumbnail(); ?>
                            <?php the_content(); ?>
                            <?php wp_link_pages('before=<div class="post-nav"> <span>' . esc_html__( 'Page', 'mevo' ) . ': </span> &after=</div>'); ?>
                        </div>
                    </div>
                </div>        
            </div>
        </div>
    </div>
<?php endwhile; ?>
<?php get_footer(); ?>