<?php

if ($add_class) {
	$classes = ' ' . implode(' ', $add_class);
}

foreach ($node->field_images as $image) {
	$images .= theme_content_image($image, 'gallery-overview-image', array('type' => 'lightshow', 'group' => 'bildergalerie'));
}

// Zeilenumbrüche formatieren.
//$content = str_replace("\n", '<br />', $content);

$content = str_replace("\n\n", '</p><p>', $content);
$content = '<p>' . $content . '</p>';


?>


<div id="node-<?php print $node->nid; ?>" class="node<?php if ($sticky) { print " sticky"; }; print $classes; ?><?php if (!$status) { print " node-unpublished"; } ?>">
  <div class="clearfix">
    <?php print $picture ?>
    <?php if ($teaser): print $teaser_img_link; endif; ?>
    <?php if ($page == 0): ?>
      <h3><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h3>
    <?php endif; ?>
    <?php if (($terms || $submitted) && !$teaser): ?>
      <div class="meta">
      <?php if ($submitted): ?>
        <span class="submitted"><?php print $submitted ?></span>
      <?php endif; ?>
      <?php if ($terms): ?>
        <div class="terms"><?php print $terms ?></div>
      <?php endif;?>
      </div>
    <?php endif; ?>
    <?php if ($teaser): ?>
    <div class="content"><?php print node_teaser($node->content['body']['#value']) ?></div>
    <?php endif;?>
    <?php if (!$teaser): ?>
    <div class="content"><?php print $content . $images ?></div>
    <?php endif;?>
    <?php if ($links) { print $links; } ?>
  </div>
</div>
