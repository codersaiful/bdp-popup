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
                        <label for="data[popup_as_header]">Coupon Button Visibility</label>
                    </div>
                    <div class="form-field col-lg-6">
                        <?php
                        $header_chk = '';
                        $popup_as_header = $save_data['coupon_visibility'] ?? '';
                        if(!empty($popup_as_header)){
                            $header_chk = 'checked';
                        }
                        
                        ?>
                        <label class="switch">
                            <input value="1" name="data[coupon_visibility]"
                                <?php echo $header_chk; /* finding checked or null */ ?> type="checkbox" id="_tracker">
                            <div class="slider round"><!--ADDED HTML -->
                                <span class="on"><?php echo esc_html__('Show','wcmmq');?></span><span class="off"> <?php echo esc_html__('Hide','wcmmq');?></span><!--END-->
                            </div>
                        </label>
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