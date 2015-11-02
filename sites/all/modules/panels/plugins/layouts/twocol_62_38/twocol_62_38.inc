<?php
// $Id: twocol_62_38.inc,v 1.1 2009/09/26 12:00:00 hass Exp $

/**
 * implementation of hook_panels_layouts
 */
function panels_twocol_62_38_panels_layouts() {
  $items['twocol_62_38'] = array(
    'title' => t('2 columns 62/38'),
    'icon' => 'twocol_62_38.png',
    'theme' => 'panels_twocol_62_38',
    'panels' => array(
      'left' => t('Left column'),
      'right' => t('Right column')
    ),
  );

  return $items;
}
