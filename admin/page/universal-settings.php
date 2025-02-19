<table class="wcmmq-table universal-setting">
    <thead>
        <tr>
            <th class="wcmmq-inside">
                <div class="wcmmq-table-header-inside">
                    <h3><?php echo esc_html__( 'Settings (Universal)', 'wcmmq' ); ?></h3>
                </div>
                
            </th>
            <th>
            <div class="wcmmq-table-header-right-side"></div>
            </th>
        </tr>
    </thead>

    <tbody>

    <tr>
            <td>
                <div class="wcmmq-form-control">
                    <div class="form-label col-lg-6">
                        <label for="data[visibility_all]">Visibility Header and Popup</label>
                    </div>
                    <div class="form-field col-lg-6">

                        <?php
                        $visibility_all = $save_data['visibility_all'] ?? 'off';
                        $selected_value = !empty($visibility_all) && $visibility_all == 'on' ? 'on' : 'off';
                        ?>
                        <select name="data[visibility_all]" id="data[visibility_all]" class="ua_input_select">
                            <option value="on" <?php selected($selected_value, 'on'); ?>><?php echo esc_html__('ON', 'wcmmq'); ?></option>
                            <option value="off" <?php selected($selected_value, 'off'); ?>><?php echo esc_html__('OFF', 'wcmmq'); ?></option>
                        </select>
                    </div>
                </div>
            </td>
            <td>
                <div class="wcmmq-form-info">
                    Topbar and Popup will Show or hide
                </div> 
            </td>
        </tr> 

        <tr>
            <td>
                <div class="wcmmq-form-control">
                    <div class="form-label col-lg-6">
                        <label for="data[title]">Close Date</label>
                    </div>
                    <div class="form-field col-lg-6">
                        <?php
                        $after10days = date('Y-m-d', strtotime('+10 Days'));
                        $closed_date = $save_data['closed_date'] ?? $after10days;
                        ?>
                        <input name="data[closed_date]" id="data[closed_date]" class="ua_input_number" 
                        value="<?php echo esc_attr($closed_date); ?>"  type="text" placeholder="2023-09-10 Year-Month-Day Number">
                    </div>
                </div>
            </td>
            <td>
                <div class="wcmmq-form-info">
                    <p>Remember: date format like: <?php echo esc_html( $after10days ); ?>
                    <br>After this day, poppub and header will close automatially.</p>
                </div> 
            </td>
        </tr> 
        <tr>
            <td>
                <div class="wcmmq-form-control">
                    <div class="form-label col-lg-6">
                        <label for="data[cookie_expire_time]">Loop Exire (in second)</label>
                    </div>
                    <div class="form-field col-lg-6">
                        <?php
                        $onehour = MINUTE_IN_SECONDS * 10;
                        $cookie_expire_time = $save_data['cookie_expire_time'] ?? $onehour;
                        ?>
                        <input name="data[cookie_expire_time]" id="data[cookie_expire_time]" class="ua_input_number" 
                        value="<?php echo esc_attr($cookie_expire_time); ?>"  type="number" placeholder="<?php echo esc_attr( $onehour ); ?> for 10 minutes">
                    </div>
                </div>
            </td>
            <td>
                <div class="wcmmq-form-info">
                    <p>Input as second. suppose you have input 100 second. then popup will 
                    show in each 100 second.
                    <br>Example:
                        1 minute = <code><?php echo esc_html( MINUTE_IN_SECONDS ); ?></code> seconds,,
                        1 hour = <code><?php echo esc_html( HOUR_IN_SECONDS ); ?></code> seconds, 
                        1 day = <code><?php echo esc_html( DAY_IN_SECONDS ); ?></code> seconds,
                        1 week = <code><?php echo esc_html( DAY_IN_SECONDS ); ?></code> seconds
                    </p>

                </div> 
            </td>
        </tr> 
        <tr>
            <td>
                <div class="wcmmq-form-control">
                    <div class="form-label col-lg-6">
                        <label for="data[popup_as_header]">Header Topbar</label>
                    </div>
                    <div class="form-field col-lg-6">

                    <?php
                        $popup_as_header = $save_data['popup_as_header'] ?? 'off';
                        $selected_value = !empty($popup_as_header) && $popup_as_header == 'on' ? 'on' : 'off';
                        ?>
                        <select name="data[popup_as_header]" id="data[popup_as_header]" class="ua_input_select">
                            <option value="on" <?php selected($selected_value, 'on'); ?>><?php echo esc_html__('ON', 'wcmmq'); ?></option>
                            <option value="off" <?php selected($selected_value, 'off'); ?>><?php echo esc_html__('OFF', 'wcmmq'); ?></option>
                        </select>

                    </div>
                </div>
            </td>
            <td>
                <div class="wcmmq-form-info">
                    Switch to show and hide Copun text with title for header.
                </div> 
            </td>
        </tr> 
        <tr>
            <td>
                <div class="wcmmq-form-control">
                    <div class="form-label col-lg-6">
                        <label for="data[browse_text]">Page ID (for always popup)</label>
                    </div>
                    <div class="form-field col-lg-6">
                        <?php
                        $popup_page_id = $save_data['popup_page_id'] ?? '';
                        ?>
                        <input name="data[popup_page_id]" id="data[popup_page_id]" class="ua_input_number" 
                        value="<?php echo esc_attr($popup_page_id); ?>"  type="text">
                    </div>
                </div>
            </td>
            <td>
                <div class="wcmmq-form-info">
                    <p>Header Coupon will not show to this page. Input your Page/Post ID, where Popup will show Always after your 15 seconds.</p>
                </div> 
            </td>
        </tr> 
        

        <tr>
            <td>
                <div class="wcmmq-form-control">
                    <div class="form-label col-lg-6">
                        <label for="data[topbar_position]">Header Position</label>
                    </div>
                    <div class="form-field col-lg-6">

                    <?php
                        $topbar_position = $save_data['topbar_position'] ?? 'top';
                        $selected_value = !empty($topbar_position) && $topbar_position == 'top' ? 'top' : 'bottom';
                        ?>
                        <select name="data[topbar_position]" id="data[topbar_position]" class="ua_input_select">
                            <option value="top" <?php selected($selected_value, 'top'); ?>><?php echo esc_html__('Top', 'wcmmq'); ?></option>
                            <option value="bottom" <?php selected($selected_value, 'bottom'); ?>><?php echo esc_html__('Bottom', 'wcmmq'); ?></option>
                        </select>                        
                        
                    </div>
                </div>
            </td>
            <td>
                <div class="wcmmq-form-info">
                    Switch to show and hide Copun text with title for header.
                </div> 
            </td>
        </tr> 


    </tbody>
</table>