<?php

/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Sakura
 */

?>
</div><!-- #content -->
<?php comments_template('', true); ?>
<!--</div> #page Pjax container-->
<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="site-info" theme-info="Sakura v<?php echo SAKURA_VERSION; ?>">
		<p><?php echo akina_option('footer_info', ''); ?></p>
		<div class="footer-device Ubuntu-font">
			<p>
				<span>
					Theme <a href="https://2heng.xin/theme-sakura/" target="_blank">Sakura</a> <i class="iconfont icon-sakura rotating"></i> by <a href="https://2heng.xin/" target="_blank">Mashiro</a>
				</span>
			</p>
		</div>
	</div><!-- .site-info -->
</footer><!-- #colophon -->
<div class="openNav no-select">
	<div class="iconflat no-select">
		<div class="icon"></div>
	</div>
	<!-- karson_obsolete -->
	<!-- why the hell would this thing in footer? -->
	<div class="site-branding">
		<?php if (akina_option('akina_logo')) { ?>
			<div class="site-title-mb"><a href="<?php bloginfo('url'); ?>"><img src="<?php echo akina_option('akina_logo'); ?>"></a></div>
		<?php } else { ?>
			<h1 class="site-title-mb"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
		<?php } ?>
	</div>
</div><!-- m-nav-bar -->
</section><!-- #section -->
<!-- m-nav-center -->
<!-- karson_todo -->
<!-- refactor mobile nav -->
<div id="mo-nav">
	<div class="m-avatar">
		<?php $ava = akina_option('focus_logo') ? akina_option('focus_logo') : get_template_directory_uri() . '/images/avatar.jpg'; ?>
		<img src="<?php echo $ava ?>">
	</div>
	<div class="m-search">
		<form class="m-search-form" method="get" action="<?php echo home_url(); ?>" role="search">
			<input class="m-search-input" type="search" name="s" placeholder="<?php _e('Search...', 'sakura') /*搜索...*/ ?>" required>
		</form>
	</div>
	<?php wp_nav_menu(array('depth' => 2, 'theme_location' => 'primary', 'container' => false)); ?>
</div><!-- m-nav-center end -->
<div class="pc-menu">
	<div class="skin-menu no-select">
		<ul class="menu-list">
			<li id="white-bg" class="selected" data="none">
				<i class="fa fa-television" aria-hidden="true"></i>
			</li>
			<!--Default-->
			<li id="sakura-bg" data-src="https://cdn.jsdelivr.net/gh/spirit1431007/cdn@1.6/img/sakura.png">
				<i class="iconfont icon-sakura"></i>
			</li>
			<!--Sakura-->
			<li id="gribs-bg" data-src="https://cdn.jsdelivr.net/gh/spirit1431007/cdn@1.6/img/plaid2dbf8.jpg">
				<i class="fa fa-slack" aria-hidden="true"></i>
			</li>
			<!--Grids-->
			<li id="KAdots-bg" data-src="https://cdn.jsdelivr.net/gh/spirit1431007/cdn@1.6/img/star02.png">
				<i class="iconfont icon-dots"></i>
			</li>
			<!--Dots-->
			<li id="totem-bg" data-src="https://cdn.jsdelivr.net/gh/spirit1431007/cdn@1.6/img/kyotoanimation.png">
				<i class="fa fa-superpowers" aria-hidden="true"></i>
			</li>
			<!--Orange-->
			<li id="pixiv-bg" data-src="https://cdn.jsdelivr.net/gh/spirit1431007/cdn@1.6/img/dot_orange.gif">
				<i class="iconfont icon-pixiv"></i>
			</li>
			<!--Start-->
			<li id="bing-bg" data-src="https://api.mashiro.top/bing/">
				<i class="iconfont icon-bing"></i>
			</li>
			<!--Bing-->
			<li id="dark-bg" class="dark-toggle" data-src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.2/other-sites/api-index/images/me.png">
				<i class="fa fa-moon-o" aria-hidden="true"></i>
				<i class="fa fa-sun-o" aria-hidden="true"></i>
			</li>
			<!--Night-->
		</ul>
		<ul class="font-family-controls">
			<li id="font-btn1" data-tag="serif">Serif</li>
			<li id="font-btn2" data-tag="sans-serif">Sans Serif</li>
		</ul>
	</div>
	<div class="changeSkin-gear no-select">
		<span id="open-skinMenu">
			<i class="iconfont icon-gear inline-block rotating"></i>&nbsp; 切换主题 | SCHEME TOOL
		</span>
	</div>
</div>
<div class="mobile-menu">
	<div id="mobileGoTop" title="Go to top"><i class="fa fa-chevron-up" aria-hidden="true"></i></div>
	<div id="mobileDark" class="dark-toggle">
		<i class="fa fa-moon-o" aria-hidden="true"></i>
		<i class="fa fa-sun-o" aria-hidden="true"></i>
	</div>
</div>
<!-- search start -->
<div class="search-panel" method="get" action="<?php echo home_url(); ?>" role="search">
	<?php if (akina_option('live_search')) { ?>
		<?php echo do_shortcode('[wpdreams_ajaxsearchlite]'); ?>
	<?php } else { ?>
		<form class="search-form hover-glow">
			<i class="iconfont icon-search"></i>
			<input class="text-input" type="search" name="s" placeholder="<?php _e('Want to find something?', 'sakura') /*想要找点什么呢*/ ?>" required>
		</form>
	<?php } ?>
	<div class="search-close"></div>
</div>
<!-- search end -->
<?php wp_footer(); ?>
<?php if (akina_option('site_statistics')) { ?>
	<div class="site-statistics">
		<script type="text/javascript">
			<?php echo akina_option('site_statistics'); ?>
		</script>
	</div>
<?php } ?>

<canvas id="night-mode-cover"></canvas>
<?php if (akina_option('sakura_widget')) : ?>
	<aside id="secondary" class="widget-area" role="complementary" style="left: -400px;">
		<div class="heading"><?php _e('Widgets') /*小工具*/ ?></div>
		<div class="sakura_widget">
			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sakura_widget')) : endif; ?>
		</div>
		<div class="show-hide-wrap"><button class="show-hide"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 32 32">
					<path d="M22 16l-10.105-10.6-1.895 1.987 8.211 8.613-8.211 8.612 1.895 1.988 8.211-8.613z"></path>
				</svg></button></div>
	</aside>
<?php endif; ?>
<?php if (akina_option('aplayer_server') != 'off') : ?>
	<div id="aplayer-float" style="z-index: 100;" class="aplayer" data-id="<?php echo akina_option('aplayer_playlistid', ''); ?>" data-server="<?php echo akina_option('aplayer_server'); ?>" data-type="playlist" data-fixed="true" data-theme="orange">
	</div>
<?php endif; ?>
</body>

</html>