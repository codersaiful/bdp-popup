jQuery(function($) {
    'use strict';
    $(document).ready(function() {
        // Initialize datepicker for closed_date field
        $('input[name="data[closed_date]"]').datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true,
            yearRange: 'c-0:c+10',
            minDate: 0, // Prevent selecting past dates
            beforeShow: function(input, inst) {
                // Ensure the datepicker appears above other elements
                inst.dpDiv.css({
                    marginTop: '-1px',
                    zIndex: 99999
                });
            }
        });

        // Initialize color pickers
        $('.bdp-color-picker').wpColorPicker({
            change: function(event, ui) {
                var colorValue = ui.color.toString();
                var inputId = $(this).attr('id');
                
                // Apply colors based on the input field
                switch(inputId) {
                    // Popup styles
                    case 'data[popup_bg_color]':
                        $('.preview-popup-wrapper .bdp-popup').css('background-color', colorValue);
                        break;
                    case 'data[popup_header_bg]':
                        $('.preview-popup-wrapper .bdp-pop-header').css('background-color', colorValue);
                        break;
                    case 'data[popup_title_color]':
                        $('.preview-popup-wrapper .bdp-right-side h2').css('color', colorValue);
                        break;
                    case 'data[coupon_bg_color]':
                        $('.preview-popup-wrapper .coupon.bdp-coupon-code').css('background-color', colorValue);
                        break;
                    case 'data[coupon_text_color]':
                        $('.preview-popup-wrapper .coupon.bdp-coupon-code').css('color', colorValue);
                        break;
                    case 'data[copy_text_color]':
                        $('.preview-popup-wrapper .bdp-copy-coupon').css('color', colorValue);
                        break;

                    // Header bar styles
                    case 'data[header_bg_color]':
                        $('.bdp-header-wrapper').css('background-color', colorValue);
                        break;
                    case 'data[header_text_color]':
                        $('.bdp-header-wrapper').css('color', colorValue);
                        $('.bdp-header-wrapper h4').css('color', colorValue);
                        break;
                    case 'data[header_coupon_bg]':
                        $('.bdp-header-wrapper .coupon.bdp-coupon-code').css('background-color', colorValue);
                        break;
                }
            }
        });

        // Handle font size changes
        $('#data\\[title_font_size\\]').on('input', function() {
            var fontSize = $(this).val() + 'px';
            $('.preview-popup-wrapper .bdp-right-side h2').css('font-size', fontSize);
        });
    });
}); 