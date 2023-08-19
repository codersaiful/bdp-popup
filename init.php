<?php
/**
 * Plugin Name: BDP Popup and Coupon Display
 * Plugin URI: https://wooproducttable.com/pricing/?utm_source=WPT+Plugin+Dashboard&utm_medium=Free+Version
 * Description: Display offer and coupon popup and modal for your WordPress website.
 * Author: CodeAstrology Team
 * Author URI: https://wooproducttable.com/?utm_source=BDP-Dashboard&utm_medium=Free+Version
 * Tags: popup, modal, popup-header
 * 
 * Version: 1.0.0
 * Requires at least:    4.0.0
 * Tested up to:         6.3
 * WC requires at least: 5.0.0
 * WC tested up to: 	 8.0.2
 * 
 * 
 * Text Domain: bdp-popup
 * Domain Path: /languages/
 */

if( ! defined( 'BDP_POP_DEV_VERSION' ) ){
    define( "BDP_POP_DEV_VERSION", '1.0.0.0' );
}
if( ! defined( 'BDP_POP_BASE_URL' ) ){
    define( "BDP_POP_BASE_URL", plugins_url() . '/'. plugin_basename( dirname( __FILE__ ) ) . '/' );
}

if( ! defined( 'BDP_POP_ASSETS_URL' ) ){
    define( "BDP_POP_ASSETS_URL", BDP_POP_BASE_URL . 'assets/' );
}

if( ! defined( 'BDP_POP_DIR_BASE' ) ){
    define( "BDP_POP_DIR_BASE", dirname( __FILE__ ) . '/' );
}
if( ! defined( 'BDP_POP_BASE_DIR' ) ){
    define( "BDP_POP_BASE_DIR", str_replace( '\\', '/', BDP_POP_DIR_BASE ) );
}

class BDP_Popup_Init
{
    public static $instance;

    public static function instance()
    {
        if( is_null( self::$instance ) ){
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function __construct()
    {
        add_action('plugins_loaded', [$this, 'init']);

    }
    public function init()
    {
        
        include_once BDP_POP_BASE_DIR . 'autoloader.php';

        if( ! is_admin() ){
            
            $front = new BDP_Popup\Frontend\Frontend_Loader();
            $front->init();
        }
    }
}

BDP_Popup_Init::instance();

