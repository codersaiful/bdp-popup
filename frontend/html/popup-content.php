<?php 
$data = $this->options;
$title = $data['title'] ?? __( "Summer discount upto 86% - Hurry" );
$coupon = $data['coupon'] ?? __( 'SAIFUL', 'bdp-popup' );
$message = $data['message'] ?? __( 'Use coupon to get total 60% discount from main price.', 'bdp-popup' );
$imgage_url = $data['image_url'] ?? BDP_POP_ASSETS_URL . 'images/popup-left.png';
?>
<div id="bdp-popup-wrapper" class="bdp-popup-wrapper" style="display: none;">
    <div class="bdp-popup-inside">
        <div class="bdp-popup">
            <div class="bdp-pop-header">

                <span class="bdp-popup-close">x</span>
            </div>
            <div class="bdp-popup-body">
                <?php
                $popupImg = !empty($this->options['popup_image']) ? $this->options['popup_image'] : null;
                if( ! empty( $popupImg ) ){ ?>
                <div class="bdp-left-side">
                    <img src="<?php echo esc_url($popupImg); ?>" />
                </div>
                <?php } ?>
                
                <div class="bdp-right-side">
                    <?php 
                    // var_dump($this);
                    ?>
                    <?php if( ! empty( $title ) ){ ?>
                    <h2><?php echo esc_html( $title ); ?></h2>
                    <?php } ?>

                    <?php if( ! empty( $message ) ){ ?>
                    <p><?php echo esc_html( $message ); ?></p>
                    <?php } ?>
                    <div class="coupon-wrapper">
                        <div class="coupon bdp-coupon-code"><?php echo esc_html( $coupon ); ?></div>
                        <p class="bdp-copy-coupon">Copy Coupon</p>
                    </div>
                    <a class="bdp-browe-product-link" target="_blank" href="https://codeastrology.com/downloads/">Browse products</a>
                </div>
            </div>
        </div>
    </div>
</div>

