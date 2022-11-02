<?php
//https://wordpress.stackexchange.com/questions/119573/is-it-possible-to-use-wp-localize-script-to-create-global-js-variables-without-a
/**
 * global js config values for the theme
 * add to head when load
 */
function sakura_js_variables()
{
    // 20161116 @Louie
    $mv_live = akina_option('focus_mvlive') ? 'open' : 'close';
    $movies = akina_option('focus_amv') ? array('url' => akina_option('amv_url'), 'name' => akina_option('amv_title'), 'live' => $mv_live) : 'close';
    $auto_height = akina_option('focus_height') ? 'fixed' : 'auto';
    $code_lamp = 'close';
    // if (wp_is_mobile()) {
    //     $auto_height = 'fixed';
    // }
    //拦截移动端
    version_compare($GLOBALS['wp_version'], '5.1', '>=') ? $reply_link_version = 'new' : $reply_link_version = 'old';
    $gravatar_url = akina_option('gravatar_proxy') ?: 'dn-qiniu-avatar.qbox.me/avatar';

    $config_values = array(
        'pjax' => akina_option('poi_pjax'),
        'movies' => $movies,
        'windowheight' => $auto_height,
        'codelamp' => $code_lamp,
        'ajaxurl' => admin_url('admin-ajax.php'),
        'order' => get_option('comment_order'), // ajax comments
        'formpostion' => 'bottom', // ajax comments 默认为bottom，如果你的表单在顶部则设置为top。
        'reply_link_version' => $reply_link_version,
        'api' => esc_url_raw(rest_url()),
        'nonce' => wp_create_nonce('wp_rest'),
        'google_analytics_id' => akina_option('google_analytics_id', ''),
        'gravatar_url' => $gravatar_url
    );
?>
    <script>
        var Poi = <?php echo json_encode($config_values); ?>
    </script>
<?php
}
add_action('wp_head', 'sakura_js_variables');
