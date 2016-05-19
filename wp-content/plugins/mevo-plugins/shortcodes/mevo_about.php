<?php
/**
 *
 * Mevo About us
 * @since 1.0.0
 *
 */
function mevo_about( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'values'      => '',
  ), $atts ) );

  $values = json_decode(urldecode($values));
  $side = 'right';
  $counter = 0;

  $output  = '<div class="timeline-wrapper">';

  foreach ($values as $value) {

    $top_img = ( is_numeric( $value->top_img ) && ! empty( $value->top_img ) ) ? wp_get_attachment_url( $value->top_img ) : '';
    $bottom_img = ( is_numeric( $value->bottom_img ) && ! empty( $value->bottom_img ) ) ? wp_get_attachment_url( $value->bottom_img ) : '';

    $ml = ( ( $counter % 2 ) == 0 ) ? '' : 'col-sm-offset-7';
    $ml = ( count( $values ) == ( $counter + 1 ) && $ml != '' ) ? 'col-sm-offset-6' : $ml;
    $col = ( count( $values ) == ( $counter + 1 ) ) ? 6 : 5;
    $last_right = ( $ml != '' && count( $values ) == ( $counter + 1 ) ) ? 'last-right' : '';

    $output .= '<div class="row ' . $last_right . '">';
    $output .= '<div class="item col-xs-12 ' . $ml . ' col-sm-' . $col . '">';
    $output .= '<div class="timeline-entry timeline-' . $side . '">';
    $output .= '<img src="' . $top_img . '" alt="">';
    $output .= '</div>';

    $side = ( count( $values ) == ( $counter + 1 ) ) ? 'top' : $side;
    /*$offset = ( $side == 'top' ) ? 'col-sm-offset-2' : '';*/

    $output .= '<div class="timeline-small timeline-' . $side . '">';
    $output .= '<div class="timeline-small-entry">';
    $output .= '<img src="' . $bottom_img . '" alt="">';
    $output .= '<div class="timeline-hover table-view">';
    $output .= '<div class="cell-view">';
    $output .= '<div class="timeline-name">' . $value->title . '</div>';
    $output .= $value->description;
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';

    $counter++;
    $side = ( ( $counter % 2 ) == 0 ) ? 'right' : 'left';
  }

  $output .= '<div class="timeline-icons">';
  $line = array();

  foreach ($values as $value) {
    $line[] = '<i class="icon-' . $value->icon . ' custom-icon"></i>';
  }

  $output .= implode( '<div class="timeline-devider"></div>', $line );
  $output .= '</div>';
  $output .= '</div>';


  return $output;
}
add_shortcode( 'mevo_about', 'mevo_about' );
