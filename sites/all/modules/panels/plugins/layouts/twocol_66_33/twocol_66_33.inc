<?php
// $Id: twocol_66_33.inc,v 1.1 2009/09/26 12:00:00 hass Exp $

/**
 * implementation of hook_panels_layouts
 */
function panels_twocol_66_33_panels_layouts() {
  $items['twocol_66_33'] = array(
    'title' => t('2 columns 66/33'),
    'icon' => 'twocol_66_33.png',
    'theme' => 'panels_twocol_66_33',
    'theme arguments' => array('id', 'content'),
    'panels' => array(
      'left' => t('Left column'),
      'right' => t('Right column')
    ),
  );

  return $items;
}
