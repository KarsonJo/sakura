<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class UserMenu extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'partials.user-menu',
    ];

    /**
     * Data to be passed to view before rendering, but after merging.
     *
     * @return array
     */
    public function override()
    {
        $user = wp_get_current_user();
        $login = is_user_logged_in();
        $items = [];
        $path = get_bloginfo('url');
        if ($login) {
            $avatar = of_get_option('focus_logo') ?: get_avatar_url($user->ID);
            $profile_url = $path . '/wp-admin/profile.php';
            //admin
            if (current_user_can('level_10')) {
                $items[] = [$path . '/wp-admin/', __('Dashboard', 'sakura'), false]; //dashboard
                $items[] = [$path . '/wp-admin/post-new.php', __('New Post', 'sakura'), false]; //new post
            }
            //user
            $items[] = [$profile_url, __('Profile', 'sakura'), false]; //profile
            $items[] = [wp_logout_url($path), __('Sign out', 'sakura'), true]; //sign out

        } else {
            //visitor
            $avatar = 'https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/none.png';
            
            $profile_url = of_get_option('exlogin_url') ?: $path . '/wp-login.php';
            $items[] = [$profile_url, __('Login', 'sakura'), false]; //Login
        }
        
        return [
            'logged' => $login,
            'avatar' => $avatar,
            'profile_url' => $profile_url,
            'name' => $user->display_name,
            'menu' => $this->map_user_menu($items),
        ];
    }

    private function map_user_menu($menu)
    {
        return array_map(function ($item) {
            return [
                'url' => $item[0],
                'title' => $item[1],
                'top' => $item[2]
            ];
        }, $menu);
    }
}
