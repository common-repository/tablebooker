<?php
/**
 * @package 	tablebooker
 * @author		tablebooker
 * @copyright 	2023 tablebooker CVBA  (email : dev@tablebooker.com)
 *
 * Plugin Name: 		tablebooker
 * Plugin URI: 			http://tablebooker.com
 * Description: 		This plugin integrates the tablebooker booking module into your Wordpress website.
 * Author: 				Tablebooker
 * Author URI: 			https://tablebooker.com
 * Version: 			3.1.0
 * Requires at least:	5.0
 * Requires PHP:      	5.6
 * License: 			GPLv2
 * License URI:       	https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:			https://wordpress.org/plugins/tablebooker/
 * Text Domain: 		tablebooker
 * Domain Path:       	/languages
 */

class WPTablebooker {
	var $pluginPath;
	var $pluginUrl;

    public function __construct()
    {
    	// Set Plugin Path
		$this->pluginPath = dirname(__FILE__);
		// Set Plugin URL
		$this->pluginUrl = WP_PLUGIN_URL . '/tablebooker';
		$this->register_hooks();
        add_action('wp_footer', array($this, 'enqueue_assets'));
    }

    /**
	 * Centralized place for adding all actions and filters for the plugin into wordpress
	 */
	private function register_hooks(){
		if(is_admin()){
			//register_activation_hook(__FILE__, array(&$this,'install'));
			add_action('admin_menu', array(&$this,'admin_menu_link'));
			add_action('admin_init', array(&$this,'admin_init'));
		}
		else{
			add_shortcode('tablebooker_reservation', array($this, 'reservation_shortcode'));
            add_shortcode('tablebooker_menu', array($this, 'menu_shortcode'));
            add_shortcode('tablebooker_feedback', array($this, 'feedback_shortcode'));
            add_shortcode('tablebooker_giftcard', array($this, 'shop_vouchers_shortcode'));
			add_shortcode('tablebooker_shop', array($this, 'shop_shortcode'));
			add_shortcode('tablebooker_shop_vouchers', array($this, 'shop_vouchers_shortcode'));
			add_shortcode('tablebooker_shop_takeaway', array($this, 'shop_takeaway_shortcode'));
            // Add shortcode support for widgets
            add_filter('widget_text', 'do_shortcode');
		}
	}

    public function enqueue_assets() {
        wp_register_script('tbkr-js', 'https://reservations.tablebooker.com/tbkr-widget-import.min.js', array('jquery'), '', true);
		wp_register_script('tbkr-shop-js', 'https://widget.tablebooker.shop/tbkr-widget-import.min.js', array('jquery'), '', true);
        wp_enqueue_script('tbkr-js');
		wp_enqueue_script('tbkr-shop-js');
    }

    /**
	 * Adds the Administration link under Settings in the Wordpress Menu for Administrators
	 */
	public function admin_menu_link(){
		add_options_page('tablebooker options', 'Tablebooker', 'administrator', basename(__FILE__), array(&$this,'admin_options_page'));
	}

    public function getWidget($type){
    	if (!class_exists('TablebookerAPI')){
    		include 'tablebookerAPI.php';
    	}

    	$options = get_option('tablebooker_options');

    	if(!$options || !isset($options['restaurant_id'])){
    		return "configure tablebooker plugin";
    	}
    	$tablebookerAPI = new TablebookerAPI($options['restaurant_id'], $options['reservation_form_primary_color'], $options['restaurant_shop_id']);
        switch ($type) {
            case 'reservation':
                $widget = $tablebookerAPI->getReservationFrom($options["reservation_form_background"], $options['embed_language'], $options['reservation_form_modal']);
                break;
            case 'menu':
                $widget = $tablebookerAPI->getMenuFrom($options["reservation_form_background"], $options['embed_language']);
                break;
            case 'feedback':
                $widget = $tablebookerAPI->getFeedbackFrom($options["reservation_form_background"], $options['embed_language']);
                break;
			case 'shop':
				$widget = $tablebookerAPI->getShopFrom($options["reservation_form_background"], $options['embed_language']);
				break;
			case 'shop_vouchers':
				$widget = $tablebookerAPI->getShopFrom($options["reservation_form_background"], $options['embed_language'], 'vouchers');
				break;
			case 'shop_takeaway':
				$widget = $tablebookerAPI->getShopFrom($options["reservation_form_background"], $options['embed_language'], 'takeaway');
				break;
			case 'giftcard':
				//Resto gift cards is EOL
                $widget = $tablebookerAPI->getGiftcardFrom($options['embed_language']);
                break;
        }

		return $widget;
    }

    public function reservation_shortcode($atts)
    {
    	return $this->getWidget('reservation');
    }

    public function menu_shortcode($atts)
    {
        return $this->getWidget('menu');
    }

    public function feedback_shortcode($atts)
    {
        return $this->getWidget('feedback');
    }

	/**
	 * @deprecated
	 */
	public function giftcard_shortcode($atts)
    {
        return $this->getWidget('giftcard');
    }

	public function shop_shortcode($atts) 
	{
		return $this->getWidget('shop');
	}

	public function shop_vouchers_shortcode($atts) 
	{
		return $this->getWidget('shop_vouchers');
	}

	public function shop_takeaway_shortcode($atts) 
	{
		return $this->getWidget('shop_takeaway');
	}


    /**
	 * Displays the administration page
	 */
	public function admin_options_page(){
		require_once($this->pluginPath .'/adminPage.php');
	}

	public function admin_init(){
        require_once($this->pluginPath .'/includes/tbkr-admin-functions.php');
		register_setting( 'tablebooker_options', 'tablebooker_options');
		add_settings_section('tablebooker_main', 'Tablebooker Pro credentials', 'tablebooker_section_text_callback', 'tablebooker');
		add_settings_field('restaurant_id', __('Restaurant id', 'tablebooker'), 'restaurant_id_field', 'tablebooker', 'tablebooker_main');
		add_settings_field('restaurant_shop_id', __('Shop id', 'tablebooker'), 'restaurant_shop_id_field', 'tablebooker', 'tablebooker_main');
        add_settings_field('reservation_form_modal', __('Module type', 'tablebooker'), 'reservation_form_type_field', 'tablebooker', 'tablebooker_main');
		add_settings_field('reservation_form_background', __('Module theme', 'tablebooker'), 'reservation_form_background_field', 'tablebooker', 'tablebooker_main');
        add_settings_field('reservation_form_primary_color', __('Primary color', 'tablebooker'), 'reservation_form_primary_color_field', 'tablebooker', 'tablebooker_main');
		add_settings_field('embed_language', __('Language', 'tablebooker'), 'embed_language_field', 'tablebooker', 'tablebooker_main');
	}
}

function tablebooker_section_text_callback() {
	echo '<p>Set up the connection with Tablebooker Pro.</p>';
}

/**
 * function that can be used in templates to render the reservation widget
 */
function tablebooker_reservation()
{
	$wpTablebooker = new WPTablebooker;
	echo $wpTablebooker->getWidget('reservation');
}

/**
 * function that can be used in templates to render the shop widget
 */
function tablebooker_shop()
{
	$wpTablebooker = new WPTablebooker;
	echo $wpTablebooker->getWidget('shop');
}

/**
 * function that can be used in templates to render the shop widget
 */
function tablebooker_shop_vouchers()
{
	$wpTablebooker = new WPTablebooker;
	echo $wpTablebooker->getWidget('shop_vouchers');
}

/**
 * function that can be used in templates to render the shop widget
 */
function tablebooker_shop_takeaway()
{
	$wpTablebooker = new WPTablebooker;
	echo $wpTablebooker->getWidget('shop_takeaway');
}


$wpTablebooker = new WPTablebooker();
?>
