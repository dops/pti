<?php
// $Id: page.tpl.php,v 3.2.1.14 2011/07/10 00:00:00 hass Exp $
?><?php if (!empty($xml_prolog)) { print $xml_prolog; } ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language ?>" lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">

<head>
  <?php print $head ?>
  <title><?php print $head_title ?></title>
  <?php print $styles ?>
  <?php print $scripts ?>
</head>

<body class="<?php print $body_classes; ?>">
<?php if (!empty($fontsize_init)) { print $fontsize_init; } ?>
<!-- skip link navigation -->
<ul id="skiplinks">
  <li><a class="skip" href="#nav"><?php print t('Skip to navigation (Press Enter).') ?></a></li>
  <li><a class="skip" href="#col3"><?php print t('Skip to main content (Press Enter).') ?></a></li>
</ul>

<div class="page_margins">
  <?php print $border_top ?>
  <div class="page">

    <div id="header" class="clearfix" role="banner">
      <div id="topnav" role="contentinfo">
        <?php if (!empty($secondary_links)) { ?><?php print theme('links_secondary', $secondary_links, array('class' => 'links secondary-links')) ?><?php } ?>
      </div>
      <?php print $header ?>
      <?php if ($logo) { ?><a href="<?php print $base_path ?>" title="<?php print t('Home') ?>"><img id="site-logo" class="_trans" src="<?php print $logo ?>" alt="<?php print t('Home') ?>" /></a><?php } ?>
      <?php if ($site_name) { ?><h1 id="site-name"><a href="<?php print $base_path ?>" title="<?php print t('Home') ?>"><?php print $site_name ?></a></h1><?php } ?>
      <?php if ($site_slogan) { ?><div id="site-slogan"><?php print $site_slogan ?></div><?php } ?>
      <?php print $search_box ?>
    </div>

    <!-- begin: main navigation #nav -->
    <div id="nav" role="navigation">
      <?php if (!empty($primary_links)) { ?>
      <div class="hlist">
        <?php print theme('links', $primary_links, array('class' => 'primary-links')) ?>
      </div>
      <?php } ?>
    </div>
    <div id="nav-bar" class="clearfix">
      <?php print $breadcrumb ?>
      <?php if (!empty($fontsize_links)) { print $fontsize_links; } ?>
    </div>
    <!-- end: main navigation -->

    <!-- begin: main content area #main -->
    <div id="main">

      <?php if ($mission) { ?>
      <!-- #mission: between main navigation and content -->
      <div id="mission" class="clearfix" role="complementary">
        <?php print $mission ?>
      </div>
      <?php } ?>

      <!-- begin: #col3 static column -->
      <div id="col3" role="main">
        <div id="col3_content" class="clearfix">
          <div id="col3_inside" class="floatbox">
            <?php if ($title) { ?><h2 class="title"><?php print $title ?></h2><?php } ?>
            <?php if ($tabs) { ?><div class="tabs"><?php print $tabs ?></div><?php } ?>
            <?php if ($show_messages && $messages): print $messages; endif; ?>
            <?php print $help ?>
            <?php print $content ?>
            <?php print $feed_icons ?>
          </div>
        </div>
        <!-- begin: IE column clearing -->
        <div id="ie_clearing">&nbsp;</div>
        <!-- end: IE column clearing -->
      </div>
      <!-- end: #col3 -->

    </div>
    <!-- end: #main -->

    <!-- begin: #footer -->
    <div id="footer" role="contentinfo">
      <?php print $footer ?>
      <?php print $footer_message ?>
    </div>
    <!-- end: #footer -->

  </div>
  <?php print $border_bottom ?>
</div>
<?php print $closure ?>
</body>
</html>
