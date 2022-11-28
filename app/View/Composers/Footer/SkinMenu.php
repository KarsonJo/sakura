<?php

namespace App\View\Composers\Footer;

use Roots\Acorn\View\Composer;

class SkinMenu extends Composer
{
    private $skins = [
        ['white-bg', ['fa-light fa-tv'], 'none'],
        ['sakura-bg', ['fa-light fa-star-christmas'], 'https://cdn.jsdelivr.net/gh/spirit1431007/cdn@1.6/img/sakura.png'],
        ['gribs-bg', ['fa-brands fa-slack'], 'https://cdn.jsdelivr.net/gh/spirit1431007/cdn@1.6/img/plaid2dbf8.jpg'],
        ['KAdots-bg', ['fa-solid fa-grip-dots'], 'https://cdn.jsdelivr.net/gh/spirit1431007/cdn@1.6/img/star02.png'],
        ['totem-bg', ['fa-brands fa-superpowers'], 'https://cdn.jsdelivr.net/gh/spirit1431007/cdn@1.6/img/kyotoanimation.png'],
        ['pixiv-bg', ['fa-light fa-star'], 'https://cdn.jsdelivr.net/gh/spirit1431007/cdn@1.6/img/dot_orange.gif'],
        ['bing-bg',  ['fa-light fa-bangladeshi-taka-sign'], 'https://api.mashiro.top/bing/'],
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
