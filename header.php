<?php

/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Akina
 */
function sakura_layout_imgbox()
{ ?>
	<div class="headertop <?php echo akina_option('focus_img_filter'); ?>">
		<figure id="center-figure" class="abs-stretch">
			<img id="centerbg" class="abs-stretch" src="<?php echo rest_url('sakura/v1/image/cover'); ?>"></img>
			<?php if (akina_option('focus_amv')) { ?>
				<div id="video-container" class="abs-stretch">
					<video id="bgvideo" class="video" video-name="" src="" width="auto" preload="auto"></video>
					<div id="video-btn" class="loadvideo videolive"></div>
					<div id="video-add"></div>
					<div class="video-stu"></div>
				</div>
			<?php } ?>

			<?php if (!akina_option('focus_infos')) { ?>
				<div class="focusinfo">
					<?php if (akina_option('focus_logo_text')) : ?>
						<h1 class="center-text glitch is-glitching Ubuntu-font" data-text="<?php echo akina_option('focus_logo_text', ''); ?>"><?php echo akina_option('focus_logo_text', ''); ?></h1>
					<?php elseif (akina_option('focus_logo')) : ?>
						<div class="header-avatar"><a href="<?php bloginfo('url'); ?>"><img src="<?php echo akina_option('focus_logo', ''); ?>"></a></div>
					<?php else : ?>
						<div class="header-avatar"><a href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('template_url'); ?>/images/avatar.jpg"></a></div>
					<?php endif; ?>
					<div class="header-info">
						<p><?php echo akina_option('admin_des', 'Hi, Mashiro?'); ?></p>
						<div class="top-social">
							<li id="bg-pre"><img class="flipx" src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/next-b.svg" /></li>
							<?php if (akina_option('github')) { ?>
								<li><a href="<?php echo akina_option('github', ''); ?>" target="_blank" class="social-github" title="github"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/github.png" /></a></li>
							<?php } ?>
							<?php if (akina_option('sina')) { ?>
								<li><a href="<?php echo akina_option('sina', ''); ?>" target="_blank" class="social-sina" title="sina"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/sina.png" /></a></li>
							<?php } ?>
							<?php if (akina_option('telegram')) { ?>
								<li><a href="<?php echo akina_option('telegram', ''); ?>" target="_blank" class="social-lofter" title="telegram"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/telegram.svg" /></a></li>
							<?php } ?>
							<?php if (akina_option('qq')) { ?>
								<li class="qq"><a href="<?php echo akina_option('qq', ''); ?>" title="Initiate chat ?"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/qq.png" /></a></li>
							<?php } ?>
							<?php if (akina_option('qzone')) { ?>
								<li><a href="<?php echo akina_option('qzone', ''); ?>" target="_blank" class="social-qzone" title="qzone"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/qzone.png" /></a></li>
							<?php } ?>
							<?php if (akina_option('wechat')) { ?>
								<li class="wechat"><a href="#"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/wechat.png" /></a>
									<div class="wechatInner">
										<img src="<?php echo akina_option('wechat', ''); ?>" alt="WeChat">
									</div>
								</li>
							<?php } ?>
							<?php if (akina_option('lofter')) { ?>
								<li><a href="<?php echo akina_option('lofter', ''); ?>" target="_blank" class="social-lofter" title="lofter"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/lofter.png" /></a></li>
							<?php } ?>
							<?php if (akina_option('bili')) { ?>
								<li><a href="<?php echo akina_option('bili', ''); ?>" target="_blank" class="social-bili" title="bilibili"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/bilibili.png" /></a></li>
							<?php } ?>
							<?php if (akina_option('youku')) { ?>
								<li><a href="<?php echo akina_option('youku', ''); ?>" target="_blank" class="social-youku" title="youku"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/youku.png" /></a></li>
							<?php } ?>
							<?php if (akina_option('wangyiyun')) { ?>
								<li><a href="<?php echo akina_option('wangyiyun', ''); ?>" target="_blank" class="social-wangyiyun" title="CloudMusic"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/wangyiyun.png" /></a></li>
							<?php } ?>
							<?php if (akina_option('twitter')) { ?>
								<li><a href="<?php echo akina_option('twitter', ''); ?>" target="_blank" class="social-wangyiyun" title="Twitter"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/twitter.png" /></a></li>
							<?php } ?>
							<?php if (akina_option('facebook')) { ?>
								<li><a href="<?php echo akina_option('facebook', ''); ?>" target="_blank" class="social-wangyiyun" title="Facebook"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/facebook.png" /></a></li>
							<?php } ?>
							<?php if (akina_option('jianshu')) { ?>
								<li><a href="<?php echo akina_option('jianshu', ''); ?>" target="_blank" class="social-wangyiyun" title="Jianshu"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/jianshu.png" /></a></li>
							<?php } ?>
							<?php if (akina_option('zhihu')) { ?>
								<li><a href="<?php echo akina_option('zhihu', ''); ?>" target="_blank" class="social-wangyiyun" title="Zhihu"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/zhihu.png" /></a></li>
							<?php } ?>
							<?php if (akina_option('csdn')) { ?>
								<li><a href="<?php echo akina_option('csdn', ''); ?>" target="_blank" class="social-wangyiyun" title="CSDN"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/csdn.png" /></a></li>
							<?php } ?>
							<?php if (akina_option('email_name') && akina_option('email_domain')) { ?>
								<li><a onclick="mail_me()" class="social-wangyiyun" title="E-mail"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/email.svg" /></a></li>
							<?php } ?>
							<li id="bg-next"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/next-b.svg" /></li>
						</div>
					</div>
				</div>
			<?php } ?>
		</figure>
	</div>
	<?php
}

function karson_keyword_description()
{
	function get_name($x)
	{
		return $x->name;
	}
	function merge_from_wp($origin, $wp_term)
	{
		return $wp_term ? array_merge($origin, array_map('get_name', $wp_term)) : $origin;
	}
	if (is_singular()) {
		$keywords = join(',', merge_from_wp(merge_from_wp(array(), get_the_tags()), get_the_category()));
		// $description = mb_strimwidth(str_replace(array("\r", "\n", " "), '', strip_tags(get_the_content())), 0, 240, '…');
		$description = karson_get_excerpt(100);
	} else {
		$keywords = akina_option('akina_meta_keywords');
		$description = akina_option('akina_meta_description');
	}
	ob_start();
	if ($description) { ?>
		<meta name="description" content="<?php echo $description; ?>" />
	<?php }
	if ($keywords) { ?>
		<meta name="keywords" content="<?php echo $keywords; ?>" />
<?php }
	return ob_get_clean();
}

header('X-Frame-Options: SAMEORIGIN'); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
	<title itemprop="name">
		<?php global $page, $paged;
		wp_title('-', true, 'right');
		bloginfo('name');
		$site_description = get_bloginfo('description', 'display');
		if ($site_description && (is_home() || is_front_page())) echo " - $site_description";
		if ($paged >= 2 || $page >= 2) echo ' - ' . sprintf(__('page %s ', 'sakura'), max($paged, $page));/*第 %s 页*/ ?>
	</title>
	<?php echo karson_keyword_description() ?>

	<link rel="shortcut icon" href="<?php echo akina_option('favicon_link', ''); ?>" />
	<meta name="theme-color" content="#31363b">
	<meta http-equiv="x-dns-prefetch-control" content="on">
	<?php wp_head(); ?>
	<script type="text/javascript">
		if (!!window.ActiveXObject || "ActiveXObject" in window) { //is IE?
			alert('朋友，IE浏览器未适配哦~\n如果是 360、QQ 等双核浏览器，请关闭 IE 模式！');
		}
	</script>
	<?php if (akina_option('google_analytics_id', '')) { ?>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo akina_option('google_analytics_id', ''); ?>"></script>
		<script>
			window.dataLayer = window.dataLayer || [];

			function gtag() {
				dataLayer.push(arguments)
			}
			gtag('js', new Date());
			gtag('config', '<?php echo akina_option('google_analytics_id', ''); ?>');
		</script>
	<?php } ?>
</head>

<body <?php body_class(); ?>>
	<div class="scrollbar" id="bar"></div>
	<section id="main-container">
		<div class="header-container">
			<a class="cd-top faa-float animated "></a>
			<header class="site-header no-select" role="banner">
				<div class="site-top">
					<!-- .site-branding -->
					<div class="site-top-aside site-branding">
						<?php if (akina_option('akina_logo')) { ?>
							<div class="site-title">
								<a href="<?php bloginfo('url'); ?>"><img src="<?php echo akina_option('akina_logo'); ?>"></a>
							</div>
						<?php } else { ?>
							<span class="site-title">
								<span class="logolink serif">
									<a href="<?php bloginfo('url'); ?>">
										<span class="site-name"><?php echo akina_option('site_name', ''); ?></span>
									</a>
								</span>
							</span>
						<?php } ?>
					</div>
					<!-- #site-navigation -->
					<div class="lower">
						<nav>
							<?php wp_nav_menu(array('depth' => 2, 'theme_location' => 'primary', 'container' => false)); ?>
						</nav>
					</div>
					<!-- right menu -->
					<div class="site-top-aside">
						<?php if (akina_option('top_search') == 'yes') { ?>
							<div class="searchbox"><i class="iconfont js-toggle-search iconsearch icon-search"></i></div>
						<?php }
						header_user_menu(); ?>
					</div>
				</div>
			</header><!-- #masthead -->
			<?php if (!akina_option('head_focus') && is_home()) { ?>
				<?php sakura_layout_imgbox(); ?>
			<?php } ?>
		</div>
		<div id="page" class="site wrapper">
			<?php
			// if (get_post_meta(get_the_ID(), 'cover_type', true) == 'hls') {
			// 	the_video_headPattern_hls();
			// } elseif (get_post_meta(get_the_ID(), 'cover_type', true) == 'normal') {
			// 	the_video_headPattern_normal();
			// } else {
			// 	the_headPattern();
			// }
			?>