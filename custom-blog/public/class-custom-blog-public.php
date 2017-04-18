<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Custom_Blog
 * @subpackage Custom_Blog/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Custom_Blog
 * @subpackage Custom_Blog/public
 * @author     Denis Shemetov <youepidemic@gmail.com>
 */
class Custom_Blog_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->custom_blog_options = get_option($this->plugin_name);

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Custom_Blog_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Custom_Blog_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/custom-blog-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Custom_Blog_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Custom_Blog_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/custom-blog-public.js', array( 'jquery' ), $this->version, false );

	}


	public function create_shortcode($atts){
		
		
			extract( shortcode_atts( array(
		      'posts_per_page' => $this->custom_blog_options['posts_per_page'],
		      'category' => $this->custom_blog_options['category'],
		      'show_images' => $this->custom_blog_options['thumb']
		      ), $atts ) );

			//return $account;

			$args = array('posts_per_page' => $posts_per_page, 'cat' => $category );

			$custom_query = new WP_Query($args); // exclude category 9

				while($custom_query->have_posts()) : $custom_query->the_post();

					?><div <?php post_class(); ?> id="post-<?php the_ID(); ?>">

						<?php if(!empty($show_images)){

							if ( has_post_thumbnail() ) : ?>
							<div class="thumb_wrapper">
							    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							        <?php the_post_thumbnail(); ?>
							    </a>
							</div>
							<?php endif;

						} ?>

						<div class="text_content_wrapper">
							<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

							<p><i><?php the_date(); ?></i></p>
							<?php 
								$content = get_the_content();
								$trimmed_content = wp_trim_words( $content, 100, '...' );
							?>
							<p><?php echo $trimmed_content; ?></p>
							<a href="<?php the_permalink(); ?>"><?php _e('Read more', $this->plugin_name);?></a>
						</div>
					</div>

				<?php endwhile;
				wp_reset_postdata(); 

		//echo $this->custom_blog_options['thumb'];

 	}

}
