<?php

/** global experpt length */
$post_excerpt_maximum = 135;

/**
 * 文章摘要
 * set maximum experpt
 */
function changes_post_excerpt_more($more)
{
    return ' ...';
}
function changes_post_excerpt_length($length)
{
    global $post_excerpt_maximum;
    return $post_excerpt_maximum;
}
add_filter('excerpt_more', 'changes_post_excerpt_more');
add_filter('excerpt_length', 'changes_post_excerpt_length', 999);

/**
 * get experpt by a limit
 * @param int $limit
 * a number bewteen 0 and excerpt_length, which set by $post_excerpt_maximum.
 */
function karson_get_excerpt($limit = 55)
{
    return wp_trim_words(get_the_excerpt(), $limit);
}
