<?php get_header(); ?>

<div class="container-fluid">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<?php include('inc/post.php'); ?>
<?php endwhile; wp_reset_query(); ?>

</div>
<?php comments_template( '', true ); ?>

<?php get_footer(); ?>