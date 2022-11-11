<?php

/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Akina
 */
//function custom_short_excerpt($excerpt){
//	return substr($excerpt, 0, 120);
//}
//add_filter('the_excerpt', 'custom_short_excerpt');
namespace thumb;

function thumb_align_class()
{
	switch (akina_option('feature_align')) {
		case 'left':
			return 'reverse';
		case 'alternate':
			return 'alternate';
		default:
			return '';
	}
}
function thumb_image()
{
	$post_img = karson_post_cover('large');
	return $post_img ? $post_img : DEFAULT_FEATURE_IMAGE();
}
function karson_article_hit()
{
	$view = get_post_views(get_the_ID());
	return $view  . ' ' . _n('Hit', 'Hits', $view, 'sakura')/*热度*/;
}

if (have_posts()) { ?>
	<div class="article-list">
		<?php while (have_posts()) {
			the_post();
			$the_cat = get_the_category(); ?>
			<article class="post post-list-thumb <?php echo thumb_align_class() ?>" itemscope="" itemtype="http://schema.org/BlogPosting">
				<div class="post-thumb">
					<a href="<?php the_permalink(); ?>"><img class="lazyload pattern-attachment-img" data-src="<?php echo thumb_image(); ?>"></a>
				</div><!-- thumbnail-->
				<div class="post-content-wrap">
					<div class="post-content">
						<div class="post-date">
							<i class="iconfont icon-time"></i><?php echo poi_time_since_post(); ?>
							<?php if (is_sticky()) : ?>
								&nbsp;<i class="iconfont hotpost icon-hot"></i>
							<?php endif ?>
						</div>
						<a href="<?php the_permalink(); ?>" class="post-title">
							<h3><?php the_title(); ?></h3>
						</a>
						<div class="post-meta">
							<span><i class="iconfont icon-attention"></i><?php echo karson_article_hit() ?></span>
							<span class="comments-number"><i class="iconfont icon-mark"></i><?php comments_popup_link('NOTHING', '1 ' . __("Comment", "sakura")/*条评论*/, '% ' . __("Comments", "sakura")/*条评论*/); ?></span>
							<span><i class="iconfont icon-file"></i><a href="<?php echo esc_url(get_category_link($the_cat[0]->cat_ID)); ?>"><?php echo $the_cat[0]->cat_name; ?></a>
							</span>
						</div>
						<div class="float-content">
							<p><?php echo karson_get_excerpt() ?></p>
							<div class="post-bottom">
								<a href="<?php the_permalink(); ?>" class="button-normal"><i class="iconfont icon-caidan"></i></a>
							</div>
						</div>
					</div>
				</div>
			</article>
		<?php
		} ?>
	</div>
<?php } ?>