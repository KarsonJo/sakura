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
    
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    // wp_enqueue_script("powermode", $dir_url . '/assets-dev/components/activate-power-mode.js', array('jQuery-CDN'), SAKURA_VERSION);
    wp_enqueue_script("lazyload-defer", $dir_url . '/assets-dev/components/lazyload.min.js', array('jQuery-CDN'), SAKURA_VERSION);
    // wp_enqueue_script("powermode-defer", $dir_url . '/assets-dev/components/activate-power-mode.js', array('jQuery-CDN'), SAKURA_VERSION);
    ob_start(); ?>
    <script>
        window.addEventListener("DOMContentLoaded", function() {
            POWERMODE.colorful = true;
            POWERMODE.shake = false;
            document.body.addEventListener('input', POWERMODE);
        });
    </script>
<?php
    wp_add_inline_script('powermode-defer', ob_get_clean(), 'after');
    wp_enqueue_script("socialshare-defer", $dir_url . '/assets-dev/components/social-share.min.js', array('jQuery-CDN'), SAKURA_VERSION);
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
    wp_enqueue_style('comment_css', get_template_directory_uri() . '/assets-dev/css/comment.css');
}

function karson_defer_css()
{

    if (akina_option('jsdelivr_cdn_test')) {
        $jsdelivr_css_src = get_template_directory_uri() . "/cdn/css/lib.css?" . SAKURA_VERSION . akina_option('cookie_version', '');
    } else {
        $jsdelivr_css_src = "https://cdn.jsdelivr.net/gh/mashirozx/Sakura@" .  SAKURA_VERSION  . "/cdn/css/lib.min.css";
    }
    if (akina_option('entry_content_theme') == "sakura") {
        $entry_content_theme_src =  get_template_directory_uri() . "/cdn/theme/sakura.css?" . SAKURA_VERSION . akina_option('cookie_version', '');
    } elseif (akina_option('entry_content_theme') == "github") {
        $entry_content_theme_src = get_template_directory_uri() . "/cdn/theme/github.css?" . SAKURA_VERSION . akina_option('cookie_version', '');
    }
    wp_enqueue_style('lib-defer', $jsdelivr_css_src);
    wp_enqueue_style('theme-defer', $entry_content_theme_src);
    wp_enqueue_style('iconfont-defer', 'https://at.alicdn.com/t/font_679578_qyt5qzzavdo39pb9.css');
    wp_enqueue_style('aplayer-defer', 'https://cdn.jsdelivr.net/npm/aplayer@1.10.1/dist/APlayer.min.css');
    wp_enqueue_style('googlefont-defer', 'https://fonts.googleapis.com/css?family=Noto+SerifMerriweather|Merriweather+Sans|Source+Code+Pro|Ubuntu:400,700|Noto+Serif+SC');
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
add_action('wp_enqueue_scripts', 'karson_defer_css');
add_action('wp_enqueue_scripts', 'karson_requirejs_main');

//===== one time executing function =====

/**support async or defer attribute for script named with suffix -async or -defer
/* https://www.filamentgroup.com/lab/load-css-simpler/
 */
if (!is_admin()) {
    function js_asyncdefer_feature($tag, $handle, $src)
    {
        // if the unique handle/name of the registered script has 'async' in it
        if (strpos($handle, '-async') !== false) {
            // return the tag with the async attribute
            return str_replace('<script ', '<script async ', $tag);
        }
        // if the unique handle/name of the registered script has 'defer' in it
        else if (strpos($handle, '-defer') !== false) {
            // return the tag with the defer attribute
            return str_replace('<script ', '<script defer ', $tag); //js
        }
        // otherwise skip
        return $tag;
    }
    add_filter('script_loader_tag', 'js_asyncdefer_feature', 10, 3);

    function css_defer_feature($tag, $handle)
    {
        if (strpos($handle, '-defer') !== false) {
            return str_replace("media='all'", 'media="print" onload="this.media=\'all\';"', $tag);
        }
        return $tag;
    }
    add_filter('style_loader_tag', 'css_defer_feature', 10, 2);
}
