jQuery(function($) {
    'use strict';
    $(document).ready(function() {
        var PopupElement = $('#bdp-popup-wrapper');
        var PopupBox = PopupElement.find('.bdp-popup');
        PopupElement.fadeIn();
        $(document.body).on('click','span.bdp-popup-close',function(){
            hidePopup();
        });

        $(document.body).click(function(event) {
            if(PopupBox.has(event.target).length < 1){
                hidePopup();
            }
        });

        function hidePopup(){
            PopupBox.css({
                marginTop: '-200px',
            });
            PopupElement.fadeOut();
        }

        $(document.body).on('click','.bdp-popup .coupon',function(){
            var textToCopy = $(this).text();
            var tempInput = $('<input>');
            $('body').append(tempInput);
            tempInput.val(textToCopy).select();

            document.execCommand('copy');
            tempInput.remove();
            alert('Text copied to clipboard: ' + textToCopy);
        });

    });
});
