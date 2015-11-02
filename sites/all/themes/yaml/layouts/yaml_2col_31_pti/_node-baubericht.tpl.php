<?php

if ($add_class) {
	$classes = ' ' . implode(' ', $add_class);
}


if (!$teaser) {
  $node->body = str_replace("\n\n", '<br><br>', $node->body);
	$body_length = strlen($node->body);
	$num_images = count($node->field_images);
	
	// Split text into $num_images + 1 parts
	$text_part_length = round($body_length / ($num_images + 1));
	$text_parts = array();
	$start = 0;
	for ($i = 0; $i <= $num_images; $i++) {
	  if ($i != $num_images) {
	    $end_pos = strpos($node->body, ' ', $text_part_length);
	  	$text_parts[] = substr($node->body, $start, $end_pos);
	  	$start = $end_pos;
	    $even_odd = ($even_odd == 'even-box') ? 'odd-box' : 'even-box';
	  	$text_parts[] = theme_content_image($node->field_images[$i], $even_odd, array('type' => 'lightbox', 'group' => 'baubericht'));
	  } else {
	  	$text_parts[] = substr($node->body, $start);
	  }
	}
	
	$content = implode('', $text_parts);
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
    <?php if ($teaser): ?>
    <div class="content"><?php print node_teaser($node->content['body']['#value']) ?></div>
    <?php endif;?>
    <?php if (!$teaser): ?>
    <div class="content"><p><?php print $content ?></p></div>
    <?php endif;?>
    <?php if ($links) { print $links; } ?>
  </div>
</div>