$(document).ready(function() {

    // Format JSON properly for submit
    $('#form-item').submit(function(e) {
        e.preventDefault();

        var name = $('#item-name').val();
        var categoryId = $('#item-category').val();
        var references = [];

        $('.item-reference').each(function() {
            var id = $(this).children('.reference-id').text();

            var quantity = $(this).find('.reference-quantity').val();
            references.push({ 'project_id': id, 'quantity': quantity });
        });

        var data = {
            '_token': csrf
            ,'id': itemId
            ,'name': name
            ,'category_id': categoryId
            ,'references': references
        };

        $.post('item', data)
            .done(function(data) {
                alert("Success!");
            })
            .fail(function(xhr, message, c) {
                if (xhr.status == 422) {
                    alert("Validation error: " + xhr.responseText);
                }
                else {
                    alert("General error");
                }

                console.log(xhr);
            });
    });
});