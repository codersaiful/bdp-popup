<?php
$api_key = get_option($this->plugin_prefix . '_api_key');
$site_url = get_site_url();
$api_base_url = rest_url('bdp-popup/v1');

// Handle form submission
if (isset($_POST['generate_api_key']) && check_admin_referer($this->plugin_prefix . '_api', $this->plugin_prefix . '_api_nonce')) {
    $new_key = pdp_generate_access_key(32);
    update_option($this->plugin_prefix . '_api_key', $new_key);
    $api_key = $new_key;
    echo '<div class="notice notice-success is-dismissible"><p>' . esc_html__('API Access Key generated successfully!', 'bdp_pop') . '</p></div>';
}

if (isset($_POST['clear_logs']) && check_admin_referer($this->plugin_prefix . '_api', $this->plugin_prefix . '_api_nonce')) {
    \BDP_Popup\Api\Request_Logger::clear_logs();
    echo '<div class="notice notice-success is-dismissible"><p>' . esc_html__('API request logs cleared successfully!', 'bdp_pop') . '</p></div>';
}

$recent_requests = \BDP_Popup\Api\Request_Logger::get_logs(100);
?>

<div class="wrap bdp-api-settings-wrap">
    <h1><?php echo esc_html__('API Settings', 'bdp_pop'); ?></h1>
    <p class="description"><?php echo esc_html__('Manage your API access key and monitor API requests.', 'bdp_pop'); ?></p>
    
    <!-- API Access Key Section -->
    <div class="postbox">
        <div class="postbox-header">
            <h2><?php echo esc_html__('API Access Key', 'bdp_pop'); ?></h2>
        </div>
        <div class="inside">
            <?php if ($api_key): ?>
                <div class="bdp-api-key-display">
                    <label><strong><?php echo esc_html__('Your API Key:', 'bdp_pop'); ?></strong></label>
                    <code><?php echo esc_html($api_key); ?></code>
                </div>
                <div class="bdp-api-key-actions">
                    <button type="button" class="button button-secondary" onclick="navigator.clipboard.writeText('<?php echo esc_js($api_key); ?>'); alert('<?php echo esc_js(__('API Key copied to clipboard!', 'bdp_pop')); ?>');">
                        <span class="dashicons dashicons-clipboard"></span>
                        <?php echo esc_html__('Copy to Clipboard', 'bdp_pop'); ?>
                    </button>
                </div>
                <div class="bdp-warning">
                    <p>
                        <strong><?php echo esc_html__('Important:', 'bdp_pop'); ?></strong>
                        <?php echo esc_html__('Keep your API key secure. Do not share it publicly.', 'bdp_pop'); ?>
                    </p>
                </div>
            <?php else: ?>
                <p><?php echo esc_html__('No API key has been generated yet. Click the button below to generate one.', 'bdp_pop'); ?></p>
            <?php endif; ?>
            
            <form method="post" style="margin-top: 15px;">
                <?php wp_nonce_field($this->plugin_prefix . '_api', $this->plugin_prefix . '_api_nonce'); ?>
                <button type="submit" name="generate_api_key" class="button button-primary">
                    <span class="dashicons dashicons-admin-network"></span>
                    <?php echo esc_html__('Generate New API Key', 'bdp_pop'); ?>
                </button>
                <?php if ($api_key): ?>
                    <p class="description" style="margin-top: 10px; color: #d63638;">
                        <?php echo esc_html__('Warning: Generating a new key will invalidate the current key and break any existing integrations.', 'bdp_pop'); ?>
                    </p>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <!-- API Endpoints Section -->
    <div class="postbox">
        <div class="postbox-header">
            <h2><?php echo esc_html__('API Endpoints', 'bdp_pop'); ?></h2>
        </div>
        <div class="inside">
            <p><strong><?php echo esc_html__('Base URL:', 'bdp_pop'); ?></strong> <code><?php echo esc_html($api_base_url); ?></code></p>
            
            <div class="bdp-info-box">
                <h4 style="margin-top: 0;"><?php echo esc_html__('Authentication', 'bdp_pop'); ?></h4>
                <p><?php echo esc_html__('Include your API key in the request header:', 'bdp_pop'); ?></p>
                <code>X-API-Key: <?php echo esc_html($api_key ? $api_key : 'YOUR_API_KEY'); ?></code>
                <p style="margin-top: 10px;"><?php echo esc_html__('Or as a query parameter:', 'bdp_pop'); ?></p>
                <code>?api_key=<?php echo esc_html($api_key ? $api_key : 'YOUR_API_KEY'); ?></code>
            </div>

            <h4><?php echo esc_html__('Available Endpoints:', 'bdp_pop'); ?></h4>
            <ul class="bdp-endpoint-list">
                <li><span class="bdp-method-badge get">GET</span> <code>/settings</code> - <?php echo esc_html__('Get all plugin settings', 'bdp_pop'); ?></li>
                <li><span class="bdp-method-badge post">POST</span> <code>/settings</code> - <?php echo esc_html__('Update all plugin settings', 'bdp_pop'); ?></li>
                <li><span class="bdp-method-badge get">GET</span> <code>/content</code> - <?php echo esc_html__('Get content settings', 'bdp_pop'); ?></li>
                <li><span class="bdp-method-badge post">POST</span> <code>/content</code> - <?php echo esc_html__('Update content settings', 'bdp_pop'); ?></li>
                <li><span class="bdp-method-badge get">GET</span> <code>/universal</code> - <?php echo esc_html__('Get universal settings', 'bdp_pop'); ?></li>
                <li><span class="bdp-method-badge post">POST</span> <code>/universal</code> - <?php echo esc_html__('Update universal settings', 'bdp_pop'); ?></li>
                <li><span class="bdp-method-badge get">GET</span> <code>/coupon</code> - <?php echo esc_html__('Get coupon settings', 'bdp_pop'); ?></li>
                <li><span class="bdp-method-badge post">POST</span> <code>/coupon</code> - <?php echo esc_html__('Update coupon settings', 'bdp_pop'); ?></li>
            </ul>
            
            <p style="margin-top: 20px;">
                <a href="<?php echo esc_url(admin_url('admin.php?page=bdp_pop-api-docs')); ?>" class="button button-secondary">
                    <span class="dashicons dashicons-media-document"></span>
                    <?php echo esc_html__('View Full Documentation', 'bdp_pop'); ?>
                </a>
            </p>
        </div>
    </div>

    <!-- Recent API Requests Section -->
    <div class="postbox">
        <div class="postbox-header">
            <h2><?php echo esc_html__('Recent API Requests', 'bdp_pop'); ?> <span class="description">(<?php echo esc_html__('Last 100', 'bdp_pop'); ?>)</span></h2>
        </div>
        <div class="inside">
            <?php if (!empty($recent_requests)): ?>
                <div class="bdp-table-wrapper">
                    <table class="wp-list-table widefat fixed striped">
                        <thead>
                            <tr>
                                <th style="width: 15%;"><?php echo esc_html__('Time', 'bdp_pop'); ?></th>
                                <th style="width: 10%;"><?php echo esc_html__('Method', 'bdp_pop'); ?></th>
                                <th style="width: 30%;"><?php echo esc_html__('Endpoint', 'bdp_pop'); ?></th>
                                <th style="width: 20%;"><?php echo esc_html__('IP Address', 'bdp_pop'); ?></th>
                                <th style="width: 10%;"><?php echo esc_html__('Status', 'bdp_pop'); ?></th>
                                <th style="width: 15%;"><?php echo esc_html__('Message', 'bdp_pop'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recent_requests as $request): ?>
                                <tr>
                                    <td><?php echo esc_html($request['time']); ?></td>
                                    <td><span class="bdp-method-badge <?php echo strtolower(esc_attr($request['method'])); ?>"><?php echo esc_html($request['method']); ?></span></td>
                                    <td><code style="font-size: 12px;"><?php echo esc_html($request['endpoint']); ?></code></td>
                                    <td><?php echo esc_html($request['ip_address']); ?></td>
                                    <td>
                                        <span class="bdp-status-badge <?php echo $request['status_code'] == 200 ? 'success' : 'error'; ?>">
                                            <?php echo esc_html($request['status_code']); ?>
                                        </span>
                                    </td>
                                    <td><?php echo esc_html($request['status_message']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
                <form method="post" style="margin-top: 15px;">
                    <?php wp_nonce_field($this->plugin_prefix . '_api', $this->plugin_prefix . '_api_nonce'); ?>
                    <button type="submit" name="clear_logs" class="button button-secondary" onclick="return confirm('<?php echo esc_js(__('Are you sure you want to clear all API request logs?', 'bdp_pop')); ?>');">
                        <span class="dashicons dashicons-trash"></span>
                        <?php echo esc_html__('Clear Logs', 'bdp_pop'); ?>
                    </button>
                </form>
            <?php else: ?>
                <div class="bdp-no-data">
                    <span class="dashicons dashicons-info" style="font-size: 48px; color: #c3c4c7;"></span>
                    <p><?php echo esc_html__('No API requests have been logged yet.', 'bdp_pop'); ?></p>
                    <p class="description"><?php echo esc_html__('When you start using the API, request logs will appear here.', 'bdp_pop'); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
