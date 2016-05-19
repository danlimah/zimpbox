<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK SETTINGS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$settings      = array(
  'menu_title' => 'Theme options',
  'menu_type'  => 'add_' . 'menu_page',
  'menu_slug'  => 'cs-framework',
  'ajax_save'  => false,
);

// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options        = array();

// ----------------------------------------
// General section
// ----------------------------------------
$options[]      = array(
    'name'        => 'general_options',
    'title'       => 'General',
    'icon'        => 'fa fa-star',
    'fields'      => array(
        array(
            'id'      => 'page_loader',
            'type'    => 'switcher',
            'title'   => 'Page loader',
            'default' => true
        ),
        array(
            'id'          => 'site_type',
            'type'        => 'select',
            'title'       => 'Site type',
            'options'     => array(
                'multypage' => 'Multipage',
                'onepage'   => 'Onepage'
            ),
            'default' => 'multypage'
        ),
        array(
            'id'          => 'onepage_type',
            'type'        => 'select',
            'title'       => 'One page type',
            'options'     => array(
                'all'      => 'All pages',
                'custom'   => 'Custom list'
            ),
            'default'     => 'all',
            'dependency'  => array( 'site_type', '==', 'onepage' ),
        ),
        array(
            'id'          => 'custom_page_list',
            'type'        => 'select',
            'title'       => 'Custom page list',
            'options'     => 'pages',
            'attributes'  => array(
                'multiple' => 'only-key',
                'style'    => 'width: 100%; height: 125px;'
            ),
            'dependency'  => array( 'onepage_type', '==', 'custom' ),
        ),
        array(
            'id'       => 'sidebar',
            'type'     => 'checkbox',
            'title'    => 'Show sidebar on:',
            'options'  => array(
                'post'  => 'Post',
                'blog'  => 'Blog'
            ),
            'default'  => array( 'post', 'blog' )
        ),
        array(
            'id'         => 'site_favicon',
            'type'       => 'upload',
            'title'      => 'Site Favicon',
            'default'    => get_template_directory_uri().'/assets/images/favicon.ico',
            'desc'       => 'Upload any media using the WordPress Native Uploader.',
        ),
        array(
            'id'         => 'portfolio_page_url',
            'type'       => 'text',
            'title'      => 'Portfolio page URL',
            'default'    => '#'
        )
    )
);

// ----------------------------------------
// Page Header section
// ----------------------------------------
$options[]      = array(
    'name'        => 'page_header',
    'title'       => 'Page Header',
    'icon'        => 'fa fa-book',
    'fields'      => array(
        array(
            'id'      => 'single_breadcrumbs',
            'type'    => 'switcher',
            'title'   => 'Single post breadcrumbs',
            'default' => true
        ),
        array(
            'id'       => 'header_style',
            'type'     => 'radio',
            'title'    => 'Header style',
            'options'  => array(
                'style-1'  => 'Classic',
                'style-2'  => 'Modern',
                'style-3'  => 'Creative'
            ),
            'default'  => 'style-1'
        ),
        array(
            'id'         => 'header_color',
            'type'       => 'color_picker',
            'title'      => 'Header background color',
            'default'    => '',
        ),
        array(
            'id'         => 'site_logo',
            'type'       => 'upload',
            'title'      => 'Site Logo',
            'default'    => get_template_directory_uri().'/assets/images/logo.png',
            'desc'       => 'Upload any media using the WordPress Native Uploader.',
        ),
        array(
            'id'         => 'second_site_logo',
            'type'       => 'upload',
            'title'      => 'Invert Color Site Logo',
            'default'    => get_template_directory_uri().'/assets/images/logo_alt.png',
            'desc'       => 'Upload any media using the WordPress Native Uploader.',
        ),
    )
);

// ----------------------------------------
// Social Options
// ----------------------------------------
$options[]      = array(
    'name'        => 'social_options',
    'title'       => 'Social Options',
    'icon'        => 'fa fa-share-alt',
    'fields'      => array(
        array(
            'id'         => 'instagram_api_key',
            'type'       => 'text',
            'title'      => 'Instagram API key',
            'default'    => '1e2759b12eda4309a6f8c31bbd6d50fb'
        ),
        array(
            'id'         => 'instagram_user_name',
            'type'       => 'text',
            'title'      => 'Instagram username',
            'default'    => 'bodotheme'
        ),
        array(
            'id'         => 'twitter_user_name',
            'type'       => 'text',
            'title'      => 'Twitter user name',
            'default'    => 'bodotheme'
        ),
        array(
            'id'         => 'twitter_api_key',
            'type'       => 'text',
            'title'      => 'Twitter API key',
            'default'    => 'ebVifSd9qmmLHNyYKDqZPj4G3'
        ),
        array(
            'id'         => 'twitter_api_secret',
            'type'       => 'text',
            'title'      => 'Twitter API Secret',
            'default'    => 'dZJ63AZoyxKFn3eS2Et2wX3vZ1nhVBIxv5igNtXPSfRK0t1xWv'
        ),
    )
);

// ----------------------------------------
// Custom css section
// ----------------------------------------
$options[]      = array(
  'name'        => 'custom_css',
  'title'       => 'Custom css',
  'icon'        => 'fa fa-paint-brush',
  'fields'      => array(
    array(
      'id'         => 'custom_css_styles',
      'desc'       => 'Only CSS, without tag &lt;style&gt;.',
      'type'       => 'textarea',
      'title'      => 'Custom css code'
    )
  )
);

// ----------------------------------------
// Footer option section                  -
// ----------------------------------------
$options[]      = array(
    'name'        => 'footer',
    'title'       => 'Footer',
    'icon'        => 'fa fa-copyright',
    'fields'      => array(
        array(
            'id'       => 'footer_style',
            'type'     => 'radio',
            'title'    => 'Footer style',
            'options'  => array(
                'modern'  => 'Modern',
                'classic' => 'Classic',
            ),
            'default'  => 'modern'
        ),
        /*=============Modern================*/
        array(
            'id'          => 'footer_menu_link',
            'type'        => 'switcher',
            'title'       => 'Add menu link',
            'default'     => true,
            'desc'        => 'Menu item(only for Onepage site type) for scroling to modern footer area.', 
            'dependency'  => array( 'footer_style_modern', '==', 'true' )
        ),
        array(
            'id'          => 'footer_menu_link_text',
            'type'        => 'text',
            'title'       => 'Menu link text',
            'default'     => 'Contact',
            'dependency'  => array( 'footer_style_modern|footer_menu_link', '==|==', 'true|true' )
        ),
        array(
            'id'          => 'footer_map_lat',
            'type'        => 'text',
            'title'       => 'Footer map latitude',
            'default'     => '40.6941859',
            'dependency'  => array( 'footer_style_modern', '==', 'true' )
        ),
        array(
            'id'          => 'footer_map_lng',
            'type'        => 'text',
            'title'       => 'Footer map longitude',
            'default'     => '-73.7210592',
            'dependency'  => array( 'footer_style_modern', '==', 'true' )
        ),
        array(
            'id'          => 'footer_black_section',
            'type'        => 'wysiwyg',
            'title'       => 'Footer black section',
            'default'     => '50241 Blackwood rd.<br/>320 PO BOX<br/>Richmond, Virginia<br/>United States of America<br/>www.mevo.com<br/>contact@mevo.com',
            'dependency'  => array( 'footer_style_modern', '==', 'true' )
        ),
        array(
            'id'          => 'footer_blue_section',
            'type'        => 'wysiwyg',
            'title'       => 'Footer blue section',
            'default'     => '<a href="tel:555768534089">+555 768 534 089</a>',
            'dependency'  => array( 'footer_style_modern', '==', 'true' )
        ),
        array(
            'id'         => 'footer_copy',
            'type'       => 'text',
            'title'      => 'Fotter copyright text',
            'default'    => '&copy; Copyright 2015 Mevo. All rights reserved.'
        ),
        array(
            'id'         => 'footer_logo',
            'type'       => 'upload',
            'title'      => 'Site Logo',
            'default'    => get_template_directory_uri().'/assets/images/logo.png',
            'desc'       => 'Upload any media using the WordPress Native Uploader.',
        ),
        // Footer right side.
        array(
            'id'           => 'footer_social',
            'type'         => 'group',
            'title'        => 'Footer social links',
            'button_title' => 'Add New',
            'fields'       => array(
                array(
                    'id'          => 'footer_social_link',
                    'type'        => 'text',
                    'title'       => 'Text'
                ),
                array(
                    'id'          => 'footer_social_icon',
                    'type'        => 'icon',
                    'title'       => 'Icon'
                )
            ),
            'default' => array(
                array(
                    'footer_social_link' => 'https://www.facebook.com/',
                    'footer_social_icon' => 'fa fa-facebook'
                ),
                array(
                    'footer_social_link' => 'https://twitter.com/',
                    'footer_social_icon' => 'fa fa-twitter'
                ),
                array(
                    'footer_social_link' => 'https://dribbble.com/',
                    'footer_social_icon' => 'fa fa-dribbble'
                ),
                array(
                    'footer_social_link' => 'https://plus.google.com/',
                    'footer_social_icon' => 'fa fa-google-plus'
                ),
                array(
                    'footer_social_link' => 'https://www.linkedin.com/',
                    'footer_social_icon' => 'fa fa-linkedin'
                ),
            ),
            'dependency'  => array( 'footer_style_classic', '==', 'true' )
        )
    ) // end: fields
);

// ----------------------------------------
// 404 Page                               -
// ----------------------------------------
$options[]      = array(
    'name'        => 'error_page',
    'title'       => '404 Page',
    'icon'        => 'fa fa-bolt',
    // begin: fields
    'fields'      => array(
        array(
            'id'      => 'error_title',
            'type'    => 'text',
            'title'   => 'Error Title*',
            'default' => 'Oops!',
        ),
        array(
            'id'      => 'error_message',
            'type'    => 'textarea',
            'title'   => 'Error Message',
            'default' => 'Something went wrong or this page no longer exist.',
        ),
        array(
            'id'      => 'error_link_text',
            'type'    => 'text',
            'title'   => 'Back home link text',
            'default' => 'Back to the homepage',
        ),
        array(
            'id'      => 'error_secondary_message',
            'type'    => 'textarea',
            'title'   => 'Error Secondary Message*',
            'default' => 'Lost? Here you&apos;ll find your way back to the website.',
        )
    ) // end: fields
);

// ----------------------------------------
// Backup
// ----------------------------------------
$options[]   = array(
  'name'     => 'backup_section',
  'title'    => 'Backup',
  'icon'     => 'fa fa-shield',

  // begin: fields
  'fields'   => array(

    array(
        'type'    => 'notice',
        'class'   => 'warning',
        'content' => 'You can save your current options. Download a Backup and Import.',
    ),

    array(
        'type'    => 'backup',
    ),

  )  // end: fields
);

// ----------------------------------------
// Documentation
// ----------------------------------------
$options[]   = array(
    'name'     => 'documentation_section',
    'title'    => 'Documentation',
    'icon'     => 'fa fa-info-circle',
    'fields'   => array(
        array(
          'type'    => 'heading',
          'content' => 'Documentation'
        ),
        array(
          'type'    => 'content',
          'content' => 'To view the documentation, go to <a href="http://demo.nrgthemes.com/projects/themes-doc/mevo/index.html" target="_blank">documentation page</a>.',
        ),
    )
);
CSFramework::instance( $settings, $options );
