<?php
/**
 * Plugin Name:       FastLoader
 * Plugin URI:        https://wpfastloader.vercel.app/
 * Description:       Disable specific plugin scripts and styles on a per-page basis to boost speed. Surgical asset management for better Core Web Vitals.
 * Version:           1.0.0
 * Author:            Sakib MD Nazmush
 * Author URI:        https://sakibnazmush.vercel.app/
 * License:           GPLv2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       fastloader
 * Requires at least: 6.0
 * Requires PHP:      7.4
 */

if (!defined('ABSPATH')) {
    exit;
}

define('FASTLOADER_PATH', plugin_dir_path(__FILE__));
define('FASTLOADER_URL', plugin_dir_url(__FILE__));
define('FASTLOADER_VERSION', '1.0.0');

if (file_exists(FASTLOADER_PATH . 'includes/class-asset-manager.php')) {
    require_once FASTLOADER_PATH . 'includes/class-asset-manager.php';
}

add_action('plugins_loaded', array('FASTLOADER_Asset_Manager', 'get_instance'));
