<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 *
 * Field: Backup
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class CSFramework_Option_backup extends CSFramework_Options {

  public function __construct( $field, $value = '', $unique = '' ) {
    parent::__construct( $field, $value, $unique );
  }

  public function output() {

    print $this->element_before();

    print '<textarea name="'. $this->unique .'[import]"'. $this->element_class() . $this->element_attributes() .'></textarea>';
    submit_button( esc_html__( 'Import a Backup','mevo' ), 'primary cs-import-backup', 'backup', false );
    print '<small>( ' . esc_html__( 'copy-paste your backup string here','mevo' ).' )</small>';

    print '<hr />';

    print '<textarea name="_nonce"'. $this->element_class() . $this->element_attributes() .' disabled="disabled">'. cs_encode_string( get_option( $this->unique ) ) .'</textarea>';
    print '<a href="'. admin_url( 'admin-ajax.php?action=cs-export-options' ) .'" class="button button-primary" target="_blank">'. esc_html__( 'Export and Download Backup','mevo' ) .'</a>';
    print '<small>-( ' . esc_html__( 'or','mevo' ) .' )-</small>';
    submit_button( esc_html__( '!!! Reset All Options !!!','mevo' ), 'cs-warning-primary cs-reset-confirm', $this->unique . '[resetall]', false );
    print '<small class="cs-text-warning">' . esc_html__( 'Please be sure for reset all of framework options.','mevo' ) .'</small>';
    print $this->element_after();

  }

}
