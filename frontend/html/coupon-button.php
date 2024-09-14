<?php
$c_img = BDP_POP_ASSETS_URL . 'images/coupon.png';

$coupon_text = $this->options['coupon_text'] ?? 'Coupon';
$coupon_link= $this->options['coupon_page_link'] ?? get_site_url() . '/';
?>
<div class="bdp-coupon-button-wrapper">
    <a href="<?php echo esc_url($coupon_link); ?>" class="coupon-link">
        <img src="<?php echo esc_url($c_img); ?>" alt="Coupon">
        <span class="coupon-text"><?php echo esc_html($coupon_text); ?></span>
    </a>
</div>
<style>
.bdp-coupon-button-wrapper{
    display: inline-block;
    position: fixed;
    top: 50%;
    transform: translateY(-50%);
    right: -58px;
    z-index: 9999;
}
.coupon-link>img{
    width: 35px;
    height: auto;
}
.coupon-link {
    transform: rotate(-90deg);
    background: #fff;
    box-shadow: 0 22px 79px 0 rgb(0 0 0 / 25%);
    width: 166px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 5px 5px 0 0;
    gap: 10px;
    color: #000;
    font-weight: 600;
    font-size: 22px;
    text-decoration: none;
}
</style>