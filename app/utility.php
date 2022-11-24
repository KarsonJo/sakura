<?php
namespace ThemeNova;
/**
 * 订制时间样式
 * time_since(strtotime($post->post_date_gmt));
 * time_since(strtotime($comment->comment_date_gmt), true );
 * time_since(strtotime($post->post_date));
 * time_since(strtotime($comment->comment_date), true );
 */
function time_since($older_date, $comment_date = false, $text = false)
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
    $merge_from_wp = function ($origin, $wp_term)
    {
        $get_name = function ($x)
        {
            return $x->name;
        };
        return $wp_term ? join(',', array_merge($origin, array_map($get_name, $wp_term))) : $origin;
    };
    return is_singular() ? $merge_from_wp($merge_from_wp(array(), get_the_tags()), get_the_category()) : of_get_option('akina_meta_keywords');
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
function feature_image() {
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
        $img_array = glob(get_template_directory() . '/resources/images/gallary/*.{gif,jpg,png}', GLOB_BRACE);
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

/**
 * get first attachment image as post cover
 * @param string|int[] $size
 * Optional. Image size. 
 * Accepts any registered image size name, or an array of width and height values in pixels (in that order). 
 * Default 'thumbnail'.
 */
function karson_post_cover($size = 'full')
{
  $list = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $size);
  return $list ? $list[0] : false;
}

namespace ThemeNova\Post;
use ThemeNova;
function time_since_post($comment_date = false, $text = false)
{
  return ThemeNova\time_since(get_post_time('U', true), $comment_date, $text);
}

/**
 * @param int $post_id
 * @return int view times
 */
function get_post_views($post_id)
{
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