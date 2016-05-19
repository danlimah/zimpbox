<?php
/**
 *
 * Mevo Intro text
 * @since 1.0.0
 *
 */
function mevo_intro( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'text_align' => 'center',
    'color'      => ''
  ), $atts ) );

  $color = ( ! empty( $color ) ) ? ' color: ' . $color . ';' : '';
  $text_align = ( ! empty( $text_align ) && $text_align != 'center' ) ? ' text-align: ' . $text_align . ';' : '';
  $style = ( ! empty( $color ) || ! empty( $text_align ) ) ? 'style="' . $color . $text_align . '"' : '';
  $content = preg_replace( "!</p>(.*?)<p>!si","\\1", $content );

  $output = '';
  if( ! empty( $content ) ) {
    $output = '<div class="block-intro" ' . $style . '>' . $content . '</div>';
  }
  return $output;
}
add_shortcode( 'mevo_intro', 'mevo_intro' );

