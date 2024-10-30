<?php

/**
 *
 * @link              http://copitosystem.com
 * @since             1.0.0
 * @package           Copito_Comments
 *
 * @wordpress-plugin
 * Plugin Name:       Copito Comments
 * Plugin URI:        
 * Description:       Allows you to add comments manually. Useful to migrate comments from a Facebook Fan Page to your website.
 * Version:           1.1.0
 * Author:            Cosme12
 * Author URI:        http://copitosystem.com/about-us/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       copito-comments
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'COPITO_COMMENTS_VERSION', '1.1.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-copito-comments-activator.php
 */
function activate_copito_comments() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-copito-comments-activator.php';
	Copito_Comments_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-copito-comments-deactivator.php
 */
function deactivate_copito_comments() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-copito-comments-deactivator.php';
	Copito_Comments_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_copito_comments' );
register_deactivation_hook( __FILE__, 'deactivate_copito_comments' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-copito-comments.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_copito_comments() {

	$plugin = new Copito_Comments();
	$plugin->run();

}


run_copito_comments();
