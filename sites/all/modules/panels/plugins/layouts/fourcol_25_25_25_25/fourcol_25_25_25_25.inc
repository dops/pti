<?php
// $Id: fourcol_25_25_25_25.inc,v 1.1 2009/09/26 12:00:00 hass Exp $

/**
 * implementation of hook_panels_layouts
 */
function panels_fourcol_25_25_25_25_panels_layouts() {
  $items['fourcol_25_25_25_25'] = array(
    'title' => t('4 columns 25/25/25/25'),
    'icon' => 'fourcol_25_25_25_25.png',
    'theme' => 'panels_fourcol_25_25_25_25',
    'theme arguments' => array('id', 'content'),
    'panels' => array(
      'left' => t('Left column'),
      'left_middle' => t('Left middle column'),
      'right_middle' => t('Right middle column'),
      'right' => t('Right column')
    ),
  );

  return $items;
}
