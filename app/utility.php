<?php

namespace ThemeNova;

/**
 * display the time span calculate before current time
 */
function display_time($older_date, $comment_date = false, $text = false)
{
    $chunks = array(
        array(24 * 60 * 60, __(' days ago', 'sakura')),/*天前*/
        array(60 * 60, __(' hours ago', 'sakura')),/*小时前*/
        array(60, __(' minutes ago', 'sakura')),/*分钟前*/
        array(1, __(' seconds ago', 'sakura'))/*秒前*/
    );

    $since = time() - $older_date;
    if ($text) {
        $output = '';
    } else {
        $output = __('Posted on ', 'sakura')/*发布于*/;
    }

    if ($since < 30 * 24 * 60 * 60) {
        for ($i = 0, $j = count($chunks); $i < $j; $i++) {
            $seconds = $chunks[$i][0];
            $name    = $chunks[$i][1];
            if (($count = floor($since / $seconds)) != 0) {
                break;
            }
        }
        $output .= $count . $name;
    } else {
        $output .= $comment_date ? date('Y-m-d H:i', $older_date) : date('Y-m-d', $older_date);
    }

    return $output;
}

namespace ThemeNova\Assets;

function js_asyncdefer_feature($tag, $handle, $src)
{
    // if the unique handle/name of the registered script has 'async' in it
    if (strpos($handle, '-async') !== false) {
        // return the tag with the async attribute
        return str_replace('<script ', '<script async ', $tag);
    }
    // if the unique handle/name of the registered script has 'defer' in it
    else if (strpos($handle, '-defer') !== false) {
        // return the tag with the defer attribute
        return str_replace('<script ', '<script defer ', $tag); //js
    }
    // otherwise skip
    return $tag;
}

function css_defer_feature($tag, $handle)
{
    if (strpos($handle, '-defer') !== false) {
        return str_replace("media='all'", 'media="print" onload="this.media=\'all\';"', $tag);
    }
    return $tag;
}

namespace ThemeNova\Preference;

function get_statistics_number($number)
{
    switch (of_get_option('statistics_format')) {
        case "type_2": //23,333 次访问
            return number_format($number);
            break;
        case "type_3": //23 333 次访问
            return number_format($number, 0, '.', ' ');
            break;
        case "type_4": //23k 次访问
            if ($number >= 1000) {
                return round($number / 1000, 2) . 'k';
            } else {
                return $number;
            }
            break;
        default:
            return $number;
    }
}

namespace ThemeNova\Site;

/**
 * get experpt by a limit
 * @param int $limit
 * a number bewteen 0 and excerpt_length, which set by excerpt_length filter
 */
function get_excerpt($limit = 55)
{
    return wp_trim_words(get_the_excerpt(), $limit);
}

/**
 * get keyword of current page
 */
function get_page_keyword()
{
    $merge_from_wp = function ($origin, $wp_term) {
        $get_name = function ($x) {
            return $x->name;
        };
        return $wp_term ? array_merge($origin, array_map($get_name, $wp_term)) : $origin;
    };
    return is_singular() ? join(',', $merge_from_wp($merge_from_wp(array(), get_the_tags()), get_the_category())) : of_get_option('akina_meta_keywords');
}

function get_page_description()
{
    return is_singular() ? get_excerpt(100) : of_get_option('akina_meta_description');
}

namespace ThemeNova\Gallery;

/**
 * get image for external link if post_covet api set,
 * otherwise get image from cover_gallery
 */
function feature_image()
{
    if (of_get_option('post_cover_options') == "type_2") {
        $imgurl = of_get_option('post_cover');
    } else {
        $imgurl = cover_gallery();
    }
    return $imgurl;
}

/**
 * random image from local
 */
function cover_gallery()
{
    if (of_get_option('cover_cdn_options') == 'type_2') {
        $img_array = glob(get_template_directory() . '/resources/images/gallery/*.{gif,jpg,png,webp}', GLOB_BRACE);
        $img = array_rand($img_array);
        $imgurl = trim($img_array[$img]);
        $imgurl = str_replace(get_template_directory(), get_template_directory_uri(), $imgurl);
    } elseif (of_get_option('cover_cdn_options') == 'type_3') {
        $imgurl = of_get_option('cover_cdn');
    } else {
        global $sakura_image_array;
        $img_array = json_decode($sakura_image_array, true);
        $img = array_rand($img_array);
        $img_domain = of_get_option('cover_cdn') ? of_get_option('cover_cdn') : get_template_directory_uri();
        if (strpos($_SERVER['HTTP_ACCEPT'], 'image/webp') !== false) {
            $imgurl = $img_domain . '/manifest/' . $img_array[$img]['webp'][0];
        } else {
            $imgurl = $img_domain . '/manifest/' . $img_array[$img]['jpeg'][0];
        }
    }
    return $imgurl;
}

namespace ThemeNova\Post;

use ThemeNova;

function post_display_time($comment_date = false, $text = false)
{
    return ThemeNova\display_time(get_post_time('U', true), $comment_date, $text);
}

/**
 * @param int $post_id
 * @return int view times
 */
function get_post_views($post_id)
{
    return 0;
    if (of_get_option('statistics_api') == 'wp_statistics') {
        if (!function_exists('wp_statistics_pages')) {
            return __('Please install pulgin <a href="https://wordpress.org/plugins/wp-statistics/" target="_blank">WP-Statistics</a>', 'sakura');
        } else {
            return call_user_func('wp_statistics_pages', 'total', 'uri', $post_id);
        }
    } else {
        $views = get_post_meta($post_id, 'views', true);
        if ($views == '') {
            return 0;
        } else {
            return $views;
        }
    }
}

/**
 * generate a comment block for single comment.
 * can be used as wp_list_comments callback.
 * 
 * the container lacks closing tag \</li>, which is by design because of usage in callback.
 * @param WP_Comment $comment
 * @param string|array $_ [discarded] tags that provided by callback.
 * @param int $depth The depth of current comment
 */
function comment_block_generator($comment, $_, $depth)
{
    global $post;
    $GLOBALS['comment'] = $comment;
    echo view('partials.snippet.comment-block', ['depth' => $depth]);
}

/**
 * Add @ for comment reply
 */
function comment_add_at($comment_text, $comment)
{
    if ($comment && $comment->comment_parent > 0) {
        $add_link = '<a href="#comment-' . $comment->comment_parent . '" class="comment-at">@' . get_comment_author($comment->comment_parent) . '</a>';
        if (substr($comment_text, 0, 3) === '<p>')
            $comment_text = str_replace('<p>', '<p>' . $add_link, $comment_text);
        else
            $comment_text = $add_link . $comment_text;
    }
    return $comment_text;
}

/**
 * get first attachment image as post cover
 * @param int|WP_Post $post
 * @param string|int[] $size
 * Optional. Image size. 
 * Accepts any registered image size name, or an array of width and height values in pixels (in that order). 
 * Default 'thumbnail'.
 */
function post_cover($post = null, $size = 'full')
{
    $list = wp_get_attachment_image_src(get_post_thumbnail_id($post), $size);
    return $list ? $list[0] : false;
}

/**
 * get the first content image of post
 * @param int|WP_Post $post
 */
function post_first_content_image($post = null)
{
    $post = get_post($post);
    if ($post && preg_match('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches)) {
        return $matches[1];
    }
    return false;
}

/**
 * get the first of:
 * cover image > first content image > cover gallery
 * @param int|WP_Post $post
 */
function post_preview_image($post)
{
    return post_cover($post) ?: post_first_content_image($post) ?: \ThemeNova\Gallery\cover_gallery() ?: false;
}
