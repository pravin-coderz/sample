<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              test.com
 * @since             1.0.0
 * @package           Apple_Sample
 *
 * @wordpress-plugin
 * Plugin Name:       Apple
 * Plugin URI:        appleplugin.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            test
 * Author URI:        test.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       apple-sample
 * Domain Path:       /languages
 */

add_action( 'init', 'github_plugin_updater_test_init' );
function github_plugin_updater_test_init() {

	include_once 'updater.php';

	define( 'WP_GITHUB_FORCE_UPDATE', true );

	if ( is_admin() ) { // note the use of is_admin() to double check that this is happening in the admin

		$config = array(
			'slug' => plugin_basename( __FILE__ ),
			'proper_folder_name' => 'github-updater',
			'api_url' => 'https://api.github.com/repos/pravinmbf/sample',
			'raw_url' => 'https://raw.github.com/pravinmbf/sample/master',
			'github_url' => 'https://github.com/pravinmbf/sample',
			'zip_url' => 'https://github.com/pravinmbf/sample/archive/master.zip',
			'sslverify' => true,
			'requires' => '3.0',
			'tested' => '3.3',
			'readme' => 'README.md',
			'access_token' => '',
		);

		new WP_GitHub_Updater( $config );

	}

}


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'APPLE_SAMPLE_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-apple-sample-activator.php
 */
function activate_apple_sample() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-apple-sample-activator.php';
	Apple_Sample_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-apple-sample-deactivator.php
 */
function deactivate_apple_sample() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-apple-sample-deactivator.php';
	Apple_Sample_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_apple_sample' );
register_deactivation_hook( __FILE__, 'deactivate_apple_sample' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-apple-sample.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_apple_sample() {

	$plugin = new Apple_Sample();
	$plugin->run();

}
run_apple_sample();
