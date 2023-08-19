<?php
namespace BDP_Popup\Frontend;

use BDP_Popup\Core\Base;

class Frontend_Loader extends Base
{
    public $cookie_name;
    public $cookie_expire_time;
    public $is_already_cookie;
    public $is_popup;

    public $popup_as_header = true;
    public $popup_page_id = 7;//Confirm popup for specific page
    public $current_page_id;

    public function init()
    {
        
        
        $this->cookie_name = $this->plugin_prefix . '_poppup_displayed';
        
        $this->cookie_expire_time = time() + 10 * DAY_IN_SECONDS;
        //This following line stay uncomment when development
        $this->cookie_expire_time = time() + 30;
        
        $this->is_already_cookie = isset($_COOKIE[$this->cookie_name]) && $_COOKIE[$this->cookie_name] == $this->plugin_prefix;

        $this->is_popup = ! $this->is_already_cookie;
        
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
        add_action('init',[$this, 'set_cookie']);
        // var_dump($this);
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
             */
            'rand_number' => rand(2,8), 

        ];
        if($this->current_page_id == $this->popup_page_id){
            //If match with my selected page, then I will wait 20 * 500 = 10000 mili second = 10 second
            $BDP_POPUP['rand_number'] = 20;
        }
        wp_localize_script( $js_handle, 'BDP_POPUP', $BDP_POPUP );


        wp_enqueue_style($this->plugin_prefix . 'popup-styles', $this->base_url . 'assets/css/popup-styles.css', array(), $this->dev_version);
        wp_enqueue_style($this->plugin_prefix . 'header-styles', $this->base_url . 'assets/css/header-styles.css', array(), $this->dev_version);
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
    public function display_header() {
        if( ! $this->popup_as_header ) return;
        if($this->current_page_id == $this->popup_page_id) return;

        include $this->base_dir . 'frontend/html/header-content.php';
    }

    /**
     * Set plugin_prefix as cookie value
     *
     * @return void
     */
    public function set_cookie()
    {   
        //When want to delete cokie
        // setcookie($this->cookie_name, $this->plugin_prefix, -3600, '/');

        if( ! $this->is_popup ) return;
        setcookie($this->cookie_name, $this->plugin_prefix, $this->cookie_expire_time);  
    }
}
