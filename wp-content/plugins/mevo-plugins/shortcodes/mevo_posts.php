<?php
/**
*
* Posts
* @since 1.0.0
*
*/
function mevo_posts( $atts, $content = '', $id = '' ) {

    extract( shortcode_atts( array(
        'cats'            => '',
		'portfolio_cats'  => '',
		'limit' 	      => '',
        'post_type'       => 'post',
        'filter'          => '',
        'lightbox'        => '',
        'portfolio_style' => 'classic',
        'filter_position' => ''
		), $atts ) );

	$category = '';

    // Blog by category.
	if ( ! empty( $cats) && $post_type == 'post' ) {
        $category = array(
            'taxonomy' => 'category',
            'field'    => 'term_id',
            'terms'    => explode( ',', $cats )
        );
    }

    // Portfolio by category.
    if ( ! empty( $portfolio_cats) && $post_type == 'portfolio' ) {
        $category = array(
            'taxonomy' => 'portfolio-category',
            'field'    => 'term_id',
            'terms'    => explode( ',', $portfolio_cats )
        );
	}

	$args = array(
        'post_type'      => $post_type,
        'posts_per_page' => $limit,
        'tax_query' => array(
            $category
        )
    );

    $item_classes = array( 2, 6, 4, 2, 2, 2, 4, 2, 4 );
    $desinged_classes = array( 6, 3, 3, 6, 3, 6, 3, 3, 3, 6, 3, 3, 3, 3 );
    $counter = 0;

    $post = new WP_Query( $args );

    $output = '';
    $categories = get_terms( 'portfolio-category', '' );
    $style_4 = ( $portfolio_style == 'modern' ) ? 'style-4' : '';
    $style_4 = ( $portfolio_style == 'designed' ) ? 'style-2' : $style_4;
    $no_padding = ( $portfolio_style == 'modern' ) ? 'no-padding' : '';

    if( $post_type == 'post' ) {
        // Blog.
        $output .= '<div class="block-list">';
    } else {
        // Portfolio.
        $output .= '<div class="filter ' . $style_4 . ' ' . $filter_position . '">';
        if( $filter == 'yes' && $portfolio_style != 'modern' ) {
            $output .= '<ul class="nav filter-nav">';
            $output .= '<li class="selected"><a href="#all" data-filter="*">all</a></li>';
            if( $categories ) {
                foreach ( $categories as $fc ) {
                    if( ! empty( $portfolio_cats ) ) {
                        if( in_array($fc->term_id, explode( ',', $portfolio_cats) ) ) {
                            $output .= '<li><a href="#' . $fc->slug . '" data-filter=".' . $fc->slug . '">' . $fc->name . '</a></li>';
                        }
                    } else {
                        $output .= '<li><a href="#' . $fc->slug . '" data-filter=".' . $fc->slug . '">' . $fc->name . '</a></li>';
                    }
                }
            }
            $output .= '</ul>';
        }
        $output .= '<div class="row">';
        $output .= '<div class="filter-content">';
        if( $portfolio_style == 'classic' ) {
            $output .= '<div class="grid-sizer col-mob-12 col-xs-6 col-sm-6 col-md-4"></div>';
        } 
        if( $portfolio_style == 'modern' ) {
            $output .= '<div class="grid-sizer no-padding col-mob-12 col-xs-6 col-sm-6 col-md-2"></div>';
        }
        if( $portfolio_style == 'creative' ) {
            $output .= '<div class="grid-sizer col-mob-12 col-xs-6 col-sm-6 col-md-3"></div>';
        }
        if( $portfolio_style == 'designed' ) {
            $output .= '<div class="grid-sizer no-padding col-mob-12 col-xs-6 col-sm-6 col-md-3"></div>';
        }
    }

    if ( $post->have_posts() ) while ( $post->have_posts() ) : $post->the_post();


        // Get portfolio categories for filter.
        $portfolio_category = '';
        if ( $post_type == 'portfolio' && $filter == 'yes' && $portfolio_style != 'modern' ) {
            $categories = get_the_terms( $post->ID , 'portfolio-category' );
            if( $categories ) {
                foreach ( $categories as $categorsy ) {
                    $portfolio_category .= strtolower( $categorsy->slug ) . ' ';
                }
            }
        }

        if( $post_type == 'portfolio' ) {
            // Portfolio
            $counter = ( $portfolio_style == 'modern' && count( $item_classes ) == $counter ) ? 0 : $counter;
            $counter = ( $portfolio_style == 'designed' && count( $desinged_classes ) == $counter ) ? 0 : $counter;
            $item_size = ( $portfolio_style == 'modern' ) ? $item_classes[$counter] : 4;
            $item_size = ( $portfolio_style == 'designed' ) ? $desinged_classes[$counter] : $item_size;

            $img_url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
            $the_cat = array();
            $terms = get_the_terms( $post->ID , 'portfolio-category' );
            if( ! empty( $terms ) ) {
                foreach ( $terms as $term ) {
                    $the_cat[] = $term->name;
                }
            }
            $the_cat = implode(' / ', $the_cat);
            $portfolio_link = ( $lightbox == 'yes' ) ? get_the_permalink() : $img_url;
            $lightbox = ( $lightbox == 'yes' ) ? '' : 'class="lightbox"';
            $xs_size = ( $portfolio_style == 'designed' ) ? 12 : 6;

            if( $portfolio_style != 'creative' ) {
                $output .= '<div class="item ' . $portfolio_category . ' ' . $no_padding . ' col-mob-12 col-xs-' . $xs_size . ' col-sm-6 col-md-' . $item_size . '">';
                $output .= '<a ' . $lightbox . ' href="' . $portfolio_link . '">';
                $output .= '<img class="img-responsive img-full" src="' . $img_url . '" alt="' . get_the_title() . '" data-author="' . $the_cat . '">';
                $output .= '<div class="item-hovered">';
                $output .= '<div class="hovered-bg table-view">';
                $output .= '<div class="cell-view">';
                $output .= ( $portfolio_style == 'modern' ) ? '<img src="' . get_template_directory_uri() . '/assets/images/icon_plus.png" alt="">' : '';
                $output .= ( $portfolio_style != 'modern' ) ? '<div class="work-title">' . get_the_title() . '</div>' : '';
                $output .= ( ! empty( $the_cat ) && $portfolio_style != 'modern' ) ? '<div class="work-category">' . $the_cat . '</div>' : '';
                $output .= '</div>';
                $output .= '</div>';
                $output .= '</div>';
                $output .= '</a>';
                $output .= '</div>';
            } else {
                $output .= '<div class="filter style-3 item ' . $portfolio_category . ' col-mob-12 col-xs-6 col-sm-6 col-md-3">';
                $output .= '<a ' . $lightbox . ' href="' . $portfolio_link . '">';
                $output .= '<div class="image-box">';
                $output .= '<img class="img-responsive img-full" src="' . $img_url . '" alt="The Project Title" data-author="' . $the_cat . '">';
                $output .= '<div class="item-hovered"></div>';
                $output .= '</div>';
                $output .= '<div class="work-desc">';
                $output .= '<div class="work-title">' . get_the_title() . '</div>';
                $output .= '<div class="work-category">' . $the_cat . '</div>';
                $output .= '</div> ';
                $output .= '</a>';
                $output .= '</div>';
            }

            $counter++;

        } else {
            // Blog
            include ABSPATH . 'wp-content/plugins/mevo-plugins/lib/aq_resizer.php';

            $img_url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
            $cell_class = ( ! empty( $img_url ) ) ? 5 : 2;
            $content_class = 12 - $cell_class;

            $output .= '<div class="block-list-item">';
            $output .= '<div class="row">';
            $output .= '<div class="col-xs-12 col-sm-' . $cell_class . '">';
            $output .= '<div class="post-date">' . strtoupper( get_the_time( 'M, d' ) ) . '<br /> ' . get_the_time( 'Y' ) . '</div>';
            $output .= ( ! empty( $img_url ) ) ? '<div class="post-icon"><a href="' . get_the_permalink() . '"><img src="' . aq_resize( $img_url, 250, 250, true, true, true ) . '" alt=""></a></div>' : '';
            $output .= '</div>';
            $output .= '<div class="col-xs-12 col-sm-' . $content_class . '">';
            $output .= '<h3><a class="post-title" href="' . get_the_permalink() . '">' . get_the_title() . '</a></h3>';
            $output .= '<div class="post-intro">' . get_the_excerpt() . '</div>';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>';

        }

    endwhile;
    wp_reset_query();

    if( $post_type == 'post' ) {
        $output .= '</div>';
    } else {
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';
    }

    print $output;
}

add_shortcode( 'mevo_posts', 'mevo_posts' );
