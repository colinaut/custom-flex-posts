<?php
/**
 * Flex posts widget template: List 2
 *
 * @package Flex Posts
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="fp-row fp-list-2 fp-flex">

	<?php while ( $query->have_posts() ) : ?>

		<?php $query->the_post(); ?>

		<div class="fp-col fp-post">
			<div class="fp-media">
				<?php flex_posts_thumbnail( $medium_size ); ?>
			</div>
			<div class="fp-body">
				<?php if ( ! empty( $instance['show_categories'] ) ) : ?>
					<?php flex_posts_categories_meta(); ?>
				<?php endif; ?>

				<h4 class="fp-title">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h4>

				<div class="fp-meta">
					<?php flex_posts_meta( $instance ); ?>
				</div>

				<?php if ( ! empty( $instance['show_excerpt'] ) ) : ?>
					<div class="fp-excerpt"><?php flex_posts_excerpt(); ?></div>
				<?php endif; ?>
			</div>
		</div>

	<?php endwhile; ?>

	<div class="fp-col"></div>
	<div class="fp-col"></div>

</div>