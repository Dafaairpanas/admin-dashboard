@extends('layouts.vertical', ['title' => 'Roles'])

@section('css')
<style>
    .permission-group {
        border-bottom: 1px solid #e9ecef;
        padding-bottom: 1rem;
        margin-bottom: 1rem;
    }
    .permission-group:last-child {
        border-bottom: none;
        margin-bottom: 0;
    }
    .permission-group-header {
        font-weight: 600;
        color: #495057;
        margin-bottom: 0.75rem;
        font-size: 0.95rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .permission-item {
        padding: 0.5rem 0;
        border-bottom: 1px solid #f8f9fa;
    }
    .permission-item:last-child {
        border-bottom: none;
    }
    .permission-label {
        font-weight: 500;
        color: #6c757d;
    }
</style>
@endsection

@section('content')
    <!-- Breadcrumb dan Header -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                <h4 class="page-title">Roles</h4>
                <div class="">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Management</a></li>
                        <li class="breadcrumb-item active">Roles</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Card -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Roles List</h4>
                        </div>
                        <div class="col-auto">
                            @if(\App\Helper::hasPermission('ROLES', 'create'))
                            <button class="btn bg-primary text-white" data-bs-toggle="modal" data-bs-target="#addRoleModal">
                                <i class="fas fa-plus me-1"></i> Add Role
                            </button>
                            @endif
                        </div>
                    </div>

                    <form action="{{ route('ROLES.read') }}" method="GET" class="mt-3">
                        <div class="input-group">
                            <input type="text" name="search_value" class="form-control" placeholder="Search by name..."
                                value="{{ $search ?? '' }}">
                            <button class="btn btn-outline-secondary" type="submit">Search</button>
                        </div>
                    </form>
                </div>

                <div class="card-body pt-0">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Badge Color</th>
                                    <th>Created At</th>
                                    @if (\App\Helper::hasPermission('ROLES', 'update') || \App\Helper::hasPermission('ROLES', 'delete'))
                                    <th class="text-end">Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($roles as $index => $role)
                                    <tr>
                                        <td>{{ $attributes['from'] + $index }}</td>
                                        <td>{{ $role['name'] }}</td>
                                        <td>
                                            <span
                                                class="badge rounded-pill
                                                        {{ str_starts_with($role['badge_color'], '#') ? '' : 'bg-' . $role['badge_color'] }}"
                                                style="{{ str_starts_with($role['badge_color'], '#') ? 'background-color: ' . $role['badge_color'] : '' }}">
                                                {{ $role['badge_color'] }}
                                            </span>
                                        </td>
                                        <td>{{ $role['created_at'] }}</td>
                                        @if (\App\Helper::hasPermission('ROLES', 'update') || \App\Helper::hasPermission('ROLES', 'delete'))
                                        <td class="text-end">
                                            @if(\App\Helper::hasPermission('ROLES', 'update'))
                                            <button class="btn btn-sm btn-soft-info btn-edit" data-bs-toggle="modal"
                                                data-bs-target="#editRoleModal" data-id="{{ $role['id'] }}"
                                                data-name="{{ $role['name'] }}" data-badge_color="{{ $role['badge_color'] }}"
                                                data-permissions="{{ json_encode($role['permissions']) }}">
                                                <i class="las la-pen fs-18"></i>
                                            </button>
                                            @endif

                                            @if(\App\Helper::hasPermission('ROLES', 'delete'))
                                            <form action="{{ route('ROLES.delete', $role['id']) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-soft-danger">
                                                    <i class="las la-trash-alt fs-18"></i>
                                                </button>
                                            </form>
                                            @endif
                                        </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No roles found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-3">
                        @if($attributes['total'] > 0)
                            <p class="mb-0">Showing {{ $attributes['from'] }} to {{ $attributes['total'] }} of
                                {{ $attributes['total'] }} entries</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Role Modal -->
    <div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('ROLES.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Role</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                        <div class="mb-3">
                            <label class="form-label">Role Name</label>
                            <input type="text" name="name" placeholder="Role Name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Badge Color</label>
                            <input type="color" name="badge_color" placeholder="Badge Color"
                                class="form-control form-control-color" value="#6c757d" title="Choose your color">
                        </div>

                        {{-- Permission Section --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold mb-3">Menu Access</label>
                            <div class="border rounded p-3" style="max-height: 50vh; overflow-y: auto;">
                                @forelse($groupedMenus as $parentName => $menuGroup)
                                    <div class="permission-group">
                                        <div class="permission-group-header">
                                            {{ $parentName }}
                                        </div>
                                        <div>
                                            @foreach($menuGroup as $menu)
                                                <div class="permission-item row align-items-center">
                                                    <div class="col-md-4">
                                                        <span class="permission-label">{{ $menu['name'] }}</span>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="d-flex justify-content-end gap-3 flex-wrap">
                                                            @foreach(['create', 'read', 'update', 'delete'] as $perm)
                                                                <div class="form-check form-check-inline m-0">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="permissions[{{ $menu['id'] }}][{{ $perm }}]"
                                                                        value="1"
                                                                        id="add_{{ $perm }}_{{ $menu['id'] }}">
                                                                    <label class="form-check-label small text-muted text-capitalize"
                                                                        for="add_{{ $perm }}_{{ $menu['id'] }}">{{ $perm }}</label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center text-muted py-5">
                                        <i class="fas fa-exclamation-circle mb-2 fs-4"></i>
                                        <p>No actionable menus found.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Role Modal -->
    <div class="modal fade" id="editRoleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="editRoleForm" action="#" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Role</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                        <div class="mb-3">
                            <label class="form-label">Role Name</label>
                            <input type="text" name="name" id="edit_name" placeholder="Role Name" class="form-control"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Badge Color</label>
                            <input type="color" name="badge_color" placeholder="Badge Color" id="edit_badge_color"
                                class="form-control form-control-color" title="Choose your color">
                        </div>

                        {{-- Permission Section --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold mb-3">Menu Access</label>
                            <div class="border rounded p-3" style="max-height: 50vh; overflow-y: auto;">
                                @foreach($groupedMenus as $parentName => $menuGroup)
                                    <div class="permission-group">
                                        <div class="permission-group-header">
                                            {{ $parentName }}
                                        </div>
                                        <div>
                                            @foreach($menuGroup as $menu)
                                                <div class="permission-item row align-items-center">
                                                    <div class="col-md-4">
                                                        <span class="permission-label">{{ $menu['name'] }}</span>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="d-flex justify-content-end gap-3 flex-wrap">
                                                            @foreach(['create', 'read', 'update', 'delete'] as $perm)
                                                                <div class="form-check form-check-inline m-0">
                                                                    <input class="form-check-input edit-perm" type="checkbox"
                                                                        name="permissions[{{ $menu['id'] }}][{{ $perm }}]"
                                                                        value="1"
                                                                        id="edit_{{ $perm }}_{{ $menu['id'] }}"
                                                                        data-menu="{{ $menu['id'] }}"
                                                                        data-perm="{{ $perm }}">
                                                                    <label class="form-check-label small text-muted text-capitalize"
                                                                        for="edit_{{ $perm }}_{{ $menu['id'] }}">{{ $perm }}</label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('script-bottom')
    <script>
        const editModal = document.getElementById('editRoleModal');
        editModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const name = button.getAttribute('data-name');
            const badge_color = button.getAttribute('data-badge_color');
            const permissions = JSON.parse(button.getAttribute('data-permissions') || '{}');

            const form = document.getElementById('editRoleForm');
            form.action = '/manage/roles/' + id + '/update';

            document.getElementById('edit_name').value = name;
            document.getElementById('edit_badge_color').value = badge_color;

            // Reset all checkboxes
            document.querySelectorAll('.edit-perm').forEach(cb => cb.checked = false);

            // Set checkboxes based on existing permissions
            Object.keys(permissions).forEach(menuId => {
                const perms = permissions[menuId];
                ['create', 'read', 'update', 'delete'].forEach(perm => {
                    if (perms[perm] == 1) {
                        const cb = document.getElementById('edit_' + perm + '_' + menuId);
                        if (cb) cb.checked = true;
                    }
                });
            });
        });
    </script>
@endsection
