<?php
/**
 *
 * Mevo Bread Crumbs
 * @since 1.0.0
 *
 */
function mevo_bread_crumbs( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'values' => '',
  ), $atts ) );

  $values = json_decode(urldecode($values));

  $output = '<ul class="breadcrumbs">';
  foreach ( $values as $value ) {
    if( ! empty( $value->url ) ){
      $output .= '<li><a href=' . $value->url . '">' . $value->text . '</a></li>';
    } else {
      $output .= '<li>' . $value->text . '</li>';
    }
  }
  $output .= '</ul>';
  return $output;
}
add_shortcode( 'mevo_bread_crumbs', 'mevo_bread_crumbs' );
