$(function () {

    $('#images').change(function (e) {
        var files = e.target.files;
        for (var i = 0; i <= files.length; i++) {

            // when i == files.length reorder and break
            if (i == files.length) {
                // need timeout to reorder beacuse prepend is not done
                setTimeout(function () { reorderImages(); }, 100);
                break;
            }

            var file = files[i];
            var reader = new FileReader();

            reader.onload = (function (file) {
                return function (event) {
                    $('#sortable').prepend('<li class="ui-state-default" data-order=0 data-id="' + file.lastModified + '"><img src="' + event.target.result + '" style="width:100%;" /> <div class="order-number"></div></li>');
                };
            })(file);

            reader.readAsDataURL(file);
        }

    });
});
