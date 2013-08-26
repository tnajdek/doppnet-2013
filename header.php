<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title>
  <?php
    if( ! is_home() ):
      wp_title( '', true);
      echo(" | ");
      bloginfo( 'name' );
    else:
      bloginfo( 'name' );
    endif;
  ?>

</title>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
<?php wp_head(); ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="{{STATIC_URL}}favicon.ico">
</head>

<body <?php body_class(); ?>>

<div id="wrap">
	<div class="container-fluid">
		<div class="row-fluid">
			<header>
				<div class="row-fluid">
					<div class="span8 offset4 logo">
						<h1>
						<a href="<?php echo home_url( '/' ); ?>">doppnet.com</a>
						</h1>
						<p class="headline">
							<?php bloginfo('description'); ?>
						</p>
					</div>
				</div>
			</header>
			<section class="main">

<?php 
  // Uncomment to show menu
  // wp_nav_menu( array( 'menu' => 'Main' ) );
?>
