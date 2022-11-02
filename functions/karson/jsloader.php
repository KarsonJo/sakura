<?php

// define( 'WP_DEBUG', true );
// define( 'WP_DEBUG_DISPLAY', false );
// define( 'WP_DEBUG_LOG', true );

// karson_todo
// may move to options later
define('KARSON_THEME_DEVELOP', false);

function karson_asset_folder()
{
    if (constant('KARSON_THEME_DEVELOP'))
        return '/assets-dev';
    else
        return '/assets';
}

/**
 * load require.js and common-used js 
 */
function karson_requirejs_main()
{
    $dir_url = get_template_directory_uri();
    // load require.js
    wp_enqueue_script('requirejs', $dir_url . '/assets-rjs/require.js', array(), SAKURA_VERSION, true);
    // embed require.js config path
    ob_start(); ?>
    <script>
        var themeUri = "<?php echo $dir_url . karson_asset_folder() ?>";
        // require.config({
        //     baseUrl: "<?php echo $dir_url ?>/assets",
        //     paths: {
        //         hljs: "components/code-block/highlight.pack",
        //         clipboard: "components/code-block/clipboard.min",
        //         hljsnum: "components/code-block/highlightjs-line-numbers.min",
        //         powermode: "components/activate-power-mode",
        //         lazyload: "components/lazyload.min",
        //         socialshare: "components/social-share.min",
        //         loadCSS: "components/loadCSS",
        //         tocbot: "components/tocbot/tocbot.min",
        //         sakura: "js/sakura-app",
        //     },
        //     shim: {
        //         socialshare: {
        //             exports: 'social-share'
        //         },
        //         loadCSS: {
        //             exports: 'loadCSS'
        //         },
        //         tocbot: {
        //             exports: 'tocbot'
        //         }
        //     },
        //     waitSeconds: 15
        // });
    </script>
<?php
    $script = ob_get_clean();
    wp_add_inline_script('requirejs', $script, 'before');
    //load require.js config
    wp_enqueue_script('requirejs-cfg', $dir_url . '/assets-rjs/req-config.js', array('requirejs'), SAKURA_VERSION, true);

    // load common required js list
    karson_requirejs_package();
}

/**
 * load page specific js  
 * defualt load common packages
 * @param string $path relative path from /assets/require folder
 */
function karson_requirejs_package($path = '')
{
    // if (constant('KARSON_THEME_DEVELOP'))
    //     $filename = '/req-list.js';
    // else
    //     $filename = '/req.js';
    $filename = '/req-list.js';

    wp_enqueue_script($path, get_template_directory_uri() . karson_asset_folder() . '/require' . $path . $filename, array('requirejs'), SAKURA_VERSION, true);
}

//priority 101 just in case other scripts conflit with require.js asynchronous load
add_action('wp_enqueue_scripts', 'karson_requirejs_main', 101);
