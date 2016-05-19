<?php
/**
 * Custom widgets.
 *
 * @package mevo
 * @since 1.0
 */

/**
 * Widget with two tabs, latest and popular posts.
 */
class Latest_Posts_Widget extends WP_Widget {
	public function __construct() {
		parent::__construct(
			'latest_posts',
			'Latest posts',
			array( 'description' => esc_html__( 'Get latest posts', 'mevo' ), )
		);
	}
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['count_posts'] = strip_tags( $new_instance['count_posts'] );
		return $instance;
	}
	public function form( $instance ) {
		$instance['title'] = ( isset( $instance['title'] ) && ! empty( $instance['title'] ) ) ? $instance['title'] : '';
		$instance['count_posts'] = ( isset( $instance['count_posts'] ) && ! empty( $instance['count_posts'] ) ) ? $instance['count_posts'] : '';
		?>
		<p>
			<label for="<?php print $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title', 'mevo' ); ?></label>
			<input class="widefat" id="<?php print $this->get_field_id( 'title' ); ?>" 
				name="<?php print $this->get_field_name( 'title' ); ?>" type="text" 
				value="<?php print $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php print $this->get_field_id( 'count_posts' ); ?>"><?php esc_html_e( 'Count posts', 'mevo' ); ?></label>
			<input class="widefat" id="<?php print $this->get_field_id( 'count_posts' ); ?>" 
				name="<?php print $this->get_field_name( 'count_posts' ); ?>" type="text" 
				value="<?php print $instance['count_posts']; ?>" />
		</p>
		<?php
	}


	public function widget( $args, $instance ) {

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$count_posts = ( ! empty( $instance['count_posts'] ) && is_numeric( $instance['count_posts'] ) ) ? $instance['count_posts'] : 2;

		print $args['before_widget'];
		if ( $title ) {
			print $args['before_title'] . $title . $args['after_title'];
		}
				
		$this->get_custom_posts( $count_posts, '', 'first-tab', 1 );

		print $args['after_widget'];
	}

	function get_custom_posts( $count, $filter = 'comment_count', $class = 'first-tab', $tab ) {
		
		$posts = get_posts( array( 'numberposts' => $count, 'orderby' => $filter ) );
		
		if ( $posts ) {
			require_once 'aq_resizer.php';
			print '<div class="latest-post">';
			foreach ( $posts as $post ) {
				$img_url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
				?>
					<div class="s-post">
	                    <a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>"><img class="s-post-img" src="<?php echo esc_html( aq_resize( $img_url, 55, 55, true, true, true ) ); ?>" alt=""></a>
	                    <div class="s-post-content">
	                        <a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>" class="s-post-title"><?php echo esc_html( $post->post_title ); ?></a>
	                        <div class="s-post-date"><?php the_time( get_option('date_format') ); ?></div>
	                    </div>
	                </div>
				<?php 
			}
			print '</div>';
		}
	}
}

add_action( 'widgets_init', function() {
	register_widget( 'Latest_Posts_Widget' );
});
/*

/**
 * Display latest Instagram photos.
 */
class Instagram_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'instagram_widget',
			'Instagram Widget',
			array( 'description' => esc_html__( 'Get latest photos', 'mevo' ), )
		);
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['count_photos'] = strip_tags( $new_instance['count_photos'] );
		return $instance;
	}

	public function form( $instance ) {
	$instance['title'] = ( isset( $instance['title'] ) && ! empty( $instance['title'] ) ) ? $instance['title'] : '';
	$instance['count_photos'] = ( isset( $instance['count_photos'] ) && ! empty( $instance['count_photos'] ) ) ? $instance['count_photos'] : '';
	?>
		<p>
			<label for="<?php print $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title', 'mevo' ); ?></label>
			<input class="widefat" id="<?php print $this->get_field_id( 'title' ); ?>" 
				name="<?php print $this->get_field_name( 'title' ); ?>" type="text" 
				value="<?php print $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php print $this->get_field_id( 'count_photos' ); ?>"><?php esc_html_e( 'Count photos', 'mevo' ); ?></label>
			<input class="widefat" id="<?php print $this->get_field_id( 'count_photos' ); ?>" 
				name="<?php print $this->get_field_name( 'count_photos' ); ?>" type="text" 
				value="<?php print $instance['count_photos']; ?>" />
		</p>
	<?php
	}
	public function widget( $args, $instance ) {
		if ( ! file_exists( ABSPATH . 'wp-content/plugins/mevo-plugins/lib/instagram.class.php' ) ) {
			print "<p>" . esc_html__( 'Plaese activate required plugins' , 'mevo' ) . "</p>";
		}
		else {
			$count_photos = ( ! empty( $instance['count_photos'] ) && is_numeric( $instance['count_photos'] ) ) ? $instance['count_photos'] : 2;
			$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
			
			print $args['before_widget'];
			if ( $title ) {
				print $args['before_title'] . $title . $args['after_title'];
			}

			print mevo_get_instagram_photos( $count_photos, 80 );

			print $args['after_widget'];
		}
	}
}

add_action( 'widgets_init', function() {
	register_widget( 'Instagram_Widget' );
});

/**
 * Display last user twitts.
 */
class Twitter_Widget extends WP_Widget {
	public function __construct() {
		parent::__construct(
			'twitter_widget',
			'Twitter Widget',
			array( 'description' => esc_html__( 'Get latest tweets', 'mevo' ), )
		);
	}
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['count_twitts'] = strip_tags( $new_instance['count_twitts'] );
		return $instance;
	}

	public function form( $instance ) {
	$instance['title'] = ( isset( $instance['title'] ) && ! empty( $instance['title'] ) ) ? $instance['title'] : '';
	$instance['count_twitts'] = ( isset( $instance['count_twitts'] ) && ! empty( $instance['count_twitts'] ) ) ? $instance['count_twitts'] : '';
	?>
		<p>
			<label for="<?php print $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title', 'mevo' ); ?></label>
			<input class="widefat" id="<?php print $this->get_field_id( 'title' ); ?>" 
				name="<?php print $this->get_field_name( 'title' ); ?>" type="text" 
				value="<?php print $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php print $this->get_field_id( 'count_twitts' ); ?>"><?php esc_html_e( 'Count twitts', 'mevo' ); ?></label>
			<input class="widefat" id="<?php print $this->get_field_id( 'count_twitts' ); ?>" 
				name="<?php print $this->get_field_name( 'count_twitts' ); ?>" type="text" 
				value="<?php print $instance['count_twitts']; ?>" />
		</p>
	<?php
	}

	public function widget( $args, $instance ) {

		if ( ! file_exists( ABSPATH . 'wp-content/plugins/mevo-plugins/lib/TwitterApi.php' ) ) {
			print "<p>" . esc_html__( 'Plaese activate required plugins' , 'mevo' ) . "</p>";
		}
		else {
			$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
			$count_twitts = ( ! empty( $instance['count_twitts'] ) && is_numeric( $instance['count_twitts'] ) ) ? $instance['count_twitts'] : 2;
			
			print $args['before_widget'];
			if ( $title ) {
				print $args['before_title'] . $title . $args['after_title'];
			}

			$twitts = mevo_get_twitts( $count_twitts );

			$output = '';

			$output .= '<ul class="f-tweets">';
			foreach ( $twitts as $twitt ) {
				$output .= '<li>' . $twitt->text . '</li>';
			}
			$output .= '</ul>';

			print $output;
			print $args['after_widget'];
		}
	}
}

add_action( 'widgets_init', function() {
	register_widget( 'Twitter_Widget' );
});
