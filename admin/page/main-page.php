<?php
$save_data = $this->options;
$api_site_bool = ! empty($save_data['api_site_url']) && filter_var($save_data['api_site_url'], FILTER_VALIDATE_URL) && ! empty($save_data['api_access_token']) ;
$api_bool_class = $api_site_bool ? 'api-site-enabled' : 'no-api-site-enabled';
$api_area_class = $api_site_bool ? 'api-area-api-enabled' : 'api-area-api-disabled';
?>
<div class="wrap wcmmq_wrap wcmmq-content">

    <h1 class="wp-heading "></h1>
    <div class="fieldwrap">

        <!-- <div class="wcmmq-section-panel no-background">
            <a class="wcmmq-btn wcmmq-has-icon" href="#"><span><i class="wcmmq_icon-ok"></i></span>Link</a>
            <button class="wcmmq-btn wcmmq-has-icon"><span><i class="wcmmq_icon-ok"></i></span>Save Change</button>
            <button class="wcmmq-btn reset wcmmq-has-icon"><span><i class="wcmmq_icon-ok"></i></span>Save Change</button>
            <button class="wcmmq-btn round reset wcmmq-has-icon"><span><i class="wcmmq_icon-ok"></i></span>Round Button</button>
            
        </div> -->
        
        <form class="" action="" method="POST" id="bdp-pop-main-configuration-form">
            <div class="wcmmq-section-panel no-background wcmmq-full-form-submit-wrapper">
                
                <button name="configure_submit" type="submit"
                    class="wcmmq-btn wcmmq-has-icon configure_submit">
                    <span><i class="wcmmq_icon-floppy"></i></span>
                    <strong class="form-submit-text">
                    <?php echo esc_html__('Save Change','wcmmq');?>
                    </strong>
                </button>
            </div>
            <?php wp_nonce_field( $this->plugin_prefix, $this->plugin_prefix ); ?>
            <div class="wcmmq-section-panel api-data <?php echo $api_area_class; ?>" id="wcmmq-api-data">
                <?php include 'api-data.php'; ?>
            </div>
            <div class="wcmmq-section-panel content-settings <?php echo $api_bool_class; ?>" id="wcmmq-content-settings">
                <?php include 'content-settings.php'; ?>
            </div>
            <div class="wcmmq-section-panel universal-settings <?php echo $api_bool_class; ?>" id="wcmmq-universal-settings">
                <?php include 'universal-settings.php'; ?>
            </div>
            <div class="wcmmq-section-panel style-settings <?php echo $api_bool_class; ?>" id="wcmmq-style-settings">
                <?php include 'style-settings.php'; ?>
            </div>
            <div class="wcmmq-section-panel coupon-toggle <?php echo $api_bool_class; ?>" id="coupon-toggle-settings">
                <?php include 'coupon-button.php'; ?>
            </div>

            <div class="wcmmq-section-panel export-import <?php echo $api_bool_class; ?>" id="export-import-settings">
                <?php include 'export-import.php'; ?>
            </div>

            <div class="wcmmq-section-panel no-background wcmmq-full-form-submit-wrapper">
                
                <button name="configure_submit" type="submit"
                    class="wcmmq-btn wcmmq-has-icon configure_submit">
                    <span><i class="wcmmq_icon-floppy"></i></span>
                    <strong class="form-submit-text">
                    <?php echo esc_html__('Save Change','wcmmq');?>
                    </strong>
                </button>
                <!-- <button name="reset_button" 
                    class="wcmmq-btn reset wcmmq-has-icon reset_button"
                    onclick="return confirm('If you continue with this action, you will reset all options in this page.\nAre you sure?');">
                    <span><i class="wcmmq_icon-arrows-cw "></i></span>
                    <?php echo esc_html__( 'Reset Settings', 'wcmmq' ); ?>
                </button> -->
                
            </div>

            

                    
        </form>
    </div>
</div> 
<div class="style-preview-section <?php echo esc_attr($api_bool_class); ?>">
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