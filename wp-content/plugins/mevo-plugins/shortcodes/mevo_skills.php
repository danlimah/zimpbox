<?php
/**
 *
 * Mevo Skills
 * @since 1.0.0
 *
 */
function mevo_skills( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'title'            => '',
    'count'            => '',
    'color'            => '',
    'color_active'     => '',
    'color_non_active' => ''
  ), $atts ) );

  $color_active = ( ! empty( $color_active ) ) ? $color_active : '#fff';
  $color_non_active = ( ! empty( $color_non_active ) ) ? $color_non_active : '#f58634';
  $output = '';

  if( ! empty( $title ) ) {
    $color = ( ! empty( $color ) ) ? 'style="color: ' . $color . ';"' : '';

    $output .= ( ! empty( $color ) ) ? '<style>.circle-entry .circle span.circle-text {color:' . $color . ';}</style>' : '';
    $output .= '<div class="col-xs-12 col-sm-6 col-md-6">';
    $output .= '<div class="circle-entry clearfix circle-wrapper">';
    $output .= '<div class="circle" data-startdegree="90" data-dimension="105" data-text="' . $count . '%" data-info="" data-width="5" data-fontsize="16" data-percent="' . $count . '" data-fgcolor="' . $color_active . '" data-bgcolor="' . $color_non_active . '"></div>';
    $output .= '<div class="circle-title" ' . $color . '>' . $title . '</div>';
    $output .= '</div>';
    $output .= '</div>';
  }
  return $output;
}
add_shortcode( 'mevo_skills', 'mevo_skills' );
