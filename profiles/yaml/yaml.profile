<?php
// $Id: yaml.profile, 6.x-1.2 2009/12/05 00:00:00 hass Exp $

/**
 * The modules that are enabled when this profile is installed.
 *
 * @return
 *   An array of modules to be enabled.
 */
function yaml_profile_modules() {
  $core_optional = array('comment', 'help', 'menu', 'taxonomy', 'dblog');
  return $core_optional;
}

/**
 * Implementation of hook_profile_details().
 *
 * This contains an array of profile details for display from the main selection screen.
 */
function yaml_profile_details() {
  return array(
    'name' => 'YAML for Drupal',
    'description' => '"Yet Another Multicolumn Layout" is a (X)HTML/CSS Framework to create modern, flexible and accessible CSS layouts.'
  );
}

/**
 * Return a list of tasks that this profile supports.
 *
 * @return
 *   A keyed array of tasks the profile will perform during
 *   the final stage. The keys of the array will be used internally,
 *   while the values will be displayed to the user in the installer
 *   task list.
 */
function yaml_profile_task_list() {
}

/**
 * Perform any final installation tasks for this profile.
 *
 * The installer goes through the configure -> locale-import ->
 * locale-batch -> finished -> done tasks in this order, if you
 * don't implement this function in your profile.
 *
 * If this function is implemented, you can have any number of
 * custom tasks to perform, implementing a state machine here to
 * walk the user through those tasks, by setting $task to something
 * other then the reserved tasks listed in install_reserved_tasks()
 * and the 'profile' task this function gets called with for first
 * time. If you implement your custom tasks, this function will get called
 * in every HTTP request (for form processing, printing your
 * information screens and so on) until you advance to the
 * 'locale-import' task, with which you hand control back to the
 * installer.
 *
 * You should define the list of custom tasks you implement by
 * returning an array of them in hook_profile_task_list().
 *
 * Should a profile want to display a form here, it can; it should set
 * the task using variable_set('install_task', 'new_task') and use
 * the form technique used in install_tasks() rather than using
 * drupal_get_form().
 *
 * @param $task
 *   The current $task of the install system. When hook_profile_tasks()
 *   is first called, this is 'profile'.
 *
 * @return
 *   An optional HTML string to display to the user. Only used if you
 *   modify the $task, otherwise discarded.
 */
function yaml_profile_tasks() {

  // Insert default user-defined node types into the database. For a complete
  // list of available node type attributes, refer to the node type API
  // documentation at: http://api.drupal.org/api/HEAD/function/hook_node_info.
  $types = array(
    array(
      'type' => 'page',
      'name' => st('Page'),
      'module' => 'node',
      'description' => st("A <em>page</em>, similar in form to a <em>story</em>, is a simple method for creating and displaying information that rarely changes, such as an \"About us\" section of a website. By default, a <em>page</em> entry does not allow visitor comments and is not featured on the site's initial home page."),
      'custom' => TRUE,
      'modified' => TRUE,
      'locked' => FALSE,
      'help' => '',
      'min_word_count' => '',
    ),
    array(
      'type' => 'story',
      'name' => st('Story'),
      'module' => 'node',
      'description' => st("A <em>story</em>, similar in form to a <em>page</em>, is ideal for creating and displaying content that informs or engages website visitors. Press releases, site announcements, and informal blog-like entries may all be created with a <em>story</em> entry. By default, a <em>story</em> entry is automatically featured on the site's initial home page, and provides the ability to post comments."),
      'custom' => TRUE,
      'modified' => TRUE,
      'locked' => FALSE,
      'help' => '',
      'min_word_count' => '',
    ),
  );

  foreach ($types as $type) {
    $type = (object) _node_type_set_defaults($type);
    node_type_save($type);
  }

  // Default page to not be promoted and have comments disabled.
  variable_set('node_options_page', array('status'));
  variable_set('node_options_story', array('status'));
  variable_set('comment_page', COMMENT_NODE_DISABLED);
  //variable_set('comment_story', COMMENT_NODE_DISABLED);

  // Don't display date and author information for page nodes by default.
  $theme_settings = variable_get('theme_settings', array());
  $theme_settings['default_logo'] = 1;
  $theme_settings['logo_path'] = '';
  $theme_settings['toggle_name'] = 1;
  $theme_settings['toggle_slogan'] = 0;
  $theme_settings['toggle_mission'] = '';
  $theme_settings['toggle_primary_links'] = 1;
  $theme_settings['toggle_secondary_links'] = 1;
  $theme_settings['toggle_node_user_picture'] = 0;
  $theme_settings['toggle_comment_user_picture'] = 0;
  $theme_settings['toggle_search'] = 1;
  //$theme_settings['toggle_node_info_page'] = FALSE;
  //$theme_settings['toggle_node_info_story'] = FALSE;
  variable_set('theme_settings', $theme_settings);

  /** CONFIGURATION SETTINGS **/

  // Turn on user pictures
  variable_set('user_pictures', 1);

  /** DEFAULT CONTENT TYPE SETTINGS **/

  // File: disabled / enable attachments
  variable_set('upload_page', 0);
  variable_set('upload_story', 0);

  /** ROLES AND PERMISSIONS **/

  // Create administrator group / Multisite installation with shared role table require role exists check.
  $res = db_fetch_object(db_query("SELECT * FROM {role} WHERE name = '%s'", 'administrator'));
  if (!$res) {
    db_query("INSERT INTO {role} (name) VALUES ('%s')", 'administrator');
  }

  // Configure default permissions for each role
  // TODO: extend settings
  db_query("UPDATE {permission} SET perm = '%s' WHERE rid = %d", 'access content', 1);
  db_query("UPDATE {permission} SET perm = '%s' WHERE rid = %d", 'access comments, post comments, post comments without approval, access content', 2);
  db_query("INSERT INTO {permission} (rid, perm, tid) VALUES (%d, '%s', %d)", 3, 'administer blocks, use PHP for block visibility, access comments, administer comments, post comments, post comments without approval, administer filters, administer menu, access content, administer content types, administer nodes, create page content, create story content, delete any page content, delete any story content, delete own page content, delete own story content, delete revisions, edit any page content, edit any story content, edit own page content, edit own story content, revert revisions, view revisions, access administration pages, access site reports, administer actions, administer files, administer site configuration, select different theme, administer taxonomy, access user profiles, administer permissions, administer users, change own username', 0);

  /** THEME SETUP **/

  // Enable default theme
  system_theme_data();
  system_initialize_theme_blocks('yaml');
  db_query("UPDATE {system} SET status = %d WHERE type = '%s'", 0, 'theme');
  db_query("UPDATE {system} SET status = %d WHERE type = '%s' AND name = '%s'", 1, 'theme', 'yaml');
  variable_set('theme_default', 'yaml');
  variable_set('admin_theme', 'yaml');

  // Init default theme blocks
  system_initialize_theme_blocks('yaml_2col_13');
  system_initialize_theme_blocks('yaml_2col_31');
  system_initialize_theme_blocks('yaml_3col_standard');
  system_initialize_theme_blocks('yaml_3col_subcol');

  // Correct wrong region init
  db_query("UPDATE {blocks} SET region = '%s' WHERE module = '%s' AND theme = '%s' AND delta IN (0, 1)", 'right', 'user', 'yaml_2col_31');

  /** BLOCK CONFIGURATION **/

  // Hide normal user login block
  //db_query("UPDATE {blocks} SET status = 0 WHERE module = 'user' AND delta = 0");

  // Move navigation block down
  //db_query("UPDATE {blocks} SET weight = 1 WHERE module = 'user' AND delta = 1");

  /** MODULE SETUP **/

	/** LANGUAGE DEPENDENT SETUP **/
  // If you know more language dependent configs please tell me, i will add them.

  global $install_locale;
  if ($install_locale == 'de') {
    // Website in German: week starts on monday, German dateformat, timezone GMT +0100
    variable_set('configurable_timezones', '1');
    variable_set('date_default_timezone', '3600');
    variable_set('date_first_day', '1');
    variable_set('date_format_long', 'l, j. F Y - G:i');
    variable_set('date_format_medium', 'j. F Y - G:i');
    variable_set('date_format_short', 'd.m.Y - H:i');
  }

  // Update the menu router information.
  menu_rebuild();
}

/**
 * Implementation of hook_form_alter().
 *
 * Allows the profile to alter the site-configuration form. This is
 * called through custom invocation, so $form_state is not populated.
 */
function yaml_form_alter(&$form, $form_state, $form_id) {
  if ($form_id == 'install_configure') {
    // Set default for site name field.
    $form['site_information']['site_name']['#default_value'] = $_SERVER['SERVER_NAME'];
  }
}
