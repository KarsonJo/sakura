<?php

/**
 * Theme setup.
 */

namespace App;

use function Roots\bundle;

/**
 * Register the theme assets.
 *
 * @return void
 */
add_action('wp_enqueue_scripts', function () {
    bundle('app')->enqueue();
}, 100);

/**
 * Register the theme assets with the block editor.
 *
 * @return void
 */
add_action('enqueue_block_editor_assets', function () {
    bundle('editor')->enqueue();
}, 100);

/**
 * Register the initial theme setup.
 *
 * @return void
 */
add_action('after_setup_theme', function () {
    /**
     * Enable features from the Soil plugin if activated.
     *
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil', [
        'clean-up',
        'nav-walker',
        'nice-search',
        'relative-urls',
    ]);

    /**
     * Disable full-site editing support.
     *
     * @link https://wptavern.com/gutenberg-10-5-embeds-pdfs-adds-verse-block-color-options-and-introduces-new-patterns
     */
    remove_theme_support('block-templates');

    /**
     * Register the navigation menus.
     *
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary' => __('Nav Menus', 'sakura'), //导航菜单
    ]);

    /**
     * Disable the default block patterns.
     *
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-the-default-block-patterns
     */
    remove_theme_support('core-block-patterns');

    /**
     * Enable plugins to manage the document title.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Enable post thumbnail support.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable responsive embed support.
     *
     * @link https://wordpress.org/gutenberg/handbook/designers-developers/developers/themes/theme-support/#responsive-embedded-content
     */
    add_theme_support('responsive-embeds');

    /**
     * Enable HTML5 markup support.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', [
        'caption',
        'comment-form',
        'comment-list',
        'gallery',
        'search-form',
        'script',
        'style',
    ]);

    /**
     * Enable selective refresh for widgets in customizer.
     *
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    add_theme_support('customize-selective-refresh-widgets');
}, 20);

/**
 * Register the theme sidebars.
 *
 * @return void
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ];

    register_sidebar([
        'name' => __('Primary', 'sage'),
        'id' => 'sidebar-primary',
    ] + $config);

    register_sidebar([
        'name' => __('Footer', 'sage'),
        'id' => 'sidebar-footer',
    ] + $config);
});

/* ========================= */

/**
 * constants
 */
define('SAKURA_VERSION', wp_get_theme()->get('Version'));
define('NOVA_VERSION', wp_get_theme()->get('Version'));
define('MAX_EXCERPT', 135);


/**
 * Register the init hook.
 *
 * @return void
 */
add_action('init', function () {
    /**
     * options framework
     * 
     * @link https://github.com/devinsays/options-framework-theme
     */
    define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/app/options-framework/');
    require_once dirname(__FILE__) . '/options-framework/options-framework.php';

    // Loads options.php from child or parent theme
    $optionsfile = locate_template('options.php');
    load_template($optionsfile);
});


/**
 * Register css and js
 */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('font-awesome-defer', 'https://cdn.jsdelivr.net/gh/hung1001/font-awesome-pro-v6@44659d9/css/all.min.css');
    if (of_get_option('entry_content_theme') == "sakura") {
        wp_enqueue_style('md-sakura.css', get_template_directory_uri() . '/resources/styles/article/prettydoc-cayman.css');
    } elseif (of_get_option('entry_content_theme') == "github") {
        wp_enqueue_style('md-github.css', get_template_directory_uri() . '/resources/styles/article/github.css');
    }

    // wp_deregister_script('jQuery');
    // wp_deregister_script('jquery');
    // wp_deregister_script('jquery-core');
    wp_register_script('jquery', 'https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js');
    // wp_enqueue_style('prism', 'https://unpkg.com/dracula-prism/dist/css/dracula-prism.min.css');

});

// add_action( 'init', 'loadJQueryByCDN', 20 );

// function loadJQueryByCDN(){
// 	if ( is_admin() ) {
// 		return;
// 	}

// 	$protocol = is_ssl() ? 'https' : 'http';

// 	/** @var WP_Scripts $wp_scripts */
// 	global $wp_scripts;

// 	/** @var _WP_Dependency $core */
// 	$core         = $wp_scripts->registered['jquery-core'];
// 	$core_version = $core->ver;
// 	$core->src    = "$protocol://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js";

// 	/** @var _WP_Dependency $jquery */
// 	$jquery       = $wp_scripts->registered['jquery'];
// 	$jquery->deps = [ 'jquery-core' ];
// }