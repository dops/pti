<?php
// $Id: twocol_50_50.inc,v 1.1 2009/09/26 12:00:00 hass Exp $

/**
 * implementation of hook_panels_layouts
 */
function panels_twocol_50_50_panels_layouts() {
  $items['twocol_50_50'] = array(
    'title' => t('2 columns 50/50'),
    'icon' => 'twocol_50_50.png',
    'theme' => 'panels_twocol_50_50',
    'theme arguments' => array('id', 'content'),
    'panels' => array(
      'left' => t('Left column'),
      'right' => t('Right column')
    ),
  );

  return $items;
}
