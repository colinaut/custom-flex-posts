<?php
/**
 * Functions used in widgets and blocks
 *
 * @package Custom Flex Posts
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register style sheet
 */
function custom_flex_posts_register_style() {
	wp_register_style(
		'custom-flex-posts',
		CUSTOM_FLEX_POSTS_URL . '/public/css/custom-flex-posts.css',
		array(),
		CUSTOM_FLEX_POSTS_VERSION
	);
}
add_action( 'init', 'custom_flex_posts_register_style' );

/**
 * Get args for WP Query
 *
 * @param  array $instance Attributes.
 * @return array Args
 */
function custom_flex_posts_get_query_args( $instance ) {
	$args['orderby'] = 'date';
	$args['order']   = 'desc';
	if ( ! empty( $instance['order_by'] ) ) {
		switch ( $instance['order_by'] ) {
			case 'oldest':
				$args['order'] = 'asc';
				break;
			case 'title':
				$args['orderby'] = 'title';
				$args['order']   = 'asc';
				break;
			case 'comments':
				$args['orderby'] = 'comment_count';
				break;
			case 'random':
				$args['orderby'] = 'rand';
				break;
		}
	}

	if ( ! empty( $instance['post_type'] ) ) {
		$args['post_type'] = $instance['post_type'];
	} else {
		$args['post_type'] = 'post';
	}

	if ( ! empty( $instance['cat'] ) ) {
		$args['cat'] = absint( $instance['cat'] );
	}

	if ( ! empty( $instance['tag'] ) ) {
		$args['tag'] = sanitize_text_field( wp_unslash( $instance['tag'] ) );
	}

	if ( isset( $instance['number'] ) ) {
		$args['posts_per_page'] = intval( $instance['number'] );
	}

	if ( isset( $instance['skip'] ) ) {
		$args['offset'] = absint( $instance['skip'] );
	}

	$args['ignore_sticky_posts'] = true;
	$args['no_found_rows']       = true;
	$args['post_status']         = 'publish';

	return $args;
}

/**
 * Front-end display of widget.
 *
 * @param array $instance Attributes.
 */
function custom_flex_posts_display( $instance ) {
	$args = apply_filters( 'custom_flex_posts_list_args', custom_flex_posts_get_query_args( $instance ) );

	$query = new WP_Query( $args );

	$layout = 1;
	if ( ! empty( $instance['layout'] ) ) {
		$layout = absint( $instance['layout'] );
	}

	$medium_size    = apply_filters( 'custom_flex_posts_medium_size', '400x250-crop', $instance );
	$thumbnail_size = apply_filters( 'custom_flex_posts_thumbnail_size', 'thumbnail', $instance );

	$file     = 'custom-flex-posts-list-' . $layout . '.php';
	$template = locate_template( $file );
	if ( empty( $template ) ) {
		$template = CUSTOM_FLEX_POSTS_DIR . 'public/' . $file;
	}

	if ( ! file_exists( $template ) ) {
		return;
	}

	if ( $query->have_posts() ) {
		include $template;
	}

	wp_reset_postdata();
}
