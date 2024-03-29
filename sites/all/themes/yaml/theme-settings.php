<?php
// $Id: theme-settings.php,v 3.2.1.14 2011/07/10 00:00:00 hass Exp $

/**
 * "Yet Another Multicolumn Layout" for Drupal
 *
 * (en) Integration of Theme specific settings
 * (de) Integration von Theme spezifischen Einstellungen
 *
 * @copyright       Copyright 2006-2011, Alexander Hass
 * @license         http://www.yaml-fuer-drupal.de/en/terms-of-use
 * @link            http://www.yaml-for-drupal.com
 * @package         yaml-for-drupal
 * @version         6.x-3.2.1.14
 * @lastmodified    2011/07/10
 */

/**
 * Include the global theme-settings.inc.
 */
require_once(realpath(dirname(__FILE__) .'/theme-settings.inc'));

/**
 * Add theme settings configuration.
 */
function yaml_settings($saved_settings) {

  // Set the default values for theme variables.
  $defaults = array(
    'yaml_nav_primary' => 0,
    'yaml_nav_vertical' => 0,
    'yaml_layout_page_width' => 'auto',
    'yaml_layout_page_width_min' => '740px',
    'yaml_layout_page_width_max' => '80em',
    'yaml_layout_page_width_col1' => '25%',
    'yaml_layout_page_width_col2' => 'auto',
    'yaml_layout_page_width_col3' => '25%',
    'yaml_layout_page_align' => 'center',
    'yaml_layout_page_gfxborder' => 0,
    'yaml_msie_hack_pngfix' => 1,
    'yaml_msie_hack_minmaxwidth' => 1,
    'yaml_display_link_validation_xhtml' => 0,
    'yaml_display_link_validation_css' => 0,
    'yaml_display_link_license_yaml' => 1,
    'yaml_display_link_license_yamlfd' => 1,
  );

  $form = _yaml_get_themesettings_form($saved_settings, $defaults, '132');

  return $form;
}
