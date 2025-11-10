<?php
namespace BDP_Popup\Api;

use BDP_Popup\Core\Base;

class Request_Logger extends Base
{
    const LOG_OPTION_KEY = 'bdp_pop_api_requests';
    const MAX_LOGS = 100;

    /**
     * Log API request
     */
    public static function log_request($request, $status_code, $status_message)
    {
        $logs = get_option(self::LOG_OPTION_KEY, []);

        // Get request details
        $log_entry = [
            'time' => current_time('mysql'),
            'timestamp' => time(),
            'method' => $request->get_method(),
            'endpoint' => $request->get_route(),
            'ip_address' => self::get_client_ip(),
            'status_code' => $status_code,
            'status_message' => $status_message,
            'user_agent' => isset($_SERVER['HTTP_USER_AGENT']) ? sanitize_text_field($_SERVER['HTTP_USER_AGENT']) : 'Unknown',
        ];

        // Add to beginning of array
        array_unshift($logs, $log_entry);

        // Keep only last 100 entries
        if (count($logs) > self::MAX_LOGS) {
            $logs = array_slice($logs, 0, self::MAX_LOGS);
        }

        update_option(self::LOG_OPTION_KEY, $logs);
    }

    /**
     * Get all logged requests
     */
    public static function get_logs($limit = 100)
    {
        $logs = get_option(self::LOG_OPTION_KEY, []);
        
        if ($limit && count($logs) > $limit) {
            return array_slice($logs, 0, $limit);
        }

        return $logs;
    }

    /**
     * Clear all logs
     */
    public static function clear_logs()
    {
        delete_option(self::LOG_OPTION_KEY);
    }

    /**
     * Get client IP address
     */
    private static function get_client_ip()
    {
        $ip = '';
        
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = sanitize_text_field($_SERVER['HTTP_CLIENT_IP']);
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = sanitize_text_field($_SERVER['HTTP_X_FORWARDED_FOR']);
        } elseif (isset($_SERVER['HTTP_X_FORWARDED'])) {
            $ip = sanitize_text_field($_SERVER['HTTP_X_FORWARDED']);
        } elseif (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ip = sanitize_text_field($_SERVER['HTTP_FORWARDED_FOR']);
        } elseif (isset($_SERVER['HTTP_FORWARDED'])) {
            $ip = sanitize_text_field($_SERVER['HTTP_FORWARDED']);
        } elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip = sanitize_text_field($_SERVER['REMOTE_ADDR']);
        }

        return $ip;
    }
}
