<?php
namespace BDP_Popup\Frontend;

use BDP_Popup\Core\Base;

class API extends Base
{

    public $route_namespace = 'bdp_popup/v1';
    public $data_route = 'data';
    public $options;


    public $http_response_code = 200;

    /**
     * Initializing static property for Class
     * We will use this Trait acutally
     *
     * @var null|object
     */
    public static $init;

    /**
     * Initializing method init()
     * If we want to make any Class as Standalone 
     * then we have to use this trait
     * 
     * @since 1.0.0.11
     * 
     * @author Saiful Islam <codersaiful@gmail.com>
     * @return null|object
     */
    public static function init()
    {
        if( self::$init && self::$init instanceof self ) return self::$init;

        self::$init = new self();

        return self::$init;
    }

    public function __construct()
    {
        $this->options = get_option( $this->option_key );
        // dd($this->options);
        add_action('rest_api_init', [$this,'register_endpoint']);
    }

    public function register_endpoint() {
        register_rest_route( $this->route_namespace, '/' . $this->data_route, array(
            'methods' => 'POST',
            'callback' => [$this,'handle_request'],
            'permission_callback'   => [$this,'permission_callback'],
        ));
    }

    /**
     * Function to handle the POST request and update the option.
     * 
     *
     * @test new \WP_REST_Request();
     * @param \WP_REST_Request $request Request will come using \WP_REST_Request class
     * @return \WP_REST_Response
     */
    public function handle_request($request)
    {

        // Return a success response.
        return new \WP_REST_Response( $this->options, $this->http_response_code);
        
    }

    public function permission_callback( $request )
    {
        return true;
    }
    
}