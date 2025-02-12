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
                    Title of Popup and Header Topbar text.
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

        <!-- Popup Image -->
        <tr>
            <td>
                <div class="wcmmq-form-control">
                    <div class="form-label col-lg-6">
                        <label for="data[popup_image]"><?php echo esc_html__('Popup Image', 'bdp-popup'); ?></label>
                    </div>
                    <div class="form-field col-lg-6">
                        <?php
                        $popup_image = $save_data['popup_image'] ?? '';
                        ?>
                        <div class="image-preview-wrapper">
                            <img id="popup-image-preview" src="<?php echo esc_url($popup_image ? $popup_image : BDP_POP_ASSETS_URL . 'images/popup-left.png'); ?>" 
                                 style="max-width: 200px; height: auto;" />
                        </div>
                        <input type="hidden" name="data[popup_image]" id="popup_image" value="<?php echo esc_attr($popup_image); ?>" />
                        <input type="button" class="button button-secondary" value="<?php echo esc_attr__('Upload Image', 'bdp-popup'); ?>" id="upload_popup_image_button" />
                        <input type="button" class="button button-secondary" value="<?php echo esc_attr__('Remove Image', 'bdp-popup'); ?>" id="remove_popup_image_button" <?php echo empty($popup_image) ? 'style="display:none;"' : ''; ?> />
                        <p class="description"><?php echo esc_html__('Upload or select an image for the popup and header. Recommended size: 300x400px', 'bdp-popup'); ?></p>
                    </div>
                </div>
            </td>
            <td>
                <div class="wcmmq-form-info">
                    <p><?php echo esc_html__('This image will be displayed in both popup and header content', 'bdp-popup'); ?></p>
                </div> 
            </td>
        </tr>

    </tbody>
</table>