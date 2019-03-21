<?php
/**
 * Flex Posts List Block
 *
 * @package Flex Posts
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue style sheet
 */
function flex_posts_enqueue_block_assets() {
	wp_enqueue_style( 'flex-posts' );
}
add_action( 'enqueue_block_assets', 'flex_posts_enqueue_block_assets' );

/**
 * Register block
 */
function flex_posts_register_block() {
	wp_register_script(
		'flex-posts',
		plugins_url( 'block.js', __FILE__ ),
		array( 'wp-blocks', 'wp-element', 'wp-i18n' ),
		FLEX_POSTS_VERSION,
		true
	);

	$categories[] = array(
		'label' => __( 'All Categories', 'flex-posts' ),
		'value' => '',
	);

	$cats = get_categories();

	foreach ( $cats as $cat ) {
		$categories[] = array(
			'label' => $cat->name,
			'value' => $cat->term_id,
		);
	}

	wp_localize_script(
		'flex-posts',
		'flex_posts',
		array(
			'categories' => $categories,
		)
	);

	register_block_type(
		'flex-posts/list',
		array(
			'editor_script'   => 'flex-posts',
			'render_callback' => 'flex_posts_render_block',
			'attributes'      => apply_filters(
				'flex_posts_attributes',
				array(
					'layout'          => array(
						'type'    => 'number',
						'default' => 1,
					),
					'title'           => array(
						'type'    => 'string',
						'default' => '',
					),
					'cat'             => array(
						'type'    => 'string',
						'default' => '',
					),
					'tag'             => array(
						'type'    => 'string',
						'default' => '',
					),
					'order_by'        => array(
						'type'    => 'string',
						'default' => 'newest',
					),
					'number'          => array(
						'type'    => 'number',
						'default' => 4,
					),
					'skip'            => array(
						'type'    => 'number',
						'default' => 0,
					),
					'show_categories' => array(
						'type'    => 'boolean',
						'default' => false,
					),
					'show_author'     => array(
						'type'    => 'boolean',
						'default' => false,
					),
					'show_date'       => array(
						'type'    => 'boolean',
						'default' => true,
					),
					'show_comments'   => array(
						'type'    => 'boolean',
						'default' => true,
					),
					'show_excerpt'    => array(
						'type'    => 'boolean',
						'default' => false,
					),
					'className'       => array(
						'type'    => 'string',
						'default' => '',
					),
				)
			),
		)
	);
}
add_action( 'init', 'flex_posts_register_block' );

/**
 * Render block
 *
 * @param array $attributes Attributes.
 */
function flex_posts_render_block( $attributes ) {
	ob_start();
	$class = '';
	if ( ! empty( $attributes['className'] ) ) {
		$class = ' ' . $attributes['className'];
	}
	echo '<section class="widget widget_flex-posts-list' . esc_attr( $class ) . '">';
	if ( ! empty( $attributes['title'] ) ) {
		$title        = apply_filters( 'flex_posts_block_title', $attributes['title'], $attributes, 'flex-posts-list' );
		$allowed_html = array(
			'a'    => array(
				'href'  => array(),
				'title' => array(),
				'class' => array(),
			),
			'span' => array(
				'class' => array(),
			),
		);
		echo '<h2 class="widget-title">' . wp_kses( $title, $allowed_html ) . '</h2>';
	}

	flex_posts_display( $attributes );

	echo '</section>';
	$display = ob_get_clean();
	return $display;
}