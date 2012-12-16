<div class="row-fluid">
	<div class="span4 meta clearfix">
		<h1>
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h1>
		<ul>
			<li class="post-author"><?php echo esc_html(get_the_author()); ?> <span class="accent-color icon icon-user"></span></li>
			<li class="post-date"><?php echo esc_html(get_the_date()) ?> <span class="accent-color icon icon-calendar"></span></li>
			<li class="post-time"><?php echo esc_html(get_the_time()) ?> <span class="accent-color icon icon-clock"></span></li>
			<?php $categories = get_the_category(false); ?>
				<?php foreach($categories as $category): ?>
				<li class="post-category">
					<?php echo $category->name; ?>
				<span class="accent-color icon icon-drawer"></span>
				</li>
			<?php endforeach; ?>
			<?php 
			/*
			tag list
			<li><?php echo get_the_tag_list('', ', ') ?><span class="accent-color icon icon-clock"></span></li>
			*/
			?>
		</ul>
	</div>
	<div class="span8">
		<?php the_content(); ?>
	</div>
</div>