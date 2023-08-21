<?php
$save_data = $this->options;

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

            <div class="wcmmq-section-panel content-settings" id="wcmmq-universal-settings">
                <?php include 'content-settings.php'; ?>
            </div>
            <div class="wcmmq-section-panel universal-settings" id="wcmmq-universal-settings">
                <?php include 'universal-settings.php'; ?>
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