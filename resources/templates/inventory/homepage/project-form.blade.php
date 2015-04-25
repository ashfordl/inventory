<h3>Add new project</h3>
<form id="form-project-new" method="post" action="{{ route('project_post') }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
    <input type="hidden" name="id" value="-1"/>

    {{ $errors->first() === null ? "" : $errors->first() }}

    Name
    <input type="text" name="name" id="project-name" value="" />

    <input type="submit" value="Submit" />
</form>
