<?php
/**
 *
 * Mevo video
 * @since 1.0.0
 *
 */
function mevo_video( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'left_side'  => '',
    'right_side' => '',
    'video_url'  => '',
    'img'        => ''
  ), $atts ) );

  $img_url = ( is_numeric( $img ) && ! empty( $img ) ) ? wp_get_attachment_url( $img ) : '';
  $video_url = ( ! empty( $video_url ) ) ? str_replace( 'watch?v=', 'embed/', $video_url ) : '';

  $output  = '';

  if( ! empty( $video_url ) ) {
    $output  = '<div class="video-block">';
    $output .= '<img class="center-image" src="' . $img_url . '" alt="">';
    $output .= '<div class="container">';
    $output .= '<span>' . $left_side . '</span>';
    $output .= '<a class="video-play" data-video="' . $video_url . '" href="#"><img src="' . get_template_directory_uri() . '/assets/images/play.png" alt=""></a>';
    $output .= '<span>' . $right_side . '</span>';
    $output .= '</div>';
    $output .= '<div class="popup-video video-about">';
    $output .= '<div class="movie">';
    $output .= '<iframe src="about:blank" class=""></iframe>';
    $output .= '<div class="close-button">';
    $output .= '<i class="fa fa-times"></i>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
  }

  return $output;
}
add_shortcode( 'mevo_video', 'mevo_video' );
