@extends('backend.layouts.app')

@section('title', $title ?? __('Role'))

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Role /</span> Updated
    </h4>
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <h5 class="card-header">
                    Role add
                </h5>
                <div class="card-body">
                    <form method="POST" id="" action="{{ route('roles.update', $role->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Role Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $role->name }}" placeholder="Name" required>
                        </div>
                        <div class="mb-3">
                            <label for="permission" class="form-label">Select permitted modules</label>
                            @foreach ($permissions as $permission)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permissions[]"
                                        value="{{ $permission->name }}" id="flexCheckIndeterminate"
                                        @if($permitted->contains('name', $permission->name)) checked @endif>
                                    <label class="form-check-label" for="flexCheckIndeterminate">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button class="btn btn-success" type="submit">
                                <span class="align-middle d-sm-inline-block d-none me-sm-1">Update</span>
                                <i class="ti ti-arrow-up"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script type="text/javascript"></script>
@endpush
