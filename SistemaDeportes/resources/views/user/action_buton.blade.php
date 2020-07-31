<a href="javascript:void(0)" data-toggle="tooltip"  data-id="{{ $id }}" data-original-title="Password" class="password btn btn btn-success text-dark" disabled>
	<i class="fa fa-key" aria-hidden="true"></i>
</a>
<a href="{{ route('user.edit', $id) }}" data-toggle="tooltip"  data-id="{{ $id }}" data-original-title="Edit" class="edit btn btn-warning edit-user" disabled>
    <i class="fa fa-pencil"></i>
</a>
<a href="javascript:void(0);" id="delete-user" data-toggle="tooltip" data-original-title="Delete" data-id="{{ $id }}" class="delete btn btn-danger " disabled>
    <i class="fa fa-times"></i>
</a>


<!-- <a href="javascript:void(0)" data-toggle="tooltip"  data-id="{{ $id }}" data-original-title="Edit" class="edit btn btn-warning edit-user" disabled>
    <i class="fa fa-pencil"></i>
</a>
<a href="javascript:void(0);" id="delete-user" data-toggle="tooltip" data-original-title="Delete" data-id="{{ $id }}" class="delete btn btn-danger text-dark" disabled>
    <i class="fa fa-times"></i>
</a> -->
