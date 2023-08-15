<?php

namespace KarsonJo\Utility\RESTAPI {
    /**
     * 加入用于api的JavaScript数据
     */
    add_action('wp_enqueue_scripts', function () {
        wp_enqueue_script('wp-api');
        wp_localize_script('wp-api', 'wpApiSettings', [
            'root' => esc_url_raw(rest_url()),
            'nonce' => wp_create_nonce('wp_rest')
        ]);
    });

    class APIBuilder
    {
        public string $namespace;
        function __construct($domain, $version = 'v1')
        {
            $this->namespace = $domain . '/' . $version;
        }

        function registerRoute(string $routePath, array $args, $override = false)
        {
            add_action('rest_api_init', fn () => register_rest_route($this->namespace, $routePath, $args), $override);
        }
    }

    // function from_same_origin()
    // {
    //     // 获取当前 WordPress 站点的主机名
    //     $current_host = wp_parse_url(home_url(), PHP_URL_HOST);

    //     // 引荐来源的 host
    //     $referer = $_SERVER['HTTP_REFERER'];
    //     $parsed_referer = parse_url($referer);
    //     $referer_host = isset($parsed_referer['host']) ? $parsed_referer['host'] : '';
    // }
}
