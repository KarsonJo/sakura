<?php

/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Akina
 */

get_header();
$full_image_url = karson_post_cover();
if ($full_image_url) {
	echo karson_header_banner(karson_header_title(get_the_title()), $full_image_url);
} else { ?>
	<header class="entry-header">
		<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
	</header><!-- .entry-header -->
<?php }

ob_start() ?>
<div id="content" class="site-content">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php
			while (have_posts()) {
				the_post();
				get_template_part('tpl/content', 'page');
			} ?>
		</main><!-- #main -->
	</div><!-- #primary -->
</div>
<?php
echo karson_three_layout_container(null, ob_get_clean(), karson_toc_menu());
karson_requirejs_package('/page-post');
get_footer();
