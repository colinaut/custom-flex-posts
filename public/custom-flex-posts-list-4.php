<?php
/**
 * Custom Flex posts widget template: List 4
 *
 * @package Custom Flex Posts
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="cfp-list-4">

	<?php while ( $query->have_posts() ) : ?>

		<?php $query->the_post(); ?>

		<div class="cfp-post cfp-flex">
			<div class="cfp-media">
				<?php custom_flex_posts_thumbnail( $medium_size ); ?>
			</div>
			<div class="cfp-body">
				<?php if ( ! empty( $instance['show_categories'] ) ) : ?>
					<?php custom_flex_posts_categories_meta(); ?>
				<?php endif; ?>

				<h4 class="cfp-title">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h4>

				<div class="cfp-meta">
					<?php custom_flex_posts_meta( $instance ); ?>
				</div>

				<?php if ( ! empty( $instance['show_excerpt'] ) ) : ?>
					<div class="cfp-excerpt"><?php custom_flex_posts_excerpt(); ?></div>
				<?php endif; ?>
			</div>
		</div>

	<?php endwhile; ?>

</div>
