<table class="wcmmq-table universal-setting">
    <thead>
        <tr>
            <th class="wcmmq-inside">
                <div class="wcmmq-table-header-inside">
                    <h3><?php echo esc_html__( 'Conent & Message', 'wcmmq' ); ?></h3>
                </div>
                
            </th>
            <th>
            <div class="wcmmq-table-header-right-side"></div>
            </th>
        </tr>
    </thead>

    <tbody>

<!--     
        <tr>
            <td>
                <div class="wcmmq-form-control">
                    <div class="form-label col-lg-6">
                        LabelTagHere
                    </div>
                    <div class="form-field col-lg-6">
                        InputFieldOrAnyOtherField
                    </div>
                </div>
            </td>
            <td>
                <div class="wcmmq-form-info">
                    DescriptionOfField_and_docLink
                </div> 
            </td>
        </tr> 
-->

        <tr>
            <td>
                <div class="wcmmq-form-control">
                    <div class="form-label col-lg-6">
                        <label for="data[title]">Title</label>
                    </div>
                    <div class="form-field col-lg-6">
                        <?php
                        $title = $save_data['title'] ?? '';
                        ?>
                        <input name="data[title]" id="data[title]" class="ua_input_number" 
                        value="<?php echo esc_attr($title); ?>"  type="text">
                    </div>
                </div>
            </td>
            <td>
                <div class="wcmmq-form-info">
                    DescriptionOfField_and_docLink
                </div> 
            </td>
        </tr> 
        <tr>
            <td>
                <div class="wcmmq-form-control">
                    <div class="form-label col-lg-6">
                        <label for="data[message]">Long Text</label>
                    </div>
                    <div class="form-field col-lg-6">
                        <?php
                        $message = $save_data['message'] ?? '';
                        ?>
                        <input name="data[message]" id="data[message]" class="ua_input_number" 
                        value="<?php echo esc_attr($message); ?>"  type="text">
                    </div>
                </div>
            </td>
            <td>
                <div class="wcmmq-form-info">
                    It shows on popup as a message text. input a simple direction or a message
                </div> 
            </td>
        </tr> 
        <tr>
            <td>
                <div class="wcmmq-form-control">
                    <div class="form-label col-lg-6">
                        <label for="data[coupon]">Coupon Code</label>
                    </div>
                    <div class="form-field col-lg-6">
                        <?php
                        $coupon = $save_data['coupon'] ?? '';
                        ?>
                        <input name="data[coupon]" id="data[coupon]" class="ua_input_number" 
                        value="<?php echo esc_attr($coupon); ?>"  type="text">
                    </div>
                </div>
            </td>
            <td>
                <div class="wcmmq-form-info">
                    Only Coupon code input here.
                </div> 
            </td>
        </tr> 
        <tr>
            <td>
                <div class="wcmmq-form-control">
                    <div class="form-label col-lg-6">
                        <label for="data[browse_text]">Browse Link Text</label>
                    </div>
                    <div class="form-field col-lg-6">
                        <?php
                        $browse_text = $save_data['browse_text'] ?? '';
                        ?>
                        <input name="data[browse_text]" id="data[browse_text]" class="ua_input_number" 
                        value="<?php echo esc_attr($browse_text); ?>"  type="text">
                    </div>
                </div>
            </td>
            <td>
                <div class="wcmmq-form-info">
                    Input Browse button text.
                </div> 
            </td>
        </tr> 
        <tr>
            <td>
                <div class="wcmmq-form-control">
                    <div class="form-label col-lg-6">
                        <label for="data[browse_link]">Browse Link Text</label>
                    </div>
                    <div class="form-field col-lg-6">
                        <?php
                        $browse_link = $save_data['browse_link'] ?? 'https://codeastrology.com';
                        ?>
                        <input name="data[browse_link]" id="data[browse_link]" class="ua_input_number" 
                        value="<?php echo esc_attr($browse_link); ?>"  type="text">
                    </div>
                </div>
            </td>
            <td>
                <div class="wcmmq-form-info">
                    Input Browse link with https:// or with http://
                </div> 
            </td>
        </tr> 



    </tbody>
</table>