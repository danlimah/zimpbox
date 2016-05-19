<?php
/**
 * The template includes necessary functions for theme.
 *
 * @package mevo
 * @since 1.0
 */

 update_option('siteurl','http://www.zimpbox.com');
 update_option('home','http://www.zimpbox.com');

if ( ! isset( $content_width ) ) {
    $content_width = 960; /* pixels */
}

defined( 'T_URI' )  or define( 'T_URI',  get_template_directory_uri() );
defined( 'T_PATH' ) or define( 'T_PATH', get_template_directory() );
defined( 'F_PATH' ) or define( 'F_PATH', 'framework/cs-framework' );

// Framework integration
// ----------------------------------------------------------------------------------------------------
require_once T_PATH . '/framework/cs-framework/include/helper-functions.php';
require_once T_PATH . '/framework/cs-framework/include/include-config.php';
require_once T_PATH . '/framework/cs-framework/include/actions-config.php';
require_once T_PATH . '/framework/cs-framework/include/custom-widgets.php';
require_once T_PATH . '/framework/cs-framework/cs-framework.php';
require_once T_PATH . '/framework/class-tgm-plugin-activation.php';

function mevo_after_setup() {
    register_nav_menus( array( 'primary-menu' => esc_html__( 'Top Navigation', 'mevo' ) ) );
    add_theme_support( 'post-formats', array( 'video', 'gallery', 'audio', 'quote' ) );
    add_theme_support( 'custom-header' );
    add_theme_support( 'custom-background' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'mevo_after_setup' );

/**
 * Сustom mevo menu.
 */
function mevo_custom_menu() {
    if ( has_nav_menu( 'primary-menu' ) ) {
        $top_walker = new MevoTopMenuWalker();
        wp_nav_menu(
            array(
                'container'      => '',
                'theme_location' => 'primary-menu',
                'walker'         => $top_walker
            )
        );
    } else {
        print '<span class="no-menu">' . esc_html__( 'Please register Top Navigation from', 'mevo' ) . '<a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '" target="_blank">' . esc_html__( 'Appearance &gt; Menus', 'mevo' ) . '</a></span>';
    }
}

class MevoTopMenuWalker extends Walker_Nav_Menu {
    // change view of top navigation menu items
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $mevo;

        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $class_names = $value = '';
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        $classes[] = 'page-scroll';

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = ' class="' . esc_attr( $class_names ) . '"';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li ' . $id . $value . $class_names .'>';

        $cur_post = get_post($item->object_id);
        @$slug = "#" . $cur_post->post_name;

        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';

        if ( substr_count($class_names, 'menu-item-has-children') ) {
            $attributes .= ' data-toggle="dropdown"';
        }

        if ( get_option('show_on_front') == 'page' && $mevo['site_type'] == 'onepage' ) {
            $pages = get_all_page_ids();
            $blog_page = get_option( 'page_for_posts' );

            if ( $blog_page && ( $key = array_search( $blog_page, $pages ) ) !== false ) {
                unset($pages[$key]);
            }

            if ( $mevo['onepage_type'] == 'all' && in_array( $item->object_id, $pages ) ) {
                $attributes .= ! empty( $item->object_id )  ? ' class="anchor-scroll" href="' . esc_html( $slug ) . '"' : '';
            } elseif ( $mevo['onepage_type'] == 'custom' && ! empty( $mevo['custom_page_list'] ) && in_array( $item->object_id, $mevo['custom_page_list'] ) ) {
                $attributes .= ! empty( $item->object_id )  ? ' class="anchor-scroll" href="' . esc_html( $slug ) . '"' : '';
            } else {
                $attributes .= ! empty( $item->url ) ? ' href="' . esc_url( $item->url ) . '"' : '';
            }
        } else {
            $attributes .= ! empty( $item->url ) ? ' href="' . esc_url( $item->url ) . '"' : '';
        }

        $item_output = $args->before;
        $item_output .= '<a '. $attributes .'>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

/*
 * Custom menu item.
 */
function mevo_custom_menu_item( $items, $args ) {
    global $mevo;
    if( $args->theme_location == 'primary-menu' && $mevo['footer_menu_link'] == true ){
        $link = '<li class="menu-item"><a class="anchor-scroll" href="#footer-area">' . esc_html( $mevo['footer_menu_link_text'] ) . '</a></li>';
        $items = $items . $link;
    }
    return $items;
}
add_filter( 'wp_nav_menu_items', 'mevo_custom_menu_item', 10, 2 );
