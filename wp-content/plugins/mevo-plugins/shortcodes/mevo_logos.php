<?php
/**
 *
 * Mevo Logo line
 * @since 1.0.0
 *
 */
function mevo_logos( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'values' => ''
  ), $atts ) );

  $values = json_decode( urldecode( $values ) );
  $output  = '';
  $slide = 0;

  if( ! empty( $values ) ) {
    $output  = '<div class="customers-slider">';
    $output .= '<div class="swiper-container" data-autoplay="0" data-loop="0" data-speed="500" data-center="0" data-slides-per-view="responsive" data-xs-slides="2" data-sm-slides="4" data-md-slides="5" data-lg-slides="6" data-add-slides="4">';
    $output .= '<div class="swiper-wrapper">';
    foreach ($values as $value) {
      $img_url = ( is_numeric( $value->img ) && ! empty( $value->img ) ) ? wp_get_attachment_url( $value->img ) : '';
      $active = ( $slide == 0 ) ? ' active' : '';

      $output .= '<div class="swiper-slide' . $active . '" data-val="' . $slide . '">';
      $output .= '<a class="customer-icon" href="' . $value->url . '"><img class="img-responsive" src="' . $img_url . '" alt=""></a>';
      $output .= '</div>';

      $slide++;
    }
    $output .= '</div>';
    $output .= '<div class="pagination"></div>';
    $output .= '</div>';
    $output .= '</div>';
  }
  return $output;
}
add_shortcode( 'mevo_logos', 'mevo_logos' );
