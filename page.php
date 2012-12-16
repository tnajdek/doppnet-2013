<?php get_header(); ?>

<div class="container-fluid">
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<div class="row-fluid">
		<div class="span4 meta clearfix">
			<h1><?php the_title(); ?></h1>
		</div>
		<div class="span8">
			<?php the_content(); ?>
		</div>
	</div>
	<?php endwhile; wp_reset_query(); ?>
</div>

<?php get_footer(); ?>