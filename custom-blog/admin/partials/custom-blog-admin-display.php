<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Custom_Blog
 * @subpackage Custom_Blog/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<?php
/**
*
* admin/partials/wp-cbf-admin-display.php - Don't add this comment
*
**/
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">

    <h2><?php echo esc_html(get_admin_page_title()); ?></h2>
    
    <form method="post" name="custom_blog_options" action="options.php">
		
		<?php
	        // Cleanup
			//$options = get_option($this->plugin_name);

            $options = wp_parse_args(get_option($this->plugin_name), $this->custom_blog_options);

	        $thumb = $options['thumb'];
            $posts_per_page = $options['posts_per_page'];
	        $category = $options['category'];

	        settings_fields($this->plugin_name);
	        do_settings_sections($this->plugin_name);
	    ?>


        <!-- remove some meta and generators from the <head> -->
        <fieldset>
            <legend class="screen-reader-text"><span>Options</span></legend>
            <label for="<?php echo $this->plugin_name; ?>-thumb">
                <span><?php esc_attr_e('Show thumbnail of the post: ', $this->plugin_name); ?></span>
                <input type="checkbox" id="<?php echo $this->plugin_name; ?>-thumb" name="<?php echo $this->plugin_name; ?>[thumb]" value="1" <?php checked($thumb, 1);?>/>
            </label>
        </fieldset>
        <fieldset>
            <label for="<?php echo $this->plugin_name; ?>-posts_per_page">
                <span><?php esc_attr_e('How mush posts to show: ', $this->plugin_name); ?></span>
                <input name="<?php echo $this->plugin_name; ?>[posts_per_page]" type="number" step="1" min="1" id="<?php echo $this->plugin_name; ?>-posts_per_page" value="<?php echo $posts_per_page; ?>" class="small-text">
            </label>
        </fieldset>

        
        <label><?php esc_attr_e('Select category: ', $this->plugin_name); ?></label>
        <?php 
            wp_dropdown_categories( array(
                'hide_empty'       => 1,
                'name'             => $this->plugin_name.'[category]',
                'id'               => $this->plugin_name.'-category',
                'orderby'          => 'name',
                'selected'         => $category->parent,
                'hierarchical'     => true,
                'show_option_all'  => 'All categories',
                'selected'         => $category
            ) );
        ?>

        <?php //var_dump( $options ); ?>


        <?php submit_button('Save all changes', 'primary','submit', TRUE); ?>

    </form>

</div>
