<?php
/**
 * Custom Flex posts widget template: List 3
 *
 * @package Custom Flex Posts
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="cfp-row cfp-list-3 cfp-flex">

	<?php while ( $query->have_posts() ) : ?>

		<?php $query->the_post(); ?>

		<?php if ( 0 === $query->current_post ) : ?>

			<div class="cfp-col cfp-post cfp-main">
				<?php if ( ! empty( $instance['show_excerpt'] ) ) : ?>
					<div class="cfp-media">
						<?php custom_flex_posts_thumbnail( $medium_size ); ?>
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

					<?php if ( ! empty( $instance['show_excerpt'] ) ) : ?>
						<div class="cfp-excerpt"><?php custom_flex_posts_excerpt(); ?></div>
					<?php endif; ?>
				</div>
			</div>

		<?php else : ?>

			<?php if ( 1 === $query->current_post ) : ?>

				<div class="cfp-col cfp-extra">

			<?php endif; ?>

			<div class="cfp-post">
				<div class="cfp-flex">
					<div class="cfp-media">
						<?php custom_flex_posts_thumbnail( $thumbnail_size ); ?>
					</div>
					<div class="cfp-body">
						<h4 class="cfp-title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h4>

						<div class="cfp-meta">
							<?php custom_flex_posts_meta( $instance ); ?>
						</div>
					</div>
				</div>
			</div>

		<?php endif; ?>

	<?php endwhile; ?>

	<?php if ( 1 < $query->post_count ) : ?>

		</div>

	<?php endif; ?>

</div>
