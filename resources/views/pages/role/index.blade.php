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
                            <button class="btn bg-primary text-white" data-bs-toggle="modal" data-bs-target="#addRoleModal">
                                <i class="fas fa-plus me-1"></i> Add Role
                            </button>
                        </div>
                    </div>

                    <form action="{{ route('roles.index') }}" method="GET" class="mt-3">
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
                                    <th>Color</th>
                                    <th>Registered Users</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $role)
                                    <tr>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            <span class="badge rounded text-white"
                                                style="background-color: {{ $role->badge_color }};">
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary">{{ $role->users_count }} Users</span>
                                        </td>
                                        <td class="text-end">
                                            <button class="btn btn-sm btn-soft-info btn-edit" data-bs-toggle="modal"
                                                data-bs-target="#editRoleModal" data-id="{{ $role->id }}"
                                                data-name="{{ $role->name }}" data-badge_color="{{ $role->badge_color }}">
                                                <i class="las la-pen fs-18"></i>
                                            </button>

                                            <form action="{{ route('roles.destroy', $role->id) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-soft-danger">
                                                    <i class="las la-trash-alt fs-18"></i>
                                                </button>
                                            </form>
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
                        {{ $data->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Role Modal -->
    <div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('roles.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Role</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Role Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Badge Color (Hex)</label>
                            <input type="color" name="badge_color" class="form-control form-control-color" value="#6c757d"
                                title="Choose your color">
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
        <div class="modal-dialog">
            <form id="editRoleForm" action="#" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Role</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Role Name</label>
                            <input type="text" name="name" id="edit_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Badge Color (Hex)</label>
                            <input type="color" name="badge_color" id="edit_badge_color"
                                class="form-control form-control-color" title="Choose your color">
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

            const form = document.getElementById('editRoleForm');
            form.action = '/admin/roles/' + id; // Warning: Ensure prefix is correct matching web.php

            document.getElementById('edit_name').value = name;
            document.getElementById('edit_badge_color').value = badge_color;
        });
    </script>
@endsection