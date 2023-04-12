<?php
/*
 * @themes-extended
 * Plugin Name:       Themes Extended
 * Plugin URI:        
 * Description:       Customize UI, expand wordpress config
 * Author:            Eric Go
 * Author URI:        https://wordpress.org/
 * Version:           1.0.0
 * Text Domain:       themes-extended
 */

if (!function_exists('is_admin')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

if (!class_exists('WP_Themes_Extended')) :

    final class WP_Themes_Extended
    {

        protected static $_instance = null;

        /**
         * Creates singleton instance of the class
         *
         * @since 1.0
         * @param null
         * @return void
         */
        public static function instance()
        {

            if (is_null(self::$_instance)) {
                self::$_instance = new self();
                self::$_instance->setup_constants();
                self::$_instance->includes();
                self::$_instance->hooks();
            }

            return self::$_instance;
        }

        /**
         * Throw error on object clone
         *
         * The whole idea of the singleton design pattern is that there is a single
         * object therefore, we don't want the object to be cloned.
         *
         * @since 1.0
         * @access protected
         * @return void
         */
        public function __clone()
        {
            // Cloning instances of the class is forbidden
            _doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?', 'esig'), '1.0');
        }

        /**
         * Disable unserializing of the class
         *
         * @since 1.0
         * @access protected
         * @return void
         */
        public function __wakeup()
        {
            // Unserializing instances of the class is forbidden
            _doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?', 'esig'), '1.6');
        }

        /**
         * Include required files
         *
         * @access private
         * @since 1.0
         * @return void
         */
        private function includes()
        {
            // require_once ESIGNEXT_URI . "includes/functions.php";
            // require_once ESIGNEXT_URI . "dashboard/dashboard-functions.php";
            // require_once ESIGNEXT_URI . "includes/configs.php";
            // require_once ESIGNEXT_URI . "dashboard/controllers/controllers.php";
        }

        /**
         * Setup plugin constants
         *
         * @access private
         * @since 1.0
         * @return void
         */
        private function setup_constants()
        {
            //prevent header sent.
            ob_start();
            if (!defined('HOME_URL')) {
                define("HOME_URL",  home_url());
            }
            if (!defined('THEMESEXT_URL')) {
                define("THEMESEXT_URL", plugin_dir_url(__FILE__));
            }
            if (!defined('THEMESEXT_URI')) {
                define("THEMESEXT_URI", plugin_dir_path(__FILE__));
            }
        }

        private function hooks()
        {
            add_action('plugins_loaded', array($this, 'load_updater'));
            register_activation_hook(__FILE__, array($this, 'activate'));
            register_deactivation_hook(__FILE__, array($this, 'deactivate'));
        }

        public function load_updater()
        {
            // global $esig_ext = WP_Themes_Extended::instance();
        }

        private static function deactive()
        {
            // $dependent = 'acf-frontend-plus/acf-frontend-plus.php';
            // deactivate_plugins($dependent);
        }

        /**
         * Fired for each blog when the plugin is activated.
         *
         * @since     0.1
         */
        private static function single_activate()
        {
            // if (!is_plugin_active('advanced-custom-fields-pro/acf.php') || !is_plugin_active('e-signature/e-signature.php') || !is_plugin_active('e-signature-business-add-ons/e-signature-business-add-ons.php')) {
            //     add_action('update_option_active_plugins', array($this, 'deactive'));
            //     wp_safe_redirect(admin_url('plugins.php'));
            // }
        }

        /**
         * Fired for each blog when the plugin is deactivated.
         *
         * @since     0.1
         */
        private static function single_deactivate()
        {
            // @TODO: Define deactivation functionality here
        }

        /**
         * Fired when the plugin is activated.
         *
         * @since     0.1
         * @param    boolean    $network_wide    True if WPMU superadmin uses
         *                                       "Network Activate" action, false if
         *                                       WPMU is disabled or plugin is
         *                                       activated on an individual blog.
         */
        public static function activate($network_wide)
        {
            self::single_activate();
        }

        /**
         * Fired when the plugin is deactivated.
         *
         * @since     0.1
         * @param    boolean    $network_wide    True if WPMU superadmin uses
         *                                       "Network Deactivate" action, false if
         *                                       WPMU is disabled or plugin is
         *                                       deactivated on an individual blog.
         */
        public static function deactivate($network_wide)
        {
            self::single_deactivate();
        }
    }
endif; // Ends if class exists

/**
 * @since 1.0
 * @return type
 */
function WP_Themes_Ext()
{
    return WP_Themes_Extended::instance();
}

// run esignature extended
WP_Themes_Ext();
