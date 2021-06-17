<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           product-addon-for-chat
 *
 * @wordpress-plugin
 * Plugin Name:       Product Addon For Chat
 * Plugin URI:        http://example.com/product-addon-for-chat-uri/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            SmartPipl
 * Author URI:        http://smartpipl.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       product-addon-for-chat
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

require_once ABSPATH . 'wp-admin/includes/plugin.php';

$status_plugin_active_woocommerce = is_plugin_active('woocommerce/woocommerce.php');

define( 'PRODUCT_ADDON_FOR_CHAT_VERSION', '1.0.0' );
define( 'SLUG_WATSON_ASSISTANT_PAGE',  'watson_asst');
define( 'STATUS_ACTIVE_WOOCOMMERCE',  $status_plugin_active_woocommerce);

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-product-addon-for-chat-activator.php
 */

function activate_product_addon_for_chat() {

	require_once plugin_dir_path( __FILE__ ) . 'includes/class-product-addon-for-chat-activator.php';
    Product_Addon_For_Chat_Activator::activate();

}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-product-addon-for-chat-deactivator.php
 */
function deactivate_product_addon_for_chat() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-product-addon-for-chat-deactivator.php';
    Product_Addon_For_Chat_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_product_addon_for_chat' );
register_deactivation_hook( __FILE__, 'deactivate_product_addon_for_chat' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-product-addon-for-chat.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_Product_Addon_For_Chat() {

	$plugin = new Product_Addon_For_Chat();
	$plugin->run();

}
run_Product_Addon_For_Chat();
