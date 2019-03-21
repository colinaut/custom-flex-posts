<?php
/**
 * Flex posts widget template: List 1
 *
 * @package Flex Posts
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="fp-row fp-list-1 fp-flex">

	<?php while ( $query->have_posts() ) : ?>

		<?php $query->the_post(); ?>

		<div class="fp-col fp-post">
			<div class="fp-flex">
				<div class="fp-media">
					<?php custom_flex_posts_thumbnail( $thumbnail_size ); ?>
				</div>
				<div class="fp-body">
					<?php if ( ! empty( $instance['show_categories'] ) ) : ?>
						<?php custom_flex_posts_categories_meta(); ?>
					<?php endif; ?>

					<h4 class="fp-title">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h4>

					<div class="fp-meta">
						<?php custom_flex_posts_meta( $instance ); ?>
					</div>
				</div>
			</div>
			<?php if ( ! empty( $instance['show_excerpt'] ) ) : ?>
				<div class="fp-excerpt"><?php custom_flex_posts_excerpt(); ?></div>
			<?php endif; ?>
		</div>

	<?php endwhile; ?>

	<div class="fp-col"></div>
	<div class="fp-col"></div>

</div>
