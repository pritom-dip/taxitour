$(function () {
    $('#tourType').on('change', function () {
        var selectedField = $(this).val();
        if (selectedField == 'taxi') {
            $('.tourNaming').hide();
        } else {
            $('.tourNaming').show();
        }
    })

});

