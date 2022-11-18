<?php

// define( 'WP_DEBUG', true );
// define( 'WP_DEBUG_DISPLAY', false );
// define( 'WP_DEBUG_LOG', true );

// karson_todo
// may move to options later
define('KARSON_THEME_DEVELOP', true);

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
    // wp_deregister_script('jquery');
    // wp_enqueue_script("jquery", 'https://cdn.jsdelivr.net/wp/wp-editormd/tags/10.2.1/assets/jQuery/jquery.min.js?ver=10.2.1', array(), SAKURA_VERSION, true);
    // wp_enqueue_script("hotwired-turbo", 'https://cdn.jsdelivr.net/npm/@hotwired/turbo@7.2.4/dist/turbo.es2017-umd.min.js', array(), SAKURA_VERSION);

    $dir_url = get_template_directory_uri();
    // load require.js

    /*
    wp_enqueue_script('requirejs', $dir_url . '/assets-rjs/require.js', array(), SAKURA_VERSION);
    // embed require.js config path
    ob_start(); ?>
    <script>
        var themeUri = "<?php echo $dir_url . karson_asset_folder() ?>";
    </script>
<?php
    $script = ob_get_clean();
    wp_add_inline_script('requirejs', $script, 'before');
    //load require.js config
    wp_enqueue_script('requirejs-cfg', $dir_url . '/assets-rjs/req-config.js', array('requirejs'), SAKURA_VERSION);
    */


    // wp_enqueue_script("powermode", $dir_url . '/assets-dev/components/activate-power-mode.js', array('jQuery-CDN'), SAKURA_VERSION);
    wp_enqueue_script("lazyload-defer", $dir_url . '/assets-dev/components/lazyload.min.js', array('jQuery-CDN'), SAKURA_VERSION);
    wp_enqueue_script("powermode-defer", $dir_url . '/assets-dev/components/activate-power-mode.js', array('jQuery-CDN'), SAKURA_VERSION);
    wp_enqueue_script("socialshare-defer", $dir_url . '/assets-dev/components/social-share.min.js', array('jQuery-CDN'), SAKURA_VERSION);
    wp_enqueue_script("loadCSS-defer", $dir_url . '/assets-dev/components/loadCSS.js', array('jQuery-CDN'), SAKURA_VERSION);
    wp_enqueue_script("tocbot-defer", $dir_url . '/assets-dev/components/tocbot/tocbot.min.js', array('jQuery-CDN'), SAKURA_VERSION);
    wp_enqueue_script("sakura-defer", $dir_url . '/assets-dev/js/sakura-app.js', array('jQuery-CDN'), SAKURA_VERSION);

    // load common required js list
    karson_requirejs_package();
}

function karson_partial_debug_css()
{
    wp_enqueue_style('footer_css', get_template_directory_uri() . '/assets-dev/css/footer.css');
    wp_enqueue_style('header_css', get_template_directory_uri() . '/assets-dev/css/header.css');
    wp_enqueue_style('index_css', get_template_directory_uri() . '/assets-dev/css/index.css');
}

/**
 * load page specific js  
 * defualt load common packages
 * @param string $path relative path from /assets/require folder
 */
function karson_requirejs_package($path = '')
{
    // $filename = '/req-list.js';

    // wp_enqueue_script('req' . $path, get_template_directory_uri() . karson_asset_folder() . '/require' . $path . $filename, array('requirejs'), SAKURA_VERSION, true);
}

add_action('wp_enqueue_scripts', 'karson_partial_debug_css');
//priority 101 just in case other scripts conflit with require.js asynchronous load
add_action('wp_enqueue_scripts', 'karson_requirejs_main');

if (!is_admin()) {
    // add_filter('script_loader_tag', function ($tag) {
    //     if (strpos($tag, ' src'))
    //         return str_replace(' src', ' defer src', $tag);
    //     else
    //         return str_replace('text/javascript', 'module', $tag);
    // });

    // function add_defer($url)
    // {
    //     if (strpos($url, ' src'))
    //         return "$url' defer";
    //     else
    //         return str_replace('text/javascript', 'module', $url);
    // }
    // add_filter('clean_url', 'add_defer', 11, 1);
    
}

//support async or defer attribute for script named with suffix -async or -defer
if(!is_admin()) {
    function add_asyncdefer_attribute($tag, $handle) {
        // if the unique handle/name of the registered script has 'async' in it
        if (strpos($handle, '-async') !== false) {
            // return the tag with the async attribute
            return str_replace( '<script ', '<script async ', $tag );
        }
        // if the unique handle/name of the registered script has 'defer' in it
        else if (strpos($handle, '-defer') !== false) {
            // return the tag with the defer attribute
            return str_replace( '<script ', '<script defer ', $tag );
        }
        // otherwise skip
        else {
            return $tag;
        }
    }
    add_filter('script_loader_tag', 'add_asyncdefer_attribute', 10, 2);
}
