var inventory = inventory || {};

// Returns an array of all references to be submitted
// Array format: [ {project_id, quantity}, ... ]
inventory.findReferences = function() {
    var references = [];

    // For each reference, find the project id and quantity
    $('.item-reference').each(function() {
        var id = $(this).children('.reference-id').text();
        var quantity = $(this).find('.reference-quantity').val();

        references.push({ 'project_id': id, 'quantity': quantity });
    });

    return references;
};

// Creates the data object for the POST call
inventory.createDataObject = function() {
    var name = $('#item-name').val();
    var categoryId = $('#item-category').val();
    var references = inventory.findReferences();

    var data = {
        '_token': csrf
        ,'id': itemId
        ,'name': name
        ,'category_id': categoryId
        ,'references': references
    };

    return data;
};

// Upon successful call to server
inventory.onSuccess = function(data) {
    alert("Success!");

    // If on new item page
    if (window.location.href.indexOf("/item/new") > -1) {
        // Redirect to /item/id
        // PHP backend will echo the correct URL
        window.location.href = data;
    }
};

// Upon the server returning an error code
inventory.onFailure = function(xhr, message, c) {
    // If there is a validation error
    if (xhr.status == 422) {
        alert("Validation error: " + xhr.responseText);
    }
    // In all other cases
    else {
        alert("General error");
    }

    // Log the error to console for debug
    console.log(xhr);
};

// Format JSON properly for submit
inventory.submit = function(e) {
    e.preventDefault();

    // Retrieve item data
    var data = inventory.createDataObject();

    // Call server and handle response
    $.post('item', data)
        .done(inventory.onSuccess)
        .fail(inventory.onFailure);
};

inventory.findNewReferenceData = function() {
    var data = {};

    // Get selected option
    data.selected = $('#reference-new-select option:selected');

    // Get data of selected option
    data.id = data.selected.val();
    data.name = data.selected.text();
    data.quantity = $('#reference-new-quantity').val();

    return data;
};

inventory.displayNewReference = function(data) {
    // Create new row element for table of references
    var element =
    '<tr class="item-reference">'
        +'<td class="hidden reference-id"> {0} </td>'
        +'<td> {1} </td>'
        +'<td><input type="number" min="0" class="reference-quantity" value="{2}" /></td>'
    +'</tr>';

    // Format values into element
    element = element.format(data.id, data.name, data.quantity);

    // Append element
    $('#item-references').append(element);
};

inventory.cleanupNewReferenceSelect = function(selected) {
    // Remove selected option
    selected.remove();

    // If no other options, hide div
    if ($('#reference-new-select option').length == 0) {
        $('#reference-new-div').remove();
    }
};

inventory.addNewReference = function(e) {
    // Find data for new reference
    var data = inventory.findNewReferenceData();

    // Display the new reference
    inventory.displayNewReference(data);

    // Tidy up the new reference select
    inventory.cleanupNewReferenceSelect(data.selected);
};

$(document).ready(function() {

    // Format JSON properly for submit
    $('#form-item').submit(inventory.submit);

    // Add new reference row upon button press
    $('#reference-new-add').click(inventory.addNewReference);
});
