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
                <a href="{{ route('roles.create') }}"
                        class="btn btn-primary mb-2 text-nowrap add-new-role">
                    <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i> Add New Role
                </a>
            </div>
        </div>
    </div>
    <!-- Role cards -->
    <div class="row g-2">
        @foreach ($roles as $role)
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <span class="badge bg-label-primary">Total User:
                                <span class="badge badge-center bg-primary bg-glow">{{ $role->users_count }}</span>
                            </span>
                            <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                @foreach ($role->users as $user)
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                        title="Vinnie Mostowy" class="avatar avatar-sm pull-up">
                                        <img class="rounded-circle" src="{{ asset('assets/img/avatars/5.png') }}"
                                             alt="Avatar" />
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="d-flex justify-content-between align-items-end mt-1">
                            <div class="role-heading">

                                <h4 class="mb-1">{{ $role->name }} <span class="badge bg-label-primary">Primary</span> </h4>

                                <div class="d-flex align-items-center justify-content-center gap-2">
                                    <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#updateRoleModal"
                                       class="role-edit-modal"><span
                                            onclick="updateRole({{ $role->id }},'{{ $role->name }}')">Edit
                                            Role</span></a>
                                    <a href="javascript:;" class="text-danger"><span
                                            onclick="deleteRole({{ $role->id }})">Delete
                                            Role</span></a>

                                </div>

                            </div>
                            <a href="#" class="text-success"
                               title="Assign Permission"><i class="ti ti-pencil ti-sm"></i>Permissions</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!--/ Role cards -->
@endsection

@push('scripts')
    <script type="text/javascript">

    </script>
@endpush
