<?php
function customizer_css() { ?>
<style type="text/css">

<?php // theme-skin
if ( akina_option('theme_skin') ) { ?>
:root {
    --theme-main-color:  <?php echo akina_option('theme_skin'); ?>;
}

.changeSkin-gear,.toc-wrapper{
    background:rgba(255,255,255,<?php echo akina_option('sakura_skin_alpha','') ?>);
}

<?php if(akina_option('entry_content_theme') == "sakura"){ ?>
.entry-content th {
    background-color: var(--theme-main-color);
}
<?php } ?>
<?php if(akina_option('live_search')){ ?>
.search-form--modal .search-form__inner {
    bottom: unset !important;
    top: 10% !important;
}
<?php } ?>

<?php if(akina_option('feature_align') == 'left'){ ?>
.post-list-thumb .post-content-wrap {
    float: left;
    padding-left: 30px;
    padding-right: 0;
    text-align: right;
    margin: 20px 10px 10px 0
}
.post-list-thumb .post-thumb {
    float: left
}

.post-list-thumb .post-thumb a {
    border-radius: 10px 0 0 10px
}
<?php }if(akina_option('feature_align') == 'alternate'){ ?>
.post-list-thumb:nth-child(2n) .post-content-wrap {
    float: left;
    padding-left: 30px;
    padding-right: 0;
    text-align: right;
    margin: 20px 10px 10px 0
}
.post-list-thumb:nth-child(2n) .post-thumb {
    float: left
}

.post-list-thumb:nth-child(2n) .post-thumb a {
    border-radius: 10px 0 0 10px
}
<?php } ?>


.post-list-thumb{opacity: 0}
.post-list-show {opacity: 1}

<?php } // theme-skin ?>
<?php // Custom style
if ( akina_option('site_custom_style') ) {
  echo akina_option('site_custom_style');
} 
// Custom style end ?>
<?php // liststyle
if ( akina_option('list_type') == 'square') { ?>
.feature img{ border-radius: 0px; !important; }
.feature i { border-radius: 0px; !important; }
<?php } // liststyle ?>
<?php // comments
if ( akina_option('toggle-menu') == 'no') { ?>
.comments .comments-main {display:block !important;}
.comments .comments-hidden {display:none !important;}
<?php } // comments ?>
<?php 
$image_api = 'background-image: url("'.rest_url('sakura/v1/image/cover').'");';
$bg_style = akina_option('focus_height') ? 'background-position: center center;background-attachment: inherit;' : '';
?>
.centerbg{<?php echo $image_api.$bg_style ?>background-position: center center;background-attachment: inherit;}
.rotating {
    -webkit-animation: rotating 6s linear infinite;
    -moz-animation: rotating 6s linear infinite;
    -ms-animation: rotating 6s linear infinite;
    -o-animation: rotating 6s linear infinite;
    animation: rotating 6s linear infinite;
}
<?php if(akina_option('comment_info_box_width', '')): ?>
.cmt-popup {
    --widthA: <?php echo akina_option('comment_info_box_width', ''); ?>%;
    --widthB: calc(var(--widthA) - 71px);
    --widthC: calc(var(--widthB) / 3);
    width: var(--widthC);
}
<?php endif;?>

</style>
<?php }
add_action('wp_head', 'customizer_css');
