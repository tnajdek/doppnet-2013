
				</section>
			</div>
		</div>
	<div id="push"></div>
</div>
<footer>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span4">
				<?php get_search_form(); ?>
			</div>
			<div class="span4 social">
				<p>
					<a href="http://twitter.com/tnajdek">
						Follow me
						<span class="icon icon-twitter"></span>
					</a>
				</p>
				<p>
					<a href="https://github.com/tnajdek/">
						Fork me
						<span class="icon icon-github"></span>
					</a>
				</p>
			</div>
			<div class="span4">
				<?php $locations = get_nav_menu_locations() ?>
				<?php $menu = wp_get_nav_menu_object( $locations['primary'] ); ?>
				<?php $items = wp_get_nav_menu_items( $menu->term_id ); ?> 
				<nav class="offset6 span6 post-menu right">
					<ul>
						<?php foreach($items as $item): ?>
							<li>
								<a href="<?php echo($item->url); ?>">
									<?php echo($item->title); ?>
									<span class="icon icon-<?php echo(preg_replace('/\s/', '-', strtolower($item->title))); ?>"></span>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</nav>
			</div>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>