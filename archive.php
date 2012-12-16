<?php get_header(); ?>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span4 meta">
				<h1>
					<?php if( is_author() ): ?>
						Author: <?php echo $author_name ?>
					<?php elseif( is_category() ): ?>
						Category: <?php single_cat_title(); ?>
					<?php elseif( is_tag() ): ?>
						Tag: <?php single_tag_title(); ?>
					<?php elseif( is_year() ): ?>
						Archive for <?php the_time('Y'); ?>
					<?php elseif( is_month() ): ?>
						Archive for <?php the_time('F Y'); ?>
					<?php else: ?>
						Archive
					<?php endif; ?>
				</h1>
			</div>
			<div class="span8">
				<?php if ( have_posts() ): ?>
				<?php while ( have_posts() ) : the_post(); ?>
				<?php $author_name = get_the_author_meta('nickname'); ?>

				<h2>
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h2>
				<?php the_excerpt(); ?>

				<?php endwhile; wp_reset_query(); ?>
				<?php else: ?>
				<h2>No posts found</h2>
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