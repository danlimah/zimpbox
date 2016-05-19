<?php
/**
 * Requried functions for theme backend.
 *
 * @package mevo
 * @subpackage Template
 */


/**
 *
 * element values post, page, categories
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'mevo_element_values' ) ) {
  function mevo_element_values(  $type = '', $query_args = array() ) {

    $options = array();

    switch( $type ) {

      case 'portfolio-categories':
        $categories = get_terms( 'portfolio-category', '' );

        foreach ( $categories as $category ) {
          $options[$category->name] = $category->term_id;
        }
        break;

      case 'pages':
      case 'page':
        $pages = get_pages( $query_args );

        if ( !empty($pages) ) {
          foreach ( $pages as $page ) {
            $options[$page->post_title] = $page->ID;
          }
        }
        break;

      case 'posts':
      case 'post':
       $posts = get_posts( $query_args );

        if ( !empty($posts) ) {
          foreach ( $posts as $post ) {
            $options[$post->post_title] = lcfirst($post->post_title);
          }
        }
        break;

      case 'tags':
      case 'tag':

        $tags = get_terms( $query_args['taxonomies'], $query_args['args'] );
          if ( !empty($tags) ) {
            foreach ( $tags as $tag ) {
              $options[$tag->name] = $tag->term_id;
          }
        }
        break;

      case 'categories':
      case 'category':

        $categories = get_categories( $query_args );
        if ( !empty($categories) ) {
          foreach ( $categories as $category ) {
            $options[$category->name] = $category->term_id;
          }
        }
        break;

      case 'custom':
      case 'callback':

        if( is_callable( $query_args['function'] ) ) {
          $options = call_user_func( $query_args['function'], $query_args['args'] );
        }

        break;

    }

    return $options;

  }
}

/**
 *
 * Helper Functions
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( !function_exists( 'mevo_the_post_thumbnail' ) ) {
  function mevo_the_post_thumbnail() {
    the_post_thumbnail( 'full' );
    get_post_format();
  }
}

/**
 *
 * Helper Functions
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( !function_exists( 'mevo_get_options' ) ) {
  function mevo_get_options() {
    global $mevo;
    $mevo = apply_filters( 'cs_get_option', get_option( CS_OPTION ) );
  }
  add_action( 'wp', 'mevo_get_options' );
}

/**
 *
 * Get first "url" from post content or string
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'mevo_get_first_url_from_string' ) ) {
  function mevo_get_first_url_from_string( $string ) {
    $pattern  = "/^\b(?:(?:https?|ftp):\/\/)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i";
    preg_match( $pattern, $string, $link );
    return ( !empty( $link[0] ) ) ? $link[0] : false;
  }
}

/**
 *
 * Custom Regular Expression
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists('mevo_get_shortcode_regex') ) {
  function mevo_get_shortcode_regex( $tagregexp = '' ) {
    // WARNING! Do not change this regex without changing do_shortcode_tag() and strip_shortcode_tag()
    // Also, see shortcode_unautop() and shortcode.js.
    return
      '\\['                                // Opening bracket
      . '(\\[?)'                           // 1: Optional second opening bracket for escaping shortcodes: [[tag]]
      . "($tagregexp)"                     // 2: Shortcode name
      . '(?![\\w-])'                       // Not followed by word character or hyphen
      . '('                                // 3: Unroll the loop: Inside the opening shortcode tag
      .     '[^\\]\\/]*'                   // Not a closing bracket or forward slash
      .     '(?:'
      .         '\\/(?!\\])'               // A forward slash not followed by a closing bracket
      .         '[^\\]\\/]*'               // Not a closing bracket or forward slash
      .     ')*?'
      . ')'
      . '(?:'
      .     '(\\/)'                        // 4: Self closing tag ...
      .     '\\]'                          // ... and closing bracket
      . '|'
      .     '\\]'                          // Closing bracket
      .     '(?:'
      .         '('                        // 5: Unroll the loop: Optionally, anything between the opening and closing shortcode tags
      .             '[^\\[]*+'             // Not an opening bracket
      .             '(?:'
      .                 '\\[(?!\\/\\2\\])' // An opening bracket not followed by the closing shortcode tag
      .                 '[^\\[]*+'         // Not an opening bracket
      .             ')*+'
      .         ')'
      .         '\\[\\/\\2\\]'             // Closing shortcode tag
      .     ')?'
      . ')'
      . '(\\]?)';                          // 6: Optional second closing brocket for escaping shortcodes: [[tag]]
  }
}

/**
 *
 * Tag Regular Expression
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'mevo_tagregexp' ) ) {
  function mevo_tagregexp() {
    return apply_filters( 'artis_custom_tagregexp', 'video|audio|playlist|video-playlist|embed|cs_media' );
  }
}

/**
 *
 * POST FORMAT: VIDEO & AUDIO
 *
 */
if( ! function_exists( 'mevo_post_media' ) ) {
  function mevo_post_media( $content ) {
    $result = strpos ($content, 'iframe');
    if ($result === FALSE) {
      $media = mevo_get_first_url_from_string( $content );
      if( ! empty( $media ) ) {
        global $wp_embed;
        $content  = do_shortcode( $wp_embed->run_shortcode( '[embed]'. $media .'[/embed]' ) );
      } else {
        $pattern = mevo_get_shortcode_regex( mevo_tagregexp() );
        preg_match( '/'.$pattern.'/s', $content, $media );
        if ( ! empty( $media[2] ) ) {
          if( $media[2] == 'embed' ) {
            global $wp_embed;
            $content = do_shortcode( $wp_embed->run_shortcode( $media[0] ) );
          } else {
            $content = do_shortcode( $media[0] );
          }
        }
      }
      if( ! empty( $media ) ) {
        $output = $content;
        return $output;
      }
      return false;
    } else {
      return $content;
    }
  }
}

/**
 *
 * Create custom html structure for comments
 *
 */
function mevo_comment( $comment, $args, $depth ) {

  $GLOBALS['comment'] = $comment;

  $reply_class = ( $comment->comment_parent ) ? 'indented' : '';
  switch ( $comment->comment_type ):
    case 'pingback':
    case 'trackback':
      ?>
        <p class="pingback">
          <?php esc_html_e( 'Pingback:', 'mevo' ); ?> <?php comment_author_link(); ?>
          <?php edit_comment_link( esc_html__( '(Edit)', 'mevo' ), '<span class="edit-link">', '</span>' ); ?>
        </p>
      <?php
      break;
    default:
      // generate comments
      ?>
      <div class="comment clearfix" id="comment-<?php comment_ID(); ?>">
        <?php print get_avatar( $comment, 100,'','', array( 'class' => 'comment-img' ) ); ?>
        <!-- <img class="comment-img" src="img/user-1.jpg" alt=""> -->
        <div class="comment-content">
          <div class="comment-title">
            <?php comment_author(); ?>,
            <span><?php comment_date( get_option('date_format') );?></span>
            <?php
              comment_reply_link(
                array_merge( $args,
                  array(
                    'reply_text' => esc_html__( 'Reply &raquo;', 'mevo' ),
                    'after' => '',
                    'depth' => $depth,
                    'max_depth' => $args['max_depth']
                  )
                )
              );
            ?>
          </div>
          <div class="comment-text"><?php comment_text(); ?></div>
        </div>
      </div>

      <?php
      break;
  endswitch;
}

/*
 * Blog item header.
 */
function mevo_blog_item_hedeader( $option, $post_id ) {
  global $mevo;
  if ( isset( $option[0]['post_preview_style'] ) ) {
    switch ( $option[0]['post_preview_style'] ) {
      case 'image':
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' );
        if ( empty( $image ) ) {
          $image[0] = $mevo['default_post_image'];
        }
        $output  = '<div class="post-media">';
        $output .= '<img src="' . $image[0] . '">';
        $output .= '</div>';
        break;
      case 'video':
        $output  = '<div class="post-media video-container">';
        $output .= mevo_post_media($option[0]['post_preview_video']);
        $output .= '</div>';
        break;
      case 'slider':
        $output  = '<div class="post-media">';
        $output .= '<div class="img-slider">';
        $output .= '<ul class="slides">';
        $images = explode( ',' , $option[0]['post_preview_slider'] );
        foreach ( $images as $image ) {
          $url = ( is_numeric( $image ) && ! empty( $image ) ) ? wp_get_attachment_url( $image ) : '';
          if( ! empty( $url ) ) {
            $output .= '<li><img src="' . $url . '" alt=""></li>';
          }
        }
        $output .= '</ul>';
        $output .= '</div>';
        $output .= '</div>';
        break;
      case 'text':
        $output   = '<i class="fa fa-quote-right fa-2x"></i><blockquote>';
        $output  .= $option[0]['post_preview_text'];
        $output  .= '</blockquote>';
        break;
      case 'audio':
        $output  = '<div class="post-media">';
        $output .= mevo_post_media($option[0]['post_preview_audio']);
        $output .= '</div>';
        break;
    }
  } else {
    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' );
    if ( empty( $image ) ) {
      $image[0] = $mevo['default_post_image'];
    }
    $output  = '<div class="post-media">';
    $output .= '<img src="' . $image[0] . '">';
    $output .= '</div>';
  }
  print $output;
}

function mevo_get_post_views( $postID ) {
  $count_key = 'post_views_count';
  $count = get_post_meta( $postID, $count_key, true );
  if( $count == '' ){
    delete_post_meta( $postID, $count_key );
    add_post_meta( $postID, $count_key, '0' );
    return "0";
  }
  return $count;
}

function mevo_set_post_views( $postID ) {
  $count_key = 'post_views_count';
  $count = get_post_meta( $postID, $count_key, true );
  if( $count == '' ) {
      $count = 0;
      delete_post_meta( $postID, $count_key );
      add_post_meta( $postID, $count_key, '0' );
  } else {
    $count++;
    update_post_meta( $postID, $count_key, $count );
  }
}

/**
 * Return @count last photos from Instagram.
 */
function mevo_get_instagram_photos( $count = 1, $size = 128, $resolution = 'thumbnail' ) {
  if ( ! file_exists( ABSPATH . 'wp-content/plugins/mevo-plugins/lib/instagram.class.php' ) ) {
    return false;
  }

  global $mevo;
  include ABSPATH . 'wp-content/plugins/mevo-plugins/lib/instagram.class.php';

  $config = array(
      'apiKey'      => $mevo['instagram_api_key'],
      'apiSecret'   => '',
      'apiCallback' => ''
  );

  $instagram = new Instagram( $config );

  // Get user data
  $user = $instagram->searchUser( $mevo['instagram_user_name'], 1 );

  // Get user media by user id
  $media = $instagram->getUserMedia( $user->data[0]->id, $count );

  $output = '<ul class="f-gallery clearfix">';
  foreach( $media->data as $data ) {
    $output .= '<li><a href="' . $data->link . '" target="_blank">';
    $output .= '<img src="' . $data->images->$resolution->url . '" height="' . $size . '" width="' . $size . '"/>';
    $output .= '</a></li>';
  }
  $output .= '<ul class="f-gallery clearfix">';

  return $output;
}

/**
 * Helper function for getting twitts.
 */
function mevo_get_twitts( $count_twitts = 2 ) {
  if ( ! file_exists( ABSPATH . 'wp-content/plugins/mevo-plugins/lib/TwitterApi.php' ) ) {
    return false;
  }
  global $mevo;
  include ABSPATH . 'wp-content/plugins/mevo-plugins/lib/TwitterApi.php';

  $config = array(
    'api_key'    => $mevo['twitter_api_key'],
    'api_secret' => $mevo['twitter_api_secret']
  );

  $twitterApi = new Tang\TwitterRestApi\TwitterApi( $config );

  $twitterApi->authenticate();

  $data = $twitterApi->get('statuses/user_timeline', array(
      'screen_name'     => $mevo['twitter_user_name'],
      'count'           => $count_twitts,
      'exclude_replies' => true
  ), true);

  return $data;
}

function mevo_folio_the_widget( $content ) {
  $content = preg_replace( "!</p>(.*?)<p>!si","\\1", $content );
  return $content;
}   
add_filter('widget_text', 'mevo_folio_the_widget');