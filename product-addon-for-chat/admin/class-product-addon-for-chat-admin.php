<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    product-addon-for-chat
 * @subpackage product-addon-for-chat/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    product-addon-for-chat
 * @subpackage product-addon-for-chat/admin
 * @author     Your Name <email@example.com>
 */
class Product_Addon_For_Chat_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->build_admin_setting_page();

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/product-addon-for-chat-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/product-addon-for-chat-admin.js', array( 'jquery' ), $this->version, false );

	}

//    public function check_plugin_activated() {
//
//    }

    public function build_admin_setting_page() {

        add_action('admin_menu',  array (&$this, 'add_admin_setting_page') );

    }

    public function add_admin_setting_page() {

//        add_menu_page(
//            'Product Addon Options',
//            'Product Addon For Chat',
//            'manage_options',
//            'product-addon-options',
//            array (&$this, 'render_admin_setting_page'),
//            'dashicons-admin-comments'
//        );

        add_submenu_page(
            SLUG_WATSON_ASSISTANT_PAGE,
            'Product Addon Options',
            'Product Addon For Chat',
            'manage_options',
            'watson_product_addon_for_chat',
            array (&$this, 'render_admin_setting_page')
        );

    }

    public function render_admin_setting_page(){ ?>

        <div class="wrap_pr_add_chat">
            <h2><?php esc_html_e('Product Addon For Chat'); ?></h2>
            <?php self::render_content_setting_page(); ?>
        </div>

    <?php }

    public static function render_content_setting_page() { ?>

        <h2 class="tab_wrapper_pr_add_chat">
            <a onClick="switch_tab_pr_add_chat('setup')" class="nav-tab nav-tab-active setup_tab">Plugin Setup</a>
            <a onClick="switch_tab_pr_add_chat('workspace')" class="nav-tab workspace_tab">Plugin Options</a>
        </h2>

        <form action="options.php" method="POST">
            <div class="tab-page setup_page">
                <?php $status_woocommerce = is_plugin_active('woocommerce/woocommerce.php');
                $status_watson = is_plugin_active('conversation-watson/watson.php');
                if ( $status_woocommerce && $status_watson ):?>
                    <p class="message success">All conditions for activation are met. You can proceed to the next step of configuring the addon.</p>
                <?php else:?>
                    <p class="message error">The activation conditions have not been met. Activate the required plugins. if they are missing, install them. You can activate plugins <a href="<?php echo get_home_url() . '/wp-admin/plugins.php';?>">here</a>.</p>
                <?php endif;?>
                <ul class="list_n_plugins">
                    <li class="item_list woocommerce">
                        <div class="checkbox_wrap">
                            <?php echo ( $status_woocommerce ? '<span class="dashicons dashicons-yes"></span>' : '<span class="dashicons dashicons-no"></span>');?>
                        </div>
                        <a href="https://downloads.wordpress.org/plugin/woocommerce.zip">Woocommerce</a>
                    </li>
                    <li class="item_list w_assistant">
                        <div class="checkbox_wrap">
                            <?php echo ( $status_watson ? '<span class="dashicons dashicons-yes"></span>' : '<span class="dashicons dashicons-no"></span>');?>
                        </div>
                        <a href="https://downloads.wordpress.org/plugin/conversation-watson.zip">Watson Assistant</a>
                    </li>
                </ul>
                <div class="wrap_btn">
                    <a onClick="switch_tab_pr_add_chat('workspace')" class="btn_next_tab">Next</a>
                </div>
            </div>

            <?php settings_fields('product-addon-options'); ?>

            <div class="tab-page workspace_page" style="display: none">

            </div>
        </form>

    <?php }

}
