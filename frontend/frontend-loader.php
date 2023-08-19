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
    public $popup_checkout = true;

    public function init()
    {
        $this->cookie_name = $this->plugin_prefix . '_poppup_displayed';
        
        $this->cookie_expire_time = time() + 10 * DAY_IN_SECONDS;
        //This following line stay uncomment when development
        $this->cookie_expire_time = time() + 5;
        
        $this->is_already_cookie = isset($_COOKIE[$this->cookie_name]) && $_COOKIE[$this->cookie_name] == $this->plugin_prefix;
        $this->is_popup = ! $this->is_already_cookie;
        add_action('wp_footer',[$this, 'display_popup']);
        add_action('wp_enqueue_scripts',[$this, 'wp_enqueue']);
        add_action('init',[$this, 'set_cookie']);
    }

    public function wp_enqueue(){
        if( ! $this->is_popup ) return;
        wp_enqueue_script( 'jquery' );
        
        //Custom JS
        $js_handle = $this->plugin_prefix . 'popup';
        wp_register_script( $js_handle, $this->base_url . 'assets/js/popup.js', array( 'jquery' ), $this->dev_version, true );
        wp_enqueue_script( $js_handle );
        $BDP_POPUP = [
            'rand_number' => rand(2,8), //Actually to delay of showing popup, I have taken a rand number

        ];
        wp_localize_script( $js_handle, 'BDP_POPUP', $BDP_POPUP );


        wp_enqueue_style($this->plugin_prefix . 'popup-styles', $this->base_url . 'assets/css/popup-styles.css', array(), $this->dev_version);
    }

    public function display_popup() {
        if( ! $this->is_popup ) return;

        include $this->base_dir . 'frontend/html.php';
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
