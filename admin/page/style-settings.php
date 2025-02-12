<?php
$save_data = $this->options;
?>
<table class="wcmmq-table style-setting">
    <thead>
        <tr>
            <th class="wcmmq-inside">
                <div class="wcmmq-table-header-inside">
                    <h3><?php echo esc_html__( 'Style Settings', 'bdp-popup' ); ?></h3>
                </div>
            </th>
            <th>
                <div class="wcmmq-table-header-right-side">
                    <p><?php echo esc_html__( 'Customize the appearance of your popup and header bar', 'bdp-popup' ); ?></p>
                </div>
            </th>
        </tr>
    </thead>

    <tbody>
        <!-- Popup Background Color -->
        <tr>
            <td>
                <div class="wcmmq-form-control">
                    <div class="form-label col-lg-6">
                        <label for="data[popup_bg_color]"><?php echo esc_html__('Popup Background Color', 'bdp-popup'); ?></label>
                    </div>
                    <div class="form-field col-lg-6">
                        <?php
                        $popup_bg_color = $save_data['popup_bg_color'] ?? '#ffffff';
                        ?>
                        <input type="text" name="data[popup_bg_color]" id="data[popup_bg_color]" class="bdp-color-picker" 
                        value="<?php echo esc_attr($popup_bg_color); ?>">
                    </div>
                </div>
            </td>
            <td>
                <div class="wcmmq-form-info">
                    <p><?php echo esc_html__('Choose background color for the popup', 'bdp-popup'); ?></p>
                </div> 
            </td>
        </tr>

        <!-- Popup Text Color -->
        <tr>
            <td>
                <div class="wcmmq-form-control">
                    <div class="form-label col-lg-6">
                        <label for="data[popup_text_color]"><?php echo esc_html__('Text Color', 'bdp-popup'); ?></label>
                    </div>
                    <div class="form-field col-lg-6">
                        <?php
                        $popup_text_color = $save_data['popup_text_color'] ?? '#000000';
                        ?>
                        <input type="text" name="data[popup_text_color]" id="data[popup_text_color]" class="bdp-color-picker" 
                        value="<?php echo esc_attr($popup_text_color); ?>">
                    </div>
                </div>
            </td>
            <td>
                <div class="wcmmq-form-info">
                    <p><?php echo esc_html__('Choose color for popup text', 'bdp-popup'); ?></p>
                </div> 
            </td>
        </tr>

        <!-- Title Font Size -->
        <tr>
            <td>
                <div class="wcmmq-form-control">
                    <div class="form-label col-lg-6">
                        <label for="data[title_font_size]"><?php echo esc_html__('Title Font Size', 'bdp-popup'); ?></label>
                    </div>
                    <div class="form-field col-lg-6">
                        <?php
                        $title_font_size = $save_data['title_font_size'] ?? '24';
                        ?>
                        <input type="number" name="data[title_font_size]" id="data[title_font_size]" class="ua_input_number" 
                        value="<?php echo esc_attr($title_font_size); ?>" min="12" max="72"> px
                    </div>
                </div>
            </td>
            <td>
                <div class="wcmmq-form-info">
                    <p><?php echo esc_html__('Set font size for popup title (in pixels)', 'bdp-popup'); ?></p>
                </div> 
            </td>
        </tr>

        <!-- Button Background Color -->
        <tr>
            <td>
                <div class="wcmmq-form-control">
                    <div class="form-label col-lg-6">
                        <label for="data[button_bg_color]"><?php echo esc_html__('Button Background', 'bdp-popup'); ?></label>
                    </div>
                    <div class="form-field col-lg-6">
                        <?php
                        $button_bg_color = $save_data['button_bg_color'] ?? '#4CAF50';
                        ?>
                        <input type="text" name="data[button_bg_color]" id="data[button_bg_color]" class="bdp-color-picker" 
                        value="<?php echo esc_attr($button_bg_color); ?>">
                    </div>
                </div>
            </td>
            <td>
                <div class="wcmmq-form-info">
                    <p><?php echo esc_html__('Choose background color for buttons', 'bdp-popup'); ?></p>
                </div> 
            </td>
        </tr>

        <!-- Button Text Color -->
        <tr>
            <td>
                <div class="wcmmq-form-control">
                    <div class="form-label col-lg-6">
                        <label for="data[button_text_color]"><?php echo esc_html__('Button Text Color', 'bdp-popup'); ?></label>
                    </div>
                    <div class="form-field col-lg-6">
                        <?php
                        $button_text_color = $save_data['button_text_color'] ?? '#ffffff';
                        ?>
                        <input type="text" name="data[button_text_color]" id="data[button_text_color]" class="bdp-color-picker" 
                        value="<?php echo esc_attr($button_text_color); ?>">
                    </div>
                </div>
            </td>
            <td>
                <div class="wcmmq-form-info">
                    <p><?php echo esc_html__('Choose text color for buttons', 'bdp-popup'); ?></p>
                </div> 
            </td>
        </tr>

        <!-- Header Bar Background Color -->
        <tr>
            <td>
                <div class="wcmmq-form-control">
                    <div class="form-label col-lg-6">
                        <label for="data[header_bg_color]"><?php echo esc_html__('Header Bar Background', 'bdp-popup'); ?></label>
                    </div>
                    <div class="form-field col-lg-6">
                        <?php
                        $header_bg_color = $save_data['header_bg_color'] ?? '#f8f9fa';
                        ?>
                        <input type="text" name="data[header_bg_color]" id="data[header_bg_color]" class="bdp-color-picker" 
                        value="<?php echo esc_attr($header_bg_color); ?>">
                    </div>
                </div>
            </td>
            <td>
                <div class="wcmmq-form-info">
                    <p><?php echo esc_html__('Choose background color for header bar', 'bdp-popup'); ?></p>
                </div> 
            </td>
        </tr>

        <!-- Header Bar Text Color -->
        <tr>
            <td>
                <div class="wcmmq-form-control">
                    <div class="form-label col-lg-6">
                        <label for="data[header_text_color]"><?php echo esc_html__('Header Bar Text Color', 'bdp-popup'); ?></label>
                    </div>
                    <div class="form-field col-lg-6">
                        <?php
                        $header_text_color = $save_data['header_text_color'] ?? '#212529';
                        ?>
                        <input type="text" name="data[header_text_color]" id="data[header_text_color]" class="bdp-color-picker" 
                        value="<?php echo esc_attr($header_text_color); ?>">
                    </div>
                </div>
            </td>
            <td>
                <div class="wcmmq-form-info">
                    <p><?php echo esc_html__('Choose text color for header bar', 'bdp-popup'); ?></p>
                </div> 
            </td>
        </tr>
    </tbody>
</table> 