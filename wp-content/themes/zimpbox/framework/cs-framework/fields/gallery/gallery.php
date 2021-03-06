<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 *
 * Field: Gallery
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class CSFramework_Option_Gallery extends CSFramework_Options {

  public function __construct( $field, $value = '', $unique = '' ) {
    parent::__construct( $field, $value, $unique );
  }

  public function output(){

    print $this->element_before();

    $value  = $this->element_value();
    $add    = ( ! empty( $this->field['add_title'] ) ) ? $this->field['add_title'] : esc_html__( 'Add Gallery','mevo' );
    $edit   = ( ! empty( $this->field['edit_title'] ) ) ? $this->field['edit_title'] : esc_html__( 'Edit Gallery','mevo' );
    $clear  = ( ! empty( $this->field['clear_title'] ) ) ? $this->field['clear_title'] : esc_html__( 'Clear','mevo' );
    $hidden = ( empty( $value ) ) ? ' hidden' : '';

    print '<ul>';

    if( ! empty( $value ) ) {

      $values = explode( ',', $value );

      foreach ( $values as $id ) {
        $attachment = wp_get_attachment_image_src( $id, 'thumbnail' );
        print '<li><img src="'. $attachment[0] .'" alt="" /></li>';
      }

    }

    print '</ul>';
    print '<a href="#" class="button button-primary cs-add">'. $add .'</a>';
    print '<a href="#" class="button cs-edit'. $hidden .'">'. $edit .'</a>';
    print '<a href="#" class="button cs-warning-primary cs-remove'. $hidden .'">'. $clear .'</a>';
    print '<input type="text" name="'. $this->element_name() .'" value="'. $value .'"'. $this->element_class() . $this->element_attributes() .'/>';

    print $this->element_after();

  }

}
