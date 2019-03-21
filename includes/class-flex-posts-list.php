<?php
/**
 * Flex Posts List Widget
 *
 * @package Flex Posts
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Flex Posts List widget class
 */
class Custom_Flex_Posts_List extends Custom_Flex_Posts_Widget {

	/**
	 * Set base ID, name & options
	 */
	public function __construct() {
		parent::__construct(
			'custom-flex-posts-list',
			esc_html__( 'Custom Flex Posts', 'custom-flex-posts' ),
			array(
				'description' => esc_html__( 'Displays posts list.', 'custom-flex-posts' ),
			)
		);

		if ( is_active_widget( false, false, $this->id_base ) ) {
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ), 11 );
		}
	}

	/**
	 * Get form fields
	 */
	public function get_fields() {
		return apply_filters( 'custom_flex_posts_list_fields', parent::get_fields() );
	}

	/**
	 * Front-end display of widget.
	 *
	 * @param array $instance Saved values from database.
	 */
	public function front( $instance ) {
		custom_flex_posts_display( $instance );
	}
}
