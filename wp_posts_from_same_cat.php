<?php
	$cats_ids = array();
	if ( $categories = get_the_category() ) {
		$cats_ids = wp_list_pluck( $categories, 'term_id' );
	}
	$args = array(
		'posts_per_page' => 3,
		'post__not_in' => array( get_the_ID() ),
	);
	if ( ! empty( $cats_ids ) ) {
		$args['category__in'] = $cats_ids;
	}
	query_posts( $args );
?>
<?php if ( have_posts() ) : ?>
	<section class="related-posts">
		<div class="container">
			<h2><?php _e( 'Related Posts', 'base' ); ?></h2>
			<div class="posts-list">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'blocks/content', get_post_type() ); ?>
				<?php endwhile; ?>
			</div>
		</div>
	</section>
<?php endif; wp_reset_query(); ?>