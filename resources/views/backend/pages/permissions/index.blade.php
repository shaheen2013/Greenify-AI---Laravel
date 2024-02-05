@extends('backend.layouts.app')

@section('title', $title ?? __('Category'))

@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-2">Permission List</h4>

        <div class="app-ecommerce-category">
            <!-- Category List Table -->
            <div class="card">
                <div class="card-datatable table-responsive">
                    <table class="data-table table border-top">
                        <thead>
                        <tr>
                            <th><input type="checkbox" class="form-check-input"></th>
                            <th>Name</th>

                            <th width="100px">Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <div class="offcanvas offcanvas-end" tabindex="-1" id="Permission"
                 aria-labelledby="PermissionLabel">
                <div class="offcanvas-header py-4">
                    <h5 id="PermissionLabel" class="offcanvas-title">Add Permission</h5>
                    <button type="button" class="btn-close bg-label-secondary text-reset" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                </div>

                <div class="offcanvas-body border-top">
                    <form class="pt-0" id="addModal" method="POST">

                        <div class="mb-3">
                            <label class="form-label" for="ecommerce-category-title">Name</label>
                            <input type="text" class="form-control" id="ecommerce-category-title"
                                   placeholder="Enter Permission name" name="name" aria-label="Permission title"/>
                            <span class="text-danger nameError error"></span>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Add</button>
                            <button type="reset" class="btn bg-label-danger" data-bs-dismiss="offcanvas">Discard
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Offcanvas to edit category -->
            <div class="offcanvas offcanvas-end" tabindex="-1" id="PermissionEditModal"
                 aria-labelledby="PermissionLabel">
                <!-- Offcanvas Header -->
                <div class="offcanvas-header py-4">
                    <h5 id="PermissionLabel" class="offcanvas-title">Edit Permission</h5>
                    <button type="button" class="btn-close bg-label-secondary text-reset" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                </div>
                <!-- Offcanvas Body -->
                <div class="offcanvas-body border-top">
                    <form class="pt-0" id="updatePermissionModal" method="POST">
                        <input type="hidden" name="id" id="edit_id" value="">
                        <div class="mb-3">
                            <label class="form-label" for="edit_name">Permission Name</label>
                            <input type="text" class="form-control" id="edit_name" placeholder="Enter Permission name"
                                   name="name" aria-label="category title"/>

                            <span class="text-danger editNameError error"></span>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Update</button>
                            <button type="reset" class="btn bg-label-danger"
                                    data-bs-dismiss="offcanvas">Discard
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(function () {

            let table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('permissions.index') }}',
                columns: [{
                    data: '',
                    orderable: false,
                    searchable: false
                },
                    {data: 'name', name: 'name'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                columnDefs: [{
                    targets: 0,
                    className: "control",
                    responsivePriority: 1,
                    render: function () {
                        return '<input type="checkbox" class="dt-checkboxes form-check-input">';
                    },
                }],
                order: [2, "desc"], //set any columns order asc/desc
                dom: '<"card-header d-flex flex-wrap pb-2"' +
                    "<f>" +
                    '<"d-flex justify-content-center justify-content-md-end align-items-baseline"<"dt-action-buttons d-flex justify-content-center flex-md-row mb-3 mb-md-0 ps-1 ms-1 align-items-baseline"lB>>' +
                    ">t" +
                    '<"row mx-2"' +
                    '<"col-sm-12 col-md-6"i>' +
                    '<"col-sm-12 col-md-6"p>' +
                    ">",
                lengthMenu: [10, 20, 50, 70, 100], //for length of menu
                language: {
                    sLengthMenu: "_MENU_",
                    search: "",
                    searchPlaceholder: "Search Category",
                },
                // Button for offcanvas
                buttons: [{
                    text: '<i class="ti ti-plus ti-xs me-0 me-sm-2"></i><span class="d-none d-sm-inline-block">Add Permission</span>',
                    className: "add-new btn btn-primary ms-2 waves-effect waves-light",
                    attr: {
                        "data-bs-toggle": "offcanvas",
                        "data-bs-target": "#Permission",
                    },
                },],
            });


            $('#addModal').on('submit', function (e) {
                e.preventDefault();

                let formData = new FormData();

                let name = $("input[name=name]").val();

                formData.append('name', name);


                formData.append('_token', "{{ csrf_token() }}");


                $('.error').text('');
                $.ajax({
                    url: '{{ route('permissions.store') }}',
                    type: 'POST',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function (response) {
                        if (response.status == 403) {
                            $('.nameError').text(response.errors?.name ? response.errors
                                ?.name[0] : '');
                        } else if (response.status == 200) {
                            toastr.success(response.message);
                            table.ajax.reload(null, false)
                            $("input[name=name]").val('');
                        }
                    },
                    error: function (error) {
                        toastr.error(error.responseJSON.message);
                    }
                });
            });


            $(document).on("click", ".permission_edit_button", function () {
                let id = $(this).attr("data-id");
                let name = $(this).attr("data-name");
                $('#edit_name').val(name);
                $('#edit_id').val(id);
            });


            $('#updatePermissionModal').on('submit', function (e) {
                e.preventDefault();

                let formData = new FormData();

                let id = $('#edit_id').val();

                let name = $("#edit_name").val();
                formData.append('name', name);
                formData.append('_token', "{{ csrf_token() }}");

                let url = '{{ route("permissions.update", ":id") }}';
                url = url.replace(':id', id);

                $('.error').text('');
                $.ajax({
                    url: url,
                    type: 'put',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: {
                        name: name,
                        _token: '{{csrf_token()}}'
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        if (response.status == 403) {
                            table.ajax.reload(null, false)
                            $('.editNameError').text(response.errors?.name ? response.errors
                                ?.name[0] : '');
                            $('.ErrorParenet_category_id').text(response.errors?.parenet_category_id ? response.errors
                                ?.parenet_category_id[0] : '');
                            $('.editImageError').text(response.errors?.image ? response.errors
                                ?.image[0] : '');
                            $('.editDescriptionError').text(response.errors?.description ?
                                response
                                    .errors
                                    ?.description[0] :
                                '');
                            $('.editStatusError').text(response.errors?.status ? response.errors
                                    ?.status[0] :
                                '');
                        } else if (response.status == 200) {
                            toastr.success(response.message);
                            table.ajax.reload(null, false)
                        }
                    },
                    error: function (error) {
                        toastr.error(error.responseJSON.message);
                    }
                });
            });


            $(document).on("click", ".category_delete_button", function () {

                let id = $(this).attr("data-id");
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    customClass: {
                        confirmButton: 'btn btn-danger me-3 waves-effect waves-light',
                        cancelButton: 'btn btn-label-secondary waves-effect waves-light'
                    },
                    buttonsStyling: false
                }).then(function (result) {
                    if (result.value) {

                        $.ajax({
                            url: '{{ '' }}',
                            method: 'POST',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                category_id: id,
                            },
                            success: function (response) {
                                table.ajax.reload(null, false)
                                Swal.fire({
                                    icon: response.icon,
                                    title: 'Deleted!',
                                    text: response.text,
                                    customClass: {
                                        confirmButton: 'btn btn-success waves-effect waves-light'
                                    }
                                });
                            },
                            error: function (error) {
                                console.log(error.responseJSON.message);
                                // handle the error case
                            }
                        });
                    }
                });
            });

        });
    </script>
@endpush
