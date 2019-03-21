<?php
/**
 * Plugin Name: Custom Flex Posts - Widget and Gutenberg Block
 * Plugin URI:  
 * Description: A widget to display posts adn custom post types with thumbnails in various layouts for any widget area.
 * Version:     1.0.0
 * Author:      Colin Fahrion
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: custom-flex-posts
 * Domain Path: /languages
 *
 * Custome Flex Posts is free software based on Flex posts by Tajam https://tajam.id/
 * You can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Custom Flex Posts is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Flex Posts. If not, see http://www.gnu.org/licenses/gpl-2.0.txt
 *
 * @package Custom Flex Posts
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Current plugin version.
 */
define( 'CUSTOM_FLEX_POSTS_VERSION', '1.0.0' );

/**
 * Plugin directory and url
 */
define( 'CUSTOM_FLEX_POSTS_DIR', plugin_dir_path( __FILE__ ) );
define( 'CUSTOM_FLEX_POSTS_URL', plugins_url( '', __FILE__ ) );

/**
 * Include functions & widget classes
 */
require CUSTOM_FLEX_POSTS_DIR . 'includes/functions.php';
require CUSTOM_FLEX_POSTS_DIR . 'includes/template-tags.php';
require CUSTOM_FLEX_POSTS_DIR . 'includes/form-helpers.php';
require CUSTOM_FLEX_POSTS_DIR . 'includes/class-flex-posts-widget.php';
require CUSTOM_FLEX_POSTS_DIR . 'includes/class-flex-posts-list.php';

/**
 * Include block
 */
if ( function_exists( 'register_block_type' ) ) {
	require CUSTOM_FLEX_POSTS_DIR . 'blocks/list/block.php';
}

/**
 * Register custom widget
 */
function custom_flex_posts_register_widgets() {
	register_widget( 'Custom_Flex_Posts_List' );
}
add_action( 'widgets_init', 'custom_flex_posts_register_widgets' );

/**
 * Load the text domain for translation.
 */
function custom_flex_posts_load_textdomain() {
	load_plugin_textdomain(
		'custom-flex-posts',
		false,
		CUSTOM_FLEX_POSTS_DIR . 'languages/'
	);
}
add_action( 'plugins_loaded', 'custom_flex_posts_load_textdomain' );

/**
 * Register a new image size
 */
function custom_flex_posts_init() {
	add_image_size( '400x250-crop', 400, 250, true );
}
add_action( 'init', 'custom_flex_posts_init' );
