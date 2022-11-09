<?php

/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Akina
 */
get_header();
?>


<?php
/**
 * content (title & authoer info etc.) in header cover
 */
$full_image_url = karson_post_cover();
$post_time = poi_time_since(get_post_time('U', true), false, true);
$post_view_count = get_post_views(get_the_ID());
$post_view_str =  $post_view_count . ' ' . _n("View", "Views", $post_view_count, "sakura");/*次阅读*/

if ($full_image_url) {
	ob_start();
	while (have_posts()) {
		the_post();
		$authoer_url = esc_url(get_author_posts_url(get_the_author_meta('ID'), get_the_author_meta('user_nicename'))); ?>
		<header class="pattern-header single-header">
			<h1 class="entry-title"><?php echo the_title() ?></h1>
			<p class="entry-census">
				<span>
					<a href="<?php echo $authoer_url ?> ">
						<img src="<?php echo get_avatar_url(get_the_author_meta('ID'), 64)/*$ava*/ ?>">
					</a>
				</span>
				<span>
					<a href="<?php echo $authoer_url ?> ">
						<?php echo get_the_author() ?>
					</a>
				</span>
				<span>·</span>
				<?php echo $post_time ?>
				<span>·</span>
				<?php echo $post_view_str ?>
				<?php if ($user_ID && current_user_can('level_10')) { ?>
					<span>·</span>
					<a href="<?php echo get_edit_post_link(); ?>">EDIT</a>
				<?php } ?>
			</p>
		</header>
	<?php } ?>
<?php echo karson_header_banner(ob_get_clean(), $full_image_url);
} else { ?>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title() ?></h1>
		<p class="entry-census"><?php echo $post_time ?> <?php echo $post_view_str ?> </p>
		<hr>
	</header>
<?php } ?>


<?php 
/**
 * main body
 */
ob_start() ?>
<div id="content" class="site-content">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php while (have_posts()) {
				the_post();
				get_template_part('tpl/content', 'single');
				get_template_part('layouts/post', 'nextprev');
				if (akina_option('show_authorprofile')) {
					get_template_part('layouts/authorprofile');
				}
			} ?>
		</main><!-- #main -->
	</div><!-- #primary -->
</div>
<?php echo karson_three_layout_container(null, ob_get_clean(), karson_toc_menu()); ?>

<?php
karson_requirejs_package('/page-post');
get_footer();
