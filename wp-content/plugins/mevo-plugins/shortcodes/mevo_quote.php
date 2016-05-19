<?php
/**
 *
 * Mevo quote
 * @since 1.0.0
 *
 */
function mevo_quote( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'padding'          => '',
    'style'            => 'modern',
    'color'            => '',
    'footer'           => '',
    'background_color' => ''
  ), $atts ) );

  if( ! empty( $padding ) ) {
    $padding = ( is_numeric( $padding ) ) ? 'padding: ' . $padding . 'px;' : 'padding: ' . $padding . ';';
  }


  $color = ( ! empty( $color ) ) ? 'color: ' . $color . ';' : '';
  $background_color = ( ! empty( $background_color ) ) ? 'background-color: ' . $background_color . ';' : '';
  $css_style = ( ! empty( $color ) || ! empty( $background_color ) ) ? 'style="' . $color . $background_color . $padding . '"' : '';

  $output = '';
  if( ! empty( $content ) ) {
    if( $style == 'modern' ) {
      $output = '<blockquote ' . $css_style . ' class="left">' . $content . '</blockquote>';
    } else {
      $output  = '<blockquote class="style-2 left" ' . $css_style . '>';
      $output .= $content;
      $output .= '<footer>' . $footer . '</footer>';
      $output .= '</blockquote> ';
    }
  }
  return $output;
}
add_shortcode( 'mevo_quote', 'mevo_quote' );
