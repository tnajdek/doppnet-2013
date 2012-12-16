<?php
if ( function_exists( 'add_theme_support' ) ):
	add_theme_support( 'menus' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
endif;

if ( function_exists('register_sidebars') ):
	register_sidebar(array(
		'name'=>'Sidebar',
		'before_title'=>'<h4>',
		'after_title'=>'</h4>'
	));
endif;

register_nav_menu( 'primary', 'Footer' );

add_editor_style( 'editor-style.css' );

function my_init_method() {
	if (is_admin() == false ):
		wp_deregister_script( 'jquery' );
		// omg no jquery! haha
		// wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js');
		// wp_enqueue_script( 'jquery' );
	endif;
}    
add_action('init', 'my_init_method');

function get_next_posts_link_url() {
	global $paged, $wp_query; //ouch

	$max_page = $wp_query->max_num_pages;
	if ( !$paged ) 
		$paged = 1;

	$nextpage = intval($paged) + 1;

	if ( !is_single() && ( $nextpage <= $max_page ) ) {
		return next_posts( $max_page, false );
	}
	return false;
}

function get_previous_posts_page_link_url() {
	global $paged;
	 if ( !is_single() && $paged > 1 ) {
		return previous_posts(false);
	}
	return false;
}

// oh my, had to copy entire comment_form() here :(
function doppnet_comment_form( $args = array(), $post_id = null ) {
	global $id;

	if ( null === $post_id )
		$post_id = $id;
	else
		$id = $post_id;

	$commenter = wp_get_current_commenter();
	$user = wp_get_current_user();
	$user_identity = $user->exists() ? $user->display_name : '';

	$req = get_option( 'require_name_email' );
	$html5_req = ( $req ? ' required="required"' : '' );
	$fields =  array(
		'author' =>
			'<div class="control-group">'
				. '<label class="control-label" for="author">' . __( 'Name' ) . '</label> ' 
				. '<div class="controls">'
					. '<input id="author" placeholder="Obi Wan Kenobi" class="'.( $req ? 'required' : '' ) .'" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $html5_req . ' />'
				. '</div>'
			. '</div>',
		'email'  => 
			'<div class="control-group">'
				. '<label class="control-label" for="email">' . __( 'Email' ) . '</label> '
				. '<div class="controls">'
					. '<input id="email" name="email" placeholder="obiwan@jedi.un" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"' . $html5_req . ' />'
				.' </div>'
			.' </div>',
		'url'    => 
			'<div class="control-group">'
				. '<label class="control-label" for="url">' . __( 'Website' ) . '</label>'
				. '<div class="controls">'
					. '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" />'
				. '</div>'
			. '</div>',
	);

	$required_text = "";
	$defaults = array(
		'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
		'comment_field'        =>
			'<div class="control-group">'
				. '<label class="control-label" for="comment">'. _x( 'Comment', 'noun' ). '</label>'
				. '<div class="controls">'
					. '<textarea id="comment" name="comment" rows="10" required="required"></textarea>'
				. '</div>'	
			. '</div>',
		'must_log_in'          => '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email address will not be published.' ) . ( $req ? $required_text : '' ) . '</p>',
		'comment_notes_after'  => '<p class="form-allowed-tags">' . sprintf( __( 'You may use these HTML tags and attributes: %s' ), ' <code>' . allowed_tags() . '</code>' ) . '</p>',
		'id_form'              => 'commentform',
		'id_submit'            => 'submit',
		'title_reply'          => __( 'Leave a Reply' ),
		'title_reply_to'       => __( 'Leave a Reply to %s' ),
		'cancel_reply_link'    => __( 'Cancel reply' ),
		'label_submit'         => __( 'Post Comment' ),
	);

	$args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

	?>
		<?php if ( comments_open( $post_id ) ) : ?>
			<?php do_action( 'comment_form_before' ); ?>
			<div id="respond">
				<h3 id="reply-title"><?php comment_form_title( $args['title_reply'], $args['title_reply_to'] ); ?> <small><?php cancel_comment_reply_link( $args['cancel_reply_link'] ); ?></small></h3>
				<?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) : ?>
					<?php echo $args['must_log_in']; ?>
					<?php do_action( 'comment_form_must_log_in_after' ); ?>
				<?php else : ?>
					<form class="form-horizontal" action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>">
						<?php do_action( 'comment_form_top' ); ?>
						<?php if ( is_user_logged_in() ) : ?>
							<?php echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity ); ?>
							<?php do_action( 'comment_form_logged_in_after', $commenter, $user_identity ); ?>
						<?php else : ?>
							<?php echo $args['comment_notes_before']; ?>
							<?php
							do_action( 'comment_form_before_fields' );
							foreach ( (array) $args['fields'] as $name => $field ) {
								echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
							}
							do_action( 'comment_form_after_fields' );
							?>
						<?php endif; ?>
						<?php echo apply_filters( 'comment_form_field_comment', $args['comment_field'] ); ?>
						<div class="control-group">
							<div class="controls">
								<input name="submit" class="btn" type="submit" id="<?php echo esc_attr( $args['id_submit'] ); ?>" value="<?php echo esc_attr( $args['label_submit'] ); ?>" />
							<?php comment_id_fields( $post_id ); ?>
							</div>
						</div>
						<?php do_action( 'comment_form', $post_id ); ?>
						<?php echo $args['comment_notes_after']; ?>
					</form>
				<?php endif; ?>
			</div><!-- #respond -->
			<?php do_action( 'comment_form_after' ); ?>
		<?php else : ?>
			<?php do_action( 'comment_form_comments_closed' ); ?>
		<?php endif; ?>
	<?php
}

?>