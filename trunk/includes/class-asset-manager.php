<?php

if (!defined('ABSPATH')) {
    exit;
}

class SAO_FL_Asset_Manager
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
            wp_enqueue_style('sao-fl-admin-style', SAO_FL_URL . 'assets/css/admin-style.css', array(), SAO_FL_VERSION);
        }
    }

    public function add_scan_button($wp_admin_bar)
    {
        if (current_user_can('manage_options')) {
            $wp_admin_bar->add_node(array(
                'id' => 'sao-fl-scan-assets',
                'title' => '<span class="ab-icon dashicons dashicons-search"></span>' . __('Scan Assets', 'smart-asset-optimizer-for-fast-loading'),
                'href' => '#',
                'meta' => array('class' => 'sao-fl-scan-action')
            ));
        }
    }

    public function enqueue_scanner_assets()
    {
        if (is_admin_bar_showing() && current_user_can('manage_options')) {
            wp_enqueue_style('sao-fl-admin-style', SAO_FL_URL . 'assets/css/admin-style.css', array(), SAO_FL_VERSION);
            wp_enqueue_script('sao-fl-scanner', SAO_FL_URL . 'assets/js/scanner.js', array('jquery'), SAO_FL_VERSION, true);
            
            wp_localize_script('sao-fl-scanner', 'sao_fl_i18n', array(
                'scanning'       => esc_html__('Smart Asset Optimizer: Scanning DOM for assets...', 'smart-asset-optimizer-for-fast-loading'),
                'no_assets'      => esc_html__('No WordPress-managed assets detected. Ensure you are on the frontend.', 'smart-asset-optimizer-for-fast-loading'),
                'active_handles' => esc_html__('Active Asset Handles', 'smart-asset-optimizer-for-fast-loading'),
                'scripts'        => esc_html__('Scripts', 'smart-asset-optimizer-for-fast-loading'),
                'styles'         => esc_html__('Stylesheets', 'smart-asset-optimizer-for-fast-loading'),
                'tip'            => esc_html__('Tip: Click a handle to copy it to your clipboard.', 'smart-asset-optimizer-for-fast-loading'),
                'copied'         => esc_html__('✓ Copied!', 'smart-asset-optimizer-for-fast-loading'),
                'error_copy'     => esc_html__('Smart Asset Optimizer: Unable to copy', 'smart-asset-optimizer-for-fast-loading'),
                'admin_warning'  => esc_html__('Please navigate to the frontend of your website to scan page-specific assets.', 'smart-asset-optimizer-for-fast-loading'),
            ));
        }
    }

    public function register_meta_box()
    {
        add_meta_box('sao_fl_manager', __('Smart Asset Optimizer Asset Manager', 'smart-asset-optimizer-for-fast-loading'), array($this, 'render_meta_box'), array('post', 'page'), 'side');
    }

    public function render_meta_box($post)
    {
        $blocked = get_post_meta($post->ID, '_sao_fl_blocked_assets', true) ?: '';
        wp_nonce_field('sao_fl_save_meta', 'sao_fl_nonce');
        echo '<div class="sao-fl-metabox-wrapper">';
        echo '<p class="description" style="margin-bottom: 10px;">' . esc_html__('Paste handles to disable (one per line):', 'smart-asset-optimizer-for-fast-loading') . '</p>';
        echo '<textarea id="sao_fl_blocked_assets" name="sao_fl_blocked" rows="6" placeholder="e.g. contact-form-7">' . esc_textarea($blocked) . '</textarea>';
        echo '<p style="font-size: 11px; color: #8c8f94; margin-top: 8px;">' . esc_html__('Use "Scan Assets" in the admin bar to find handles.', 'smart-asset-optimizer-for-fast-loading') . '</p>';
        echo '</div>';
    }

    public function save_meta_box_data($post_id)
    {
        if (!isset($_POST['sao_fl_nonce']) || !wp_verify_nonce(sanitize_key(wp_unslash($_POST['sao_fl_nonce'])), 'sao_fl_save_meta')) {
            return;
        }

        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (isset($_POST['sao_fl_blocked'])) {
            $sanitized_data = sanitize_textarea_field(wp_unslash($_POST['sao_fl_blocked']));
            update_post_meta($post_id, '_sao_fl_blocked_assets', $sanitized_data);
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
        $blocked_data = get_post_meta($post_id, '_sao_fl_blocked_assets', true);

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
