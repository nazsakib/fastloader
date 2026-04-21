<?php
/**
 * Plugin Name:       Smart Asset Optimizer for Fast Loading
 * Plugin URI:        https://wpfastloader.vercel.app/
 * Description:       Disable specific plugin scripts and styles on a per-page basis to boost speed. Surgical asset management for better Core Web Vitals.
 * Version:           1.0.0
 * Author:            Sakib MD Nazmush
 * Author URI:        https://sakibnazmush.vercel.app/
 * License:           GPLv2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       smart-asset-optimizer-for-fast-loading
 * Requires at least: 6.0
 * Tested up to:     6.9
 * Requires PHP:      7.4
 */

if (!defined('ABSPATH')) {
    exit;
}

define('SAO_FL_PATH', plugin_dir_path(__FILE__));
define('SAO_FL_URL', plugin_dir_url(__FILE__));
define('SAO_FL_VERSION', '1.0.0');

if (file_exists(SAO_FL_PATH . 'includes/class-asset-manager.php')) {
    require_once SAO_FL_PATH . 'includes/class-asset-manager.php';
}

add_action('plugins_loaded', array('SAO_FL_Asset_Manager', 'get_instance'));
