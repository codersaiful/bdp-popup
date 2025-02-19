<table class="wcmmq-table universal-setting">
    <thead>
        <tr>
            <th class="wcmmq-inside">
                <div class="wcmmq-table-header-inside">
                    <h3><?php echo esc_html__( 'Sidebar Coupon Button', 'wcmmq' ); ?></h3>
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
                        <label for="data[coupon_text]">Coupon Text</label>
                    </div>
                    <div class="form-field col-lg-6">
                        <?php
                        $coupon_text = $save_data['coupon_text'] ?? 'Coupon';
                        ?>
                        <input name="data[coupon_text]" id="data[coupon_text]" class="ua_input_number" 
                        value="<?php echo esc_attr($coupon_text); ?>"  type="text">
                    </div>
                </div>
            </td>
            <td>
                <div class="wcmmq-form-info">
                    <p>Your coupon text. Default: Coupon</p>

                </div> 
            </td>
        </tr> 
        <tr>
            <td>
                <div class="wcmmq-form-control">
                    <div class="form-label col-lg-6">
                        <label for="data[coupon_visibility]">Coupon Button Visibility</label>
                    </div>
                    <div class="form-field col-lg-6">
                        <?php
                        $coupon_visibility = $save_data['coupon_visibility'] ?? 'off';
                        $selected_value = !empty($coupon_visibility) && $coupon_visibility == 'on' ? 'on' : 'off';
                        ?>
                        <select name="data[coupon_visibility]" id="data[coupon_visibility]" class="ua_input_select">
                            <option value="on" <?php selected($selected_value, 'on'); ?>><?php echo esc_html__('Show', 'wcmmq'); ?></option>
                            <option value="off" <?php selected($selected_value, 'off'); ?>><?php echo esc_html__('Hide', 'wcmmq'); ?></option>
                        </select>
                    </div>
                </div>
            </td>
            <td>
                <div class="wcmmq-form-info">
                    Switch to show and hide Copun box.
                </div> 
            </td>
        </tr> 
        <tr>
            <td>
                <div class="wcmmq-form-control">
                    <div class="form-label col-lg-6">
                        <label for="data[coupon_page_link]">Coupon Page Link</label>
                    </div>
                    <div class="form-field col-lg-6">
                        <?php
                        $coupon_page_link = $save_data['coupon_page_link'] ?? '';
                        ?>
                        <input name="data[coupon_page_link]" id="data[coupon_page_link]" class="ua_input_number" 
                        value="<?php echo esc_attr($coupon_page_link); ?>"  type="url">
                    </div>
                </div>
            </td>
            <td>
                <div class="wcmmq-form-info">
                    <p>Input your page link, where u want to show coupon</p>
                </div> 
            </td>
        </tr> 
        



    </tbody>
</table>