<?php
// $Id: twocol_75_25.inc,v 1.1 2009/09/26 12:00:00 hass Exp $

/**
 * implementation of hook_panels_layouts
 */
function panels_twocol_75_25_panels_layouts() {
  $items['twocol_75_25'] = array(
    'title' => t('2 columns 75/25'),
    'icon' => 'twocol_75_25.png',
    'theme' => 'panels_twocol_75_25',
    'theme arguments' => array('id', 'content'),
    'panels' => array(
      'left' => t('Left column'),
      'right' => t('Right column')
    ),
  );

  return $items;
}
