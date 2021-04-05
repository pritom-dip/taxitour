$(function () {

    $('.cross').on('click', function () {
        var parentId = $(this).parent('.edit-single-gallery');
        var deleteId = $(this).siblings(".inputId").attr('custom_val');
        var data = {
            'id': deleteId
        };

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/admin/galleyImage',
            data: data,
            dataType: 'json',
            success: function (res) {
                if (res.success) {
                    parentId.remove();
                    alert(res.success);
                }
            },
            error: function (error) {
                console.log(error);
            }
        });
    });


});

