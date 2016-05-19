<?php
/**
 *
 * Mevo services block
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function mevo_services( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'size'       => 'h2',
    'title'      => '',
    'icon'       => 'none',
    'color'      => '',
    'style'      => 'simple',
    'text_align' => '',
    'font_color' => ''
  ), $atts ) );

  $font_color = ( ! empty( $font_color ) ) ? 'style="color: ' . $font_color . ';"' : '';
  $content = preg_replace("!</p>(.*?)<p>!si","\\1",$content);

  if( $style == 'simple' || $style == 'transperent' ) {
    $transperent = ( $style == 'transperent' ) ? 'style-2' : '';

    $output  = '<div class="service-entry ' . $transperent . ' ' . $text_align . '">';
    $output .= ( $icon != 'none' ) ? '<i class="service-icon icon-' . $icon . ' custom-icon"></i>' : '';
    $output .= '<' . $size . ' class="service-title" ' . $font_color . '>' . $title . '</' . $size . '>';
    $output .= '<div class="service-text" ' . $font_color . '>' . $content . '</div>';
    $output .= '</div>';
  }
  if( $style == 'rhombus' ) {
    $color = ( ! empty( $color ) ) ? 'style="background: ' . $color . ';"' : '';

    //$output  = '<div class="squares-item">';
    $output  = '<div class="squares-entry" ' . $color . '>';
    $output .= '<div class="table-view">';
    $output .= '<div class="cell-view">';
    $output .= ( $icon != 'none' ) ? '<i class="service-icon icon-' . $icon . ' custom-icon"></i>' : '';
    $output .= '<div class="squares-name" ' . $font_color . '>' . $title . '</div>';
    $output .= '<div class="squares-text" ' . $font_color . '>';
    $output .= $content;
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
    //$output .= '</div>';
  }
  return $output;
}
add_shortcode( 'mevo_services', 'mevo_services' );
