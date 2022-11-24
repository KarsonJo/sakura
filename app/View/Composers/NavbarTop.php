<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class NavbarTop extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'partials.navbar-top',
    ];

    /**
     * Data to be passed to view before rendering, but after merging.
     *
     * @return array
     */
    public function override()
    {
        return [
            'enable_search' =>  of_get_option('top_search') == 'yes',
            'has_nav' => has_nav_menu('primary'),
            'nav_menu' => function () {
                wp_nav_menu(['depth' => 2, 'theme_location' => 'primary', 'container' => false]);
            },
        ];
    }
}
