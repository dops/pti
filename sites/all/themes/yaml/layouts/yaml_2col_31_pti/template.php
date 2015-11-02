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
include_once(realpath(dirname(__FILE__) .'/../../template.inc'));

/**
 * Theme CSS files
 *
 * Workaround for CSS aggregate and compress feature in Drupal 6.x.
 */
function _yaml_2col_31_pti_add_css($vars = array()) {

  global $theme;
  $base_theme_directory = str_replace('/layouts/'. $theme, '', $vars['directory']);

  // Add core and layout specific styles
  drupal_add_css($base_theme_directory .'/yaml/core/base.css', 'theme');
  drupal_add_css($base_theme_directory .'/css/screen/basemod.css', 'theme');
  drupal_add_css($base_theme_directory .'/css/screen/basemod_2col_31.css', 'theme');
  drupal_add_css($base_theme_directory .'/css/screen/basemod_drupal.css', 'theme');
  
  if (theme_get_setting('yaml_layout_page_gfxborder')) {
    drupal_add_css($base_theme_directory .'/css/screen/basemod_gfxborder.css', 'theme');
  }

  // Add horizontal navigations
  $yaml_nav_primary = theme_get_setting('yaml_nav_primary');
  if ($yaml_nav_primary == 1) {
    drupal_add_css($base_theme_directory .'/css/navigation/nav_shinybuttons.css', 'theme');
  }
  else {
    drupal_add_css($base_theme_directory .'/css/navigation/nav_slidingdoor.css', 'theme');
  }

  // Add vertical navigations
  $yaml_nav_vertical = theme_get_setting('yaml_nav_vertical');
  if ($yaml_nav_vertical == 1) {
    // there are currently no additional navigations available, add here if you create your own.
  }
  else {
    drupal_add_css($base_theme_directory .'/css/navigation/nav_vlist_drupal.css', 'theme');
  }

  // Add content CSS files
  drupal_add_css($base_theme_directory .'/css/screen/content.css', 'theme');

  // Add custom module styles
  _yaml_add_css_modules($base_theme_directory);
  
  // Add custom theme styles
  drupal_add_css($base_theme_directory .'/css/screen/pti.css', 'theme');

  // Add print CSS files
  drupal_add_css($base_theme_directory .'/yaml/core/print_base.css', 'theme');
  drupal_add_css($base_theme_directory .'/css/print/print_003.css', 'theme');
  drupal_add_css($base_theme_directory .'/css/print/print_drupal.css', 'theme');

  // Remove the style.css added as first array item and move it to the end
  // of the styles array. This allows to use themes style.css and keep
  // the required CSS cascading order intact for CSS overriding.
  $css = drupal_add_css();
  if (isset($css['all']['theme'][$vars['directory'] .'/style.css'])) {
    unset($css['all']['theme'][$vars['directory'] .'/style.css']);
    $css['all']['theme'][$vars['directory'] .'/style.css'] = TRUE;
  }
  if (isset($css['all']['theme'][$vars['directory'] .'/style-rtl.css'])) {
    unset($css['all']['theme'][$vars['directory'] .'/style-rtl.css']);
    $css['all']['theme'][$vars['directory'] .'/style-rtl.css'] = TRUE;
  }

  // Return CSS array
  return $css;
}

function _yaml_2col_31_pti_add_styles($vars = array()) {

  global $theme, $language;
  $base_theme_directory = str_replace('/layouts/'. $theme, '', $vars['directory']);
  $styles = drupal_get_css($vars['css']);

  // Page settings
  $styles .= _yaml_get_css_themesettings('31');

  // The styles array is complete, get the styled css and append the
  // IE Hacks. Additional this allows to dynamically add packed or other iehacks.
  $styles .= "<!--[if lte IE 7]>\n";
  $styles .= '<style type="text/css" media="all">' . "\n";
  $styles .= '@import "'. base_path() . $base_theme_directory .'/yaml/core/iehacks'. (variable_get('preprocess_css', FALSE) ? '.pack' : '') .'.css";' . "\n";
  if (defined('LANGUAGE_RTL') && $language->direction == LANGUAGE_RTL) {
    $styles .= '@import "'. base_path() . $base_theme_directory .'/yaml/core/iehacks-rtl'. (variable_get('preprocess_css', FALSE) ? '.pack' : '') .'.css";' . "\n";
  }
  $styles .= '@import "'. base_path() . $base_theme_directory .'/css/patches/patch_nav_vlist_drupal.css";' . "\n";
  $styles .= '@import "'. base_path() . $base_theme_directory .'/css/patches/patch_2col_31.css";' . "\n";
  $styles .= '@import "'. base_path() . $base_theme_directory .'/css/patches/patch_drupal.css";' . "\n";
  
  $styles .= '@import "'. base_path() . $base_theme_directory .'/css/screen/pti-ie-fix.css";' . "\n";

  // IE page settings.
  $styles_ie = _yaml_get_css_ie_themesettings('31');
  if (!empty($styles_ie)) {
    $styles .= $styles_ie . "\n";
  }
  $styles .= "</style>\n";
  $styles .= "<![endif]-->\n";

  // IE 6 settings and styles.
  $styles_ie6 = _yaml_get_css_ie6_themesettings('31', $base_theme_directory);
  if (!empty($styles_ie6)) {
    $styles .= "<!--[if lte IE 6]>\n";
    $styles .= '<style type="text/css" media="all">'. $styles_ie6 ."</style>\n";
    $styles .= "<![endif]-->\n";
  }

  // Return themed styles.
  return $styles;
}

/*
 * There is currently no .install support available for themes and the
 * following is a workaround to initialize new theme settings.
 * 
 * - 'yaml_layout_page_width_col3' may set to base theme's value.
 * - 'yaml_layout_page_width' is a new setting in 6.x-3.0.6.9
 */
function _yaml_2col_31_pti_theme_settings_install($theme) {
  if (is_null(theme_get_setting('yaml_layout_page_width')) || theme_get_setting('yaml_layout_page_width_col3') !== 'auto') {

    // Save default theme settings.
    $defaults = array(
      'yaml_nav_primary' => 0,
      'yaml_nav_vertical' => 0,
      'yaml_layout_page_width' => 'auto',
      'yaml_layout_page_width_min' => '740px',
      'yaml_layout_page_width_max' => '80em',
      'yaml_layout_page_width_col1' => '25%',
      'yaml_layout_page_width_col3' => 'auto',
      'yaml_layout_page_align' => 'center',
      'yaml_layout_page_gfxborder' => 0,
      'yaml_msie_hack_pngfix' => 1,
      'yaml_msie_hack_minmaxwidth' => 1,
      'yaml_debug' => 0,
      'yaml_display_link_validation_xhtml' => 0,
      'yaml_display_link_validation_css' => 0,
      'yaml_display_link_license_yaml' => 1,
      'yaml_display_link_license_yamlfd' => 1,
    );

    $merged_settings = array_merge($defaults, theme_get_settings($theme));

    // Upgrade 'yaml_2col_31_pti' from 6.x-3.0.6.10 to 6.x-3.0.6.11.
    if (theme_get_setting('yaml_layout_page_width_col3') != 'auto') {
      $merged_settings['yaml_layout_page_width_col3'] = 'auto';
    }

    variable_set(
      str_replace('/', '_', 'theme_'. $theme .'_settings'),
      $merged_settings
    );
    
    // Set image placeholder within text
    variable_set('image_placeholder', '[BILD]');

    // Force refresh of Drupal internals.
    theme_get_setting('', TRUE);
  }
}

/**
 * Themes a teaser image with a link to the coresponding node.
 *
 * @param stdclass $node The node with contains the teaser image.
 * @return Image HTML.
 */
function theme_teaser_img_link($node) {
  $img_file_path = $node->field_teaser_image[0]['filepath'];
  if (!empty($img_file_path)) {
  	$img_alt_tag = $node->field_teaser_image[0]['alt'];
    $img_title_tag = $node->field_teaser_image[0]['title'];
    $teaser_img = theme('imagecache', 'teaser-small-160', $img_file_path, $img_alt_tag, $img_title_tag);
    $teaser_img_link = l($teaser_img, $node->path, array('attributes' => array('class' => 'teaser-image'), 'html' => true));
  }
  return '<div class="teaser-image-link-box">' . $teaser_img_link . '</div>';
}

/**
 * Themes an image to place it into content float-text.
 *
 * @param array $img The image to be placed inside the content.
 * @param string $class The direction to float the image within the content.
 * @return string Image HTML.
 */
function theme_content_image($img, $class = '', $lightbox_options = false) {
  if (!empty($img['filepath'])) {
    if (isset($lightbox_options)) {
      $rel = ($lightbox_options['group']) ? $lightbox_options['type'] . '[' . $lightbox_options['group'] . ']' : $lightbox_options['type'];
    	$teaser_img = l(theme('imagecache', 'teaser-small-160', $img['filepath'], $img['data']['alt'], $img['data']['title']), imagecache_create_url('medium-view-800', $img['filepath']), array('attributes' => array('rel' => $rel), 'html' => true));
    } else {
      $teaser_img = theme('imagecache', 'teaser-small-160', $img['filepath'], $img['data']['alt'], $img['data']['title']);
    }
  }
  return '<span class="content-image-box ' . $class . '">' . $teaser_img . '<br><span class="image-description">' . $img['data']['description'] . '</span></span>';
}


function theme_link_list_image($img, $class = '') {
  $teaser_img = theme('imagecache', 'link-list-image', $img['filepath'], $img['data']['alt'], $img['data']['title']);
  return '<span class="content-image-box ' . $class . '">' . $teaser_img . '</span>';
}


function theme_content_video($video, $class = '', $lightbox_options = false) {
  $player = theme('emvideo_lightbox2', content_fields('field_videos', 'videogalerie'), $video, null, null);
  return '<span class="content-image-box ' . $class . '">' . $player . '<br><span class="image-description">' . $video->data['description'] . '</span></span>';
}


function yaml_2col_31_pti_preprocess_page(&$vars) {
  drupal_add_js(drupal_get_path('theme', 'yaml_2col_31_pti') . '/javascript/jquery/jquery.marquee.js', 'theme');
  
  $vars['mission'] = variable_get('site_mission', '');
  if (isset($vars['node'])) {
  	$vars['template_files'][] = 'page-' . str_replace('-', '-', $vars['node']->type);
  }
  
  // Auf Taxonomie basierenden Breadcrumb erzeugen.
  if ($vars['node']->taxonomy) {
  	$term = current($vars['node']->taxonomy);
    $allParentTerms = taxonomy_get_parents_all($term->tid);
    
    $breadcrumbLinks = array();
    foreach ($allParentTerms as $parentTerm) {
    	$breadcrumbLinks[] = l($parentTerm->name, taxonomy_term_path($parentTerm));
    }
  }
  
  // Breadcrumb für Bauberichte setzen
  if ($vars['node']->type == 'baubericht') {
  	$breadcrumbLinks = array();
  	$breadcrumbLinks[] = l('Bauberichte', 'bauberichte');
  }
  
  if ($breadcrumbLinks) {
    $breadcrumbLinks[] = l('Startseite', '<front>');
  	$breadcrumbLinks = array_reverse($breadcrumbLinks);
    $breadcrumb = theme('breadcrumb', $breadcrumbLinks);
    $vars['breadcrumb'] = $breadcrumb;
  }
  
  // Rechte Sidebar im Forum ausblenden
  if (array_search('page-forum', $vars['template_files']) !== false) {
  	$vars['right'] = null;
  }
  
  $vars['scripts'] = drupal_get_js();
}

function yaml_2col_31_pti_preprocess_node(&$vars) {
//  print_r($vars);
  if ($vars['node']->teaser) {
  	$vars['add_class'][] = 'node-teaser';
  }
  
  $vars['teaser_img_link'] = theme_teaser_img_link($vars['node']);
}

/**
* Custom taxonomy term page rendering to add a list of clickable sub-topics if the current topic has children
*/
function yaml_2col_31_pti_taxonomy_term_page($tids, $result) {
  drupal_add_css(drupal_get_path('module', 'taxonomy') .'/taxonomy.css');
  
  $output = '';
  
  // Only display the description if we have a single term, to avoid clutter and confusion.
  if (count($tids) == 1) {
    $term = taxonomy_get_term($tids[0]);
    $children = taxonomy_get_children($tids[0]);
    $description = $term->description;
    
    // Check that a description is set.
    if (!empty($description) || sizeof($children) > 0) {
      $output .= '<div class="taxonomy-details-wrapper">';
      $is_wrapped = true;
    } else {
      $is_wrapped = false;
    }
    if (!empty($description)) {
      $output .= '<div class="taxonomy-term-description">';
      $output .= filter_xss_admin($description);
      $output .= '</div>';
    }
    if (sizeof($children) > 0) {
      $output .= '<div class="sub-topic-list"><ul class="sub-topics inline">';
      foreach($children as $child) {
        $output .= '<li>' . l($child->name, taxonomy_term_path($child)) . '</li>';
      }
      $output .= '</ul></div>';
    }
    if ($is_wrapped) {
      $output .= '</div><div style="clear: both;"></div>';
    }
  }
  
  $output .= taxonomy_render_nodes($result);
  return $output;
}

/**
 * Die Standard-"Add node"-Liste wird überschrieben, um den Hinweis das der neue Node erst innerhalb der nächsten 24 Stunden vergeschaltet wird
 * einzublenden.
 *
 * @param array $content
 * @return string
 */
function yaml_2col_31_pti_node_add_list($content) {
  $output = '';

  if ($content) {
    $output = '<dl class="node-type-list">';
    foreach ($content as $item) {
      $output .= '<dt>'. l($item['title'], $item['href'], $item['localized_options']) .'</dt>';      
      $output .= '<dd>'. filter_xss_admin($item['description']) .'</dd>';
    }
    $output .= '</dl>';
  }
  
  $output .= '<p>' . t('<b>Achtung:</b> Ihr Beitrag ist zunächst nur für Sie sichbar, und wird erst vom Administrstor oder einem Moderator geprüft. Die Freischaltung Ihres Beitrages erfolgd jedoch in der Regel binnen 24 Stunden.') . '</p>';
  
  return $output;
}


function insertContentImages($content, $images) {
	$text_parts_old       = explode(variable_get('image_placeholder', '[BILD]'), $content);
	$num_text_parts       = count($text_parts_old);
	$num_images_to_insert = count($text_parts_old) - 1;
	
	$text_parts_new = array();
	for ($i = 0; $i < $num_text_parts; $i++) {
		if (isset($images[$i])) {
			$even_odd         = ($even_odd == 'odd-box') ? 'even-box' : 'odd-box';
			$text_parts_new[] = $text_parts_old[$i];
			$text_parts_new[] = theme_content_image($images[$i], $even_odd, array('type' => 'lightbox', 'group' => 'baubericht'));
		}
		else {
			$text_parts_new[] = $text_parts_old[$i];
		}
	}
	
	return implode('', $text_parts_new);
}