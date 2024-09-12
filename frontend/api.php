<?php
namespace BDP_Popup\Frontend;

use BDP_Popup\Core\Base;

class API extends Base
{

    public $route_namespace = 'bdp_popup/v1';
    public $data_route = 'data';
    public $options;
    public $target_api_site;
    public $api_url;


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
        $site_url = $this->options['api_site_url'] ?? null;
        if( ! empty( $site_url ) && filter_var($site_url, FILTER_VALIDATE_URL) ) {
            $this->target_api_site = $site_url;
            $this->api_url = trailingslashit( $this->target_api_site ) .'wp-json/'  . $this->route_namespace . '/' . $this->data_route;
        }
        if( ! $this->target_api_site ){
            add_action('rest_api_init', [$this,'register_endpoint']);
        }
        // add_action('rest_api_init', [$this,'register_endpoint']);
    }

    public function get_remote()
    {
        $data = array(
            'access_key' => 'sOdkdSsomeSaiflul',
        );
        // Prepare the arguments for wp_remote_post()
        $args = array(
            'body' => $data, // Include the data in the body
            'timeout' => 15, // Set a timeout (optional)
            'headers' => array(
                'Content-Type' => 'application/x-www-form-urlencoded', // You can change this if needed
            ),
        );
        $response = wp_remote_post( $this->api_url, $args );
        // return [$this->api_url];
        if (is_wp_error($response)) {
            // dd('Webhook request failed: ' . $response->get_error_message());
            return [
                'status' => false,
                'message' => 'failed ' . $response->get_error_message()];
          }else{
            // return ['saiful' => 'TEst success'];
            $response_body = wp_remote_retrieve_body($response);
            // return $response_body;
            $token_data = json_decode($response_body, true);
            return $token_data;
          }
          return;

        // dd($response);
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
        $params = $request->get_params();
        $requested_access_key = $params['access_key'] ?? null;
        $this_access_key = $this->options['api_access_key'] ?? null;
        if( ! empty( $this_access_key ) && ! empty( $this_access_key ) &&  $requested_access_key === $this_access_key ) {
            // Return a success response.
            return new \WP_REST_Response( $this->options, $this->http_response_code);
        }
        // update_option('saiful_test_data', 33);
        
        $this->http_response_code = 403;
        return new \WP_REST_Response( ['status' => false,'message' => 'Access Denied'], $this->http_response_code);
        
    }

    public function permission_callback( $request )
    {
        return true;
    }
    
}