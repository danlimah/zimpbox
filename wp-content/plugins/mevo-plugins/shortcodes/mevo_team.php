<?php
/**
 *
 * Mevo Team
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function mevo_team( $atts, $content = '', $id = '' ) {

	extract( shortcode_atts( array(
	    'image'           => '',
	    'name'            => '',
      'social_facebook' => '',
      'social_twitter'  => '',
      'social_dribble'  => '',
      'social_gplus'    => '',
      'social_linkedin' => '',
  	), $atts ) );

  	$url = ( is_numeric( $image ) ) ? wp_get_attachment_url( $image ) : $image;

  	$output	 = '<div class="tream-entry">';
    $output .= '<a class="team-img">';
    $output .= '<img class="img-responsive" src="' . $url . '" alt="">';
    $output .= '</a>';
    $output .= '<div class="team-hover table-view">';
    $output .= '<div class="cell-view">';
    $output .= '<div class="team-name">' . $name . '</div>';
    $output .= '<div class="team-social">';
    $output .= ( ! empty( $social_facebook ) ) ? '<a href="' . $social_facebook . '"><i class="fa fa-facebook"></i></a>' : '';
    $output .= ( ! empty( $social_twitter ) ) ? '<a href="' . $social_twitter . '"><i class="fa fa-twitter"></i></a>' : '';
    $output .= ( ! empty( $social_dribble ) ) ? '<a href="' . $social_dribble . '"><i class="fa fa-dribbble"></i></a>' : '';
    $output .= ( ! empty( $social_gplus ) ) ? '<a href="' . $social_gplus . '"><i class="fa fa-google"></i></a>' : '';
    $output .= ( ! empty( $social_linkedin ) ) ? '<a href="' . $social_linkedin . '"><i class="fa fa-linkedin"></i></a>' : '';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';

    return $output;
}
add_shortcode( 'mevo_team', 'mevo_team' );
