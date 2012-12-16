<?php if ( have_comments() ) : ?>
	 <?php wp_enqueue_script( 'comment-reply' );?>
	<div class="container-fluid comments">
		<div class="row-fluid">
			<div class="span4 meta">
				<h1>Comments</h1>
			</div>
			<div class="span8">
				<ol>
				<?php wp_list_comments(  ); ?>
				</ol>
				<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
					<?php previous_comments_link( __( '&larr; Older Comments', 'twentyten' ) ); ?>
					<?php next_comments_link( __( 'Newer Comments &rarr;', 'twentyten' ) ); ?>
				<?php endif; // check for comment navigation ?>			
			<?php if ( ! comments_open() ) : ?>
				<p>Comments are closed.</p>
			<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span4 meta">
				<h1>Add Comment</h1>
			</div>
			<div class="span8">
				<?php doppnet_comment_form(); ?>
			</div>
		</div>
	</div>
<?php endif;?>