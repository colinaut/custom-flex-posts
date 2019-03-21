<?php
/**
 * Custom Flex posts widget template: List 1
 *
 * @package Custom Flex Posts
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="cfp-row cfp-list-1 cfp-flex">

	<?php while ( $query->have_posts() ) : ?>

		<?php $query->the_post(); ?>

		<div class="cfp-col cfp-post">
			<div class="cfp-flex">
				<?php if ( ! empty( $instance['show_image'] ) ) : ?>
					<div class="cfp-media">
						<?php custom_flex_posts_thumbnail( $thumbnail_size ); ?>
					</div>
				<?php endif; ?>
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
				</div>
			</div>
			<?php if ( ! empty( $instance['show_excerpt'] ) ) : ?>
				<div class="cfp-excerpt"><?php custom_flex_posts_excerpt(); ?></div>
			<?php endif; ?>
		</div>

	<?php endwhile; ?>

	<div class="cfp-col"></div>
	<div class="cfp-col"></div>

</div>
