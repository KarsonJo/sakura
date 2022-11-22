<?php

/**
 * COMMENTS TEMPLATE
 */

/*if('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die(__('Please do not load this page directly.', 'akina'));*/

namespace comments;

function rudr_get_comment_depth($my_comment_id)
{
	$depth_level = 0;
	while ($my_comment_id > 0) {
		$my_comment = get_comment($my_comment_id);
		$my_comment_id = $my_comment->comment_parent;
		$depth_level++;
	}
	return $depth_level;
}

function siren_ajax_comment_callback()
{
	$comment = wp_handle_comment_submission(wp_unslash($_POST));
	if (is_wp_error($comment)) {
		$data = $comment->get_error_data();
		if (!empty($data)) {
			siren_ajax_comment_err($comment->get_error_message());
		} else {
			exit;
		}
	}
	$user = wp_get_current_user();
	do_action('set_comment_cookies', $comment, $user);
	$GLOBALS['comment'] = $comment; //根据你的评论结构自行修改，如使用默认主题则无需修改
	karson_get_comment_block($comment, null, rudr_get_comment_depth(comment_ID()));
	die();
?>
	<li <?php comment_class(); ?> id="comment-<?php echo esc_attr(comment_ID()); ?>">
		<div class="contents">
			<div class="comment-arrow">
				<div class="main shadow">
					<div class="profile">
						<a href="<?php comment_author_url(); ?>"><?php echo get_avatar($comment->comment_author_email, '80', '', get_comment_author()); ?></a>
					</div>
					<div class="commentinfo">
						<section class="commeta">
							<div class="left">
								<h4 class="author"><a href="<?php comment_author_url(); ?>"><?php echo get_avatar($comment->comment_author_email, '80', '', get_comment_author()); ?><?php comment_author(); ?> <span class="isauthor" title="<?php esc_attr_e('Author', 'sakura'); ?>"></span></a></h4>
							</div>
							<div class="right">
								<div class="info"><time datetime="<?php comment_date('Y-m-d'); ?>"><?php echo poi_time_since(strtotime($comment->comment_date), true); //comment_date(get_option('date_format')); 
																									?></time></div>
							</div>
						</section>
					</div>
					<div class="body">
						<?php comment_text(); ?>
					</div>
				</div>
				<div class="arrow-left"></div>
			</div>
		</div>
	</li>
<?php die();
}

// add_action('wp_ajax_nopriv_ajax_comment', 'siren_ajax_comment_callback');
// add_action('wp_ajax_ajax_comment', 'siren_ajax_comment_callback');

/**
 * generate a comment block for single comment.
 * can be used as wp_list_comments callback.
 * 
 * the container lacks closing tag \</li>, which is by design because of usage in callback.
 * @param WP_Comment $comment
 * @param string|array $_ [discarded] tags that provided by callback.
 * @param int $depth The depth of current comment
 */
function karson_get_comment_block($comment, $_, $depth)
{
	global $post;
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?> id="comment-<?php echo esc_attr(comment_ID()); ?>">
		<div class="contents">
			<div class="main shadow">
				<a class="profile" href="<?php comment_author_url(); ?>" target="_blank" rel="nofollow">
					<?php echo str_replace('src=', 'src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.0.2/img/svg/loader/trans.ajax-spinner-preloader.svg" onerror="imgError(this,1)" data-src=', get_avatar($comment->comment_author_email, '80', '', get_comment_author(), array('class' => array('lazyload')))); ?>
				</a>
				<div class="author">
					<a href="<?php comment_author_url(); ?>" target="_blank" rel="nofollow">
						<?php if ($comment->user_id === $post->post_author) { ?>
							<span class="bb-comment" title="<?php _e('Author', 'sakura'); ?>"><?php _e('Blogger', 'sakura'); /*博主*/ ?></span>
						<?php } ?>
						<span><?php comment_author(); ?></span>
					</a>
					<?php echo get_author_class($comment->comment_author_email, $comment->user_id); ?>
				</div>
				<div class="info">
					<time datetime="<?php comment_date('Y-m-d'); ?>">
						<?php echo poi_time_since(strtotime($comment->comment_date_gmt), true); ?>
					</time>
					<?php

					if (akina_option('open_useragent')) {
						$bo = siren_get_useragent($comment->comment_agent); ?>
						<span class="useragent-info">
							<img src="<?php echo $bo['brower_src'] ?>">
							<span class="ua-text"><?php echo $bo['brower_type'] ?></span>
							<img src="<?php echo $bo['os_src'] ?>">
							<span class="ua-text"><?php echo $bo['os_type'] ?></span>
						</span>
					<?php }

					if (akina_option('open_location')) { ?>
						<span><?php echo __('Location', 'sakura') /*来自*/ . ':' . convertip(get_comment_author_ip()) ?></span>
					<?php }

					if (current_user_can('manage_options') and (wp_is_mobile() == false)) { ?>
						<span>
							<?php edit_comment_link('<i class="fa fa-pencil-square-o" aria-hidden="true"></i> ' . __("Edit", "mashiro")); ?>
						</span>
						<span>·</span>
						<a href="javascript:;" data-actionp="set_private" data-idp="<?php get_comment_id() ?>" id="sp">
							<?php echo __("Private", "sakura") ?>:
							<span class="has_set_private">
								<?php $is_private = get_comment_meta($comment->comment_ID, '_private', true);
								echo $is_private ? __("Yes", "sakura") : __("No", "sakura"); ?><i class="fa <?php echo $is_private ? 'fa-lock' : 'fa-unlock' ?>" aria-hidden="true"></i>
							</span>
						</a>
					<?php
					} ?>
				</div>
				<?php comment_reply_link(array('depth' => $depth, 'max_depth' => get_option('thread_comments_depth'))); ?>
			</div>
			<div class="body">
				<?php comment_text(); ?>
			</div>
		</div>
	<?php }


/**
 * avatar, author, email, url included
 * @param bool $req if name and email are required
 */
function get_identity_fields($req)
{
	global $comment_author, $comment_author_email, $comment_author_url;
	$required = function () use ($req) {
		return ($req ? '(' . __("Must* ", " sakura") . ')' : '');
	};

	ob_start(); ?>
		<div class="comment-fields">
			<div class="comment-user-avatar">
				<img src="<?php echo get_template_directory_uri() ?>/images/avatar.jpeg">
				<div class="socila-check qq-check">
					<i class="fa fa-qq" aria-hidden="true"></i>
				</div>
				<div class="socila-check gravatar-check">
					<i class="fa fa-google" aria-hidden="true"></i>
				</div>
			</div>
			<div class="popup cmt-popup cmt-author">
				<input type="text" placeholder="<?php echo __("Nickname or QQ number", "sakura") /*昵称或QQ号*/ . $required() ?>" name="author" id="author" autocomplete="off" <?php $req ? "aria-required='true'" : '' ?> />
				<span class="popuptext" id="thePopup" style="margin-left: -115px;width: 230px;">
					<?php echo __("Auto pull nickname and avatar with a QQ num. entered", "sakura")/*输入QQ号将自动拉取昵称和头像*/ ?>
				</span>
			</div>
			<div class="popup cmt-popup">
				<input type="text" placeholder="<?php echo __(" email", "sakura") . $required() ?>" name="email" id="email" autocomplete="off" <?php $req ? "aria-required='true'" : '' ?> />
				<span class="popuptext" id="thePopup" style="margin-left: -65px;width: 130px;">
					<?php echo __("You will receive notification by email", "sakura")/*你将收到回复通知*/ ?>
				</span>
			</div>
			<div class="popup cmt-popup">
				<input type="text" placeholder="<?php __("Site", "sakura") ?>" name="url" id="url" autocomplete="off" />
				<span class="popuptext" id="thePopup" style="margin-left: -55px;width: 110px;">
					<?php echo __("Advertisement is forbidden 😀", "sakura")/*禁止小广告😀*/ ?>
				</span>
			</div>
		</div>
	<?php return ob_get_clean();
}

/**
 * overrided comment field
 */
function get_comment_field()
{
	$placeholder = __("You are a surprise that I will only meet once in my life", "sakura");
	ob_start(); ?>
		<!-- prompts -->
		<p style="font-style:italic">
			<a href="https://segmentfault.com/markdown" target="_blank">
				<i class="iconfont icon-markdown" style="color:#000"></i>
			</a>
			Markdown Supported while
			<i class="fa fa-code" aria-hidden="true"></i>
			Forbidden
		</p>
		<div class="comment-textarea">
			<textarea placeholder="<?php echo $placeholder ?>" name="comment" class="commentbody" id="comment" rows="5" tabindex="4"></textarea>
			<label class="input-label">
				<?php echo $placeholder ?>
			</label>
		</div>
		<div id="upload-img-show"></div>
		<!--sticker/emoji panel-->
		<p id="emotion-toggle" class="no-select">
			<span class="emotion-toggle-off"><?php echo __("Click me OωO", "sakura")/*戳我试试 OωO*/ ?></span>
			<span class="emotion-toggle-on"><?php echo __("Woooooow ヾ(≧∇≦*)ゝ", "sakura")/*嘿嘿嘿 ヾ(≧∇≦*)ゝ*/ ?></span>
		</p>
		<div class="emotion-box no-select">
			<table class="motion-switcher-table">
				<tr>
					<th onclick="motionSwitch(' .bili')" class="bili-bar on-hover">bilibili~</th>
					<th onclick="motionSwitch('.menhera')" class="menhera-bar">(=・ω・=)</th>
					<th onclick="motionSwitch('.tieba')" class="tieba-bar">Tieba</th>
				</tr>
			</table>
			<div class="bili-container motion-container">
				<?php echo push_bili_smilies() ?>
			</div>
			<div class="menhera-container motion-container" style="display:none;">
				<?php echo push_emoji_panel() ?>
			</div>
			<div class="tieba-container motion-container" style="display:none;">
				<?php echo push_smilies() ?>
			</div>
		</div>
		<!--sticker/emoji panel end-->
	<?php return ob_get_clean();
}


if (post_password_required()) {
	return;
}


	?>

	<?php if (comments_open()) : ?>

		<section id="comments" class="comments">
			<div class="comments-main">
				<h3 id="comments-list-title">Comments | <span class="noticom"><?php comments_number('NOTHING', '1' . __(" comment", "sakura"), '%' . __(" comments", "sakura")); ?> </span></h3>
				<div id="loading-comments"><span></span></div>
				<?php if (have_comments()) : ?>

					<ul class="commentwrap">
						<?php wp_list_comments('type=comment&callback=akina_comment_format'); ?>
					</ul>

					<nav id="comments-navi">
						<?php paginate_comments_links('prev_text=« Older&next_text=Newer »'); ?>
					</nav>

				<?php else : ?>

					<?php if (comments_open()) : ?>
						<div class="commentwrap">
							<div class="notification-hidden"><i class="iconfont icon-mark"></i> <?php _e('no comment', 'sakura'); /*暂无评论*/ ?></div>

						</div>
					<?php endif; ?>

				<?php endif; ?>

				<?php
				$robot_comments = '';
				if (comments_open()) {
					$private_ms = akina_option('open_private_message') ? '<label class="siren-checkbox-label"><input class="siren-checkbox-radio" type="checkbox" name="is-private"><span class="siren-is-private-checkbox siren-checkbox-radioInput"></span>' . __('Comment in private', 'sakura') . '</label>' : '';
					$mail_notify = akina_option('mail_notify') ? '<label class="siren-checkbox-label"><input class="siren-checkbox-radio" type="checkbox" name="mail-notify"><span class="siren-mail-notify-checkbox siren-checkbox-radioInput"></span>' . __('Comment reply notify', 'sakura') . '</label>' : '';
					$args = array(
						// 'title_reply_to' => '<div class="graybar"><i class="fa fa-comments-o"></i>' . __('Leave a Reply to', 'sakura') . ' %s' . '</div>',
						// 'cancel_reply_link' => __('Cancel Reply', 'sakura'),
						// 'label_submit' => __('BiuBiuBiu~', 'sakura'),
						'comment_field' => get_comment_field(),
						'comment_notes_after' => '',
						'comment_notes_before' => '',
						'fields' => apply_filters(
							'comment_form_default_fields',
							array(
								'test' => get_identity_fields($req), //$req is true if 'name/mail required' is set in admin panel
								// 'avatar' => '<div class="cmt-info-container"><div class="comment-user-avatar"><img src="' . get_template_directory_uri() . '/images/avatar.jpeg"><div class="socila-check qq-check"><i class="fa fa-qq" aria-hidden="true"></i></div><div class="socila-check gravatar-check"><i class="fa fa-google" aria-hidden="true"></i></div></div>',
								// 'author' =>
								// '<div class="popup cmt-popup cmt-author" onclick="cmt_showPopup(this)"><span class="popuptext" id="thePopup" style="margin-left: -115px;width: 230px;">' . __("Auto pull nickname and avatar with a QQ num. entered", "sakura")/*输入QQ号将自动拉取昵称和头像*/ . '</span><input type="text" placeholder="' . __("Nickname or QQ number", "sakura") /*昵称或QQ号*/ . ' ' . ($req ?  '(' . __("Name* ", "sakura") . ')' : '') . '" name="author" id="author" value="' . esc_attr($comment_author) . '" size="22" autocomplete="off" tabindex="1" ' . ($req ? "aria-required='true'" : '') . ' /></div>',
								// 'email' =>
								// '<div class="popup cmt-popup" onclick="cmt_showPopup(this)"><span class="popuptext" id="thePopup" style="margin-left: -65px;width: 130px;">' . __("You will receive notification by email", "sakura")/*你将收到回复通知*/ . '</span><input type="text" placeholder="' . __("email", "sakura") . ' ' . ($req ? '(' . __("Must* ", "sakura") . ')' : '') . '" name="email" id="email" value="' . esc_attr($comment_author_email) . '" size="22" tabindex="1" autocomplete="off" ' . ($req ? "aria-required='true'" : '') . ' /></div>',
								// 'url' =>
								// '<div class="popup cmt-popup" onclick="cmt_showPopup(this)"><span class="popuptext" id="thePopup" style="margin-left: -55px;width: 110px;">' . __("Advertisement is forbidden 😀", "sakura")/*禁止小广告😀*/ . '</span><input type="text" placeholder="' . __("Site", "sakura") . '" name="url" id="url" value="' . esc_attr($comment_author_url) . '" size="22" autocomplete="off" tabindex="1" /></div></div>' . $robot_comments . $private_ms . $mail_notify,
								'qq' =>
								'<input type="text" placeholder="QQ" name="new_field_qq" id="qq" value="' . esc_attr($comment_author_url) . '" style="display:none" autocomplete="off"/><!--此栏不可见-->',
							)
						)
					);
					comment_form($args);
					//field wrappers
					// add_action('comment_form_before_fields', function () {
					// 	echo '<div class="row">';
					// });
					// add_action('comment_form_after_fields', 'wpse172052_comment_form_after_fields');
				}

				?>

			</div>


		</section>
	<?php endif; ?>