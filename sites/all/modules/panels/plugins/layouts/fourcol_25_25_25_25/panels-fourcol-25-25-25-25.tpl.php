<?php
// $Id: panels-fourcol-25-25-25-25.tpl.php,v 1.1 2009/09/26 12:00:00 hass Exp $
/**
 * @file
 * Template for the 4 column panel layout.
 *
 * This template provides a four column 25%-25%-25%-25% panel display layout.
 *
 * Variables:
 * - $id: An optional CSS id to use for the layout.
 * - $content: An array of content, each item in the array is keyed to one
 *   panel of the layout. This layout supports the following sections:
 *   - $content['left']: Content in the left column.
 *   - $content['left_middle']: Content in the left middle column.
 *   - $content['right_middle']: Content in the right middle column.
 *   - $content['right']: Content in the right column.
 */
?>
<!-- Subtemplate: 4 columns 25/25/25/25 -->
<div class="subcolumns" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?>>
  <div class="c25l">
    <div class="subcl">
      <!-- left content block -->
      <?php print $content['left']; ?>
    </div>
  </div>
  <div class="c25l">
    <div class="subc">
      <!-- left middle content block -->
      <?php print $content['left_middle']; ?>
    </div>
  </div>
  <div class="c25l">
    <div class="subc">
      <!-- right middle content block -->
      <?php print $content['right_middle']; ?>
    </div>
  </div>
  <div class="c25r">
    <div class="subcr">
      <!-- right content block -->
      <?php print $content['right']; ?>
    </div>
  </div>
</div>
