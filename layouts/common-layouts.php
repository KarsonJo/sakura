<?php

/**
 * get the banner image (default with grid layout)
 * @param string $content_slot
 * content assign into the banner image (in the same grid)
 * @param string|false $full_image_url
 * image path. CSS will fallback if not valid or false
 *
 */
function karson_header_banner($content_slot, $full_image_url)
{
	ob_start(); ?>
	<div class="pattern-center">
		<img class="pattern-attachment-img lazyload fallback-img rainbow" <?php echo $full_image_url ? 'data-src="' . $full_image_url . '"' : 'src' ?>> </img>
		<?php if ($content_slot) echo $content_slot; ?>
	</div>
<?php
	return ob_get_clean();
} ?>


<?php
/**
 * get header in a h1 tag and certain classes
 * can be used as content as karson_header_banner
 * @param string $title title
 */
function karson_header_title($title)
{
	ob_start();
	if ($title) { ?>
		<h1 class="entry-title search-title">
			<?php echo $title ?>
		</h1>
	<?php }
	return ob_get_clean();
}

/**
 * get a styled left-main-right container
 * @param string|false $left
 * @param string|false $main
 * @param string|false $right
 */
function karson_three_layout_container($left, $main, $right)
{
	ob_start(); ?>
	<div class="site-post-wrapper">
		<div class="site-post-aside">
			<?php if ($left) echo $left; ?>
		</div>
		<?php echo $main ?>
		<div class="site-post-aside">
			<?php if ($right) echo $right; ?>
		</div>
	</div>
<?php
	return ob_get_clean();
}

/**
 * get a toc menu
 */
function karson_toc_menu()
{
	ob_start(); ?>
	<div class="toc-container">
		<div class="toc-wrapper">
			<div class="toc-title">目录</div>
			<div class="toc"></div>
		</div>
	</div>
<?php
	return ob_get_clean();
} ?>