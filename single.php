<?php

/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Akina
 */

get_header(); ?>
<div class="site-post-wrapper">
	<div class="site-post-aside"></div>
	<div id="content" class="site-content">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
				<?php
				while (have_posts()) : the_post();
					get_template_part('tpl/content', 'single');
					get_template_part('layouts/post', 'nextprev');
					if (akina_option('show_authorprofile')) {
						get_template_part('layouts/authorprofile');
					}
				endwhile; // End of the loop.
				?>
			</main><!-- #main -->
		</div><!-- #primary -->
	</div>
	<div class="site-post-aside">
		<?php get_template_part('layouts/sidebox'); ?>
	</div>
</div>

<?php
karson_requirejs_package('/page-post');
get_footer();
