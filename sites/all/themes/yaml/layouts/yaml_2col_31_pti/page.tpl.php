<?php
// $Id: page.tpl.php,v 3.1.0.12 2009/06/07 00:00:00 hass Exp $
?><?php if (!empty($xml_prolog)) { print $xml_prolog; } ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language ?>" lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">

<head>
  <title><?php print $head_title ?></title>
  <?php print $head ?>
  <?php print $styles ?>
  <?php print $scripts ?>
  
  <script language="JavaScript" type="text/javascript">
	$(document).ready(function(){
		$('marquee').marquee();
		
		$('a').focus(function() {
		  $(this).blur();
		});
	});
  </script>
</head>

<body class="<?php print $body_classes; ?>">

<div id="fullrange-header"></div>

<?php if (isset($fontsize_init)) { print $fontsize_init; } ?>

<div class="page_margins">
  <?php print $border_top ?>
  
  <div id="page-left-shadow"></div>
  
  <div class="page">

    <div id="header" class="clearfix">
      <div id="topnav">
        <a class="skip" href="#navigation" title="<?php print t('Skip to the navigation') ?>"><?php print t('Skip to the navigation') ?></a><span class="hideme">.</span>
        <a class="skip" href="#content" title="<?php print t('Skip to the content') ?>"><?php print t('Skip to the content') ?></a><span class="hideme">.</span>
      </div>
      <?php print $header ?>
      <?php if ($logo) { ?><a href="<?php print $base_path ?>" title="<?php print t('Home') ?>"><img id="site-logo" class="_trans" src="<?php print $logo ?>" alt="<?php print t('Home') ?>" /></a><?php } ?>
      <div id="nav"> <a id="navigation" name="navigation"></a> <!-- skip anchor: navigation -->
	      <?php if (!empty($primary_links)) { ?>
	      <div class="hlist">
	        <?php print theme('links', $primary_links, array('class' => 'primary-links')) ?>
	      </div>
	      <?php } ?>
	      <div id="sub-nav">
		    	<?php if (!empty($secondary_links)) { ?>
		    		<?php print theme('links_secondary', $secondary_links, array('class' => 'links secondary-links')) ?>
		    	<?php } ?>
		    </div>
	    </div>
      <?php if ($site_name) { ?><h1 id="site-name"><a href="<?php print $base_path ?>" title="<?php print t('Home') ?>">Herzlich willkommen beim <?php print $site_name ?></a></h1><?php } ?>
      <?php if ($site_slogan) { ?><div id="site-slogan"><?php print $site_slogan ?></div><?php } ?>
      <?php //if ($mission) { ?>
      <!-- #mission: between main navigation and content -->
      <div id="mission" class="clearfix">
        <marquee behavior="scroll" scrollamount="2" direction="left"><?php print $mission ?></marquee>
      	<div class="shadow"></div>
      </div>
      <?php //} ?>
      <?php print $search_box ?>
    </div>

    <!-- begin: main content area #main -->
    <div id="main">

      <?php if ($right): ?>
      <!-- begin: #col1 - first float column -->
      <div id="col1">
        <div id="col1_content" class="clearfix"> <a id="content" name="content"></a> <!-- skip anchor: content -->
          <div id="col1_inside" class="floatbox">
            <?php print $right ?>
          </div>
        </div>
      </div>
      <!-- end: #col1 -->
      <?php endif; ?>
      
      <!-- begin: breadcrumb #nav -->
	    <div id="nav-bar" class="clearfix">
	      <?php print $breadcrumb ?>
	      <?php if (isset($fontsize_links)) { print $fontsize_links; } ?>
	    </div>
	    <!-- end: breadcrumb -->

      <!-- begin: #col3 static column -->
      <?php if ($right): ?><div id="col3"><?php endif; ?>
      <?php if (!$right): ?><div id="col3 col3-full-width"><?php endif; ?>
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

  </div>
  <?php print $border_bottom ?>
</div>
<div id="fullrange-footer">
	<!-- begin: #footer -->
  <div id="footer">
    <?php print $footer ?>
    <?php print $footer_message ?>
    <?php print theme('links_secondary', $secondary_links, array('class' => 'links secondary-links')) ?>
  </div>
  <!-- end: #footer -->
</div>
<?php print $closure ?>
</body>
</html>
