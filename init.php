<?php
/*
Plugin Name: AAAAAA AAAAAA Popup Plugin
Description: Display a popup to users once every 10 days.
Version: 1.0
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

        
        $front = new BDP_Popup\Frontend\Frontend_Loader();
        $front->init();
    }
}

BDP_Popup_Init::instance();

