<?php
/**
 *
 * Mevo banner image
 * @since 1.0.0
 * @version 1.1.0
 *
 */
function mevo_image( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'image'      => '',
    'text_style' => 'left'
  ), $atts ) );

  $img_url = ( is_numeric( $image ) && ! empty( $image ) ) ? wp_get_attachment_url( $image ) : '';
  $output  = '';

  if( ! empty( $image ) ) {  
    $light = ( $text_style == 'light' ) ? 'style-2' : '';
    $output  = '<div class="main-image banner">';
    $output .= '<img class="center-image" src="' . $img_url . '" alt="">';
    if( ! empty( $content ) && trim( strip_tags( $content ) ) != '' ) {
      $output .= '<div class="table-view main-image-content ' . $light . '">';
      $output .= '<div class="row-view">';
      $output .= '<div class="cell-view">';
      $output .= '<div class="container">';
      if( $text_style == 'left' ) {
        $output .= '<div class="row">';
        $output .= '<div class="col-xs-8">';
        $output .= $content;
        $output .= '</div>';
        $output .= '</div>';
      } 

      if( $text_style == 'light' ) {
        $output .= '<div class="m-slider-text text-center">';
        $output .= $content;
        $output .= '</div>';
      } 

      if( $text_style == 'center' ) {
        $output .= '<div class="row">';
        $output .= '<div class="col-xs-12 col-sm-8 col-sm-offset-2">';
        $output .= $content;
        $output .= '</div>';
        $output .= '</div>';
      }

      $output .= '</div>';
      $output .= '</div>';
      $output .= '</div>';
      $output .= '</div>';
    }
    $output .= '</div>';
  }  
  return $output;
}
add_shortcode( 'mevo_image', 'mevo_image' );
