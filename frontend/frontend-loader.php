<?php
namespace BDP_Popup\Frontend;

use BDP_Popup\Core\Base;

class Frontend_Loader extends Base
{
    public $cookie_name;
    public $cookie_expire_time;
    public $is_already_cookie;
    public function init()
    {
        $this->cookie_name = $this->plugin_prefix . '_poppup_displayed';
        
        $this->cookie_expire_time = time() + 10 * DAY_IN_SECONDS;
        //This following line stay uncomment when development
        $this->cookie_expire_time = time() + 5;
        
        $this->is_already_cookie = isset($_COOKIE[$this->cookie_name]) && $_COOKIE[$this->cookie_name] == $this->plugin_prefix;
        add_action('wp_footer',[$this, 'display_popup']);
        add_action('wp_enqueue_scripts',[$this, 'wp_enqueue']);
        add_action('init',[$this, 'set_cookie']);
    }

    public function wp_enqueue(){
        wp_enqueue_style('popup-styles', $this->base_url . 'assets/css/popup-styles.css', array(), '1.0');
    }

    public function display_popup() {
        
        if (! $this->is_already_cookie ) {
            include $this->base_dir . 'frontend/html.php';
        }

        
    }

    /**
     * Set plugin_prefix as cookie value
     *
     * @return void
     */
    public function set_cookie()
    {   
        // var_dump($_COOKIE);
        if (! $this->is_already_cookie ) {
            
            setcookie($this->cookie_name, $this->plugin_prefix, $this->cookie_expire_time);
        }

        //When want to delete cokie
        // setcookie($this->cookie_name, $this->plugin_prefix, -3600, '/');
    }
}
