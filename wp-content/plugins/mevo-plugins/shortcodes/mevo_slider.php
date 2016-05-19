<?php
/**
 *
 * Mevo Slider
 * @since 1.0.0
 *
 */
function mevo_slider( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'values' => ''
  ), $atts ) );

  $values = json_decode( urldecode( $values ) );
  $output  = '';
  $slide = 0;

  if( ! empty( $values ) ) {
    $output  = '<div class="main-slider">';
    $output .= '<div class="swiper-container" data-autoplay="0" data-loop="0" data-speed="500" data-center="0" data-slides-per-view="1" data-add-slides="2">';
    $output .= '<div class="swiper-wrapper">';

    foreach ($values as $value) {
      $img_url = ( is_numeric( $value->img ) && ! empty( $value->img ) ) ? wp_get_attachment_url( $value->img ) : '';
      $active = ( $slide == 0 ) ? ' active' : '';
      $animated = ( $slide == 0 ) ? ' animated' : '';
      $animation = ( $value->animation != 'none' ) ? 'text-animation' : '';
      $text_style = ( $value->text_style == 'white' ) ? 'style-2' : '';
      $offset = '';
      switch ($value->text_align) {
        case 'center':
          $offset = 'col-sm-offset-2';
          break;
        case 'left':
          $offset = '';
          break;
        case 'right':
          $offset = 'col-sm-offset-4';
          break;
        
        default:
          $offset = '';
          break;
      }

      if( ! empty( $img_url ) ) {
        $output .= '<div class="swiper-slide' . $active . '" data-val="' . $slide . '">';
        $output .= '<img class="center-image" src="' . $img_url . '" alt="">';
        $output .= '<div class="table-view slider-content ' . $text_style . '">';//style-2
        $output .= '<div class="row-view">';
        $output .= '<div class="cell-view">';
        $output .= '<div class="container">';
        $output .= '<div class="row">';
        $output .= '<div class="col-xs-12 col-sm-8 ' . $offset . '">';
        $output .= '<div class="m-slider-text text-' . $value->text_align . '' . $animated . ' ' . $animation . '" data-animation="' . $value->animation . '">';
        $output .= $value->text;
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';

        $slide++;
      }
    }

    $output .= '</div>';
    $output .= '<div class="pagination"></div>';
    $output .= '</div>';
    $output .= '</div>';
  }

  return $output;
}
add_shortcode( 'mevo_slider', 'mevo_slider' );
