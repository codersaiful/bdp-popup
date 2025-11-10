<?php
$api_key = get_option($this->plugin_prefix . '_api_key');
$site_url = get_site_url();
$api_base_url = rest_url('bdp-popup/v1');
?>

<div class="wrap bdp-api-settings-wrap">
    <h1><?php echo esc_html__('API Documentation', 'bdp-popup'); ?></h1>
    <p class="description"><?php echo esc_html__('Learn how to integrate with the BDP Popup API to manage your popup settings programmatically.', 'bdp-popup'); ?></p>
    
    <!-- Quick Start Guide -->
    <div class="postbox">
        <div class="postbox-header">
            <h2><?php echo esc_html__('Quick Start Guide', 'bdp-popup'); ?></h2>
        </div>
        <div class="inside">
            <div class="bdp-info-box">
                <p><strong><?php echo esc_html__('Note:', 'bdp-popup'); ?></strong> <?php echo esc_html__('For detailed Bengali documentation, please check the doc folder in the plugin directory.', 'bdp-popup'); ?></p>
            </div>

            <h3><?php echo esc_html__('Authentication', 'bdp-popup'); ?></h3>
            <p><?php echo esc_html__('All API requests require authentication using your API key. You can include the key in two ways:', 'bdp-popup'); ?></p>
            
            <h4><?php echo esc_html__('Option 1: Header Authentication (Recommended)', 'bdp-popup'); ?></h4>
            <div class="bdp-code-block">
                <code>curl -X GET "<?php echo esc_html($api_base_url); ?>/settings" \
  -H "X-API-Key: <?php echo esc_html($api_key ? $api_key : 'YOUR_API_KEY_HERE'); ?>"</code>
            </div>

            <h4><?php echo esc_html__('Option 2: Query Parameter', 'bdp-popup'); ?></h4>
            <div class="bdp-code-block">
                <code>curl -X GET "<?php echo esc_html($api_base_url); ?>/settings?api_key=<?php echo esc_html($api_key ? $api_key : 'YOUR_API_KEY_HERE'); ?>"</code>
            </div>
        </div>
    </div>

    <!-- API Examples -->
    <div class="postbox">
        <div class="postbox-header">
            <h2><?php echo esc_html__('API Request Examples', 'bdp-popup'); ?></h2>
        </div>
        <div class="inside">
            <h3><?php echo esc_html__('1. Get All Settings', 'bdp-popup'); ?></h3>
            <p><strong><?php echo esc_html__('Endpoint:', 'bdp-popup'); ?></strong> <span class="bdp-method-badge get">GET</span> <code>/settings</code></p>
            <div class="bdp-code-block">
                <code>curl -X GET "<?php echo esc_html($api_base_url); ?>/settings" \
  -H "X-API-Key: <?php echo esc_html($api_key ? $api_key : 'YOUR_API_KEY_HERE'); ?>"</code>
            </div>
            
            <h4><?php echo esc_html__('Response:', 'bdp-popup'); ?></h4>
            <div class="bdp-code-block">
                <code>{
  "success": true,
  "data": {
    "title": "Your Popup Title",
    "message": "Your message",
    "coupon": "DISCOUNT10",
    "visibility_all": "on",
    ...
  }
}</code>
            </div>

            <hr style="margin: 30px 0; border: 0; border-top: 1px solid #dcdcde;">

            <h3><?php echo esc_html__('2. Update Content Settings', 'bdp-popup'); ?></h3>
            <p><strong><?php echo esc_html__('Endpoint:', 'bdp-popup'); ?></strong> <span class="bdp-method-badge post">POST</span> <code>/content</code></p>
            <div class="bdp-code-block">
                <code>curl -X POST "<?php echo esc_html($api_base_url); ?>/content" \
  -H "X-API-Key: <?php echo esc_html($api_key ? $api_key : 'YOUR_API_KEY_HERE'); ?>" \
  -H "Content-Type: application/json" \
  -d '{
    "title": "New Popup Title",
    "message": "Updated message",
    "coupon": "SAVE20"
  }'</code>
            </div>

            <h4><?php echo esc_html__('Response:', 'bdp-popup'); ?></h4>
            <div class="bdp-code-block">
                <code>{
  "success": true,
  "message": "Content settings updated successfully"
}</code>
            </div>

            <hr style="margin: 30px 0; border: 0; border-top: 1px solid #dcdcde;">

            <h3><?php echo esc_html__('3. Update Universal Settings', 'bdp-popup'); ?></h3>
            <p><strong><?php echo esc_html__('Endpoint:', 'bdp-popup'); ?></strong> <span class="bdp-method-badge post">POST</span> <code>/universal</code></p>
            <div class="bdp-code-block">
                <code>curl -X POST "<?php echo esc_html($api_base_url); ?>/universal" \
  -H "X-API-Key: <?php echo esc_html($api_key ? $api_key : 'YOUR_API_KEY_HERE'); ?>" \
  -H "Content-Type: application/json" \
  -d '{
    "visibility_all": "on",
    "popup_as_header": "on",
    "topbar_position": "top"
  }'</code>
            </div>

            <hr style="margin: 30px 0; border: 0; border-top: 1px solid #dcdcde;">

            <h3><?php echo esc_html__('4. Update Coupon Settings', 'bdp-popup'); ?></h3>
            <p><strong><?php echo esc_html__('Endpoint:', 'bdp-popup'); ?></strong> <span class="bdp-method-badge post">POST</span> <code>/coupon</code></p>
            <div class="bdp-code-block">
                <code>curl -X POST "<?php echo esc_html($api_base_url); ?>/coupon" \
  -H "X-API-Key: <?php echo esc_html($api_key ? $api_key : 'YOUR_API_KEY_HERE'); ?>" \
  -H "Content-Type: application/json" \
  -d '{
    "coupon_text": "Get Coupon",
    "coupon_visibility": "on"
  }'</code>
            </div>
        </div>
    </div>

    <!-- Available Endpoints Table -->
    <div class="postbox">
        <div class="postbox-header">
            <h2><?php echo esc_html__('Available Endpoints', 'bdp-popup'); ?></h2>
        </div>
        <div class="inside">
            <div class="bdp-table-wrapper">
                <table class="wp-list-table widefat fixed striped">
                    <thead>
                        <tr>
                            <th style="width: 15%;"><?php echo esc_html__('Method', 'bdp-popup'); ?></th>
                            <th style="width: 30%;"><?php echo esc_html__('Endpoint', 'bdp-popup'); ?></th>
                            <th style="width: 55%;"><?php echo esc_html__('Description', 'bdp-popup'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class="bdp-method-badge get">GET</span></td>
                            <td><code>/settings</code></td>
                            <td><?php echo esc_html__('Get all plugin settings', 'bdp-popup'); ?></td>
                        </tr>
                        <tr>
                            <td><span class="bdp-method-badge post">POST</span></td>
                            <td><code>/settings</code></td>
                            <td><?php echo esc_html__('Update all plugin settings', 'bdp-popup'); ?></td>
                        </tr>
                        <tr>
                            <td><span class="bdp-method-badge get">GET</span></td>
                            <td><code>/content</code></td>
                            <td><?php echo esc_html__('Get content settings (title, message, coupon, etc.)', 'bdp-popup'); ?></td>
                        </tr>
                        <tr>
                            <td><span class="bdp-method-badge post">POST</span></td>
                            <td><code>/content</code></td>
                            <td><?php echo esc_html__('Update content settings', 'bdp-popup'); ?></td>
                        </tr>
                        <tr>
                            <td><span class="bdp-method-badge get">GET</span></td>
                            <td><code>/universal</code></td>
                            <td><?php echo esc_html__('Get universal settings (visibility, closed_date, etc.)', 'bdp-popup'); ?></td>
                        </tr>
                        <tr>
                            <td><span class="bdp-method-badge post">POST</span></td>
                            <td><code>/universal</code></td>
                            <td><?php echo esc_html__('Update universal settings', 'bdp-popup'); ?></td>
                        </tr>
                        <tr>
                            <td><span class="bdp-method-badge get">GET</span></td>
                            <td><code>/coupon</code></td>
                            <td><?php echo esc_html__('Get coupon button settings', 'bdp-popup'); ?></td>
                        </tr>
                        <tr>
                            <td><span class="bdp-method-badge post">POST</span></td>
                            <td><code>/coupon</code></td>
                            <td><?php echo esc_html__('Update coupon button settings', 'bdp-popup'); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Error Responses -->
    <div class="postbox">
        <div class="postbox-header">
            <h2><?php echo esc_html__('Error Responses', 'bdp-popup'); ?></h2>
        </div>
        <div class="inside">
            <h3><?php echo esc_html__('401 Unauthorized - No API Key Configured', 'bdp-popup'); ?></h3>
            <p><?php echo esc_html__('This error occurs when the API key has not been generated yet.', 'bdp-popup'); ?></p>
            <div class="bdp-code-block">
                <code>{
  "code": "no_api_key",
  "message": "API key not configured",
  "data": {
    "status": 401
  }
}</code>
            </div>

            <h3><?php echo esc_html__('403 Forbidden - Invalid API Key', 'bdp-popup'); ?></h3>
            <p><?php echo esc_html__('This error occurs when the provided API key does not match the configured key.', 'bdp-popup'); ?></p>
            <div class="bdp-code-block">
                <code>{
  "code": "invalid_api_key",
  "message": "Invalid API key",
  "data": {
    "status": 403
  }
}</code>
            </div>

            <h3><?php echo esc_html__('400 Bad Request - No Data Provided', 'bdp-popup'); ?></h3>
            <p><?php echo esc_html__('This error occurs when making a POST request without providing data.', 'bdp-popup'); ?></p>
            <div class="bdp-code-block">
                <code>{
  "code": "no_data",
  "message": "No data provided",
  "data": {
    "status": 400
  }
}</code>
            </div>

            <h3><?php echo esc_html__('200 Success', 'bdp-popup'); ?></h3>
            <p><?php echo esc_html__('Successful requests return a 200 status code with the requested data or confirmation.', 'bdp-popup'); ?></p>
            <div class="bdp-code-block">
                <code>{
  "success": true,
  "data": { ... }
}</code>
            </div>
        </div>
    </div>

    <!-- Back to Settings -->
    <p>
        <a href="<?php echo esc_url(admin_url('admin.php?page=bdp_pop-api')); ?>" class="button button-primary">
            <span class="dashicons dashicons-admin-generic"></span>
            <?php echo esc_html__('Back to API Settings', 'bdp-popup'); ?>
        </a>
    </p>
</div>
