<?php

namespace App\View\Composers\Footer;

use Roots\Acorn\View\Composer;

class SkinMenu extends Composer
{
    private $skins = [
        ['white-bg', ['fa fa-television'], 'none'],
        ['sakura-bg', ['icon-sakura'], 'https://cdn.jsdelivr.net/gh/spirit1431007/cdn@1.6/img/sakura.png'],
        ['gribs-bg', ['fa fa-slack'], 'https://cdn.jsdelivr.net/gh/spirit1431007/cdn@1.6/img/plaid2dbf8.jpg'],
        ['KAdots-bg', ['icon-dots'], 'https://cdn.jsdelivr.net/gh/spirit1431007/cdn@1.6/img/star02.png'],
        ['totem-bg', ['fa fa-superpowers'], 'https://cdn.jsdelivr.net/gh/spirit1431007/cdn@1.6/img/kyotoanimation.png'],
        ['pixiv-bg', ['icon-pixiv'], 'https://cdn.jsdelivr.net/gh/spirit1431007/cdn@1.6/img/dot_orange.gif'],
        ['bing-bg',  ['icon-bing'], 'https://api.mashiro.top/bing/'],
        ['dark-bg',  ['fa fa-moon-o', 'fa fa-sun-o'], 'https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.2/other-sites/api-index/images/me.png'],
    ];

    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'partials.footer.skin-menu',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function override()
    {
        return [
            'skins' => $this->getSkinList(),
        ];
    }

    private function getSkinList()
    {
        $list = [];
        foreach ($this->skins as $skin){
            $list[] = [
                'id' => $skin[0],
                'icons' => $skin[1],
                'url' => $skin[2],
            ];
        }
        return $list;
    }
}
