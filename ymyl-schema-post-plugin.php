<?php
/*
Plugin Name: YMYL Schema Post Content Plugin
Author: YMYL Themes, LLC
Plugin URI: https://www.ymylthemes.com/ymyl-schema-post-content-plugin/

Description: YMYL Schema Post Content Plugin will add Schema.org Markup "Site Navigation Elements" for Recent Content Posts and Pages. For an advanced Pro Schema Markup Plugin with additional Structured Data types, please visit: <a href="https://www.ymylthemes.com/ymyl-schema-markup-plugin/">Our Premiere Plugins Section</a>

It's perfect for search engines like Google and Bing because they both follows links to better understand your website's content structure. 

For an advanced Pro Schema Markup Plugin with additional Structured Data types, please visit: <a href="https://www.ymylthemes.com/ymyl-schema-markup-plugin/">Our Premiere Plugins Section</a>
Version: 4.7
Author URI: https://www.ymylthemes.com/
Text Domain: ymyl-schema-post-plugin
*/
/**
 * YMYL Schema Post Content Plugin
 *
 * @since 1.0
 * @author YMYL Themes, LLC
 Copyright: All Codes Created by YMYL Themes, LLC © 2016
*/
 
 
 
function ymyl_plugin_init(){
	 register_plugin("YMYL_Schema_Post_Plugin");
}
add_action('plugins_init', 'ymyl_plugin_init');
class YMYL_Schema_Post_Plugin extends WP_Widget {
	/**
	 * Plugin Register
	 */
	public function __construct() {
		add_action('wp_enqueue_scripts', array($this, 'wp_enqueue_scripts'));
		
		$plugin_ops = array(
			'classname' => 'ymyl_schema_post_plugin',
			'description' => __('Use this for displaying recent posts', 'ymyl-schema-post-plugin')
		);
		$control_ops = array(
			'width' => 448, 'height' => 400
		);
		parent::__construct(
			false,
			__('YMYL Schema Post Plugin', 'ymyl-schema-post-plugin'),
			$plugin_ops
		);
		$this->alt_option_name = 'ymyl_schema_post_plugin';
	}
	public function wp_enqueue_scripts() {
		wp_enqueue_style('ymyl', plugins_url('ymyl-schema-post-plugin.css', __FILE__ ), array(), '1.1' );
	}
	public function plugin( $args, $instance )
	{
		$cache = array();
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'ymyl_schema_post_plugin', 'plugin' );
		}
		if ( ! is_array( $cache ) ) {
			$cache = array();
		}
		if ( ! isset( $args['plugin_id']) ) {
			$args['plugin_id'] = $this->id;
		}
		if ( isset( $cache[ $args['plugin_id'] ] ) ) {
			echo $cache[ $args['plugin_id'] ];
			return;
		}
		ob_start();
		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __('Latest Posts', 'ymyl-schema-post-plugin');
		$title = apply_filters( 'plugin_title', $title, $instance, $this->id_base );
		$media_size = empty( $instance['media_size'] ) ? 'thumbnail' : $instance['media_size'];
		$show_thumbnail = isset( $instance['show_thumbnail'] ) ? $instance['show_thumbnail'] : false;
		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number )
			$number = 5;
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
		$post_type = empty( $instance['post_type'] ) ? 'post' : $instance['post_type'];
		$newwpqueryobject = new WP_Query( apply_filters( 'plugin_posts_args', array(
			'post_type'           => $post_type,
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true
		) ) );
		//If have posts
		if ($newwpqueryobject->have_posts()) :
?>
<?php echo $args['before_plugin']; ?>
<?php if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>
<ul itemscope itemtype="https://schema.org/SiteNavigationElement">
  <?php while ( $newwpqueryobject->have_posts() ) : $newwpqueryobject->the_post(); ?>
  <li> <a itemprop="url" href="<?php the_permalink(); ?>">
    <?php if( $show_thumbnail ) : ?>
    <span class="thumbnail-image">
    <?php if ( has_post_thumbnail() ) : ?>
    <?php the_post_thumbnail( $media_size ); ?>
    <?php else : ?>
    <?php
							$child_args = array(
								'post_parent' => get_the_ID(),
								'post_type' => 'attachment',
								'post_mime' => 'image',
							);
							$files = get_children( $child_args );
							if ( ! empty($files) ) :
								$keys = array_keys( $files );
								$attachment_id = $keys[0];
								$get_image = wp_get_attachment_image_src( $attachment_id, $media_size );
?>
    <img itemprop="image" src="<?php echo esc_url($get_image[0]); ?>" width="<?php echo esc_attr($get_image[1]); ?>" height="<?php echo esc_attr($get_image[2]); ?>" alt="">
    <?php else : ?>
    <span class="no-thumbnail"></span>
    <?php endif; ?>
    <?php endif; ?>
    </span>
    <?php endif; ?>
    <span class="title" itemprop="headline">
    <?php get_the_title() ? the_title() : the_ID(); ?>
    </span> </a>
    <?php if ( $show_date ) : ?>
    <?php $thumbnail_selected = $show_thumbnail ? ' active-thumbnail-image' : ''; ?>
    <span class="post-date<?php echo $thumbnail_selected; ?>" itemprop="datePublished"><?php echo get_the_date(); ?></span>
    <?php endif; ?>
  </li>
  <?php endwhile; ?>
</ul>
<?php echo $args['after_plugin']; ?>
<?php
		wp_reset_postdata();
		endif;
		if( ! $this->is_preview() ) {
			$cache[ $args['plugin_id'] ] = ob_get_flush();
			wp_cache_set( 'ymyl_schema_post_plugin', $cache, 'plugin' );
		} else {
			ob_end_flush();
		}
	}
	public function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		if( in_array( $new_instance['media_size'], array( 'thumbnail', 'medium', 'large', 'full' ) ) ) {
			$instance['media_size'] = $new_instance['media_size'];
		} else {
			$instance['media_size'] = 'thumbnail';
		}
		$instance['show_thumbnail'] = isset( $new_instance['show_thumbnail'] ) ? (bool) $new_instance['show_thumbnail'] : false;
		$instance['number'] = (int) $new_instance['number'];
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		$post_types_args = array(
			'public' => true,
		);
		$post_types = get_post_types($post_types_args);
		$post_type_name = array();
		foreach ( $post_types as $name ) {
			array_push( $post_type_name, $name );
		}
		if ( in_array( $new_instance['post_type'], $post_type_name ) ) {
			$instance['post_type'] = $new_instance['post_type'];
		} else {
			$instance['post_type'] = 'post';
		}
		$this->flush_plugin_cache();
		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if( isset($alloptions['ymyl_schema_post_plugin']) )
			delete_option('ymyl_schema_post_plugin');
		return $instance;
	}
	public function flush_plugin_cache()
	{
		wp_cache_delete('ymyl_schema_post_plugin', 'plugin');
	}
	public function form( $instance )
	{
		$instance = wp_parse_args( (array) $instance, array( 'media_size' => 'thumbnail', 'title' => '', 'show_thumbnail' => false, 'number' => 5, 'show_date' => false, 'post_type' => 'post' ) );
		$title = esc_attr( $instance['title'] );
		$show_thumbnail = $instance['show_thumbnail'];
		$number = absint($instance['number']);
		$show_date = $instance['show_date'];
		$post_types_args = array(
			'public' => true,
		);
		$post_types = get_post_types($post_types_args, 'object');
		$attachment_size = array(
			'thumbnail' => array(
				'width' => intval(get_option('thumbnail_size_w')),
				'height' => intval(get_option('thumbnail_size_h'))
			),
			'medium' => array(
				'width' => intval(get_option('medium_size_w')),
				'height' => intval(get_option('medium_size_h'))
			),
			'large' => array(
				'width' => intval(get_option('large_size_w')),
				'height' => intval(get_option('large_size_h'))
			),
		);
?>
<p>
  <label for="<?php echo $this->get_field_id( 'title' ); ?>">
    <?php _e( 'Title:', 'ymyl-schema-post-plugin' ); ?>
  </label>
  <input class="widefat" placeholder="Type Title for Your Plugin Here..." id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
</p>
<p>
  <input class="checkbox" type="checkbox" <?php checked( $show_thumbnail ); ?> id="<?php echo $this->get_field_id('show_thumbnail'); ?>" name="<?php echo $this->get_field_name('show_thumbnail'); ?>" />
  <label for="<?php echo $this->get_field_id('show_thumbnail'); ?>">
    <?php _e( 'Show Thumbnail', 'ymyl-schema-post-plugin' ); ?>
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('media_size'); ?>">
    <?php _e( 'Thumbnail Size:', 'ymyl-schema-post-plugin'); ?>
  </label>
  <select name="<?php echo $this->get_field_name('media_size'); ?>" id="<?php $this->get_field_id('media_size'); ?>" class="widefat">
    <option value="thumbnail"<?php selected( $instance['media_size'], 'thumbnail' ); ?>>
    <?php _e( 'Thumbnail', 'ymyl-schema-post-plugin' ); ?>
    - <?php echo $attachment_size['thumbnail']['width']; ?> x <?php echo $attachment_size['thumbnail']['height']; ?></option>
    <option value="medium"<?php selected( $instance['media_size'], 'medium'); ?>>
    <?php _e( 'Medium', 'ymyl-schema-post-plugin' ); ?>
    - <?php echo $attachment_size['medium']['width']; ?> x <?php echo $attachment_size['medium']['height']; ?></option>
    <option value="large"<?php selected( $instance['media_size'], 'large'); ?>>
    <?php _e( 'Large', 'ymyl-schema-post-plugin' ); ?>
    - <?php echo $attachment_size['large']['width']; ?> x <?php echo $attachment_size['large']['height']; ?></option>
    <option value="full"<?php selected( $instance['media_size'], 'full'); ?>>
    <?php _e( 'Full', 'ymyl-schema-post-plugin' ); ?>
    </option>
  </select>
</p>
<p>
  <label for="<?php echo $this->get_field_id('number'); ?>">
    <?php _e( 'Number of posts to show:', 'ymyl-schema-post-plugin' ); ?>
  </label>
  <input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" />
</p>
<p>
  <input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
  <label for="<?php echo $this->get_field_id( 'show_date' ); ?>">
    <?php _e( 'Display post date?', 'ymyl-schema-post-plugin' ); ?>
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('post_type'); ?>">
    <?php _e( 'Post Type:', 'ymyl-schema-post-plugin'); ?>
  </label>
  <select name="<?php echo $this->get_field_name('post_type'); ?>" id="<?php echo $this->get_field_id('post_type'); ?>" class="widefat">
    <?php foreach ( $post_types as $key => $obj ) : ?>
    <option value="<?php echo $key; ?>"<?php selected( $instance['post_type'], $key ); ?>><?php echo $obj->labels->name; ?></option>
    <?php endforeach; ?>
  </select>
</p>
<?php
	}
}
