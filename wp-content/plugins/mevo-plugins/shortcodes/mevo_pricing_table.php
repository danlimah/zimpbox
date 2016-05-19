<?php
/**
 *
 * Mevo pricing item
 * @since 1.0.0
 * @version 1.1.0
 *
 */
function mevo_pricing_table( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'title'        => '',
    'active'       => '',
    'currency'     => '',
    'price'        => '',
    'period'       => '',
    'items'        => '',
    'btn_link'     => '',
    'btn_text'     => ''
  ), $atts ) );

  $active = ( isset( $active ) && $active == 'yes' ) ? 'active' : '';
  $item_list = '';

  if( ! empty( $items ) ) {
    $items = explode("\n", $items);
    $item_list = '<ul class="price-spec">';
    foreach ( $items as $item ) {
      $item_list .= '<li>' . $item . '</li>';
    }
    $item_list .= '</ul>';
  }

  $output  = '<div class="price-entry ' . $active . '">';
  $output .= '<div class="price-name">' . $title . '</div>';
  $output .= '<div class="price-count">';
  $output .= ( ! empty( $currency ) ) ? '<span>' . $currency . '</span>' : '';
  $output .= $price;
  $output .= ( ! empty( $period ) ) ? '<span>/' . $period . '</span>' : '';
  $output .= '</div>';
  $output .= ( ! empty( $item_list ) ) ? $item_list : '';
  $output .= ( ! empty( $btn_link ) && ! empty( $btn_text ) ) ? '<a class="button size-2" href="' . $btn_link . '">' . $btn_text . '</a>' : '';
  $output .= '</div>';

  return $output;
}
add_shortcode( 'mevo_pricing_table', 'mevo_pricing_table' );
