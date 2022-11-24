<?php

namespace App\View\Composers\Header;

use Roots\Acorn\View\Composer;

class Banner extends Composer
{
    private $socials = [
        ['github', 'https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/github.png'],
        ['sina', 'https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/sina.png'],
        ['telegram', 'https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/telegram.svg'],
        ['qq', 'https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/qq.png'],
        ['qzone', 'https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/qzone.png'],
        ['wechat', 'https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/wechat.png'],
        ['lofter', 'https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/lofter.png'],
        ['bili', 'https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/bilibili.png'],
        ['youku', 'https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/youku.png'],
        ['wangyiyun', 'https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/wangyiyun.png'],
        ['twitter', 'https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/twitter.png'],
        ['facebook', 'https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/facebook.png'],
        ['jianshu', 'https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/jianshu.png'],
        ['zhihu', 'https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/zhihu.png'],
        ['csdn', 'https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/csdn.png'],
    ];

    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'partials.header.banner',
    ];

    /**
     * Data to be passed to view before rendering, but after merging.
     *
     * @return array
     */
    public function override()
    {
        $text_logo = of_get_option('focus_logo_text');
        $avatar_src = $text_logo ?: of_get_option('focus_logo') ?: get_bloginfo('template_url') . '/resources/images/avatar.jpg';
        return [
            'bg_filter' =>  of_get_option('focus_img_filter'),
            'bg_img' => \ThemeNova\Gallery\cover_gallery(),
            'movie_enabled' => of_get_option('focus_amv') == true,
            'social_enabled' => of_get_option('focus_infos') == true,
            'is_text_logo' => $text_logo == true,
            'avatar_src' => $avatar_src,
            'motto' => of_get_option('admin_des', 'Hello, world!'),
            'socials' => $this->pack_socials(),
        ];
    }

    private function pack_socials()
    {
        return array_reduce($this->socials, function ($result, $social) {
            $option = of_get_option($social[0]);
            if ($option) {
                $result[] = [
                    'title' => $social[0],
                    'social_src' => $option,
                    'icon_src' => $social[1],
                    'is_image' => $this->social_is_image($social[0])
                ];
            }
            return $result;
        }, []);
    }

    /**
     * may do better
     */
    private function social_is_image($social)
    {
        return $social === 'wechat';
    }
}
