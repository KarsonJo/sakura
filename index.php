<?php

/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Akina
 */

namespace index;

function title($icon_class, $title)
{
	ob_start() ?>
	<h1 class="index-title">
		<?php if ($icon_class) { ?>
			<i class="<?php echo $icon_class ?>" aria-hidden="true"></i>
		<?php }
		echo $title; ?>
	</h1>
	<?php return ob_get_clean();
}

function article_list()
{
	ob_start();
	if (have_posts()) {
		/* Start the Loop */
		if (akina_option('post_list_style') == 'standard') {
			while (have_posts()) {
				the_post();
				get_template_part('tpl/content', get_post_format());
			};
		} else {
			get_template_part('tpl/content', 'thumb');
		}
		/* load more */
		if (akina_option('pagenav_style') == 'ajax') { ?>
			<div id="pagination">
				<?php
				$link = get_next_posts_link('Previous');
				if ($link) {
					echo $link;
				} else { ?>
					<span>很高兴你翻到这里，但是真的没有了...</span>
				<?php } ?>
			</div>
			<div id="add_post"></div>
		<?php } else { ?>
			<nav class="navigator">
				<?php previous_posts_link('<i class="iconfont icon-back"></i>') ?>
				<?php next_posts_link('<i class="iconfont icon-right"></i>') ?>
			</nav>
<?php
		}
	} else {
		get_template_part('tpl/content', 'none');
	}

	return ob_get_clean();
}

get_header();
?>
<div id="content" class="site-content">
	<div id="primary" class="content-area">
		<?php if (akina_option('head_notice') != '0') { ?>
			<!-- notice -->
			<div>
				<?php echo title("iconfont icon-notification", "Notice"); ?>
				<div class="notice notice-content"><?php echo akina_option('notice_title'); ?></div>
			</div>
		<?php } ?>
		<!-- feature -->
		<div class="top-feature-row">
			<?php echo title("fa fa-anchor", akina_option('feature_title', 'Feature')); ?>
			<?php get_template_part('layouts/feature_v2'); ?>
		</div>
		<!-- #main -->
		<main id="main" class="site-main" role="main">
			<?php echo title("fa fa-envira", "Discovery"); ?>
			<?php echo article_list(); ?>
		</main>
	</div><!-- #primary -->
</div>
<?php
karson_requirejs_package('/page-post');
get_footer();
