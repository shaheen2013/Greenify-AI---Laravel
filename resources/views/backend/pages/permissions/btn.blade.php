<div class="d-flex align-items-sm-center justify-content-sm-center">
    <button class="btn btn-sm btn-icon permission_edit_button" data-bs-toggle="offcanvas"
            data-bs-target="#PermissionEditModal" data-id="{{$row->id}}" data-name="{{$row->name}}"><i class="ti ti-edit"></i></button>

    <button class="btn btn-sm btn-icon text-danger delete-record me-2 category_delete_button"
            data-id="{{$row->id}}"><i class="ti ti-trash"></i></button>

</div>
