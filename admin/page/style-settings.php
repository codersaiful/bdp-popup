<?php
$save_data = $this->options;
?>


<table class="wcmmq-table style-setting">
    <thead>
        <tr>
            <th class="wcmmq-inside">
                <div class="wcmmq-table-header-inside">
                    <h3><?php echo esc_html__( 'Popup Styles', 'bdp-popup' ); ?></h3>
                </div>
            </th>
            <th>
                <div class="wcmmq-table-header-right-side">
                    <p><?php echo esc_html__( 'Customize the appearance of your popup', 'bdp-popup' ); ?></p>
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
                        <label for="data[popup_bg_color]"><?php echo esc_html__('Popup Background', 'bdp-popup'); ?></label>
                    </div>
                    <div class="form-field col-lg-6">
                        <?php
                        $popup_bg_color = $save_data['popup_bg_color'] ?? '#fff4e4';
                        ?>
                        <input type="text" name="data[popup_bg_color]" id="data[popup_bg_color]" class="bdp-color-picker" 
                        value="<?php echo esc_attr($popup_bg_color); ?>">
                    </div>
                </div>
            </td>
            <td>
                <div class="wcmmq-form-info">
                    <p><?php echo esc_html__('Background color for the popup box', 'bdp-popup'); ?></p>
                </div> 
            </td>
        </tr>

        <!-- Popup Header Background -->
        <tr>
            <td>
                <div class="wcmmq-form-control">
                    <div class="form-label col-lg-6">
                        <label for="data[popup_header_bg]"><?php echo esc_html__('Header Background', 'bdp-popup'); ?></label>
                    </div>
                    <div class="form-field col-lg-6">
                        <?php
                        $popup_header_bg = $save_data['popup_header_bg'] ?? '#ff9aca';
                        ?>
                        <input type="text" name="data[popup_header_bg]" id="data[popup_header_bg]" class="bdp-color-picker" 
                        value="<?php echo esc_attr($popup_header_bg); ?>">
                    </div>
                </div>
            </td>
            <td>
                <div class="wcmmq-form-info">
                    <p><?php echo esc_html__('Background color for popup header', 'bdp-popup'); ?></p>
                </div> 
            </td>
        </tr>

        <!-- Popup Title Color -->
        <tr>
            <td>
                <div class="wcmmq-form-control">
                    <div class="form-label col-lg-6">
                        <label for="data[popup_title_color]"><?php echo esc_html__('Title Color', 'bdp-popup'); ?></label>
                    </div>
                    <div class="form-field col-lg-6">
                        <?php
                        $popup_title_color = $save_data['popup_title_color'] ?? '#96588a';
                        ?>
                        <input type="text" name="data[popup_title_color]" id="data[popup_title_color]" class="bdp-color-picker" 
                        value="<?php echo esc_attr($popup_title_color); ?>">
                    </div>
                </div>
            </td>
            <td>
                <div class="wcmmq-form-info">
                    <p><?php echo esc_html__('Color for popup title text', 'bdp-popup'); ?></p>
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
                        $popup_title_color = $save_data['popup_text_color'] ?? '#6d6d6d';
                        ?>
                        <input type="text" name="data[popup_text_color]" id="data[popup_text_color]" class="bdp-color-picker" 
                        value="<?php echo esc_attr($popup_title_color); ?>">
                    </div>
                </div>
            </td>
            <td>
                <div class="wcmmq-form-info">
                    <p><?php echo esc_html__('Color for popup title text', 'bdp-popup'); ?></p>
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
                        $title_font_size = $save_data['title_font_size'] ?? '23';
                        ?>
                        <input type="number" name="data[title_font_size]" id="data[title_font_size]" class="ua_input_number" 
                        value="<?php echo esc_attr($title_font_size); ?>" min="12" max="72"> px
                    </div>
                </div>
            </td>
            <td>
                <div class="wcmmq-form-info">
                    <p><?php echo esc_html__('Font size for popup title', 'bdp-popup'); ?></p>
                </div> 
            </td>
        </tr>

        <!-- Coupon Box Background -->
        <tr>
            <td>
                <div class="wcmmq-form-control">
                    <div class="form-label col-lg-6">
                        <label for="data[coupon_bg_color]"><?php echo esc_html__('Coupon Box Background', 'bdp-popup'); ?></label>
                    </div>
                    <div class="form-field col-lg-6">
                        <?php
                        $coupon_bg_color = $save_data['coupon_bg_color'] ?? '#ffffff';
                        ?>
                        <input type="text" name="data[coupon_bg_color]" id="data[coupon_bg_color]" class="bdp-color-picker" 
                        value="<?php echo esc_attr($coupon_bg_color); ?>">
                    </div>
                </div>
            </td>
            <td>
                <div class="wcmmq-form-info">
                    <p><?php echo esc_html__('Background color for coupon box', 'bdp-popup'); ?></p>
                </div> 
            </td>
        </tr>

        <!-- Coupon Text Color -->
        <tr>
            <td>
                <div class="wcmmq-form-control">
                    <div class="form-label col-lg-6">
                        <label for="data[coupon_text_color]"><?php echo esc_html__('Coupon Text Color', 'bdp-popup'); ?></label>
                    </div>
                    <div class="form-field col-lg-6">
                        <?php
                        $coupon_text_color = $save_data['coupon_text_color'] ?? '#0006ff';
                        ?>
                        <input type="text" name="data[coupon_text_color]" id="data[coupon_text_color]" class="bdp-color-picker" 
                        value="<?php echo esc_attr($coupon_text_color); ?>">
                    </div>
                </div>
            </td>
            <td>
                <div class="wcmmq-form-info">
                    <p><?php echo esc_html__('Text color for coupon code', 'bdp-popup'); ?></p>
                </div> 
            </td>
        </tr>

        <!-- Copy Text Color -->
        <tr>
            <td>
                <div class="wcmmq-form-control">
                    <div class="form-label col-lg-6">
                        <label for="data[copy_text_color]"><?php echo esc_html__('Copy Text Color', 'bdp-popup'); ?></label>
                    </div>
                    <div class="form-field col-lg-6">
                        <?php
                        $copy_text_color = $save_data['copy_text_color'] ?? '#ff7ab9';
                        ?>
                        <input type="text" name="data[copy_text_color]" id="data[copy_text_color]" class="bdp-color-picker" 
                        value="<?php echo esc_attr($copy_text_color); ?>">
                    </div>
                </div>
            </td>
            <td>
                <div class="wcmmq-form-info">
                    <p><?php echo esc_html__('Color for "Copy Coupon" text', 'bdp-popup'); ?></p>
                </div> 
            </td>
        </tr>
    </tbody>
</table>

<table class="wcmmq-table style-setting">
    <thead>
        <tr>
            <th class="wcmmq-inside">
                <div class="wcmmq-table-header-inside">
                    <h3><?php echo esc_html__( 'Header Bar Styles', 'bdp-popup' ); ?></h3>
                </div>
            </th>
            <th>
                <div class="wcmmq-table-header-right-side">
                    <p><?php echo esc_html__( 'Customize the appearance of your header bar', 'bdp-popup' ); ?></p>
                </div>
            </th>
        </tr>
    </thead>

    <tbody>
        <!-- Header Bar Background -->
        <tr>
            <td>
                <div class="wcmmq-form-control">
                    <div class="form-label col-lg-6">
                        <label for="data[header_bg_color]"><?php echo esc_html__('Background Color', 'bdp-popup'); ?></label>
                    </div>
                    <div class="form-field col-lg-6">
                        <?php
                        $header_bg_color = $save_data['header_bg_color'] ?? '#9C27B0';
                        ?>
                        <input type="text" name="data[header_bg_color]" id="data[header_bg_color]" class="bdp-color-picker" 
                        value="<?php echo esc_attr($header_bg_color); ?>">
                    </div>
                </div>
            </td>
            <td>
                <div class="wcmmq-form-info">
                    <p><?php echo esc_html__('Background color for header bar', 'bdp-popup'); ?></p>
                </div> 
            </td>
        </tr>

        <!-- Header Text Color -->
        <tr>
            <td>
                <div class="wcmmq-form-control">
                    <div class="form-label col-lg-6">
                        <label for="data[header_text_color]"><?php echo esc_html__('Text Color', 'bdp-popup'); ?></label>
                    </div>
                    <div class="form-field col-lg-6">
                        <?php
                        $header_text_color = $save_data['header_text_color'] ?? '#ffffff';
                        ?>
                        <input type="text" name="data[header_text_color]" id="data[header_text_color]" class="bdp-color-picker" 
                        value="<?php echo esc_attr($header_text_color); ?>">
                    </div>
                </div>
            </td>
            <td>
                <div class="wcmmq-form-info">
                    <p><?php echo esc_html__('Text color for header bar', 'bdp-popup'); ?></p>
                </div> 
            </td>
        </tr>

        <!-- Header Coupon Background -->
        <tr>
            <td>
                <div class="wcmmq-form-control">
                    <div class="form-label col-lg-6">
                        <label for="data[header_coupon_bg]"><?php echo esc_html__('Coupon Background', 'bdp-popup'); ?></label>
                    </div>
                    <div class="form-field col-lg-6">
                        <?php
                        $header_coupon_bg = $save_data['header_coupon_bg'] ?? '#730b85';
                        ?>
                        <input type="text" name="data[header_coupon_bg]" id="data[header_coupon_bg]" class="bdp-color-picker" 
                        value="<?php echo esc_attr($header_coupon_bg); ?>">
                    </div>
                </div>
            </td>
            <td>
                <div class="wcmmq-form-info">
                    <p><?php echo esc_html__('Background color for header coupon box', 'bdp-popup'); ?></p>
                </div> 
            </td>
        </tr>
    </tbody>
</table>
<div class="style-preview-section">
                    <h4><?php echo esc_html__('Live Preview', 'bdp-popup'); ?></h4>
                    <div class="preview-popup">
                        <div id="bdp-popup-wrapper" class="bdp-popup-wrapper preview-popup-wrapper" style="position: relative; height: 300px; background: #fff;">
                            <div class="bdp-popup-inside">
                                <div class="bdp-popup">
                                    <div class="bdp-pop-header">
                                        <span class="bdp-popup-close">x</span>
                                    </div>
                                    <div class="bdp-popup-body">
                                        <div class="bdp-left-side">
                                            <img src="<?php echo esc_url(BDP_POP_ASSETS_URL . 'images/popup-left.png'); ?>" />
                                        </div>
                                        <div class="bdp-right-side">
                                            <h2>Preview Title</h2>
                                            <p>This is a preview of how your popup will look.</p>
                                            <div class="coupon-wrapper">
                                                <div class="coupon bdp-coupon-code">SAMPLE10</div>
                                                <p class="bdp-copy-coupon">Copy Coupon</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<style>
.style-preview-section {
    padding: 20px;
    background: #f8f9fa;
    border-radius: 0px;
    margin-bottom: 0;
    position: fixed;
    bottom: 20px;
    right: 10px;
    width: 800px;
    z-index: 9999;
    box-shadow: 4px 1px 18px 0 #a1a1a17a;
    transform: scale(.5);
    transform-origin: bottom right;
}
.preview-popup {
    padding: 20px;
    background: #fff;
    border-radius: 5px;
}
#preview-popup-wrapper {
    position: relative !important;
    margin: 20px 0;
}
</style> 