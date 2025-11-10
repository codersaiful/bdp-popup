<?php
$api_key = get_option($this->plugin_prefix . '_api_key');
$site_url = get_site_url();
$api_base_url = rest_url('bdp-popup/v1');
?>

<div class="wrap wcmmq_wrap wcmmq-content">
    <h1 class="wp-heading"><?php echo esc_html__('API Documentation', 'bdp-popup'); ?></h1>
    
    <div class="fieldwrap">
        
        <div class="wcmmq-section-panel">
            <div style="padding: 20px;">
                <p style="margin-bottom: 20px;">
                    <?php echo esc_html__('This documentation will help you integrate with the BDP Popup API to manage your popup settings programmatically.', 'bdp-popup'); ?>
                </p>

                <div style="background: #f8f9fa; padding: 15px; border-left: 4px solid #2271b1; margin-bottom: 20px;">
                    <p><strong><?php echo esc_html__('Documentation in doc folder', 'bdp-popup'); ?></strong></p>
                    <p><?php echo esc_html__('For detailed Bengali documentation, please check the doc folder in the plugin directory:', 'bdp-popup'); ?></p>
                    <code><?php echo esc_html(plugin_dir_path(__FILE__) . '../../doc/'); ?></code>
                </div>
            </div>
        </div>

        <!-- Quick Start Section -->
        <div class="wcmmq-section-panel">
            <table class="wcmmq-table">
                <thead>
                    <tr>
                        <th class="wcmmq-inside" colspan="2">
                            <div class="wcmmq-table-header-inside">
                                <h3><?php echo esc_html__('Quick Start Guide', 'bdp-popup'); ?></h3>
                            </div>
                        </th>
                    </tr>
                </thead>
            </table>
            
            <div style="padding: 20px;">
                <h4><?php echo esc_html__('1. Authentication', 'bdp-popup'); ?></h4>
                <p><?php echo esc_html__('All API requests require authentication using your API key. You can include the key in two ways:', 'bdp-popup'); ?></p>
                
                <h5><?php echo esc_html__('Option 1: Header Authentication (Recommended)', 'bdp-popup'); ?></h5>
                <pre style="background: #f0f0f1; padding: 15px; border-radius: 4px; overflow-x: auto;"><code>curl -X GET "<?php echo esc_html($api_base_url); ?>/settings" \
  -H "X-API-Key: YOUR_API_KEY_HERE"</code></pre>

                <h5><?php echo esc_html__('Option 2: Query Parameter', 'bdp-popup'); ?></h5>
                <pre style="background: #f0f0f1; padding: 15px; border-radius: 4px; overflow-x: auto;"><code>curl -X GET "<?php echo esc_html($api_base_url); ?>/settings?api_key=YOUR_API_KEY_HERE"</code></pre>

                <hr style="margin: 30px 0;">

                <h4><?php echo esc_html__('2. Get All Settings', 'bdp-popup'); ?></h4>
                <p><strong><?php echo esc_html__('Endpoint:', 'bdp-popup'); ?></strong> <code>GET /settings</code></p>
                <pre style="background: #f0f0f1; padding: 15px; border-radius: 4px; overflow-x: auto;"><code>curl -X GET "<?php echo esc_html($api_base_url); ?>/settings" \
  -H "X-API-Key: YOUR_API_KEY_HERE"</code></pre>

                <p><strong><?php echo esc_html__('Response:', 'bdp-popup'); ?></strong></p>
                <pre style="background: #f0f0f1; padding: 15px; border-radius: 4px; overflow-x: auto;"><code>{
  "success": true,
  "data": {
    "title": "Your Popup Title",
    "message": "Your message",
    "coupon": "DISCOUNT10",
    ...
  }
}</code></pre>

                <hr style="margin: 30px 0;">

                <h4><?php echo esc_html__('3. Update Content Settings', 'bdp-popup'); ?></h4>
                <p><strong><?php echo esc_html__('Endpoint:', 'bdp-popup'); ?></strong> <code>POST /content</code></p>
                <pre style="background: #f0f0f1; padding: 15px; border-radius: 4px; overflow-x: auto;"><code>curl -X POST "<?php echo esc_html($api_base_url); ?>/content" \
  -H "X-API-Key: YOUR_API_KEY_HERE" \
  -H "Content-Type: application/json" \
  -d '{
    "title": "New Popup Title",
    "message": "Updated message",
    "coupon": "SAVE20"
  }'</code></pre>

                <hr style="margin: 30px 0;">

                <h4><?php echo esc_html__('4. Update Universal Settings', 'bdp-popup'); ?></h4>
                <p><strong><?php echo esc_html__('Endpoint:', 'bdp-popup'); ?></strong> <code>POST /universal</code></p>
                <pre style="background: #f0f0f1; padding: 15px; border-radius: 4px; overflow-x: auto;"><code>curl -X POST "<?php echo esc_html($api_base_url); ?>/universal" \
  -H "X-API-Key: YOUR_API_KEY_HERE" \
  -H "Content-Type: application/json" \
  -d '{
    "visibility_all": "on",
    "popup_as_header": "on",
    "topbar_position": "top"
  }'</code></pre>

                <hr style="margin: 30px 0;">

                <h4><?php echo esc_html__('5. Update Coupon Settings', 'bdp-popup'); ?></h4>
                <p><strong><?php echo esc_html__('Endpoint:', 'bdp-popup'); ?></strong> <code>POST /coupon</code></p>
                <pre style="background: #f0f0f1; padding: 15px; border-radius: 4px; overflow-x: auto;"><code>curl -X POST "<?php echo esc_html($api_base_url); ?>/coupon" \
  -H "X-API-Key: YOUR_API_KEY_HERE" \
  -H "Content-Type: application/json" \
  -d '{
    "coupon_text": "Get Coupon",
    "coupon_visibility": "on"
  }'</code></pre>

            </div>
        </div>

        <!-- Available Endpoints -->
        <div class="wcmmq-section-panel">
            <table class="wcmmq-table">
                <thead>
                    <tr>
                        <th class="wcmmq-inside" colspan="2">
                            <div class="wcmmq-table-header-inside">
                                <h3><?php echo esc_html__('Available Endpoints', 'bdp-popup'); ?></h3>
                            </div>
                        </th>
                    </tr>
                </thead>
            </table>
            
            <div style="padding: 20px;">
                <table class="wp-list-table widefat fixed striped">
                    <thead>
                        <tr>
                            <th style="width: 15%;"><?php echo esc_html__('Method', 'bdp-popup'); ?></th>
                            <th style="width: 35%;"><?php echo esc_html__('Endpoint', 'bdp-popup'); ?></th>
                            <th style="width: 50%;"><?php echo esc_html__('Description', 'bdp-popup'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span style="background: #2271b1; color: white; padding: 3px 8px; border-radius: 3px;">GET</span></td>
                            <td><code>/settings</code></td>
                            <td><?php echo esc_html__('Get all plugin settings', 'bdp-popup'); ?></td>
                        </tr>
                        <tr>
                            <td><span style="background: #00a32a; color: white; padding: 3px 8px; border-radius: 3px;">POST</span></td>
                            <td><code>/settings</code></td>
                            <td><?php echo esc_html__('Update all plugin settings', 'bdp-popup'); ?></td>
                        </tr>
                        <tr>
                            <td><span style="background: #2271b1; color: white; padding: 3px 8px; border-radius: 3px;">GET</span></td>
                            <td><code>/content</code></td>
                            <td><?php echo esc_html__('Get content settings (title, message, coupon, etc.)', 'bdp-popup'); ?></td>
                        </tr>
                        <tr>
                            <td><span style="background: #00a32a; color: white; padding: 3px 8px; border-radius: 3px;">POST</span></td>
                            <td><code>/content</code></td>
                            <td><?php echo esc_html__('Update content settings', 'bdp-popup'); ?></td>
                        </tr>
                        <tr>
                            <td><span style="background: #2271b1; color: white; padding: 3px 8px; border-radius: 3px;">GET</span></td>
                            <td><code>/universal</code></td>
                            <td><?php echo esc_html__('Get universal settings (visibility, closed_date, etc.)', 'bdp-popup'); ?></td>
                        </tr>
                        <tr>
                            <td><span style="background: #00a32a; color: white; padding: 3px 8px; border-radius: 3px;">POST</span></td>
                            <td><code>/universal</code></td>
                            <td><?php echo esc_html__('Update universal settings', 'bdp-popup'); ?></td>
                        </tr>
                        <tr>
                            <td><span style="background: #2271b1; color: white; padding: 3px 8px; border-radius: 3px;">GET</span></td>
                            <td><code>/coupon</code></td>
                            <td><?php echo esc_html__('Get coupon button settings', 'bdp-popup'); ?></td>
                        </tr>
                        <tr>
                            <td><span style="background: #00a32a; color: white; padding: 3px 8px; border-radius: 3px;">POST</span></td>
                            <td><code>/coupon</code></td>
                            <td><?php echo esc_html__('Update coupon button settings', 'bdp-popup'); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Error Responses -->
        <div class="wcmmq-section-panel">
            <table class="wcmmq-table">
                <thead>
                    <tr>
                        <th class="wcmmq-inside" colspan="2">
                            <div class="wcmmq-table-header-inside">
                                <h3><?php echo esc_html__('Error Responses', 'bdp-popup'); ?></h3>
                            </div>
                        </th>
                    </tr>
                </thead>
            </table>
            
            <div style="padding: 20px;">
                <h4><?php echo esc_html__('401 Unauthorized - No API Key Configured', 'bdp-popup'); ?></h4>
                <pre style="background: #f0f0f1; padding: 15px; border-radius: 4px; overflow-x: auto;"><code>{
  "code": "no_api_key",
  "message": "API key not configured",
  "data": {
    "status": 401
  }
}</code></pre>

                <h4><?php echo esc_html__('403 Forbidden - Invalid API Key', 'bdp-popup'); ?></h4>
                <pre style="background: #f0f0f1; padding: 15px; border-radius: 4px; overflow-x: auto;"><code>{
  "code": "invalid_api_key",
  "message": "Invalid API key",
  "data": {
    "status": 403
  }
}</code></pre>

                <h4><?php echo esc_html__('400 Bad Request - No Data Provided', 'bdp-popup'); ?></h4>
                <pre style="background: #f0f0f1; padding: 15px; border-radius: 4px; overflow-x: auto;"><code>{
  "code": "no_data",
  "message": "No data provided",
  "data": {
    "status": 400
  }
}</code></pre>
            </div>
        </div>

    </div>
</div>
