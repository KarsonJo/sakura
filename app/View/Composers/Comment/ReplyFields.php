<?php

namespace App\View\Composers\Comment;

use Roots\Acorn\View\Composer;

class ReplyFields extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'partials.comment.reply-fields',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function override()
    {
        $req = get_option( 'require_name_email');
        $fields = [
            [__('Nickname or QQ number', 'sakura'), 'author', __('Auto pull nickname and avatar with a QQ num. entered', 'sakura'), $req],
            [__(' email', 'sakura'), 'email', __('You will receive notification by email', 'sakura'), $req],
            [__('Site', 'sakura'), 'url', __('Advertisement is forbidden 😀', 'sakura'), false],
        ];

        return [
            'fields' => array_map(function ($item) {
                return [
                    'prompt' => $item[0],
                    'name' => $item[1],
                    'tooltip' => $item[2],
                    'required' => $item[3],
                ];
            }, $fields),
        ];
    }

    private function required()
    {
        global $req;
        return ($req ? '(' . __("Must* ", " sakura") . ')' : '');
    }
}
