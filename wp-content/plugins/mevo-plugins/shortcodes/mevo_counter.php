<?php
/**
 *
 * Mevo Counter
 * @since 1.0.0
 *
 */
function mevo_counter( $atts, $content = '', $id = '' ) {
  extract( shortcode_atts( array(
    'title' => '',
    'count' => ''
  ), $atts ) );

  $output = '';
  if( ! empty( $title ) ) {
    $output  .= '<div class="count-entry counters">';
    $output  .= '<div class="count-number" data-to="' . $count . '" data-speed="3000">0</div>';
    $output  .= '<div class="count-title">' . $title . '</div>';
    $output  .= '</div>';
  }
  return $output;
}
add_shortcode( 'mevo_counter', 'mevo_counter' );