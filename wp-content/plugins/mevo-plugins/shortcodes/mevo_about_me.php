<?php
/**
 *
 * Mevo About Me
 * @since 1.0.0
 * @version 1.1.0
 *
 */
function mevo_about_me( $atts, $content = '', $id = '' ) {
  extract( shortcode_atts( array(
    'img'      => '',
    'name'     => '',
    'position' => ''
  ), $atts ) );

  $img_url = ( is_numeric( $img ) && ! empty( $img ) ) ? wp_get_attachment_url( $img ) : '';

  $output  = ( ! empty( $img_url ) ) ? '<img class="about-image img-responsive" src="' . $img_url . '" alt="">' : '';
  $output .= ( ! empty( $name ) ) ? '<h3 class="about-title">' . $name . '</h3>' : '';
  $output .= ( ! empty( $position ) ) ? '<div class="about-subtitle">' . $position . '</div>' : '';
  $output .= ( ! empty( $content ) ) ? '<div class="about-text">' . $content . '</div>' : '';

  return $output;
}
add_shortcode( 'mevo_about_me', 'mevo_about_me' );
