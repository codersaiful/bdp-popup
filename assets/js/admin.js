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
                // Optional: Add live preview functionality here
                var colorValue = ui.color.toString();
                var inputId = $(this).attr('id');
                
                // Apply colors based on the input field
                switch(inputId) {
                    case 'data[popup_bg_color]':
                        $('.bdp-popup').css('background-color', colorValue);
                        break;
                    case 'data[popup_text_color]':
                        $('.bdp-popup').css('color', colorValue);
                        break;
                    case 'data[button_bg_color]':
                        $('.bdp-popup button, .bdp-popup .button').css('background-color', colorValue);
                        break;
                    case 'data[button_text_color]':
                        $('.bdp-popup button, .bdp-popup .button').css('color', colorValue);
                        break;
                    case 'data[header_bg_color]':
                        $('.bdp-header-wrapper').css('background-color', colorValue);
                        break;
                    case 'data[header_text_color]':
                        $('.bdp-header-wrapper').css('color', colorValue);
                        break;
                }
            }
        });
    });
}); 