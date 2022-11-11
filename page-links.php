<?php

/**
 Template Name: links
 */

get_header();
echo karson_page_banner();?>

<div id="content" class="site-content">
	<?php while (have_posts()) : the_post(); ?>
		<article <?php post_class("post-item"); ?>>
			<?php the_content(); ?>
			<div class="links">
				<?php echo get_link_items(); ?>
			</div>
		</article>
		<div class="have-toc"></div>
		<div class="toc-container">
			<div class="toc"></div>
		</div>
	<?php endwhile; ?>
</div>>
<?php
get_footer();
