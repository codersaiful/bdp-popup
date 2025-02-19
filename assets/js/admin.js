jQuery(function($) {
    'use strict';
    $(document).ready(function() {
        // Export/Import Functionality
        $('#bdp-export-settings').on('click', function() {
            var settings = WCMMQ_ADMIN_DATA.current_settings || {};
            var dataStr = JSON.stringify(settings, null, 2);
            var date = new Date().toISOString().slice(0,10);
            
            // Create and trigger download
            var blob = new Blob([dataStr], { type: 'application/json' });
            var url = window.URL.createObjectURL(blob);
            var a = document.createElement('a');
            a.style.display = 'none';
            a.href = url;
            a.download = 'bdp-popup-settings-' + date + '.json';
            document.body.appendChild(a);
            a.click();
            window.URL.revokeObjectURL(url);
            a.remove();
        });

        $('#bdp-import-settings').on('click', function() {
            var importData = $('#bdp-import-data').val().trim();
            if (!importData) {
                alert('Please paste settings data to import');
                return;
            }

            try {
                var settings = JSON.parse(importData);
                
                // Send AJAX request to import settings
                $.ajax({
                    url: WCMMQ_ADMIN_DATA.ajax_url,
                    type: 'POST',
                    data: {
                        action: 'bdp_import_settings',
                        settings: settings,
                        nonce: WCMMQ_ADMIN_DATA.nonce
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('Settings imported successfully. Page will reload to apply changes.');
                            location.reload();
                        } else {
                            alert('Import failed: ' + (response.data.message || 'Unknown error'));
                        }
                    },
                    error: function() {
                        alert('Import failed. Please try again.');
                    }
                });
            } catch (e) {
                alert('Invalid JSON data. Please check the imported settings.');
            }
        });

        // Media Uploader
        var mediaUploader;

        $('#wcmmq-show-api-area-btn').on('click', function(e) {
            e.preventDefault(); 
            $(this).toggleClass('wcmmq-show-api-area-btn-clicked');
            $(this).closest('.wcmmq-section-panel').find('table.api-setting-table.table-hide').fadeToggle();
        });
        
        $('#wcmmq-show-customize-area-btn').on('click', function(e) {
            e.preventDefault();
            $(this).hide();
            $(this).closest('.wcmmq-section-panel').find('table.api-setting-table.table-hide').addClass('customized-btn-clicked');
            $('.wcmmq-section-panel.api-site-enabled').fadeIn();
        });


        $('#upload_popup_image_button').on('click', function(e) {
            e.preventDefault();
            // If the uploader object has already been created, reopen the dialog
            if (mediaUploader) {
                mediaUploader.open();
                return;
            }
            
            // Create the media uploader
            mediaUploader = wp.media({
                title: 'Choose Image',
                button: {
                    text: 'Use this image'
                },
                multiple: false
            });
            
            // When an image is selected, run a callback
            mediaUploader.on('select', function() {
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                $('#popup_image').val(attachment.url);
                $('#popup-image-preview').attr('src', attachment.url);
                $('#remove_popup_image_button').show();
            });
            
            // Open the uploader dialog
            mediaUploader.open();
        });
        
        // Remove image button
        $('#remove_popup_image_button').on('click', function(e) {
            e.preventDefault();
            var defaultImage = WCMMQ_ADMIN_DATA.site_url + '/wp-content/plugins/bdp-popup/assets/images/popup-left.png';
            $('#popup_image').val('');
            $('#popup-image-preview').attr('src', defaultImage);
            $(this).hide();
        });

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
                    case 'data[popup_text_color]':
                        $('div#bdp-popup-wrapper .bdp-right-side>p').css('color', colorValue);
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