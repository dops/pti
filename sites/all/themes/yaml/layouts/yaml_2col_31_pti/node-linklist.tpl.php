<?php

if ($add_class) {
	$classes = ' ' . implode(' ', $add_class);
}

if (!$teaser) {
	$content = str_replace("\n\n", '<br><br>', $node->body);
}
//print_r($node);
$links = array();
$i = 0;
while (isset($node->field_link_title[$i])) {
	$link_list[$i] = '
    <div id="link-list-link-'.$i.'" class="link-list-link">
      <h3>'.l($node->field_link_title[$i]['value'], $node->field_link[$i]['value'], array('html' => true, 'attributes' => array('target' => '_blank'))).'</h3>
      <div id="image-link-'.$i.'">
        '.l(theme_link_list_image($node->field_images[$i], 'link-list-image-box'), $node->field_link[$i]['value'], array('html' => true, 'attributes' => array('target' => '_blank'))).'
      </div>
      <p>
        '.$node->field_link_description[$i]['value'].'
      </p>
    </div>
	';
  $i++;
}

$content = implode('', $link_list);

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
