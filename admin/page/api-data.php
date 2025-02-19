<?php
    $my_access_key = $save_data['api_access_key'] ?? '';
    if( empty( $my_access_key ) ){
        $my_access_key = pdp_generate_access_key(18); 
    }
    $api_site_url = $save_data['api_site_url'] ?? '';
    $api_access_token = $save_data['api_access_token'] ?? '';

    $connection_status_show = $connection_status_output = false;
    $connection_class = 'hide';
    if( ! empty( $api_site_url ) && ! empty( $api_access_token ) ){
        $connection_class = 'connection_problem';
        $connection_status_show = true;
        $api = \BDP_Popup\Frontend\API::init();
        $remote_options = $api->get_remote();

        if(empty($remote_options)){
            $connection_status_output .= '<p style="color:red">Connection Error</p>';
            $connection_status_output .= '<p style="color:gray">[Target Site] error, Check your target site url.</p>';
        }else if(  ! empty( $remote_options ) && is_array( $remote_options )){
            if( isset( $remote_options['status'] ) && $remote_options['status'] == true ){

                //We will keep at backup on options, because, transition will delete after 8000 seconds
                update_option( $this->backup_option_key, $remote_options );
                $connection_class = 'connection_success';
                $connection_status_output .= '<span style="color:green">Connection Success</span>';
            }else if( ! empty( $remote_options['status_message'] ) ){ 
                $connection_status_output .= '<p style="color:red">Connection Error</p>';
                $connection_status_output .= '<span style="color:orange">' . $remote_options['status_message'] . '</span>';
            }else{
                $connection_status_output .= '<p style="color:orange">Unknown Error</p>';
                if( ! empty( $remote_options['message'] ) ){
                    $connection_status_output .= '<code style="color:gray">' . $remote_options['message'] . '</code>';
                }
                
            }
        }
        delete_transient( $this->token_key );
    }
    
?>

<button type="submit" class="wcmmq-btn wcmmq-btn-tiny reset wcmmq-has-icon wcmmq-show-api-area" id="wcmmq-show-api-area-btn">
    <span><i class="wcmmq_icon-plug"></i></span>
    <strong class="form-submit-text">SHOW API AREA</strong>
</button>
<table class="wcmmq-table api-setting-table table-<?php echo esc_attr($connection_class); ?>">
    <thead>
        <tr>
            <th class="wcmmq-inside">
                <div class="wcmmq-table-header-inside">
                    <h3><?php echo esc_html__( 'API Area', 'wcmmq' ); ?> <code class="this-site-access-key" title="Access Key"><?php echo esc_attr($my_access_key) ?></code></h3>
                    
                </div>
                
            </th>
            <th>
            <div class="wcmmq-table-header-right-side">

             <p><?php echo esc_html__( 'If u sent your API site, data will come from API and this site data will override, if you input.', 'wcmmq' ); ?></p>
            </div>
            </th>
        </tr>
    </thead>

    <tbody>



        
        <tr>
            <td>
                <div class="wcmmq-form-control">
                    
                    <input name="data[api_access_key]" class="ua_hidden" 
                    value="<?php echo esc_attr($my_access_key); ?>"  type="hidden">
                    
                </div>
                <div class="wcmmq-form-control">
                    <div class="form-label col-lg-6">
                        <label for="data[api_site_url]">Target Site</label>
                    </div>
                    <div class="form-field col-lg-6">
                        <?php
                        
                        if (! empty( $api_site_url ) && ! filter_var($api_site_url, FILTER_VALIDATE_URL)) {
                            $api_site_url = '';
                        }
                        ?>
                        <input name="data[api_site_url]" id="data[api_site_url]" class="ua_input_number" 
                        value="<?php echo esc_attr($api_site_url); ?>"  type="text">
                    </div>
                </div>
            </td>
            <td>
                <div class="wcmmq-form-info">
                    <p><?php echo esc_html__( 'Your target site url.', 'wcmmq' ); ?></p>

                </div> 
            </td>
        </tr> 
        <tr>
            <td>
                <div class="wcmmq-form-control">
                    <div class="form-label col-lg-6">
                        <label for="data[api_access_token]">Access Token</label>
                    </div>
                    <div class="form-field col-lg-6">
                        <?php
                        
                        ?>
                        <input name="data[api_access_token]" id="data[api_access_token]" class="ua_input_number" 
                        value="<?php echo esc_attr($api_access_token); ?>"  type="text">
                    </div>
                </div>
            </td>
            <td>
                <div class="wcmmq-form-info">
                    <p><?php echo esc_html__( 'Your target site url.', 'wcmmq' ); ?></p>

                </div> 
            </td>
        </tr> 
        <?php if( $connection_status_show ){ ?>
        <tr>
            <td>
                <div class="wcmmq-form-control">
                    <div class="form-label col-lg-6">
                        <label for="data[api_access_token]">Connection Status</label>
                    </div>
                    <div class="form-field col-lg-6">
                        <?php
                        echo wp_kses_post($connection_status_output);

                        ?>
                        
                    </div>
                </div>
            </td>
            <td>
                <div class="wcmmq-form-info">
                    

                </div> 
            </td>
        </tr> 
        <?php } ?>
    </tbody>
</table>
<?php if($connection_class === 'connection_success'){ ?>
    <button class="wcmmq-btn wcmmq-btn-tiny reset wcmmq-has-icon wcmmq-show-customize-area" id="wcmmq-show-customize-area-btn">
        <span><i class="wcmmq_icon-plug"></i></span>
        <strong class="form-submit-text">Customized Settings</strong>
    </button>
<?php } ?>
