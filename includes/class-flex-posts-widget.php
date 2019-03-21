<?php
/**
 * Custom Flex Posts Widget
 *
 * @package Custom Flex Posts
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Custom Flex Posts widget class
 */
class Custom_Flex_Posts_Widget extends WP_Widget {

	/**
	 * Register the stylesheets for widget.
	 */
	public function enqueue() {
		wp_enqueue_style( 'custom-flex-posts' );
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$fields = $this->get_fields();
		if ( empty( $fields ) ) {
			return;
		}
		?>
		<?php foreach ( $fields as $key => $field ) : ?>
			<?php
			$name    = $this->get_field_name( $key );
			$id      = $this->get_field_id( $key );
			$default = isset( $field['default'] ) ? $field['default'] : '';
			$value   = isset( $instance[ $key ] ) ? $instance[ $key ] : $default;
			$min     = isset( $field['min'] ) ? $field['min'] : 0;
			$max     = isset( $field['max'] ) ? $field['max'] : 10;
			?>
			<p>
				<?php if ( ! in_array( $field['type'], array( 'checkbox' ), true ) ) : ?>
					<label for="<?php echo esc_attr( $id ); ?>">
						<?php echo esc_html( $field['label'] ); ?>:
					</label>
				<?php endif; ?>

				<?php if ( 'text' === $field['type'] ) : ?>

					<?php
					custom_flex_posts_input(
						array(
							'type'  => 'text',
							'name'  => $name,
							'id'    => $id,
							'class' => 'widefat',
							'value' => $value,
						)
					);
					?>

				<?php elseif ( 'number' === $field['type'] ) : ?>

					<?php
					custom_flex_posts_input(
						array(
							'type'  => 'number',
							'name'  => $name,
							'id'    => $id,
							'class' => 'tiny-text',
							'value' => $value,
							'size'  => 3,
							'min'   => $min,
							'max'   => $max,
						)
					);
					?>

				<?php elseif ( 'textarea' === $field['type'] ) : ?>

					<?php
					custom_flex_posts_textarea(
						array(
							'name'  => $name,
							'id'    => $id,
							'class' => 'widefat',
							'value' => $value,
						)
					);
					?>

				<?php elseif ( 'select' === $field['type'] ) : ?>

					<?php
					custom_flex_posts_select(
						array(
							'name'       => $name,
							'id'         => $id,
							'class'      => isset( $field['class'] ) ? $field['class'] : 'widefat',
							'options'    => $field['options'],
							'selected'   => $value,
							'first'      => isset( $field['first'] ) ? $field['first'] : null,
							'multiple'   => isset( $field['multiple'] ) ? $field['multiple'] : false,
							'array_name' => isset( $field['array_name'] ) ? $field['array_name'] : false,
							'size'       => isset( $field['size'] ) ? $field['size'] : false,
						)
					);
					?>

				<?php elseif ( 'checkbox' === $field['type'] ) : ?>

					<?php
					custom_flex_posts_input(
						array(
							'type'    => 'checkbox',
							'name'    => $name,
							'id'      => $id,
							'class'   => 'checkbox',
							'value'   => 1,
							'checked' => $value,
						)
					);
					?>
					<label for="<?php echo esc_attr( $id ); ?>">
						<?php echo esc_html( $field['label'] ); ?>
					</label>

				<?php elseif ( 'category' === $field['type'] ) : ?>

					<?php
					wp_dropdown_categories(
						array(
							'hide_empty'      => 0,
							'name'            => $name,
							'id'              => $id,
							'class'           => 'widefat',
							'hierarchical'    => 1,
							'show_option_all' => esc_html__( 'All Categories', 'custom_flex_posts' ),
							'selected'        => $value,
						)
					);
					?>

				<?php endif; ?>

				<?php if ( ! empty( $field['desc'] ) ) : ?>
					<br><small><?php echo esc_html( $field['desc'] ); ?></small>
				<?php endif; ?>
			</p>
		<?php endforeach; ?>
		<?php
	}

	/**
	 * Get form fields
	 *
	 * @return array Form fields
	 */
	public function get_fields() {
		$fields['layout'] = array(
			'type'    => 'select',
			'label'   => esc_html__( 'Layout', 'custom-flex-posts' ),
			'options' => array(
				1 => esc_html__( 'Layout 1', 'custom-flex-posts' ),
				2 => esc_html__( 'Layout 2', 'custom-flex-posts' ),
				3 => esc_html__( 'Layout 3', 'custom-flex-posts' ),
				4 => esc_html__( 'Layout 4', 'custom-flex-posts' ),
			),
			'default' => 1,
		);

		$fields['title'] = array(
			'type'  => 'text',
			'label' => esc_html__( 'Title', 'custom-flex-posts' ),
		);

		$fields['cat'] = array(
			'type'  => 'category',
			'label' => esc_html__( 'Filter by category', 'custom-flex-posts' ),
		);

		$fields['tag'] = array(
			'type'  => 'text',
			'label' => esc_html__( 'Filter by tag(s)', 'custom-flex-posts' ),
		);

		$fields['order_by'] = array(
			'type'    => 'select',
			'label'   => esc_html__( 'Order by', 'custom-flex-posts' ),
			'options' => array(
				'newest'   => esc_html__( 'Newest', 'custom-flex-posts' ),
				'oldest'   => esc_html__( 'Oldest', 'custom-flex-posts' ),
				'comments' => esc_html__( 'Most commented', 'custom-flex-posts' ),
				'title'    => esc_html__( 'Alphabetical', 'custom-flex-posts' ),
				'random'   => esc_html__( 'Random', 'custom-flex-posts' ),
			),
			'default' => 'newest',
		);

		$fields['number'] = array(
			'type'    => 'number',
			'label'   => esc_html__( 'Number of posts to show', 'custom-flex-posts' ),
			'default' => 4,
			'min'     => 1,
			'max'     => 100,
		);

		$fields['skip'] = array(
			'type'    => 'number',
			'label'   => esc_html__( 'Number of posts to skip', 'custom-flex-posts' ),
			'default' => 0,
			'min'     => 0,
			'max'     => 100,
		);

		$fields['show_categories'] = array(
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Show categories', 'custom-flex-posts' ),
			'default' => 0,
		);

		$fields['show_author'] = array(
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Show author', 'custom-flex-posts' ),
			'default' => 0,
		);

		$fields['show_date'] = array(
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Show date', 'custom-flex-posts' ),
			'default' => 1,
		);

		$fields['show_comments'] = array(
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Show comments number', 'custom-flex-posts' ),
			'default' => 1,
		);

		$fields['show_excerpt'] = array(
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Show excerpt', 'custom-flex-posts' ),
			'default' => 0,
		);

		return $fields;
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = empty( $new_instance['title'] ) ? '' : sanitize_text_field( $new_instance['title'] );

		$fields = $this->get_fields();
		if ( ! empty( $fields ) ) {
			foreach ( $fields as $key => $val ) {
				switch ( $val['type'] ) {
					case 'text':
						$instance[ $key ] = empty( $new_instance[ $key ] ) ? '' : sanitize_text_field( $new_instance[ $key ] );
						break;

					case 'textarea':
						$instance[ $key ] = empty( $new_instance[ $key ] ) ? '' : sanitize_textarea_field( $new_instance['title'] );
						break;

					case 'checkbox':
						$instance[ $key ] = isset( $new_instance[ $key ] ) ? 1 : 0;
						break;

					case 'number':
						$instance[ $key ] = intval( $new_instance[ $key ] );
						break;

					case 'select':
					case 'category':
						if ( empty( $new_instance[ $key ] ) ) {
							$instance[ $key ] = '';
						} else {
							if ( is_array( $new_instance[ $key ] ) ) {
								$instance[ $key ] = array_map( 'sanitize_key', $new_instance[ $key ] );
							} else {
								$instance[ $key ] = sanitize_key( $new_instance[ $key ] );
							}
						}
						break;
				}
			}
		}

		return $instance;
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget']; // WPCS: XSS ok.
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		echo $args['before_title'] . $title . $args['after_title']; // WPCS: XSS ok.
		$this->front( $instance );
		echo $args['after_widget']; // WPCS: XSS ok.
	}
}
