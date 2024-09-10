<?php 
$data = $this->options;
$title = $data['title'] ?? '';
$coupon = $data['coupon'] ?? '';
?>
<div id="bdp-header-wrapper" class="bdp-header-wrapper">
    <div class="bdp-popup-inside">
        <div class="bdp-popup">
            <div class="bdp-popup-body">
                <div class="bdp-left-side">
                    <?php
                    $popupImg = BDP_POP_ASSETS_URL . 'images/popup-left.png';
                    ?>
                    <img src="<?php echo esc_url( $popupImg ); ?>"/>
                </div>
                <div class="bdp-right-side">
                    <?php if( ! empty( $title ) ){ ?>
                    <h4><?php echo esc_html( $title ); ?></h4>
                    <?php } ?>
                    <div class="coupon-wrapper">
                        <div class="coupon bdp-coupon-code"><?php echo esc_html( $coupon ); ?></div>
                    </div>
                    <p class="claim-text bdp-copy-coupon">
                        Use Coupon
                    </p>
                    
                </div>
            </div>
        </div>
    </div>
</div>

