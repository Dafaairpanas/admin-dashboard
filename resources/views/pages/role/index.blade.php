@extends('layouts.vertical', ['title' => 'Roles'])

@section('css')
@endsection

@section('content')


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
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
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
                                    <th>Name</th>
                                    <th>Badge Color</th>
                                    <th>Created At</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($roles as $index => $role)
                                    <tr>
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
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">No roles found.</td>
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

    @php
        try {
            // Query langsung untuk menu clickable (yang memiliki parent_id)
            // Menu tanpa parent_id adalah label sidebar, bukan clickable menu
            $clickableMenus = \App\Models\Menu::withoutGlobalScopes()
                ->whereNotNull('parent_id')
                ->orderBy('urutan', 'asc')
                ->get()
                ->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'name' => $item->name,
                        'parent_id' => $item->parent_id,
                        'parent_name' => $item->parent ? $item->parent->name : null,
                        'url' => $item->url,
                        'code' => $item->code,
                    ];
                });
            
            $groupedMenus = collect($clickableMenus)->groupBy('parent_name');
        } catch (\Throwable $e) {
            dd($e->getMessage());
        }
    @endphp

    <style>
        .permission-group {
            margin-bottom: 1.5rem;
        }
        .permission-group-header {
            background-color: #f3f6f9;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
            border-left: 4px solid #6c757d;
        }
        .permission-item {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #f1f1f1;
            transition: background-color 0.2s;
        }
        .permission-item:hover {
            background-color: #fafafa;
        }
        .permission-item:last-child {
            border-bottom: none;
        }
        .permission-label {
            font-size: 0.9rem;
            font-weight: 500;
            color: #333;
        }
        .form-check-inline .form-check-input {
            margin-top: 0.15rem;
        }
    </style>

    <!-- Add Role Modal -->
    <div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('ROLES.create') }}" method="POST">
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
                            <label class="form-label">Badge Color (Hex)</label>
                            <input type="color" name="badge_color" placeholder="Badge Color"
                                class="form-control form-control-color" value="#6c757d" title="Choose your color">
                        </div>

                        {{-- Permission Section --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold mb-3">Akses Menu</label>
                            <div class="border rounded" style="max-height: 50vh; overflow-y: auto;">
                                @forelse($groupedMenus as $parentName => $menuGroup)
                                    <div class="permission-group px-3 pt-3">
                                        <div class="permission-group-header">
                                            {{ $parentName ?: 'Main Modules' }}
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
                            <label class="form-label">Badge Color (Hex)</label>
                            <input type="color" name="badge_color" placeholder="Badge Color" id="edit_badge_color"
                                class="form-control form-control-color" title="Choose your color">
                        </div>

                        {{-- Permission Section --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Akses Menu</label>
                            <div class="border rounded p-3" id="editPermissionsContainer">
                                @foreach($groupedMenus as $parentName => $menuGroup)
                                    <div class="mb-3">
                                        <h6 class="fw-semibold text-primary border-bottom pb-2 mb-2">{{ $parentName ?: 'Other' }}</h6>
                                        @foreach($menuGroup as $menu)
                                            <div class="d-flex align-items-center justify-content-between py-2 border-bottom">
                                                <span class="me-3" style="min-width: 120px;">{{ $menu['name'] }}</span>
                                                <div class="d-flex gap-3">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input edit-perm" type="checkbox" name="permissions[{{ $menu['id'] }}][create]" value="1" id="edit_create_{{ $menu['id'] }}" data-menu="{{ $menu['id'] }}" data-perm="create">
                                                        <label class="form-check-label small" for="edit_create_{{ $menu['id'] }}">Create</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input edit-perm" type="checkbox" name="permissions[{{ $menu['id'] }}][read]" value="1" id="edit_read_{{ $menu['id'] }}" data-menu="{{ $menu['id'] }}" data-perm="read">
                                                        <label class="form-check-label small" for="edit_read_{{ $menu['id'] }}">Read</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input edit-perm" type="checkbox" name="permissions[{{ $menu['id'] }}][update]" value="1" id="edit_update_{{ $menu['id'] }}" data-menu="{{ $menu['id'] }}" data-perm="update">
                                                        <label class="form-check-label small" for="edit_update_{{ $menu['id'] }}">Update</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input edit-perm" type="checkbox" name="permissions[{{ $menu['id'] }}][delete]" value="1" id="edit_delete_{{ $menu['id'] }}" data-menu="{{ $menu['id'] }}" data-perm="delete">
                                                        <label class="form-check-label small" for="edit_delete_{{ $menu['id'] }}">Delete</label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
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