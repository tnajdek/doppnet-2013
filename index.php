<?php get_header(); ?>

<div class="container-fluid">
	<?php if ( have_posts() ): ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php include('inc/post.php'); ?>
	<?php endwhile; wp_reset_query(); ?>

	<?php else: ?>
		<div class="row-fluid">
			<div class="span4 meta">
				<h1>No posts found</h1>
			</div>
			<div class="span8">
				<p>Sorry</p>
			</div>
		</div>
	<?php endif; ?>

	<?php if ( $wp_query->max_num_pages > 1 ) : ?>
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="offset4 span8 meta">
					<nav class="post-navigator clearfix">
						<?php if(get_previous_posts_page_link_url()) : ?>
							<a href="<?php echo get_previous_posts_page_link_url(); ?>" class="newer left">
								<span class="accent-color icon icon-arrow-left"></span>
								Newer Posts
							</a>
						<?php endif; ?>
						<?php if(get_next_posts_link_url()) : ?>
							<a href="<?php echo get_next_posts_link_url(); ?>" class="older right">
								Older Posts
								<span class="accent-color icon icon-arrow-right"></span>
							</a>
						<?php endif; ?>
					</nav>
				</div>
			</div>
		</div>
	<?php endif; ?>
</div>
<?php get_footer(); ?>