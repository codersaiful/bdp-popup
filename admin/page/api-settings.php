<?php
$api_key = get_option($this->plugin_prefix . '_api_key');
$site_url = get_site_url();
$api_base_url = rest_url('bdp-popup/v1');

// Handle form submission
if (isset($_POST['generate_api_key']) && check_admin_referer($this->plugin_prefix . '_api', $this->plugin_prefix . '_api_nonce')) {
    $new_key = pdp_generate_access_key(32);
    update_option($this->plugin_prefix . '_api_key', $new_key);
    $api_key = $new_key;
    echo '<div class="notice notice-success"><p>API Access Key generated successfully!</p></div>';
}

if (isset($_POST['clear_logs']) && check_admin_referer($this->plugin_prefix . '_api', $this->plugin_prefix . '_api_nonce')) {
    \BDP_Popup\Api\Request_Logger::clear_logs();
    echo '<div class="notice notice-success"><p>API request logs cleared successfully!</p></div>';
}

$recent_requests = \BDP_Popup\Api\Request_Logger::get_logs(100);
?>

<div class="wrap wcmmq_wrap wcmmq-content">
    <h1 class="wp-heading"><?php echo esc_html__('API Settings', 'bdp-popup'); ?></h1>
    
    <div class="fieldwrap">
        
        <!-- API Access Key Section -->
        <div class="wcmmq-section-panel">
            <table class="wcmmq-table">
                <thead>
                    <tr>
                        <th class="wcmmq-inside">
                            <div class="wcmmq-table-header-inside">
                                <h3><?php echo esc_html__('API Access Key', 'bdp-popup'); ?></h3>
                            </div>
                        </th>
                        <th>
                            <div class="wcmmq-table-header-right-side">
                                <p><?php echo esc_html__('Generate and manage your API access key', 'bdp-popup'); ?></p>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="wcmmq-form-control">
                                <div class="form-label col-lg-6">
                                    <label><?php echo esc_html__('Current API Key', 'bdp-popup'); ?></label>
                                </div>
                                <div class="form-field col-lg-6">
                                    <?php if ($api_key): ?>
                                        <code style="padding: 10px; background: #f0f0f1; display: inline-block; word-break: break-all;"><?php echo esc_html($api_key); ?></code>
                                        <button type="button" class="button" onclick="navigator.clipboard.writeText('<?php echo esc_js($api_key); ?>'); alert('API Key copied to clipboard!');">
                                            <?php echo esc_html__('Copy', 'bdp-popup'); ?>
                                        </button>
                                    <?php else: ?>
                                        <p style="color: #999;"><?php echo esc_html__('No API key generated yet', 'bdp-popup'); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="wcmmq-form-info">
                                <p><?php echo esc_html__('Use this key to authenticate your API requests', 'bdp-popup'); ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <form method="post" style="margin-top: 10px;">
                                <?php wp_nonce_field($this->plugin_prefix . '_api', $this->plugin_prefix . '_api_nonce'); ?>
                                <button type="submit" name="generate_api_key" class="wcmmq-btn wcmmq-has-icon">
                                    <span><i class="wcmmq_icon-key"></i></span>
                                    <strong><?php echo esc_html__('Generate New API Key', 'bdp-popup'); ?></strong>
                                </button>
                                <?php if ($api_key): ?>
                                    <p style="color: #d63638; margin-top: 10px;">
                                        <strong><?php echo esc_html__('Warning:', 'bdp-popup'); ?></strong>
                                        <?php echo esc_html__('Generating a new key will invalidate the current key', 'bdp-popup'); ?>
                                    </p>
                                <?php endif; ?>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- API Endpoints Section -->
        <div class="wcmmq-section-panel">
            <table class="wcmmq-table">
                <thead>
                    <tr>
                        <th class="wcmmq-inside">
                            <div class="wcmmq-table-header-inside">
                                <h3><?php echo esc_html__('API Endpoints', 'bdp-popup'); ?></h3>
                            </div>
                        </th>
                        <th>
                            <div class="wcmmq-table-header-right-side">
                                <p><?php echo esc_html__('Available API endpoints for your plugin', 'bdp-popup'); ?></p>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2">
                            <div style="padding: 15px;">
                                <p><strong><?php echo esc_html__('Base URL:', 'bdp-popup'); ?></strong> <code><?php echo esc_html($api_base_url); ?></code></p>
                                
                                <h4 style="margin-top: 20px;"><?php echo esc_html__('Available Endpoints:', 'bdp-popup'); ?></h4>
                                <ul style="list-style: disc; margin-left: 20px;">
                                    <li><code>GET <?php echo esc_html($api_base_url); ?>/settings</code> - <?php echo esc_html__('Get all settings', 'bdp-popup'); ?></li>
                                    <li><code>POST <?php echo esc_html($api_base_url); ?>/settings</code> - <?php echo esc_html__('Update all settings', 'bdp-popup'); ?></li>
                                    <li><code>GET <?php echo esc_html($api_base_url); ?>/content</code> - <?php echo esc_html__('Get content settings', 'bdp-popup'); ?></li>
                                    <li><code>POST <?php echo esc_html($api_base_url); ?>/content</code> - <?php echo esc_html__('Update content settings', 'bdp-popup'); ?></li>
                                    <li><code>GET <?php echo esc_html($api_base_url); ?>/universal</code> - <?php echo esc_html__('Get universal settings', 'bdp-popup'); ?></li>
                                    <li><code>POST <?php echo esc_html($api_base_url); ?>/universal</code> - <?php echo esc_html__('Update universal settings', 'bdp-popup'); ?></li>
                                    <li><code>GET <?php echo esc_html($api_base_url); ?>/coupon</code> - <?php echo esc_html__('Get coupon settings', 'bdp-popup'); ?></li>
                                    <li><code>POST <?php echo esc_html($api_base_url); ?>/coupon</code> - <?php echo esc_html__('Update coupon settings', 'bdp-popup'); ?></li>
                                </ul>

                                <p style="margin-top: 15px;">
                                    <strong><?php echo esc_html__('Authentication:', 'bdp-popup'); ?></strong><br>
                                    <?php echo esc_html__('Include your API key in the request header as', 'bdp-popup'); ?>: <code>X-API-Key: YOUR_API_KEY</code><br>
                                    <?php echo esc_html__('Or include it as a query parameter', 'bdp-popup'); ?>: <code>?api_key=YOUR_API_KEY</code>
                                </p>
                                
                                <p style="margin-top: 15px;">
                                    <a href="<?php echo esc_url(admin_url('admin.php?page=bdp_pop-api-docs')); ?>" class="button button-primary">
                                        <?php echo esc_html__('View Full Documentation', 'bdp-popup'); ?>
                                    </a>
                                </p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Recent API Requests Section -->
        <div class="wcmmq-section-panel">
            <table class="wcmmq-table">
                <thead>
                    <tr>
                        <th class="wcmmq-inside" colspan="2">
                            <div class="wcmmq-table-header-inside">
                                <h3><?php echo esc_html__('Recent API Requests (Last 100)', 'bdp-popup'); ?></h3>
                            </div>
                        </th>
                    </tr>
                </thead>
            </table>
            
            <?php if (!empty($recent_requests)): ?>
                <div style="overflow-x: auto; padding: 15px;">
                    <table class="wp-list-table widefat fixed striped" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 15%;"><?php echo esc_html__('Time', 'bdp-popup'); ?></th>
                                <th style="width: 10%;"><?php echo esc_html__('Method', 'bdp-popup'); ?></th>
                                <th style="width: 25%;"><?php echo esc_html__('Endpoint', 'bdp-popup'); ?></th>
                                <th style="width: 20%;"><?php echo esc_html__('IP Address', 'bdp-popup'); ?></th>
                                <th style="width: 15%;"><?php echo esc_html__('Status', 'bdp-popup'); ?></th>
                                <th style="width: 15%;"><?php echo esc_html__('Message', 'bdp-popup'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recent_requests as $request): ?>
                                <tr>
                                    <td><?php echo esc_html($request['time']); ?></td>
                                    <td><span class="badge" style="background: #2271b1; color: white; padding: 3px 8px; border-radius: 3px;"><?php echo esc_html($request['method']); ?></span></td>
                                    <td><code style="font-size: 11px;"><?php echo esc_html($request['endpoint']); ?></code></td>
                                    <td><?php echo esc_html($request['ip_address']); ?></td>
                                    <td>
                                        <span class="badge" style="background: <?php echo $request['status_code'] == 200 ? '#00a32a' : '#d63638'; ?>; color: white; padding: 3px 8px; border-radius: 3px;">
                                            <?php echo esc_html($request['status_code']); ?>
                                        </span>
                                    </td>
                                    <td><?php echo esc_html($request['status_message']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    
                    <form method="post" style="margin-top: 15px;">
                        <?php wp_nonce_field($this->plugin_prefix . '_api', $this->plugin_prefix . '_api_nonce'); ?>
                        <button type="submit" name="clear_logs" class="button" onclick="return confirm('Are you sure you want to clear all API request logs?');">
                            <?php echo esc_html__('Clear Logs', 'bdp-popup'); ?>
                        </button>
                    </form>
                </div>
            <?php else: ?>
                <div style="padding: 20px; text-align: center; color: #999;">
                    <p><?php echo esc_html__('No API requests logged yet', 'bdp-popup'); ?></p>
                </div>
            <?php endif; ?>
        </div>

    </div>
</div>
