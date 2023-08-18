<div id="bdp-popup-wrapper" class="bdp-popup-wrapper">
    <div class="bdp-popup-inside">
        <div class="bdp-popup">
            <div class="bdp-pop-header">

                <span class="bdp-popup-close">x</span>
            </div>
            <div class="bdp-popup-body">
                <div class="bdp-left-side">
                    <?php
                    $popupImg = BDP_POP_ASSETS_URL . 'images/popup-left.png';
                    ?>
                    <img src="<?php echo esc_url( $popupImg ); ?>"/>
                </div>
                <div class="bdp-right-side">
                    <h2>60% Discount on All Products!</h2>
                    <p>Use coupon to get total 60% discount on all product from main price.</p>
                    <div class="coupon bdp-coupon-code">SPECIAL60F10DAYS</div>
                    <a class="bdp-browe-product-link" target="_blank" href="https://codeastrology.com/downloads/">Browse products</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var popup = document.getElementById('bdp-popup-wrapper');
        var popupClose = document.getElementsByClassName('bdp-popup-close');

        if (popup && popupClose) {
            popupClose.addEventListener('click', function () {
                popup.style.display = 'none';
                
            });
        }

        var couponCode = document.getElementsByClassName('bdp-coupon-code');
    
        couponCode.addEventListener('click', function () {
            copyToClipboard(couponCode.textContent);
        });

        function copyToClipboard(text) {
            var textarea = document.createElement('textarea');
            textarea.value = text;
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand('copy');
            document.body.removeChild(textarea);
        }
    });
</script>
