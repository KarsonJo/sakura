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
    return defined(MAX_EXCERPT) ? MAX_EXCERPT : 55;
}, 999);
add_filter('excerpt_more', function () {
    return ' ...';
});


if (!is_admin()) {
    add_filter('script_loader_tag', '\ThemeNova\Assets\js_asyncdefer_feature', 10, 3);
    add_filter('style_loader_tag', '\ThemeNova\Assets\css_defer_feature', 10, 2);
}