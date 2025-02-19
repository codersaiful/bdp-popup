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