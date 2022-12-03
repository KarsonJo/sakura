<?php

namespace App\View\Composers\Index;

use Roots\Acorn\View\Composer;

class ArticleListItem extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'partials.index.article-list-item',
    ];

    /**
     * Data to be passed to view before rendering, but after merging.
     *
     * @return array
     */
    public function override()
    {
        $cover = \ThemeNova\Post\post_cover(null, 'large') ?: \ThemeNova\Gallery\feature_image();
        $categories = get_the_category();
        return [
            'link' => get_permalink(),
            'title' => get_the_title(),
            'excerpt' => \ThemeNova\Site\get_excerpt(),
            'align_class' => $this->thumb_align_class(),
            'cover' => $cover,
            'post_time' => \ThemeNova\Post\post_display_time(),
            'heat' => $this->article_heat(),
            'echo_comment_link' =>  function () {
                comments_popup_link('NOTHING', '1 ' . __('Comment', 'sakura') /*条评论*/, '% ' . __('Comments', 'sakura') /*条评论*/);
            },
            'category_link' => esc_url(get_category_link($categories[0]->cat_ID)),
            'category_name' =>  $categories[0]->cat_name,
        ];
    }

    function thumb_align_class()
    {
        switch (of_get_option('feature_align')) {
            case 'left':
                return 'reverse';
            case 'alternate':
                return 'alternate';
            default:
                return '';
        }
    }

    function article_heat()
    {
        $view = \ThemeNova\Post\get_post_views(get_the_ID());
        $view = \ThemeNova\Preference\get_statistics_number($view);
        return $view  . ' ' . _n('Hit', 'Hits', $view, 'sakura')/*热度*/;
    }
}
