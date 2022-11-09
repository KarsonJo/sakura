<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Akina
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<!-- .entry-header -->
	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'ondemand' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php the_reward(); ?>
	<footer class="post-footer">
	<div class="post-tags">
		<?php if ( has_tag() ) { echo '<i class="iconfont icon-tags"></i> '; the_tags('', ' ', ' ');}?>
	</div>
	<?php get_template_part('layouts/sharelike'); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
