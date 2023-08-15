<!doctype html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <?php $description = ThemeNova\Site\get_page_description(); ?>
  <?php $keywords = ThemeNova\Site\get_page_keyword(); ?>
  <?php if ($description) { /* page description */ ?>
    <meta name="description" content="<?php echo $description; ?>" /><?php } ?>
  <?php if ($keywords) { /* page keyword */ ?>
    <meta name="keywords" content="<?php echo $keywords; ?>" /><?php } ?>

  <link rel="shortcut icon" href="<?php echo of_get_option('favicon_link', ''); ?>" />
  <meta http-equiv="x-dns-prefetch-control" content="on">

  <?php $analytics = of_get_option('analytics_code', ''); ?>
  <?php if ($analytics) { ?>
    <?php echo $analytics; ?>
  <?php } ?>



  <?php wp_head(); ?>

  <?php if (of_get_option('google_analytics_id', '')) { ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo of_get_option('google_analytics_id', ''); ?>"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
        dataLayer.push(arguments)
      }
      gtag('js', new Date());
      gtag('config', '<?php echo of_get_option('google_analytics_id', ''); ?>');
    </script>
  <?php } ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>
  <?php do_action('get_header'); ?>

  <div id="app">
    <?php echo view(app('sage.view'), app('sage.data'))->render(); ?>
  </div>

  <?php do_action('get_footer'); ?>
  <?php wp_footer(); ?>
</body>

</html>