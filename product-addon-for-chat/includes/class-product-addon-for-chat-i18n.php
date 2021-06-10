<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    product-addon-for-chat
 * @subpackage product-addon-for-chat/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    product-addon-for-chat
 * @subpackage product-addon-for-chat/includes
 * @author     Your Name <email@example.com>
 */
class Product_Addon_For_Chat_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'product-addon-for-chat',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
