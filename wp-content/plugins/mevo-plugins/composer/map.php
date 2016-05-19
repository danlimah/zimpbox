<?php
/**
  * WPBakery Visual Composer Shortcodes settings
  *
  * @package VPBakeryVisualComposer
  *
 */

include_once( EF_ROOT . '/composer/params.php' );

if ( ! function_exists( 'is_plugin_active' ) ) {
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); // Require plugin.php to use is_plugin_active() below
}

function vc_remove_elements( $e = array() ) {
    if ( ! empty( $e ) ) {
        foreach ( $e as $key => $r_this ) {
            vc_remove_element( 'vc_' . $r_this );
        }
    }
}

add_action( 'admin_init', 'vc_remove_elements', 10);

$s_elements = array( 'btn', 'line_chart', 'round_chart', 'tta_accordion', 'tta_tour', 'tta_tabs', 'cta', 'tabs', 'tab', 'accordion', 'accordion_tab', 'custom_heading', 'clients', 'column_text', 'widget_sidebar', 'toggle', 'images_carousel', 'carousel', 'tour', 'gallery', 'posts_slider', 'posts_grid', 'teaser_grid', 'separator', 'text_separator', 'message', 'facebook', 'tweetmeme', 'googleplus', 'pinterest', /*'single_image', */'button', 'toogle', 'button2', 'cta_button', 'cta_button2', 'video', 'gmaps', 'flickr', 'progress_bar', 'raw_html', 'raw_js', 'pie', 'wp_search', 'wp_meta', 'wp_recentcomments', 'wp_calendar', 'wp_pages', 'wp_custommenu', 'wp_posts', 'wp_links', 'wp_categories', 'wp_archives', 'wp_rss', 'basic_grid', 'media_grid', 'masonry_grid', 'masonry_media_grid', 'icon', 'wp_tagcloud' );
vc_remove_element( 'client', 'testimonial' );
vc_remove_elements( $s_elements );

// ==========================================================================================
// BANNER IMAGE                                                                             -
// ==========================================================================================

vc_map( array(
    'name'            => __( 'Banner image', 'js_composer' ),
    'base'            => 'mevo_image',
    'description'     => __( 'Welcome Text', 'js_composer' ),
    'params'          => array(
      array(
        'type'        => 'attach_image',
        'heading'     => __( 'Attach image', 'js_composer' ),
        'param_name'  => 'image'
      ),
      array(
        'type'        => 'dropdown',
        'heading'     => __( 'Text style', 'js_composer' ),
        'param_name'  => 'text_style',
        'value'       => array(
          'Left'       => 'left',
          'Center'     => 'center',
          'Light'      => 'light'
        )
      ),
      array(
        'type'        => 'textarea_html',
        'heading'     => __( 'Custom text', 'js_composer' ),
        'holder'      => 'div',
        'param_name'  => 'content'
      )
    )
  )
);

// ==========================================================================================
// CUSTOM TITLE                                                                            -
// ==========================================================================================

vc_map( array(
    'name'            => __( 'Custom title', 'js_composer' ),
    'base'            => 'mevo_title',
    'description'     => __( 'Welcome Text', 'js_composer' ),
    'params'          => array(
      array(
        'type'        => 'dropdown',
        'heading'     => __( 'Title tag', 'js_composer' ),
        'param_name'  => 'size',
        'value'       => array(
            'H2'        =>  'h2',
            'H3'        =>  'h3',
            'H4'        =>  'h4',
            'H5'        =>  'h5',
            'H6'        =>  'h6'
        )
      ),
      array(
        'type'        => 'textfield',
        'heading'     => __( 'Title text', 'js_composer' ),
        'param_name'  => 'title',
        'value'       => ''
      ),
      array(
        'type'        => 'colorpicker',
        'heading'     => __( 'Title font color', 'js_composer' ),
        'param_name'  => 'color'
      )
    )
  )
);

// ==========================================================================================
// SERVICES BLOCK                                                                            -
// ==========================================================================================

vc_map( array(
    'name'            => __( 'Services', 'js_composer' ),
    'base'            => 'mevo_services',
    'description'     => __( 'Text with icon', 'js_composer' ),
    'params'          => array(
      array(
        'type'        => 'dropdown',
        'heading'     => __( 'Title tag', 'js_composer' ),
        'param_name'  => 'size',
        'value'       => array(
          'H2'        =>  'h2',
          'H3'        =>  'h3',
          'H4'        =>  'h4',
          'H5'        =>  'h5',
          'H6'        =>  'h6'
        )
      ),
      array(
        'type'        => 'dropdown',
        'heading'     => __( 'Style', 'js_composer' ),
        'param_name'  => 'style',
        'value'       => array(
          'Simple'      => 'simple',
          'Rhombus'     => 'rhombus',
          'Transperent' => 'transperent'
        )
      ),
      array(
        'type'        => 'dropdown',
        'heading'     => __( 'Text align', 'js_composer' ),
        'param_name'  => 'text_align',
        'value'       => array(
          'Center'     => '',
          'Left'       => 'left-align-text'
        ),
        'dependency'  => array( 'element' => 'style', 'value' => array('transperent') )
      ),
      array(
        'type'        => 'colorpicker',
        'heading'     => __( 'Background color', 'js_composer' ),
        'param_name'  => 'color',
        'dependency'  => array( 'element' => 'style', 'value' => array('rhombus') )
      ),
      array(
        'type'        => 'colorpicker',
        'heading'     => __( 'Font color', 'js_composer' ),
        'param_name'  => 'font_color'
      ),
      array(
        'type'        => 'textfield',
        'heading'     => __( 'Title text', 'js_composer' ),
        'param_name'  => 'title',
        'value'       => ''
      ),
      array(
        'type'        => 'dropdown',
        'heading'     => __( 'Icon', 'js_composer' ),
        'param_name'  => 'icon',
        'value'       => array(
          'None'       =>  'none',
          'Umbrella'   =>  'umbrella',
          'Like'       =>  'like',
          'Rocket'     =>  'rocket',
          'Settings'   =>  'settings',
          'Coffe'      =>  'coffe',
          'Portfolio'  =>  'portfolio',
          'Gleam'      =>  'gleam',
          'Light'      =>  'light',
          'Video'      =>  'video',
          'Vector'     =>  'vector'
        )
      ),
      array(
        'type'        => 'textarea_html',
        'heading'     => __( 'Text', 'js_composer' ),
        'holder'      => 'div',
        'param_name'  => 'content'
      )
    )
  )
);

// ==========================================================================================
// INTRO BLOCK                                                                           -
// ==========================================================================================

vc_map( array(
    'name'            => __( 'Intro block', 'js_composer' ),
    'base'            => 'mevo_intro',
    'description'     => __( 'Custom text block', 'js_composer' ),
    'params'          => array(
      array(
        'type'        => 'textarea_html',
        'heading'     => __( 'Text', 'js_composer' ),
        'holder'      => 'div',
        'param_name'  => 'content'
      ),
      array(
        'type'        => 'dropdown',
        'heading'     => __( 'Text position', 'js_composer' ),
        'param_name'  => 'text_align',
        'value'       => array(
            'Center'   => 'center',
            'Left'     => 'left',
            'Right'    => 'right',
        )
      ),
      array(
        'type'        => 'colorpicker',
        'heading'     => __( 'Font color', 'js_composer' ),
        'param_name'  => 'color'
      )
    )
  )
);

// ==========================================================================================
// COUNTER                                                                                  -
// ==========================================================================================

vc_map( array(
    'name'            => __( 'Counter', 'js_composer' ),
    'base'            => 'mevo_counter',
    'params'          => array(
      array(
        'type'        => 'textfield',
        'heading'     => __( 'Title', 'js_composer' ),
        'param_name'  => 'title',
        'value'       => ''
      ),
      array(
        'type'        => 'textfield',
        'heading'     => __( 'Count', 'js_composer' ),
        'param_name'  => 'count'
      )
    )
  )
);

// ==========================================================================================
// Teams
// ==========================================================================================
vc_map( array(
  'name'            => __( 'Team', 'js_composer' ),
  'base'            => 'mevo_team',
  'description'     => __( 'Team members', 'js_composer' ),
  'params'          => array(
      array(
        'type'        => 'attach_image',
        'heading'     => __( 'Avatar', 'js_composer' ),
        'param_name'  => 'image',
      ),
      array(
        'type'        => 'textfield',
        'heading'     => __( 'Name', 'js_composer' ),
        'param_name'  => 'name',
        'value'       => 'John Doe',
        'admin_label' =>  true
      ),

      array(
        'type'        => 'textfield',
        'heading'     => __( 'Facebook', 'js_composer' ),
        'param_name'  => 'social_facebook',
        'value'       => '#',
        'description' => __( 'Enter facebook social link url.', 'js_composer' ),
        'group'       => 'Social URL'
      ),
      array(
        'type'        => 'textfield',
        'heading'     => __( 'Twitter', 'js_composer' ),
        'param_name'  => 'social_twitter',
        'value'       => '#',
        'description' => __( 'Enter twitter social link url.', 'js_composer' ),
        'group'       => 'Social URL'
      ),
      array(
        'type'        => 'textfield',
        'heading'     => __( 'Dribble', 'js_composer' ),
        'param_name'  => 'social_dribble',
        'value'       => '#',
        'description' => __( 'Enter dribble social link url.', 'js_composer' ),
        'group'       => 'Social URL'
      ),
      array(
        'type'        => 'textfield',
        'heading'     => __( 'Google Plus', 'js_composer' ),
        'param_name'  => 'social_gplus',
        'value'       => '#',
        'description' => __( 'Enter google plus social link url.', 'js_composer' ),
        'group'       => 'Social URL'
      ),
      array(
        'type'        => 'textfield',
        'heading'     => __( 'Linkedin', 'js_composer' ),
        'param_name'  => 'social_linkedin',
        'value'       => '#',
        'description' => __( 'Enter Linkedin social link url.', 'js_composer' ),
        'group'       => 'Social URL'
      ),

    )
  )
);

// ==========================================================================================
// COUNTER                                                                                  -
// ==========================================================================================

vc_map( array(
    'name'            => __( 'Skills', 'js_composer' ),
    'base'            => 'mevo_skills',
    'description'     => __( 'Level of knowledge', 'js_composer' ),
    'params'          => array(
      array(
        'type'        => 'textfield',
        'heading'     => __( 'Title', 'js_composer' ),
        'param_name'  => 'title',
        'value'       => ''
      ),
      array(
        'type'        => 'colorpicker',
        'heading'     => __( 'Title font color', 'js_composer' ),
        'param_name'  => 'color'
      ),
      array(
        'type'        => 'textfield',
        'heading'     => __( 'Count percent', 'js_composer' ),
        'param_name'  => 'count'
      ),
      array(
        'type'        => 'colorpicker',
        'heading'     => __( 'Circle active color', 'js_composer' ),
        'param_name'  => 'color_active'
      ),
      array(
        'type'        => 'colorpicker',
        'heading'     => __( 'Circle non active color', 'js_composer' ),
        'param_name'  => 'color_non_active'
      ),
    )
  )
);

// ==========================================================================================
// ABOUT US                                                                                 -
// ==========================================================================================

vc_map( array(
    'name' => __( 'About us', 'js_composer' ),
    'base' => 'mevo_about',
    'description'     => __( 'Short information', 'js_composer' ),
    'params' => array(
      array(
        'type'       => 'param_group',
        'heading'    => __( 'Values', 'js_composer' ),
        'param_name' => 'values',
        'params'     => array(
          array(
            'type' => 'attach_image',
            'heading' => __( 'Top Image', 'js_composer' ),
            'param_name' => 'top_img',
            'value' => '',
          ),
          array(
            'type' => 'attach_image',
            'heading' => __( 'Bottom Image', 'js_composer' ),
            'param_name' => 'bottom_img',
            'value' => '',
          ),
          array(
            'type'        => 'textfield',
            'heading'     =>  __( 'Title', 'js_composer' ),
            'param_name'  => 'title',
            'value'       => ''
          ),
          array(
            'type'        => 'textfield',
            'heading'     =>  __( 'Short description', 'js_composer' ),
            'param_name'  => 'description',
            'value'       => ''
          ),
          array(
            'type'        => 'dropdown',
            'heading'     => __( 'Icon', 'js_composer' ),
            'param_name'  => 'icon',
            'value'       => array(
              'Umbrella'   =>  'umbrella',
              'Like'       =>  'like',
              'Rocket'     =>  'rocket',
              'Settings'   =>  'settings',
              'Coffe'      =>  'coffe',
              'Portfolio'  =>  'portfolio',
              'Gleam'      =>  'gleam',
              'Light'      =>  'light',
              'Video'      =>  'video',
              'Vector'     =>  'vector'
            )
          ),
        ),
        'callbacks' => array(
          'after_add' => 'vcChartParamAfterAddCallback'
        )
      ),
    ),
    'js_view' => 'VcIconElementView_Backend',
  )
);

// ==========================================================================================
// TESTIMONIALS                                                                             -
// ==========================================================================================

vc_map( array(
    'name' => __( 'Testimonials', 'js_composer' ),
    'base' => 'mevo_testimonials',
    'description'     => __( 'Client reviews', 'js_composer' ),
    'params' => array(
      array(
        'type'        => 'dropdown',
        'heading'     => __( 'Style', 'js_composer' ),
        'param_name'  => 'style',
        'value'       => array(
          'Classic'    =>  'classic',
          'Modern'     =>  'modern'
        )
      ),
      array(
        'type'       => 'param_group',
        'heading'    => __( 'Values', 'js_composer' ),
        'param_name' => 'values',
        'params'     => array(
          array(
            'type'       => 'attach_image',
            'heading'    => __( 'Image', 'js_composer' ),
            'param_name' => 'img',
            'value'      => '',
          ),
          array(
            'type'       => 'textfield',
            'heading'    => __( 'Name', 'js_composer' ),
            'param_name' => 'name',
            'value'      => '',
            'description'=> 'Only for Classic tetimonial style'
          ),
          array(
            'type'       => 'textfield',
            'heading'    => __( 'Position', 'js_composer' ),
            'param_name' => 'position',
            'value'      => '',
            'description'=> 'Only for Classic tetimonial style'
          ),
          array(
            'type'       => 'textarea',
            'heading'    => __( 'Text', 'js_composer' ),
            'holder'     => 'div',
            'param_name' => 'text'
          )
        ),
        'callbacks' => array(
          'after_add' => 'vcChartParamAfterAddCallback'
        )
      ),
    ),
    'js_view' => 'VcIconElementView_Backend',
  )
);

// ==========================================================================================
// BLOG OR PORTFOLIO LIST                                                                   -
// ==========================================================================================

vc_map( array(
    'name'            => __( 'Blog or Portfolio list', 'js_composer' ),
    'base'            => 'mevo_posts',
    'description'     => __( 'Create a blog or portfolio list', 'js_composer' ),
    'params'          => array(
      array(
        'type'        => 'textfield',
        'heading'     => __( 'Posts Per Page', 'js_composer' ),
        'param_name'  => 'limit',
        'value'       => '',
        'admin_label' => true
      ),
      array(
        'type'        => 'dropdown',
        'heading'     => __( 'Post type', 'js_composer' ),
        'param_name'  => 'post_type',
        'value'       => array(
          'Post'       => 'post',
          'Portfolio'  => 'portfolio'
        )
      ),
      array(
        'type'        => 'dropdown',
        'heading'     => __( 'Portfolio style', 'js_composer' ),
        'param_name'  => 'portfolio_style',
        'value'       => array(
          'Classic'    => 'classic',
          'Modern'     => 'modern',
          'Creative'   => 'creative',
          'Designed'   => 'designed'
        ),
        'dependency'  => array( 'element' => 'post_type', 'value' => array('portfolio') )
      ),
      array(
        'type'        => 'vc_efa_chosen',
        'heading'     => __( 'Custom Categories', 'js_composer' ),
        'param_name'  => 'cats',
        'placeholder' => 'Choose category (optional)',
        'value'       => mevo_element_values( 'categories', array(
          'sort_order'  => 'ASC',
          'hide_empty'  => false,
        ) ),
        'std'         => '',
        'description' => __( 'You can choose spesific categories for blog, default is all categories', 'js_composer' ),
        'dependency'  => array( 'element' => 'post_type', 'value' => array('post') )
      ),
      array(
        'type'        => 'checkbox',
        'heading'     => __( 'Enable filter?', 'js_composer' ),
        'param_name'  => 'filter',
        'value'       => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
        'dependency'  => array( 'element' => 'post_type', 'value' => array('portfolio') )
      ),
      array(
        'type'        => 'dropdown',
        'heading'     => __( 'Filter position', 'js_composer' ),
        'param_name'  => 'filter_position',
        'value'       => array(
          'Center'     => '',
          'Left'       => 'style-7',
          'Right'      => 'style-6'
        ),
        'dependency'  => array( 'element' => 'filter', 'value' => array('yes') )
      ),
      array(
        'type'        => 'checkbox',
        'heading'     => __( 'Disable lightbox?', 'js_composer' ),
        'param_name'  => 'lightbox',
        'value'       => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
        'dependency'  => array( 'element' => 'post_type', 'value' => array('portfolio') )
      ),
      array(
        'type'        => 'vc_efa_chosen',
        'heading'     => __( 'Custom Categories', 'js_composer' ),
        'param_name'  => 'portfolio_cats',
        'placeholder' => 'Choose category (optional)',
        'value'       => mevo_element_values( 'portfolio-categories', array(
          'sort_order'  => 'ASC',
          'hide_empty'  => false,
        ) ),
        'std'         => '',
        'description' => __( 'You can choose spesific categories for portfolio, default is all categories', 'js_composer' ),
        'dependency'  => array( 'element' => 'post_type', 'value' => array('portfolio') )
      ),
    )
  )
);

// ==========================================================================================
// YOUTUBE VIDEO                                                                            -
// ==========================================================================================

vc_map( array(
    'name'            => __( 'Youtube video', 'js_composer' ),
    'base'            => 'mevo_video',
    'description'     => __( 'Video block', 'js_composer' ),
    'params'          => array(
      array(
        'type'        => 'textfield',
        'heading'     => __( 'Left side text', 'js_composer' ),
        'param_name'  => 'left_side',
        'value'       => ''
      ),
      array(
        'type'        => 'textfield',
        'heading'     => __( 'Right side text', 'js_composer' ),
        'param_name'  => 'right_side',
        'value'       => ''
      ),
      array(
        'type'        => 'textfield',
        'heading'     => __( 'Youtube video URL', 'js_composer' ),
        'param_name'  => 'video_url',
        'value'       => ''
      ),
      array(
        'type'       => 'attach_image',
        'heading'    => __( 'Background image', 'js_composer' ),
        'param_name' => 'img',
        'value'      => '',
      ),
    )
  )
);

// ==========================================================================================
// LOGO LINE                                                                                -
// ==========================================================================================

vc_map( array(
    'name'        => __( 'Logo line', 'js_composer' ),
    'base'        => 'mevo_logos',
    'description' => __( 'Our bloved customers', 'js_composer' ),
    'params'      => array(
      array(
        'type'       => 'param_group',
        'heading'    => __( 'Values', 'js_composer' ),
        'param_name' => 'values',
        'params'     => array(
          array(
            'type'       => 'attach_image',
            'heading'    => __( 'Image', 'js_composer' ),
            'param_name' => 'img',
            'value'      => '',
          ),
          array(
            'type'       => 'textfield',
            'heading'    => __( 'Image URL', 'js_composer' ),
            'param_name' => 'url',
            'value'      => ''
          )
        ),
        'callbacks' => array(
          'after_add' => 'vcChartParamAfterAddCallback'
        )
      ),
    ),
    'js_view' => 'VcIconElementView_Backend',
  )
);

// ==========================================================================================
// IMAGE SLIDER                                                                             -
// ==========================================================================================

vc_map( array(
    'name'        => __( 'Image slider', 'js_composer' ),
    'base'        => 'mevo_slider',
    'params'      => array(
      array(
        'type'       => 'param_group',
        'heading'    => __( 'Values', 'js_composer' ),
        'param_name' => 'values',
        'params'     => array(
          array(
            'type'       => 'attach_image',
            'heading'    => __( 'Image', 'js_composer' ),
            'param_name' => 'img',
            'value'      => '',
          ),
          array(
            'type'       => 'textarea',
            'heading'    => __( 'Slide text', 'js_composer' ),
            'param_name' => 'text',
            'value'      => ''
          ),
          array(
            'type'        => 'dropdown',
            'heading'     => __( 'Text align', 'js_composer' ),
            'param_name'  => 'text_align',
            'value'       => array(
                'Center'   => 'center',
                'Left'     => 'left',
                'Right'    => 'right',
            )
          ),
          array(
            'type'        => 'dropdown',
            'heading'     => __( 'Text style', 'js_composer' ),
            'param_name'  => 'text_style',
            'value'       => array(
                'White'    => 'white',
                'Black'    => 'black'
            )
          ),
          array(
            'type'        => 'dropdown',
            'heading'     => __( 'Title animation', 'js_composer' ),
            'param_name'  => 'animation',
            'value'       => array(
              'None'           => 'none',
              'Fade In Left'   => 'fadeInLeft',
              'Fade In Right'  => 'fadeInRight',
              'Bounce In'      => 'bounceIn',
              'Zoom In Up'     => 'zoomInUp',
              'Flip In X'      => 'flipInX',
              'Bounce In Down' => 'bounceInDown',
              'Zoom In Down'   => 'zoomInDown',
            )
          )
        ),
        'callbacks' => array(
          'after_add' => 'vcChartParamAfterAddCallback'
        )
      ),
    ),
    'js_view' => 'VcIconElementView_Backend',
  )
);

// ==========================================================================================
// ABOUT ME                                                                                 -
// ==========================================================================================

vc_map( array(
    'name'            => __( 'About me', 'js_composer' ),
    'base'            => 'mevo_about_me',
    'params'          => array(
      array(
        'type'       => 'attach_image',
        'heading'    => __( 'Image', 'js_composer' ),
        'param_name' => 'img',
        'value'      => '',
      ),
      array(
        'type'        => 'textfield',
        'heading'     => __( 'Name', 'js_composer' ),
        'param_name'  => 'name',
        'value'       => ''
      ),
      array(
        'type'        => 'textfield',
        'heading'     => __( 'Position', 'js_composer' ),
        'param_name'  => 'position',
        'value'       => ''
      ),
      array(
        'type'        => 'textarea_html',
        'heading'     => __( 'Few words', 'js_composer' ),
        'param_name'  => 'content',
        'holder'      => 'div'
      )
    )
  )
);


// ==========================================================================================
// Pricing Tables                                                                           -
// ==========================================================================================
vc_map(
  array(
    'name'        => __( 'Pricing Tables', 'js_composer' ),
    'base'        => 'mevo_pricing_table',
    'params'      => array(
      array(
        'type'        => 'textfield',
        'heading'     => __( 'Title', 'js_composer' ),
        'param_name'  => 'title'
      ),
      array(
        'type'       => 'checkbox',
        'heading'    => __( 'Active item?', 'js_composer' ),
        'param_name' => 'active',
        'value'      => array( __( 'Yes', 'js_composer' ) => 'yes' ),
      ),
      array(
        'type'        => 'textfield',
        'heading'     => __( 'Currency', 'js_composer' ),
        'param_name'  => 'currency',
        'value'       => '',
        'description' => 'Use currency icons, like $, €...'
      ),
      array(
        'type'        => 'textfield',
        'heading'     => __( 'Price', 'js_composer' ),
        'param_name'  => 'price'
      ),
      array(
        'type'        => 'textfield',
        'heading'     => __( 'Period', 'js_composer' ),
        'param_name'  => 'period',
        'value'       => '',
        'description' => 'Example: day, week, month.'
      ),
      array(
        'type'        => 'textarea',
        'heading'     => __( 'Pricing items', 'js_composer' ),
        'holder'      => 'div',
        'param_name'  => 'items',
        'description' => __( 'Each item in a new line', 'js_composer' )
      ),
      array(
        'type'        => 'textfield',
        'heading'     => __( 'Button link', 'js_composer' ),
        'param_name'  => 'btn_link',
        'value'       => ''
      ),
      array(
        'type'        => 'textfield',
        'heading'     => __( 'Button text', 'js_composer' ),
        'param_name'  => 'btn_text',
        'value'       => ''
      ),
    )
  )
);

// ==========================================================================================
// QUOTE                                                                            -
// ==========================================================================================
vc_map( 
  array(
    'name'            => __( 'Quote', 'js_composer' ),
    'base'            => 'mevo_quote',
    'description'     => __( 'Quote text', 'js_composer' ),
    'category'        => __( 'Content', 'js_composer' ),
    'params'          => array(
      array(
        'type'        => 'textarea_html',
        'heading'     => __( 'Quote text', 'js_composer' ),
        'holder'      => 'div',
        'param_name'  => 'content'
      ),
      array(
        'type'        => 'dropdown',
        'heading'     => __( 'Text style', 'js_composer' ),
        'param_name'  => 'style',
        'value'       => array(
          'Moderm'     => 'modern',
          'Classic'    => 'classic'
        )
      ),
      array(
        'type'        => 'colorpicker',
        'heading'     => __( 'Text color', 'js_composer' ),
        'param_name'  => 'color',
        'description' => __( 'Choose text color', 'js_composer' ),
        'dependency'  => array( 'element' => 'style', 'value' => array('modern') )
      ),
      array(
        'type'        => 'textfield',
        'heading'     => __( 'Footer text', 'js_composer' ),
        'param_name'  => 'footer',
        'value'       => '',
        'dependency'  => array( 'element' => 'style', 'value' => array('classic') )
      ),
      array(
        'type'        => 'colorpicker',
        'heading'     => __( 'Background color', 'js_composer' ),
        'param_name'  => 'background_color',
        'description' => __( 'Choose text color', 'js_composer' ),
        'dependency'  => array( 'element' => 'style', 'value' => array('modern') )
      ),
      array(
        'type'        => 'textfield',
        'heading'     => __( 'Text padding', 'js_composer' ),
        'param_name'  => 'padding',
        'value'       => '',
        'dependency'  => array( 'element' => 'style', 'value' => array('modern') )
      )
    )
  )
);

// ==========================================================================================
// BREADCRUMB                                                                                -
// ==========================================================================================

vc_map( array(
    'name'        => __( 'Bread Crumbs', 'js_composer' ),
    'base'        => 'mevo_bread_crumbs',
    'params'      => array(
      array(
        'type'       => 'param_group',
        'heading'    => __( 'Values', 'js_composer' ),
        'param_name' => 'values',
        'params'     => array(
          array(
            'type'       => 'textfield',
            'heading'    => __( 'Link Text', 'js_composer' ),
            'param_name' => 'text',
            'value'      => ''
          ),
          array(
            'type'       => 'textfield',
            'heading'    => __( 'Link URL', 'js_composer' ),
            'param_name' => 'url',
            'value'      => ''
          )
        ),
        'callbacks' => array(
          'after_add' => 'vcChartParamAfterAddCallback'
        )
      ),
    ),
    'js_view' => 'VcIconElementView_Backend',
  )
);