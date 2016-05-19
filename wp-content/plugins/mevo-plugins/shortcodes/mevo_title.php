<?php
/**
 *
 * Mevo simple title
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function mevo_title( $atts, $content = '', $id = '' ) {
  extract( shortcode_atts( array(
    'size'  => 'h2',
    'title' => '',
    'color' => ''
  ), $atts ) );
  $color = ( ! empty( $color ) ) ? 'style="color: ' . $color . ';"' : '';
  $output = '';
  if( ! empty( $title ) ) {
    $output = '<' . $size . ' class="block-title" ' . $color . '>' . $title . '</' . $size . '>';
  }
  return $output;
}
add_shortcode( 'mevo_title', 'mevo_title' );
