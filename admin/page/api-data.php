<?php
    $my_access_key = $save_data['api_access_key'] ?? '';
    if( empty( $my_access_key ) ){
        $my_access_key = pdp_generate_access_key(18); 
    }
    
    
?>
<table class="wcmmq-table universal-setting">
    <thead>
        <tr>
            <th class="wcmmq-inside">
                <div class="wcmmq-table-header-inside">
                    <h3><?php echo esc_html__( 'API Area', 'wcmmq' ); ?> <code title="Access Key"><?php echo esc_attr($my_access_key) ?></code></h3>
                    
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
                        $api_site_url = $save_data['api_site_url'] ?? '';
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
                        $api_access_token = $save_data['api_access_token'] ?? '';
                        // if (! empty( $api_access_token ) ) {
                        //     $api_access_token = '';
                        // }
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
        <?php if( ! empty( $api_site_url ) && ! empty( $api_access_token ) ){ ?>
        <tr>
            <td>
                <div class="wcmmq-form-control">
                    <div class="form-label col-lg-6">
                        <label for="data[api_access_token]">Connection Status</label>
                    </div>
                    <div class="form-field col-lg-6">
                        <?php
                        $api = \BDP_Popup\Frontend\API::init();
                        $remote_options = $api->get_remote();
                        if(empty($remote_options)){
                            echo '<p style="color:red">Connection Error</p>';
                            echo '<p style="color:gray">[Target Site] error, Check your target site url.</p>';
                        }else if(  ! empty( $remote_options ) && is_array( $remote_options )){
                            if( isset( $remote_options['status'] ) && $remote_options['status'] == true ){
                                echo '<span style="color:green">Connection Success</span>';
                            }else if( ! empty( $remote_options['status_message'] ) ){ 
                                echo '<p style="color:red">Connection Error</p>';
                                echo '<span style="color:orange">' . $remote_options['status_message'] . '</span>';
                            }else{
                                echo '<span style="color:orange">Unknown Error</span>';
                            }
                        }
                        delete_transient( $this->token_key );

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