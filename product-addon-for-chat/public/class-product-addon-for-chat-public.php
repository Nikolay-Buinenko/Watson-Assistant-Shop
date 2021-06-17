<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    product-addon-for-chat
 * @subpackage product-addon-for-chat/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    product-addon-for-chat
 * @subpackage product-addon-for-chat/public
 * @author     Your Name <email@example.com>
 */
class Product_Addon_For_Chat_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/product-addon-for-chat-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/product-addon-for-chat-public.js', array( 'jquery' ), $this->version, false );

	}

    public function plugin_data_global_var(){

        $credentials = get_option('watson_product_addon_for_chat_credentials');
        $addon_status = (isset($credentials['enabled']) ? $credentials['enabled'] : 'true');
        $search_command = (isset($credentials['search_command']) && $credentials['search_command'] != '' ? $credentials['search_command'] : '/search_product' );

        wp_localize_script( $this->plugin_name, 'data_global_var_product_addon',
            array(
                'pafc_addon_status' => $addon_status,
                'pafc_search_command' => $search_command,
                'ajax_url' => admin_url('admin-ajax.php')
            )
        );
    }

    public function pafc_search_product() {

        $message = $_POST['message'];
        $search_command = $_POST['search_command'];
        $split_message = explode($search_command, $message);
        $search_query = trim($split_message[1]);

        $credentials = get_option('watson_product_addon_for_chat_credentials');
        $show_product_links                    = (isset($credentials['product_links']) ? true : false);
        $show_image_product                    = (isset($credentials['image_product']) ? true : false);
        $show_count_of_items                   = (isset($credentials['count_of_items']) ? true : false);
        $count_of_items_in_search_results      = (isset($credentials['count_of_items_in_search_results']) ? $credentials['count_of_items_in_search_results'] : 0 );
        $html_response = "";

        $args = array(
            'posts_per_page' => $count_of_items_in_search_results,
            'post_type' => 'product',
            'post_status' => 'publish',
            's' => $search_query
        );
        $query = new WP_Query( $args );

        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                $query->the_post();
                $image = "";
                $stock = "";
                global $product;
                if ( $show_count_of_items ) {
                    $stock = __("Stock quantity: ") . $product->get_stock_quantity();
                    $stock = "<span class=\"product_stock\">$stock</span>";
                }
                if ( $show_image_product ) {
                    $image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ));
                    $image = "<span class=\"wrap_img\"><img src=\"$image_url[0]\" alt=\"product_img\"></span>";
                }
                $product_link = get_permalink( get_the_ID() );
                $product_title = get_the_title( get_the_ID() );
                if ( $show_product_links ) {
                    $html_response .= "<a href=\"$product_link\" target=\"_blank\" class=\"pafc_product_item\">
                        $image
                        <span class=\"product_title\">$product_title</span>
                        $stock
                    </a>";
                } else {
                    $html_response .= "<div class=\"pafc_product_item\">
                        $image
                        <span class=\"product_title\">$product_title</span>
                        $stock
                    </div>";
                }
            }
        }

        wp_reset_postdata();

        //echo "show_product_links_enabled: ". !!$show_product_links ."; show_image_product_enabled: ". !!$show_image_product ."; show_count_of_items_enabled: ". !!$show_count_of_items ."; count_of_items_in_search_results: $count_of_items_in_search_results";

        echo $html_response;

        wp_die();

    }

}
