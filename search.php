<?php get_header(); ?>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span4">
			<h1><?php printf( __( 'Search Results for: %s' ), '' . get_search_query() . '' ); ?></h1>
		</div>
		<div class="span8">
			<?php if ( have_posts() ) : ?>
				<?php while (have_posts()) : the_post(); ?>
					<h2>
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h2>
					<?php the_excerpt(); ?>
				<?php endwhile; ?>
				<?php else: ?>
					<h2>Nothing Found</h2>
						<p>
						Sorry, but nothing matched your search criteria. Please try again with some different keywords.
						</p>
				<?php endif; ?>
		</div>
	</div>
	<?php if ( $wp_query->max_num_pages > 1 ) : ?>
		<div class="row-fluid">
			<div class="offset4 span8 meta">
				<nav class="post-navigator clearfix">
					<?php if(get_previous_posts_page_link_url()) : ?>
						<a href="<?php echo get_previous_posts_page_link_url(); ?>" class="newer left">
							<span class="accent-color icon icon-arrow-left"></span>
							Previous
						</a>
					<?php endif; ?>
					<?php if(get_next_posts_link_url()) : ?>
						<a href="<?php echo get_next_posts_link_url(); ?>" class="older right">
							Next
							<span class="accent-color icon icon-arrow-right"></span>
						</a>
					<?php endif; ?>
				</nav>
			</div>
		</div>
	<?php endif; ?>
</div>

<?php get_footer(); ?>
