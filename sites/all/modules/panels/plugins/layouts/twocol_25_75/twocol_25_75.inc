<?php
// $Id: twocol_25_75.inc,v 1.1 2009/09/26 12:00:00 hass Exp $

/**
 * implementation of hook_panels_layouts
 */
function panels_twocol_25_75_panels_layouts() {
  $items['twocol_25_75'] = array(
    'title' => t('2 columns 25/75'),
    'icon' => 'twocol_25_75.png',
    'theme' => 'panels_twocol_25_75',
    'theme arguments' => array('id', 'content'),
    'panels' => array(
      'left' => t('Left column'),
      'right' => t('Right column')
    ),
  );

  return $items;
}
