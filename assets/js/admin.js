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
    });
}); 