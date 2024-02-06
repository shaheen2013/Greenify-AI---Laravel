@extends('backend.layouts.app')

@section('title', $title ?? __('Role'))

@section('content')

    <p class="mb-1">

    </p>
    <div class="alert d-flex align-items-center bg-label-warning mb-0" role="alert">
        <span class="alert-icon text-warning me-2 bg-label-light px-2 pb-2 rounded-2">
            <i class="ti ti-bell ti-xs mt-1"></i>
        </span>
        A role provided access to predefined menus and features so that depending on assigned role an administrator can have
        access to what user needs.
    </div>

    <div class="row g-4 justify-content-end align-items-end mt-0">
        <div class="col-2">
            <div class="row justify-content-end align-items-end">
                <a href="{{ route('roles.create') }}" class="btn btn-primary mb-2 text-nowrap add-new-role">
                    <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i> Add New Role
                </a>
            </div>
        </div>
    </div>
    <!-- Role cards -->
    <div class="row g-2">
        <div class="col-12">

            <div class="card">
                <div class="card-datatable table-responsive">
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                        {{-- <div class="row mx-1">
                                <div class="col-sm-12 col-md-3">
                                    <div class="dataTables_length" id="DataTables_Table_0_length"><label>Show <select
                                                name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class="form-select">
                                                <option value="10">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select></label></div>
                                </div>
                                <div class="col-sm-12 col-md-9">
                                    <div
                                        class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-md-end justify-content-center flex-wrap me-1">
                                        <div class="me-3">
                                            <div id="DataTables_Table_0_filter" class="dataTables_filter"><label>Search<input
                                                        type="search" class="form-control" placeholder="Search.."
                                                        aria-controls="DataTables_Table_0"></label></div>
                                        </div>
                                        <div class="dt-buttons btn-group flex-wrap"><button
                                                class="btn add-new btn-primary mb-3 mb-md-0 waves-effect waves-light" tabindex="0"
                                                aria-controls="DataTables_Table_0" type="button" data-bs-toggle="modal"
                                                data-bs-target="#addPermissionModal"><span>Add Permission</span></button> </div>
                                    </div>
                                </div>
                            </div> --}}
                        <table class="datatables-permissions table border-top dataTable no-footer dtr-column"
                            id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" style="width: 1394px;">
                            <thead>
                                <tr>
                                    <th class="control sorting_disabled dtr-hidden" rowspan="1" colspan="1"
                                        style="width: 0px; display: none;" aria-label=""></th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" style="width: 318px;"
                                        aria-label="Name: activate to sort column ascending">
                                        Name</th>
                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 452px;"
                                        aria-label="Stage">Stage</th>
                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 452px;"
                                        aria-label="Total User">Total User</th>
                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 309px;"
                                        aria-label="Created Date">Created Date</th>
                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 153px;"
                                        aria-label="Actions">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($roles as $role)
                                    <tr class="odd">
                                        <td class="  control" tabindex="0" style="display: none;"></td>
                                        <td><span class="text-nowrap">{{ $role->name }}</span> 
                                            <small>(<a href="#" class="text-white-dark" title="Assign Permission"><i
                                            class="ti ti-pencil ti-sm"></i>Permissions</a>)</small>
                                        </td>
                                        <td>
                                            <span class="text-nowrap">
                                                <a href="app-user-list.html">
                                                    <span class="badge bg-label-primary">Primary</span>
                                                </a>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                {{-- <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                                    @foreach ($role->users as $user)
                                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                            data-bs-placement="top" title="Vinnie Mostowy"
                                                            class="avatar avatar-sm pull-up">
                                                            <img class="rounded-circle"
                                                                src="{{ asset('assets/img/avatars/5.png') }}"
                                                                alt="Avatar" />
                                                        </li>
                                                    @endforeach
                                                </ul> --}}
                                                    <span class="badge badge-center bg-primary bg-glow">{{ $role->users_count }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-nowrap">{{ $role->created_at }}</span>
                                        </td>
                                        <td>
                                            <span class="text-nowrap">
                                                <button href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary me-2"><i class="fa fa-pen"></i></a>
                                                <form method="POST" id="" action="{{ route('roles.update', $role->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" type="submit"> <i class="fa fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- <div class="row mx-2">
                                <div class="col-sm-12 col-md-6">
                                    <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
                                        Showing 1 to 9 of 9 entries</div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                                        <ul class="pagination">
                                            <li class="paginate_button page-item previous disabled" id="DataTables_Table_0_previous">
                                                <a aria-controls="DataTables_Table_0" aria-disabled="true" role="link"
                                                    data-dt-idx="previous" tabindex="-1" class="page-link">Previous</a></li>
                                            <li class="paginate_button page-item active"><a href="#"
                                                    aria-controls="DataTables_Table_0" role="link" aria-current="page"
                                                    data-dt-idx="0" tabindex="0" class="page-link">1</a></li>
                                            <li class="paginate_button page-item next disabled" id="DataTables_Table_0_next"><a
                                                    aria-controls="DataTables_Table_0" aria-disabled="true" role="link"
                                                    data-dt-idx="next" tabindex="-1" class="page-link">Next</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Role cards -->

@endsection

@push('scripts')
    <script type="text/javascript">
        
    </script>
@endpush
