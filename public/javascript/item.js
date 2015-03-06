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

    // Add new reference row upon button press
    $('#reference-new-add').click(function(e) {
        // Get selected option
        var selected = $('#reference-new-select option:selected');

        // Get data of selected option
        var id = selected.val();
        var name = selected.text();
        var quantity = $('#reference-new-quantity').val();

        // Create new row element for table of references
        var element =
        '<tr class="item-reference">'
            +'<td class="hidden reference-id"> {0} </td>'
            +'<td> {1} </td>'
            +'<td><input type="number" min="0" class="reference-quantity" value="{2}" /></td>'
        +'</tr>';

        // Format values into element
        element = element.format(id, name, quantity);

        // Append element
        $('#item-references').append(element);

        // Remove selected option
        selected.remove();

        // If no other options, hide div
        if ($('#reference-new-select option').length == 0) {
            $('#reference-new-div').remove();
        }
    });
});
