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
            references.push({ 'id': id, 'quantity': quantity });
        });

        var data = {
            '_token': csrf
            ,'id': itemId
            ,'name': name
            ,'category': categoryId
            ,'references': references
        };

        $.post('item', data)
            .done(function(data) {
                console.log(data);
            })
            .fail(function(data) {
                alert("AJAX call to server failed.");
            });
    });
});