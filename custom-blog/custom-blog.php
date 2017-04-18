<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              #
 * @since             1.0.0
 * @package           Custom_Blog
 *
 * @wordpress-plugin
 * Plugin Name:       Custom-blog
 * Plugin URI:        #
 * Description:       This is a short description of what the plugin does. It's displayed custom list of blog posts.
 * Version:           1.0.0
 * Author:            Denis Shemetov
 * Author URI:        #
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       custom-blog
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-custom-blog-activator.php
 */
function activate_custom_blog() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-custom-blog-activator.php';
	Custom_Blog_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-custom-blog-deactivator.php
 */
function deactivate_custom_blog() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-custom-blog-deactivator.php';
	Custom_Blog_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_custom_blog' );
register_deactivation_hook( __FILE__, 'deactivate_custom_blog' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-custom-blog.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_custom_blog() {

	$plugin = new Custom_Blog();
	$plugin->run();

}
run_custom_blog();
