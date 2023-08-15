<?php

/**
 * Theme filters.
 */

namespace App;

/**
 * Add "… Continued" to the excerpt.
 *
 * @return string
 */
add_filter('excerpt_more', function () {
    return sprintf(' &hellip; <a href="%s">%s</a>', get_permalink(), __('Continued', 'sage'));
});

/**
 * excerpt
 */
add_filter('excerpt_length', function () {
    return defined('MAX_EXCERPT') ? MAX_EXCERPT : 55;
}, 999);
add_filter('excerpt_more', function () {
    return ' ...';
});


if (!is_admin()) {
    add_filter('script_loader_tag', '\ThemeNova\Assets\js_asyncdefer_feature', 10, 3);
    add_filter('style_loader_tag', '\ThemeNova\Assets\css_defer_feature', 10, 2);

    add_filter('comment_text', '\ThemeNova\Post\comment_add_at', 10, 2);

}

/**
 * hide admin bar
 */
add_filter( 'show_admin_bar', '__return_false' );

/**
 * suppress deprecated error log
 */
// add_filter( 'deprecated_constructor_trigger_error', '__return_false' );
// add_filter( 'deprecated_function_trigger_error', '__return_false' );
// add_filter( 'deprecated_file_trigger_error', '__return_false' );
// add_filter( 'deprecated_argument_trigger_error', '__return_false' );
// add_filter( 'deprecated_hook_trigger_error', '__return_false' );
error_reporting(E_ALL & ~E_WARNING & ~E_DEPRECATED & ~E_USER_DEPRECATED & ~E_NOTICE);
// error_reporting( E_ERROR | E_NOTICE | E_PARSE );