<?php
/**
 *
 * Mevo Testimonials
 * @since 1.0.0
 *
 */
function mevo_testimonials( $atts, $content = '', $id = '' ) {
  extract( shortcode_atts( array(
    'values' => '',
    'style'  => 'classic'
  ), $atts ) );
  $values = json_decode( urldecode( $values ) );
  $slide = 0;

  $output  = '<div class="testimonals-slider">';
  $output .= '<div class="swiper-container" data-autoplay="0" data-loop="0" data-speed="500" data-center="0" data-slides-per-view="1">';
  $output .= '<div class="swiper-wrapper">';
  foreach ( $values as $value ) {
    $img_url = ( is_numeric( $value->img ) && ! empty( $value->img ) ) ? wp_get_attachment_url( $value->img ) : '';
    $active = ( $slide == 0 ) ? ' active' : '';

    $output .= '<div class="swiper-slide' . $active . '" data-val="' . $slide . '">';
    $output .= '<div class="row">';
    if( $style == 'modern' ) {
      $output .= '<div class="col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8 col-lg-offset-3 col-lg-6">';
      $output .= '<div class="block-icon"><img src="' . $img_url . '" alt=""></div>';
      $output .= '<div class="block-intro">' . $value->text . '</div>';
      $output .= '</div>';
    } else {
      $output .= '<div class="col-xs-12 col-sm-6">';
      $output .= '<div class="testimonals-img">';
      $output .= '<img src="' . $img_url . '" alt="">';
      $output .= '</div>';
      $output .= '<div class="testimonals-author">';
      $output .= '<div class="t_name">' . $value->name . '</div>';
      $output .= '<div class="t_position">' . $value->position . '</div>';
      $output .= '</div>';
      $output .= '</div>';
      $output .= '<div class="col-xs-12 col-sm-6">';
      $output .= '<div class="testimonals-text">';
      $output .= $value->text;
      $output .= '</div>';
      $output .= '</div>';
    }
    $output .= '</div>';
    $output .= '</div>';

    $slide++;
  }
  $output .= '</div>';
  $output .= '<div class="pagination"></div>';
  $output .= '</div>';
  $output .= '</div>';

  return $output;
}
add_shortcode( 'mevo_testimonials', 'mevo_testimonials' );
