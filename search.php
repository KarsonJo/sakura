<?php

/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Akina
 */
get_header();
echo karson_header_banner(
	karson_header_title(
		sprintf(__("Search results for \" %s \"", "sakura"), get_search_query()) /*关于“ '.get_search_query().' ”的搜索结果*/
	),
	get_random_bg_url()
); ?>

<div class="pd-mid"></div>

<div id="content" class="site-content">
	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			if (have_posts()) {
				/* Start the Loop */
				while (have_posts()) : the_post();

					/**
					 * Run the loop for the search to output the results.
					 * If you want to overload this in a child theme then include a file
					 * called content-search.php and that will be used instead.
					 */
					get_template_part('tpl/content', get_post_format());

				endwhile;

				the_posts_navigation();
			} else { ?>
				<div class="search-box">
					<!-- search start -->
					<form class="s-search">
						<i class="iconfont icon-search"></i>
						<input class="text-input" type="search" name="s" placeholder="<?php _e('Search...', 'sakura') ?>" required>
					</form>
					<!-- search end -->
				</div>
			<?php
				get_template_part('tpl/content', 'none');
			} ?>

			<style>
				.nav-previous,
				.nav-next {

					padding: 20px 0;
					text-align: center;
					margin: 40px 0 80px;
					display: inline-block;
					font-family: miranafont, "Hiragino Sans GB", "Microsoft YaHei", STXihei, SimSun, sans-serif;
				}

				.nav-previous,
				.nav-next a {
					padding: 13px 35px;
					border: 1px solid #D6D6D6;
					border-radius: 50px;
					color: #ADADAD;
				}

				.nav-previous,
				.nav-next span {
					color: #989898;
					font-size: 15px;
				}

				.nav-previous,
				.nav-next a:hover {
					border: 1px solid #A0DAD0;
					color: #A0DAD0;
				}
			</style>

		</main><!-- #main -->
	</section><!-- #primary -->
</div>
<?php
get_footer();
