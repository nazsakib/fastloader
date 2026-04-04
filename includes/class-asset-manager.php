<?php

if (!defined('ABSPATH')) {
    exit;
}

class FASTLOADER_Asset_Manager
{
    private static $instance = null;

    public static function get_instance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct()
    {
        add_action('add_meta_boxes', array($this, 'register_meta_box'));
        add_action('save_post', array($this, 'save_meta_box_data'));
        add_action('wp_enqueue_scripts', array($this, 'dequeue_selected_assets'), 9999);
        add_action('admin_bar_menu', array($this, 'add_scan_button'), 999);
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scanner_assets'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_scanner_assets'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_assets'));
    }

    public function enqueue_admin_assets($hook)
    {
        if ('post.php' === $hook || 'post-new.php' === $hook) {
            wp_enqueue_style('fastloader-admin-style', FASTLOADER_URL . 'assets/css/admin-style.css', array(), FASTLOADER_VERSION);
        }
    }

    public function add_scan_button($wp_admin_bar)
    {
        if (current_user_can('manage_options')) {
            $wp_admin_bar->add_node(array(
                'id' => 'fastloader-scan-assets',
                'title' => '<span class="ab-icon dashicons dashicons-search"></span>' . __('Scan Assets', 'fastloader'),
                'href' => '#',
                'meta' => array('class' => 'fastloader-scan-action')
            ));
        }
    }

    public function enqueue_scanner_assets()
    {
        if (is_admin_bar_showing() && current_user_can('manage_options')) {
            wp_enqueue_style('fastloader-admin-style', FASTLOADER_URL . 'assets/css/admin-style.css', array(), FASTLOADER_VERSION);
            wp_enqueue_script('fastloader-scanner', FASTLOADER_URL . 'assets/js/scanner.js', array('jquery'), FASTLOADER_VERSION, true);
            
            wp_localize_script('fastloader-scanner', 'fastloader_i18n', array(
                'scanning'       => esc_html__('FastLoader: Scanning DOM for assets...', 'fastloader'),
                'no_assets'      => esc_html__('No WordPress-managed assets detected. Ensure you are on the frontend.', 'fastloader'),
                'active_handles' => esc_html__('Active Asset Handles', 'fastloader'),
                'scripts'        => esc_html__('Scripts', 'fastloader'),
                'styles'         => esc_html__('Stylesheets', 'fastloader'),
                'tip'            => esc_html__('Tip: Click a handle to copy it to your clipboard.', 'fastloader'),
                'copied'         => esc_html__('✓ Copied!', 'fastloader'),
                'error_copy'     => esc_html__('FastLoader: Unable to copy', 'fastloader'),
                'admin_warning'  => esc_html__('Please navigate to the frontend of your website to scan page-specific assets.', 'fastloader'),
            ));
        }
    }

    public function register_meta_box()
    {
        add_meta_box('fastloader_manager', __('FastLoader Asset Manager', 'fastloader'), array($this, 'render_meta_box'), array('post', 'page'), 'side');
    }

    public function render_meta_box($post)
    {
        $blocked = get_post_meta($post->ID, '_fastloader_blocked_assets', true) ?: '';
        wp_nonce_field('fastloader_save_meta', 'fastloader_nonce');
        echo '<div class="fastloader-metabox-wrapper">';
        echo '<p class="description" style="margin-bottom: 10px;">' . esc_html__('Paste handles to disable (one per line):', 'fastloader') . '</p>';
        echo '<textarea id="fastloader_blocked_assets" name="fastloader_blocked" rows="6" placeholder="e.g. contact-form-7">' . esc_textarea($blocked) . '</textarea>';
        echo '<p style="font-size: 11px; color: #8c8f94; margin-top: 8px;">' . esc_html__('Use "Scan Assets" in the admin bar to find handles.', 'fastloader') . '</p>';
        echo '</div>';
    }

    public function save_meta_box_data($post_id)
    {
        if (!isset($_POST['fastloader_nonce']) || !wp_verify_nonce(sanitize_key(wp_unslash($_POST['fastloader_nonce'])), 'fastloader_save_meta')) {
            return;
        }

        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (isset($_POST['fastloader_blocked'])) {
            $sanitized_data = sanitize_textarea_field(wp_unslash($_POST['fastloader_blocked']));
            update_post_meta($post_id, '_fastloader_blocked_assets', $sanitized_data);
        }
    }

    public function dequeue_selected_assets()
    {
        if (is_admin()) {
            return;
        }

        if (!is_singular()) {
            return;
        }

        $post_id = get_the_ID();
        $blocked_data = get_post_meta($post_id, '_fastloader_blocked_assets', true);

        if (empty($blocked_data)) {
            return;
        }

        $handles = explode("\n", str_replace("\r", "", $blocked_data));
        $handles = array_map('trim', $handles);
        $handles = array_filter($handles);

        $protected = array('admin-bar', 'dashicons', 'jquery', 'jquery-core', 'jquery-migrate');

        foreach ($handles as $handle) {
            if (in_array($handle, $protected)) {
                continue;
            }

            wp_dequeue_script($handle);
            wp_deregister_script($handle);
            wp_dequeue_style($handle);
            wp_deregister_style($handle);
        }
    }
}
