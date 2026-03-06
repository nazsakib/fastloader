<?php
/**
 * Plugin Name:       FastLoader
 * Plugin URI:        https://profiles.wordpress.org/sakibsnaz/
 * Description:       Disable specific plugin scripts and styles on a per-page basis to boost speed. Surgical asset management for better Core Web Vitals.
 * Version:           1.0.0
 * Author:            Sakib MD Nazmush
 * Author URI:        https://profiles.wordpress.org/sakibsnaz/
 * License:           GPLv2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       fastloader
 * Requires at least: 6.0
 * Requires PHP:      7.4
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Define constants for paths.
 * Using FASTLOADER_ prefix to follow WordPress naming standards.
 */
define('FASTLOADER_PATH', plugin_dir_path(__FILE__));
define('FASTLOADER_VERSION', '1.0.0');

/**
 * Load the main class.
 * The file should be located in /includes/class-asset-manager.php
 */
if (file_exists(FASTLOADER_PATH . 'includes/class-asset-manager.php')) {
    require_once FASTLOADER_PATH . 'includes/class-asset-manager.php';
}

/**
 * Initialize the plugin.
 * We use the 'plugins_loaded' hook to ensure WordPress core and 
 * other plugins are ready before our manager starts.
 */
add_action('plugins_loaded', array('FASTLOADER_Asset_Manager', 'get_instance'));