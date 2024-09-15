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
                        $header_chk = '';
                        $visibility_all = $save_data['visibility_all'] ?? '';
                        if(!empty($visibility_all)){
                            $header_chk = 'checked';
                        }
                        
                        ?>
                        <label class="switch">
                            <input value="1" name="data[visibility_all]"
                                <?php echo $header_chk; /* finding checked or null */ ?> type="checkbox" id="_tracker">
                            <div class="slider round"><!--ADDED HTML -->
                                <span class="on"><?php echo esc_html__('ON','wcmmq');?></span><span class="off"> <?php echo esc_html__('OFF','wcmmq');?></span><!--END-->
                            </div>
                        </label>
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
                        $header_chk = '';
                        $popup_as_header = $save_data['popup_as_header'] ?? '';
                        if(!empty($popup_as_header)){
                            $header_chk = 'checked';
                        }
                        
                        ?>
                        <label class="switch">
                            <input value="1" name="data[popup_as_header]"
                                <?php echo $header_chk; /* finding checked or null */ ?> type="checkbox" id="_tracker">
                            <div class="slider round"><!--ADDED HTML -->
                                <span class="on"><?php echo esc_html__('ON','wcmmq');?></span><span class="off"> <?php echo esc_html__('OFF','wcmmq');?></span><!--END-->
                            </div>
                        </label>
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
        



    </tbody>
</table>