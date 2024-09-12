<table class="wcmmq-table universal-setting">
    <thead>
        <tr>
            <th class="wcmmq-inside">
                <div class="wcmmq-table-header-inside">
                    <h3><?php echo esc_html__( 'Get Data by API', 'wcmmq' ); ?></h3>
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
                        <label for="data[api_access_token]">Target Site</label>
                    </div>
                    <div class="form-field col-lg-6">
                        <?php
                        $api_access_token = $save_data['api_access_token'] ?? '';
                        if (! empty( $api_access_token ) && ! filter_var($api_access_token, FILTER_VALIDATE_URL)) {
                            $api_access_token = '';
                        }
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

    </tbody>
</table>