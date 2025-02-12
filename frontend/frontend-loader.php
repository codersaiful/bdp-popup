<?php
namespace BDP_Popup\Frontend;

use BDP_Popup\Frontend\API;
use BDP_Popup\Core\Base;

class Frontend_Loader extends Base
{
    public $popup_as_header = true;
    public $popup_page_id = 7;//Page ID, where I want to show popup always without main delay

    /**
     * specially for selected page.
     *
     * @var integer
     */
    public $page_delay = 15; //as second

    public $closed_date;// Example//2023-08-19 //Y-M-D

    //Don't set value on following. will generate at constructor and inside
    public $cookie_name;
    public $cookie_expire_time;
    public $is_already_cookie;
    public $is_popup;
    public $options;

    public $current_page_id;

    public $api_site_url;


    public static $inistance;
    public static function init()
    {
        if( is_null(self::$inistance) ){
            self::$inistance = new self;
        }
        
        return self::$inistance;
    }


    public function __construct()
    {
        
        /**
         * To set $this->options value
         * we have to call at the begging.
         * Otherwise, database value will not work.
         * It's need at the begginng of this contructor. Because, we have to change everything based on value.
         */
        // $this->set_options();
        $this->options = get_option( $this->option_key );

        /**
         * To set options based on api
         * We need following function
         * 
         * @since 1.0.0.11
         */
        $this->api_site_url = $this->options['api_site_url'] ?? null;
        if( ! empty( $this->api_site_url ) && filter_var($this->api_site_url, FILTER_VALIDATE_URL) ) {
            $this->modify_options_based_on_api();
        }

        //Popup and Header will close to the specific date
        $this->closed_date = ! empty( $this->options['closed_date'] ) ? $this->options['closed_date'] : time() + 100;
        if( time() > strtotime($this->closed_date) ) return;
        
        $this->cookie_name = $this->plugin_prefix . '_poppup_displayed';
        
        $expire = ! empty( $this->options['cookie_expire_time'] ) ? $this->options['cookie_expire_time'] : ( MINUTE_IN_SECONDS * 10 );
        $this->cookie_expire_time = time() + $expire;

        
        $this->is_already_cookie = isset($_COOKIE[$this->cookie_name]) && $_COOKIE[$this->cookie_name] == $this->plugin_prefix;

        $this->is_popup = ! $this->is_already_cookie;
        $this->popup_as_header = ! empty( $this->options['popup_as_header'] );

        /**
         * Other propertyy set here
         */
        $this->popup_page_id = ! empty( $this->options['popup_page_id'] ) ? $this->options['popup_page_id'] : null;

        if( ! empty($this->options['visibility_all']) ){
            /**
             * wp_enqueue_scripts calling should first, because I have also calculate 
             * because I have define and check 
             * * $this->current_page_id
             * * $this->popup_page_id 
             * 
             * so it should at the first
             */
            add_action('wp_enqueue_scripts',[$this, 'wp_enqueue']);
            add_action('wp_footer',[$this, 'display_popup']);
            add_action('wp_body_open',[$this, 'display_header']);

        }
        
        if( ! empty($this->options['coupon_visibility']) ){
            add_action('wp_footer',[$this, 'display_couponbox']);
        }
        add_action('init',[$this, 'set_cookie']);
    }
    
    protected function modify_options_based_on_api(){
        $remote_data_transient = get_transient( $this->token_key );
        if( ! empty( $remote_data_transient ) ){
            $this->options = array_merge( $remote_data_transient, array_filter( $this->options ) );
            return;
        }
        $api = API::init();
        $this->token_key = $api->token_key;
        $remote_options = $api->get_remote();
        if( ! empty( $remote_options ) ){
            set_transient( $this->token_key, $remote_options, 4000);
            $this->options = array_merge( $this->options, $remote_options );
        }
        
    }

    public function wp_enqueue(){

        $this->current_page_id = get_the_ID();
        if($this->current_page_id == $this->popup_page_id){
            $this->is_popup = true;
        }

        if( ! $this->is_popup && ! $this->popup_as_header ) return;
        wp_enqueue_script( 'jquery' );
        
        //Custom JS
        $js_handle = $this->plugin_prefix . 'popup';
        wp_register_script( $js_handle, $this->base_url . 'assets/js/popup.js', array( 'jquery' ), $this->dev_version, true );
        wp_enqueue_script( $js_handle );
        $BDP_POPUP = [
            /**
             * Actually to delay of showing popup, I have taken a rand number
             * in js file, I will multiply with 500 
             * and calculate as mili second
             * so if value 2 then result will 2*500 = 1000 milisecond = 1 second
             * finally rand(3,13 set done)
             */
            'rand_number' => rand(3,13), 

        ];
        if($this->current_page_id == $this->popup_page_id && $this->page_delay ){
            /**
             * If match with my selected page, then I will wait 20 * 500 = 10000 mili second = 10 second
             * currently set 15 in property
             * mean, here will be 30
             * and delay will 30*500 = 1500 mili second = 15 second
             */
            $BDP_POPUP['rand_number'] = 2 * $this->page_delay;
        }
        wp_localize_script( $js_handle, 'BDP_POPUP', $BDP_POPUP );


        wp_enqueue_style($this->plugin_prefix . 'popup-styles', $this->base_url . 'assets/css/popup-styles.css', array(), $this->dev_version);
        wp_enqueue_style($this->plugin_prefix . 'header-styles', $this->base_url . 'assets/css/header-styles.css', array(), $this->dev_version);

        // Add custom styles
        $this->add_custom_styles();
    }

    /**
     * Add custom styles based on settings
     */
    private function add_custom_styles() {
        $custom_css = '';
        
        // Popup styles
        if (!empty($this->options['popup_bg_color'])) {
            $custom_css .= 'div#bdp-popup-wrapper div.bdp-popup { background-color: ' . esc_attr($this->options['popup_bg_color']) . ' !important; }';
        }
        if (!empty($this->options['popup_header_bg'])) {
            $custom_css .= 'div#bdp-popup-wrapper .bdp-pop-header { background-color: ' . esc_attr($this->options['popup_header_bg']) . ' !important; }';
        }
        if (!empty($this->options['popup_title_color'])) {
            $custom_css .= 'div#bdp-popup-wrapper .bdp-right-side h2 { color: ' . esc_attr($this->options['popup_title_color']) . ' !important; }';
        }
        if (!empty($this->options['title_font_size'])) {
            $custom_css .= 'div#bdp-popup-wrapper .bdp-right-side h2 { font-size: ' . esc_attr($this->options['title_font_size']) . ' !importantpx; line-height: ' . (intval($this->options['title_font_size']) + 2) . 'px !important; }';
        }

        // Coupon styles
        if (!empty($this->options['coupon_bg_color'])) {
            $custom_css .= 'div#bdp-popup-wrapper .coupon.bdp-coupon-code { background-color: ' . esc_attr($this->options['coupon_bg_color']) . ' !important; }';
        }
        if (!empty($this->options['coupon_text_color'])) {
            $custom_css .= 'div#bdp-popup-wrapper .coupon.bdp-coupon-code { color: ' . esc_attr($this->options['coupon_text_color']) . ' !important; }';
        }
        if (!empty($this->options['copy_text_color'])) {
            $custom_css .= 'div#bdp-popup-wrapper p.bdp-copy-coupon { color: ' . esc_attr($this->options['copy_text_color']) . ' !important; }';
        }

        // Header bar styles
        if (!empty($this->options['header_bg_color'])) {
            $custom_css .= 'div#bdp-header-wrapper{ background-color: ' . esc_attr($this->options['header_bg_color']) . ' !important; }';
        }
        if (!empty($this->options['header_text_color'])) {
            $custom_css .= 'div#bdp-header-wrapper .bdp-right-side>h4{ color: ' . esc_attr($this->options['header_text_color']) . ' !important; }';
        }
        if (!empty($this->options['header_coupon_bg'])) {
            $custom_css .= 'div#bdp-header-wrapper .coupon.bdp-coupon-code{ background-color: ' . esc_attr($this->options['header_coupon_bg']) . ' !important; }';
        }

/**
 * 
if (!empty($this->options['popup_bg_color'])) {
            $custom_css .= '.bdp-popup { background-color: ' . esc_attr($this->options['popup_bg_color']) . '; }';
        }
        if (!empty($this->options['popup_text_color'])) {
            $custom_css .= '.bdp-popup { color: ' . esc_attr($this->options['popup_text_color']) . '; }';
        }
        if (!empty($this->options['title_font_size'])) {
            $custom_css .= '.bdp-popup h2, .bdp-popup h4 { font-size: ' . esc_attr($this->options['title_font_size']) . 'px; }';
        }

        // Button styles
        if (!empty($this->options['button_bg_color'])) {
            $custom_css .= '.bdp-popup button, .bdp-popup .button, .bdp-popup .bdp-copy-coupon { background-color: ' . esc_attr($this->options['button_bg_color']) . '; }';
        }
        if (!empty($this->options['button_text_color'])) {
            $custom_css .= '.bdp-popup button, .bdp-popup .button, .bdp-popup .bdp-copy-coupon { color: ' . esc_attr($this->options['button_text_color']) . '; }';
        }

        // Header bar styles
        if (!empty($this->options['header_bg_color'])) {
            $custom_css .= '.bdp-header-wrapper { background-color: ' . esc_attr($this->options['header_bg_color']) . '; }';
        }
        if (!empty($this->options['header_text_color'])) {
            $custom_css .= '.bdp-header-wrapper { color: ' . esc_attr($this->options['header_text_color']) . '; }';
        }
 */


        if (!empty($custom_css)) {
            wp_add_inline_style($this->plugin_prefix . 'popup-styles', $custom_css);
        }
    }

    /**
     * Popup Element included
     * and added here.
     * Total Popup content is here
     *
     * @return void
     */
    public function display_popup() {
        if( ! $this->is_popup ) return;
        include $this->base_dir . 'frontend/html/popup-content.php';
    }
    /**
     * Popup Element included
     * and added here.
     * Total Popup content is here
     *
     * @return void
     */
    public function display_couponbox() {
        include $this->base_dir . 'frontend/html/coupon-button.php';
    }
    public function display_header() {
        
        if( ! $this->popup_as_header ) return;
        if($this->current_page_id == $this->popup_page_id) return;
        include $this->base_dir . 'frontend/html/header-content.php';
    }

    public function set_options()
    {
        $this->options = get_option( $this->option_key );
    }
    /**
     * Set plugin_prefix as cookie value
     *
     * @return void
     */
    public function set_cookie()
    {   
        if( ! $this->is_popup ) return;
        setcookie($this->cookie_name, $this->plugin_prefix, $this->cookie_expire_time);  
    }
}
