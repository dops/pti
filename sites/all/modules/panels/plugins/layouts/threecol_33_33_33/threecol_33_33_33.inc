<?php
// $Id: threecol_33_33_33.inc,v 1.1 2009/09/26 12:00:00 hass Exp $

/**
 * implementation of hook_panels_layouts
 */
function panels_threecol_33_33_33_panels_layouts() {
  $items['threecol_33_33_33'] = array(
    'title' => t('3 columns 33/33/33'),
    'icon' => 'threecol_33_33_33.png',
    'theme' => 'panels_threecol_33_33_33',
    'theme arguments' => array('id', 'content'),
    'panels' => array(
      'left' => t('Left column'),
      'middle' => t('Middle column'),
      'right' => t('Right column')
    ),
  );

  return $items;
}
