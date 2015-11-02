<?php
// $Id: template.php,v 3.1.0.12 2009/06/07 00:00:00 hass Exp $

/**
 * "Yet Another Multicolumn Layout" for Drupal
 *
 * (en) Central template for theme specific functions
 * (de) Zentrales Template für theme spezifische Funktionen
 *
 * @copyright       Copyright 2006-2009, Alexander Hass
 * @license         http://www.yaml-fuer-drupal.de/en/terms-of-use
 * @link            http://www.yaml-for-drupal.com
 * @package         yaml-for-drupal
 * @version         6.x-3.1.0.12
 * @lastmodified    2009-06-07
 */

/**
 * Include the central template.inc with global theme functions.
 */
include_once(realpath(dirname(__FILE__) .'/template.inc'));

/**
 * Alter some Drupal variables required by theme.
 */
function yaml_simple_preprocess_page(&$vars) {
  global $user;

  // Load the XML prolog for standard compliant browsers if caching is inactive.
  // The function page_set_cache() does not cache pages if $user->uid has a value.
  // Additional the XML prolog can only added to YAML for Drupal if a user is
  // logged into Drupal (caching inactive) or caching is globaly disabled on the site.
  if ((_browser_xml_prolog_compliant() && $user->uid) || (_browser_xml_prolog_compliant() && !(variable_get('cache', 0)))) {
    $vars['xml_prolog'] = '<?xml version="1.0" encoding="utf-8"?>' . "\n";
  }

  // Dynamic sidebar switching.
  if ($vars['layout'] == 'none') {
    $vars['body_classes'] = $vars['body_classes'] .' hideboth';
  }
  elseif ($vars['layout'] == 'left') {
    $vars['body_classes'] = $vars['body_classes'] .' hidecol2';
  }
  elseif ($vars['layout'] == 'right') {
    $vars['body_classes'] = $vars['body_classes'] .' hidecol1';
  }

  // Add YAML Theme styles
  $vars['styles'] = _yaml_simple_add_styles($vars);
}

/**
 * Alter some Drupal variables required by maintenance theme.
 */
function phptemplate_preprocess_maintenance_page(&$vars) {
  // Dynamic sidebar switching.
  $vars['body_classes'] = $vars['body_classes'] .' hideboth';

  // Add YAML Theme styles
  $vars['styles'] = _yaml_simple_add_styles($vars);
}

function _yaml_simple_add_styles($vars = array()) {

  // Theme-Settings based on css/screen/basemod.css setting.
  $yaml_layout_page_width_min = '740px';
  $yaml_layout_page_width_max = '80em';

  $base_theme_directory = $vars['directory'];
  $styles = drupal_get_css($vars['css']);

  // The styles array is complete, get the styled css and append the
  // IE Hacks. Additional this allows to dynamically add packed or other iehacks.
  $styles .= "<!--[if lte IE 7]>\n";
  $styles .= '<style type="text/css" media="all">' . "\n";
  $styles .= '@import "'. base_path() . $base_theme_directory .'/yaml/core/iehacks'. (variable_get('preprocess_css', FALSE) ? '.pack' : '') .'.css";' . "\n";
  global $language;
  if (defined('LANGUAGE_RTL') && $language->direction == LANGUAGE_RTL) {
    $styles .= '@import "'. base_path() . $base_theme_directory .'/yaml/core/iehacks-rtl'. (variable_get('preprocess_css', FALSE) ? '.pack' : '') .'.css";' . "\n";
  }
  $styles .= '@import "'. base_path() . $base_theme_directory .'/css/patches/patch_3col_standard.css";' . "\n";
  $styles .= '@import "'. base_path() . $base_theme_directory .'/css/patches/patch_nav_vlist_drupal.css";' . "\n";
  $styles .= '@import "'. base_path() . $base_theme_directory .'/css/patches/patch_drupal.css";' . "\n";
  $styles .= "</style>\n";
  $styles .= "<![endif]-->\n";

  // IE 6 settings and styles.
  $styles .= "<!--[if lte IE 6]>\n";
  $styles .= '<style type="text/css" media="all">';
  $styles .= 'img, .pngtrans { behavior: url('. base_path() . $base_theme_directory .'/images/pngfix/iepngfix.htc) }';
  $styles .= '* html .page_margins { width: '. $yaml_layout_page_width_max .'; width: expression((document.documentElement && document.documentElement.clientHeight) ? ((document.documentElement.clientWidth < '. preg_replace('/[\D]+/', '', $yaml_layout_page_width_min) .') ? "'. $yaml_layout_page_width_min .'" : ((document.documentElement.clientWidth > (80 * 16 * (parseInt(this.parentNode.currentStyle.fontSize) / 100))) ? "'. $yaml_layout_page_width_max .'" : "auto" )) : ((document.body.clientWidth < '. preg_replace('/[\D]+/', '', $yaml_layout_page_width_min) .') ? "'. $yaml_layout_page_width_min .'" : ((document.body.clientWidth > (80 * 16 * (parseInt(this.parentNode.currentStyle.fontSize) / 100))) ? "'. $yaml_layout_page_width_max .'" : "auto" )));';
  $styles .= "</style>\n";
  $styles .= "<![endif]-->\n";

  // Return themed styles.
  return $styles;
}

function yaml_simple_theme() {
  return array(
    'links_secondary' => array(
      'arguments' => array(
        'links' => NULL,
        'attributes' => array('class' => 'links'),
        'settings' => array(
          'delimiter' => ' | ',
          'leftcab' => NULL,
          'rightcab' => NULL,
        )
      ),
      'template' => 'links-secondary',
    ),
  );
}