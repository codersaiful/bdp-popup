<?php
namespace BDP_Popup\Api;

use BDP_Popup\Core\Base;

class Api_Handler extends Base
{
    public $route_namespace = 'bdp-popup/v1';
    public $endpoints = [
        'settings' => 'settings',
        'content' => 'content',
        'universal' => 'universal',
        'coupon' => 'coupon',
    ];

    public static $instance;

    public static function init()
    {
        if (self::$instance && self::$instance instanceof self) {
            return self::$instance;
        }
        self::$instance = new self();
        return self::$instance;
    }

    public function __construct()
    {
        add_action('rest_api_init', [$this, 'register_endpoints']);
    }

    public function register_endpoints()
    {
        // Get all settings
        register_rest_route($this->route_namespace, '/settings', array(
            'methods' => 'GET',
            'callback' => [$this, 'get_settings'],
            'permission_callback' => [$this, 'check_permission'],
        ));

        // Update all settings
        register_rest_route($this->route_namespace, '/settings', array(
            'methods' => 'POST',
            'callback' => [$this, 'update_settings'],
            'permission_callback' => [$this, 'check_permission'],
        ));

        // Get content settings
        register_rest_route($this->route_namespace, '/content', array(
            'methods' => 'GET',
            'callback' => [$this, 'get_content_settings'],
            'permission_callback' => [$this, 'check_permission'],
        ));

        // Update content settings
        register_rest_route($this->route_namespace, '/content', array(
            'methods' => 'POST',
            'callback' => [$this, 'update_content_settings'],
            'permission_callback' => [$this, 'check_permission'],
        ));

        // Get universal settings
        register_rest_route($this->route_namespace, '/universal', array(
            'methods' => 'GET',
            'callback' => [$this, 'get_universal_settings'],
            'permission_callback' => [$this, 'check_permission'],
        ));

        // Update universal settings
        register_rest_route($this->route_namespace, '/universal', array(
            'methods' => 'POST',
            'callback' => [$this, 'update_universal_settings'],
            'permission_callback' => [$this, 'check_permission'],
        ));

        // Get coupon settings
        register_rest_route($this->route_namespace, '/coupon', array(
            'methods' => 'GET',
            'callback' => [$this, 'get_coupon_settings'],
            'permission_callback' => [$this, 'check_permission'],
        ));

        // Update coupon settings
        register_rest_route($this->route_namespace, '/coupon', array(
            'methods' => 'POST',
            'callback' => [$this, 'update_coupon_settings'],
            'permission_callback' => [$this, 'check_permission'],
        ));
    }

    /**
     * Check API permission
     */
    public function check_permission($request)
    {
        $api_key = $request->get_header('X-API-Key');
        if (!$api_key) {
            $api_key = $request->get_param('api_key');
        }

        $stored_key = get_option($this->plugin_prefix . '_api_key');
        
        if (empty($stored_key)) {
            return new \WP_Error('no_api_key', 'API key not configured', array('status' => 401));
        }

        if ($api_key !== $stored_key) {
            // Log failed attempt
            Request_Logger::log_request($request, 401, 'Unauthorized');
            return new \WP_Error('invalid_api_key', 'Invalid API key', array('status' => 403));
        }

        return true;
    }

    /**
     * Get all settings
     */
    public function get_settings($request)
    {
        $options = get_option($this->option_key, []);
        
        // Remove sensitive data
        unset($options['api_access_key']);
        unset($options['api_site_url']);
        unset($options['api_access_token']);

        Request_Logger::log_request($request, 200, 'Success');

        return new \WP_REST_Response([
            'success' => true,
            'data' => $options
        ], 200);
    }

    /**
     * Update all settings
     */
    public function update_settings($request)
    {
        $params = $request->get_json_params();
        
        if (empty($params)) {
            Request_Logger::log_request($request, 400, 'Bad Request');
            return new \WP_Error('no_data', 'No data provided', array('status' => 400));
        }

        $current_options = get_option($this->option_key, []);
        $updated_options = array_merge($current_options, $params);
        
        update_option($this->option_key, $updated_options);
        delete_transient($this->token_key);

        Request_Logger::log_request($request, 200, 'Success');

        return new \WP_REST_Response([
            'success' => true,
            'message' => 'Settings updated successfully',
            'data' => $updated_options
        ], 200);
    }

    /**
     * Get content settings
     */
    public function get_content_settings($request)
    {
        $options = get_option($this->option_key, []);
        
        $content_fields = ['title', 'message', 'coupon', 'browse_text', 'browse_link', 'popup_image'];
        $content_settings = [];
        
        foreach ($content_fields as $field) {
            if (isset($options[$field])) {
                $content_settings[$field] = $options[$field];
            }
        }

        Request_Logger::log_request($request, 200, 'Success');

        return new \WP_REST_Response([
            'success' => true,
            'data' => $content_settings
        ], 200);
    }

    /**
     * Update content settings
     */
    public function update_content_settings($request)
    {
        $params = $request->get_json_params();
        
        if (empty($params)) {
            Request_Logger::log_request($request, 400, 'Bad Request');
            return new \WP_Error('no_data', 'No data provided', array('status' => 400));
        }

        $current_options = get_option($this->option_key, []);
        
        $content_fields = ['title', 'message', 'coupon', 'browse_text', 'browse_link', 'popup_image'];
        foreach ($params as $key => $value) {
            if (in_array($key, $content_fields)) {
                $current_options[$key] = $value;
            }
        }
        
        update_option($this->option_key, $current_options);
        delete_transient($this->token_key);

        Request_Logger::log_request($request, 200, 'Success');

        return new \WP_REST_Response([
            'success' => true,
            'message' => 'Content settings updated successfully',
            'data' => array_intersect_key($current_options, array_flip($content_fields))
        ], 200);
    }

    /**
     * Get universal settings
     */
    public function get_universal_settings($request)
    {
        $options = get_option($this->option_key, []);
        
        $universal_fields = ['visibility_all', 'closed_date', 'cookie_expire_time', 'popup_as_header', 'popup_page_id', 'topbar_position'];
        $universal_settings = [];
        
        foreach ($universal_fields as $field) {
            if (isset($options[$field])) {
                $universal_settings[$field] = $options[$field];
            }
        }

        Request_Logger::log_request($request, 200, 'Success');

        return new \WP_REST_Response([
            'success' => true,
            'data' => $universal_settings
        ], 200);
    }

    /**
     * Update universal settings
     */
    public function update_universal_settings($request)
    {
        $params = $request->get_json_params();
        
        if (empty($params)) {
            Request_Logger::log_request($request, 400, 'Bad Request');
            return new \WP_Error('no_data', 'No data provided', array('status' => 400));
        }

        $current_options = get_option($this->option_key, []);
        
        $universal_fields = ['visibility_all', 'closed_date', 'cookie_expire_time', 'popup_as_header', 'popup_page_id', 'topbar_position'];
        foreach ($params as $key => $value) {
            if (in_array($key, $universal_fields)) {
                $current_options[$key] = $value;
            }
        }
        
        update_option($this->option_key, $current_options);
        delete_transient($this->token_key);

        Request_Logger::log_request($request, 200, 'Success');

        return new \WP_REST_Response([
            'success' => true,
            'message' => 'Universal settings updated successfully',
            'data' => array_intersect_key($current_options, array_flip($universal_fields))
        ], 200);
    }

    /**
     * Get coupon settings
     */
    public function get_coupon_settings($request)
    {
        $options = get_option($this->option_key, []);
        
        $coupon_fields = ['coupon_text', 'coupon_visibility', 'coupon_page_link'];
        $coupon_settings = [];
        
        foreach ($coupon_fields as $field) {
            if (isset($options[$field])) {
                $coupon_settings[$field] = $options[$field];
            }
        }

        Request_Logger::log_request($request, 200, 'Success');

        return new \WP_REST_Response([
            'success' => true,
            'data' => $coupon_settings
        ], 200);
    }

    /**
     * Update coupon settings
     */
    public function update_coupon_settings($request)
    {
        $params = $request->get_json_params();
        
        if (empty($params)) {
            Request_Logger::log_request($request, 400, 'Bad Request');
            return new \WP_Error('no_data', 'No data provided', array('status' => 400));
        }

        $current_options = get_option($this->option_key, []);
        
        $coupon_fields = ['coupon_text', 'coupon_visibility', 'coupon_page_link'];
        foreach ($params as $key => $value) {
            if (in_array($key, $coupon_fields)) {
                $current_options[$key] = $value;
            }
        }
        
        update_option($this->option_key, $current_options);
        delete_transient($this->token_key);

        Request_Logger::log_request($request, 200, 'Success');

        return new \WP_REST_Response([
            'success' => true,
            'message' => 'Coupon settings updated successfully',
            'data' => array_intersect_key($current_options, array_flip($coupon_fields))
        ], 200);
    }
}
