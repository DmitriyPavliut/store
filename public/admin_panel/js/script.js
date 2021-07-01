function elFinderBrowser(callback, value, meta) {
    tinymce.activeEditor.windowManager.openUrl({
        title: 'File Manager',
        url: '/elfinder/tinymce5',
        /**
         * On message will be triggered by the child window
         *
         * @param dialogApi
         * @param details
         * @see https://www.tiny.cloud/docs/ui-components/urldialog/#configurationoptions
         */
        onMessage: function (dialogApi, details) {
            if (details.mceAction === 'fileSelected') {
                const file = details.data.file;

                // Make file info
                const info = file.name;

                // Provide file and text for the link dialog
                if (meta.filetype === 'file') {
                    callback(file.url, {text: info, title: info});
                }

                // Provide image and alt text for the image dialog
                if (meta.filetype === 'image') {
                    callback(file.url, {alt: info});
                }

                // Provide alternative source and posted for the media dialog
                if (meta.filetype === 'media') {
                    callback(file.url);
                }

                dialogApi.close();
            }
        }
    });
}

$(document).ready(function () {

    $("body").on("change", ".elem_properties", function () {
        let storedArray = [];
        for (let elem of $('.elem_properties')) {
            storedArray.push(elem.value);
        }
        $('#value_properties').val(storedArray);
    });

    $("body").on("click", "#addPropertyBlock", function () {
        $('#propertyBlock').children().last().after('<div class="col-3"><input type="text" class="form-control elem_properties"></div>')
    });

    $("body").on("change", "#category_product", function () {

        $.ajax({
            url: "/admin/getProperties",
            type: "POST",
            data: {
                categoryId: this.value,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: (data) => {
                $('.item_prop').remove();
                for(let item of data) {
                    $('#properties_grop').children().last().after('<div class="item_prop"><label>'+item["name"]+'</label>' +
                        '<select name="property_'+item['id']+'[]" class="form-control" required multiple>' +
                        '<option selected disabled value="NULL">Свойство не выбрано</option></select></div>');
                    for(let itemVal of item['values']) {
                        $('#properties_grop').children().children().children().last().last().after('<option value='+itemVal["id"]+'>'+itemVal["value"]+'</option>');
                    }
                }
            }

        });
    });

});
