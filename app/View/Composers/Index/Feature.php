<?php

namespace App\View\Composers\Index;

use Roots\Acorn\View\Composer;

class Feature extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'partials.index.feature',
    ];

    /**
     * Data to be passed to view before rendering, but after merging.
     *
     * @return array
     */
    public function override()
    {
        return [
            'features' => $this->get_features(['feature1', 'feature2', 'feature3']),
        ];
    }

    private function get_features($names)
    {
        $list = [];
        foreach ($names as $name) {
            // if (of_get_option($name . '_link', '#!'));
            $list[] = $this->get_feature($name);
        }
        return $list;
    }

    private function get_feature($name)
    {
        return [
            'link' => of_get_option($name . '_link') ?: '#!',
            'image' => of_get_option($name . '_img') ?: '',
            'title' => of_get_option($name . '_title') ?: $name,
            'description' => of_get_option($name . '_description') ?: $name,
        ];
    }
}
