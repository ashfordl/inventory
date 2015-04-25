var inventory = inventory || {};

inventory.editProject = function(e) {
    var name = $('#project-name-header').text();

    var form =
    '<form id="form-project-edit" method="post" action="{0}">'
        +'<input type="hidden" name="_token" value="{1}"/>'
        +'<input type="hidden" name="id" value="{2}"/>'
        // +'Name'
        +'<input type="text" name="name" id="project-name" value="{3}" />'
        +'<input type="submit" value="Submit" />'
    +'</form>';

    form = form.format(postRoute, csrf, projectId, name);

    $('#project-name-header').replaceWith(form);

    $('#project-edit').hide();
}

$(document).ready(function() {
    // Add new reference row upon button press
    $('#project-edit').click(inventory.editProject);
});
