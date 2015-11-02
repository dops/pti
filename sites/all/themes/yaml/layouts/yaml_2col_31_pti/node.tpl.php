<?php

if ($add_class) {
	$classes = ' ' . implode(' ', $add_class);
}

if (!$teaser) {
	if ($node->field_images) {
		// Break text at image placeholders
		$content = insertContentImages($node->body, $node->field_images);
	}
}
else {
	$text    = str_replace(variable_get('image_placeholder', '[BILD]'), '', $node->content['body']['#value']);
	$content = node_teaser($text);
}

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
    <div class="content"><?php print $content ?></div>
    <?php if ($links) { print $links; } ?>
  </div>
</div>
