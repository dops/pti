<?php
// $Id: twocol_38_62.inc,v 1.1 2009/09/26 12:00:00 hass Exp $

/**
 * implementation of hook_panels_layouts
 */
function panels_twocol_38_62_panels_layouts() {
  $items['twocol_38_62'] = array(
    'title' => t('2 columns 38/62'),
    'icon' => 'twocol_38_62.png',
    'theme' => 'panels_twocol_38_62',
    'theme arguments' => array('id', 'content'),
    'panels' => array(
      'left' => t('Left column'),
      'right' => t('Right column')
    ),
  );

  return $items;
}
