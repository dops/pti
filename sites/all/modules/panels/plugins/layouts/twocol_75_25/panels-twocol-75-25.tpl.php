<?php
// $Id: panels-twocol-75-25.tpl.php,v 1.1 2009/09/26 12:00:00 hass Exp $
/**
 * @file
 * Template for the 2 column panel layout.
 *
 * This template provides a two column 75%-25% panel display layout.
 *
 * Variables:
 * - $id: An optional CSS id to use for the layout.
 * - $content: An array of content, each item in the array is keyed to one
 *   panel of the layout. This layout supports the following sections:
 *   - $content['left']: Content in the left column.
 *   - $content['right']: Content in the right column.
 */
?>
<!-- Subtemplate: 2 columns 75/25 -->
<div class="subcolumns" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?>>
  <div class="c75l">
    <div class="subcl">
      <!-- left content block -->
      <?php print $content['left']; ?>
    </div>
  </div>
  <div class="c25r">
    <div class="subcr">
      <!-- right content block -->
      <?php print $content['right']; ?>
    </div>
  </div>
</div>
