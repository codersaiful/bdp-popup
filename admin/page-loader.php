<?php 
namespace BDP_Popup\Admin;

use BDP_Popup\Core\Base;
use BDP_Popup\Modules\Module_Controller;

class Page_Loader extends Base
{

    public $main_slug = 'popup';
    public $page_folder_dir;
    public $topbar_file;
    public $topbar_sub_title;

    protected $is_pro;
    protected $pro_version;
    public $license;
    public $module_controller;

    public function __construct()
    {
        $this->main_slug = $this->plugin_prefix . '-' . $this->main_slug;
        $this->page_folder_dir = $this->base_dir . 'admin/page/';
        $this->topbar_file = $this->page_folder_dir . 'topbar.php';
        $this->topbar_sub_title = __("Manage and Settings", "bdp_pop");
    }

    public function run()
    {
        add_action( 'admin_menu', [$this, 'admin_menu'] );
        add_action( 'admin_enqueue_scripts', [$this, 'admin_enqueue_scripts'] );
    }

    
    public function main_page_html()
    {
        
        $main_page_file = $this->page_folder_dir . 'main-page.php';
        if( ! is_file( $main_page_file ) ) return;
        include $this->topbar_file;
        include $main_page_file;
    }
    

    public function browse_plugins_html()
    {
        add_filter( 'plugins_api_result', [$this, 'plugins_api_result'], 1, 3 );
        $this->topbar_sub_title = __( 'Browse our Plugins','bdp_pop' );
        include $this->topbar_file;
        include $this->page_folder_dir . 'browse-plugins.php';
    }
    

    public function admin_menu()
    {
        $capability = apply_filters( 'bdp_pop_menu_capability', 'manage_woocommerce' );
    

        $min_max_img = null;// = $this->base_url . 'assets/images/min-max.png';
        $page_title = "BDPlugin Popup";
        $menu_title = "Popup"; 
        $menu_slug = $this->main_slug;
        $callback = [$this, 'main_page_html']; 
        $icon_url = $min_max_img;
        $position = 55.11;
        add_menu_page($page_title, $menu_title, $capability, $menu_slug, $callback, $icon_url, $position);

        add_submenu_page( $this->main_slug, esc_html__( 'Browse Plugins', 'bdp_pop' ),  __( 'Browse Plugins', 'bdp_pop' ), $capability, 'bdp_pop-browse-plugins', [$this, 'browse_plugins_html'] );

        add_submenu_page($this->main_slug, 'Documentation', 'Documentation', 'read','https://codeastrology.com/min-max-quantity/documentation/');

    }

    public function admin_enqueue_scripts()
    {
        global $current_screen;
        
        $s_id = isset( $current_screen->id ) ? $current_screen->id : '';
        if( strpos( $s_id, $this->plugin_prefix ) !== false ){
            add_filter('admin_footer_text',[$this, 'admin_footer_text']);
            
            wp_register_style( $this->plugin_prefix . '-icon-font', $this->base_url . 'assets/fontello/css/wcmmq-icon.css', false, $this->dev_version );
            wp_enqueue_style( $this->plugin_prefix . '-icon-font' );

            
            wp_register_style( $this->plugin_prefix . '-icon-animation', $this->base_url . 'assets/fontello/css/animation.css', false, $this->dev_version );
            wp_enqueue_style( $this->plugin_prefix . '-icon-animation' );

            $js_handle = $this->plugin_prefix . '-backend';
            wp_register_script( $js_handle, $this->base_url . 'assets/js/admin.js', array( 'jquery','select2' ), $this->dev_version, true );
            wp_enqueue_script( $js_handle );

            
            $ajax_url = admin_url( 'admin-ajax.php' );
            $WCMMQ_ADMIN_DATA = array( 
                'ajax_url'       => $ajax_url,
                'site_url'       => site_url(),
                );
            wp_localize_script( $js_handle, 'WCMMQ_ADMIN_DATA', $WCMMQ_ADMIN_DATA );
            

            $css_new_admin = $this->plugin_prefix . '-admin';
            wp_register_style( $css_new_admin, $this->base_url . 'assets/css/new-admin.css', false, $this->dev_version );
            wp_enqueue_style( $css_new_admin );

            $css_handle = $this->plugin_prefix . '-backend';
            wp_register_style( $css_handle, $this->base_url . 'assets/css/backend.css', false, $this->dev_version );
            wp_enqueue_style( $css_handle );
            

        }

        
    }


    public function admin_footer_text($text)
    {
        $rev_link = 'https://wordpress.org/support/plugin/woo-min-max-quantity-step-control-single/reviews/#new-post';
        $text = sprintf(
			__( 'Thank you for using BDP Popup. <a href="%s" target="_blank">%sPlease review us</a>.' ),
			$rev_link,
            '<i class="bdp_pop_icon-star-filled"></i><i class="bdp_pop_icon-star-filled"></i><i class="bdp_pop_icon-star-filled"></i><i class="bdp_pop_icon-star-filled"></i><i class="bdp_pop_icon-star-filled"></i>'
		);
        return '<span id="footer-thankyou" class="bdp_pop-footer-thankyou">' . $text . '</span>';
    }
    public function plugins_api_result( $res, $action, $args )
    {
        if ( $action !== 'query_plugins' ) {
            return $res;
        }
        
        if( isset( $_GET['page'] ) && $_GET['page'] == 'bdp_pop-browse-plugins' ){
            //Will Continue to bottom actually
        }else{
            return $res;
        }
        $browse_plugins = get_transient( 'codersaiful_browse_plugins' );
        
        
        if( $browse_plugins ){
            return $browse_plugins;//As $res
        }
        
        
        
        $wp_version = get_bloginfo( 'version', 'display' );
        $action = 'query_plugins';
        $args = array(
            'page' => 1,
            'wp_version' => $wp_version
        );
        $args['author']          = 'codersaiful';
        $url = 'http://api.wordpress.org/plugins/info/1.2/';
        $url = add_query_arg(
                array(
                        'action'  => $action,
                        'request' => $args,
                ),
                $url
        );

        $http_url = $url;
        $ssl      = wp_http_supports( array( 'ssl' ) );
        if ( $ssl ) {
                $url = set_url_scheme( $url, 'https' );
        }

        $http_args = array(
                'timeout'    => 15,
                'user-agent' => 'WordPress/' . $wp_version . '; ' . home_url( '/' ),
        );
        $request   = wp_remote_get( $url, $http_args );

        if ( $ssl && is_wp_error( $request ) ) {
                if ( ! wp_is_json_request() ) {
                        trigger_error(
                                sprintf(
                                        /* translators: %s: Support forums URL. */
                                        __( 'An unexpected error occurred. Something may be wrong with WordPress.org or this server&#8217;s configuration. If you continue to have problems, please try the <a href="%s">support forums</a>.' ),
                                        __( 'https://wordpress.org/support/forums/' )
                                ) . ' ' . __( '(WordPress could not establish a secure connection to WordPress.org. Please contact your server administrator.)' ),
                                headers_sent() || WP_DEBUG ? E_USER_WARNING : E_USER_NOTICE
                        );
                }

                $request = wp_remote_get( $http_url, $http_args );
        }


        $res = json_decode( wp_remote_retrieve_body( $request ), true );
        if ( is_array( $res ) ) {
                // Object casting is required in order to match the info/1.0 format.
                $res = (object) $res;
                set_transient( 'codersaiful_browse_plugins' , $res, 32000);
        }
        
        return $res;
    }
}