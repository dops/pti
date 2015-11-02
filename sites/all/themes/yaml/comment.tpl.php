<?php
// $Id: comment.tpl.php,v 3.2.1.14 2011/07/10 00:00:00 hass Exp $
?>
<div class="comment<?php print ($comment->new) ? ' comment-new' : ''; print ($comment->status == COMMENT_NOT_PUBLISHED) ? ' comment-unpublished' : ''; ?>">
  <div class="clearfix">
  <?php if ($comment->new) : ?>
    <a id="new"></a>
    <span class="new"><?php print $new ?></span>
  <?php endif; ?>
    <?php print $picture ?>
    <h3><?php print $title ?></h3>
    <div class="submitted"><?php print $submitted ?></div>
    <div class="content">
      <?php print $content ?>
      <?php if ($signature): ?>
      <div class="user-signature clearfix">
        <?php print $signature ?>
      </div>
      <?php endif; ?>
    </div>
  </div>
  <?php print $links ?>
</div>
