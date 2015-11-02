<?php
// $Id: twocol_33_66.inc,v 1.1 2009/09/26 12:00:00 hass Exp $

/**
 * implementation of hook_panels_layouts
 */
function panels_twocol_33_66_panels_layouts() {
  $items['twocol_33_66'] = array(
    'title' => t('2 columns 33/66'),
    'icon' => 'twocol_33_66.png',
    'theme' => 'panels_twocol_33_66',
    'theme arguments' => array('id', 'content'),
    'panels' => array(
      'left' => t('Left column'),
      'right' => t('Right column')
    ),
  );

  return $items;
}
