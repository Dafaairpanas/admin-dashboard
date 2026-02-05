@extends('layouts.vertical', ['title' => 'Languages'])

@section('css')
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                <h4 class="page-title">Languages</h4>
                <div class="">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Management</a></li>
                        <li class="breadcrumb-item active">Languages</li>
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
                            <h4 class="card-title">Languages List</h4>
                        </div>
                        <div class="col-auto">
                            <button class="btn bg-primary text-white" data-bs-toggle="modal"
                                data-bs-target="#addLanguageModal">
                                <i class="fas fa-plus me-1"></i> Add Language
                            </button>
                        </div>
                    </div>

                    <form action="{{ route('master.languages.index') }}" method="GET" class="mt-3">
                        <div class="input-group">
                            <input type="text" name="search_value" class="form-control"
                                placeholder="Search by name or code..." value="{{ $search ?? '' }}">
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
                                    <th>Code</th>
                                    <th>Flag</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Default</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $language)
                                    <tr>
                                        <td>{{ $language->code }}</td>
                                        <td>
                                            @if($language->flag)
                                                <img src="{{ asset($language->flag) }}" alt="" height="15" class="me-2">
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ $language->name }}</td>
                                        <td>
                                            @if($language->is_active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-secondary">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($language->is_default)
                                                <span class="badge bg-primary">Default</span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <button class="btn btn-sm btn-soft-info btn-edit" data-bs-toggle="modal"
                                                data-bs-target="#editLanguageModal" data-id="{{ $language->id }}"
                                                data-code="{{ $language->code }}" data-name="{{ $language->name }}"
                                                data-is_active="{{ $language->is_active }}"
                                                data-is_default="{{ $language->is_default }}">
                                                <i class="las la-pen fs-18"></i>
                                            </button>

                                            <form action="{{ route('master.languages.destroy', $language->id) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-soft-danger" {{ $language->is_default ? 'disabled' : '' }}>
                                                    <i class="las la-trash-alt fs-18"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No languages found.</td>
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

    <!-- Add Language Modal -->
    <div class="modal fade" id="addLanguageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('master.languages.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Language</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Code (ISO 639-1)</label>
                            <input type="text" name="code" class="form-control" placeholder="en, id, fr" required
                                maxlength="10">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" required maxlength="100">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Flag Image</label>
                            <input type="file" name="flag" class="form-control" accept="image/*">
                        </div>
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="add_is_active" name="is_active" value="1"
                                checked>
                            <label class="form-check-label" for="add_is_active">Active</label>
                        </div>
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="add_is_default" name="is_default" value="1">
                            <label class="form-check-label" for="add_is_default">Default</label>
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

    <!-- Edit Language Modal -->
    <div class="modal fade" id="editLanguageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editLanguageForm" action="#" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Language</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Code (ISO 639-1)</label>
                            <input type="text" name="code" id="edit_code" class="form-control" required maxlength="10">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" id="edit_name" class="form-control" required maxlength="100">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Flag Image (Leave empty to keep current)</label>
                            <input type="file" name="flag" class="form-control" accept="image/*">
                        </div>
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="edit_is_active" name="is_active" value="1">
                            <label class="form-check-label" for="edit_is_active">Active</label>
                        </div>
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="edit_is_default" name="is_default"
                                value="1">
                            <label class="form-check-label" for="edit_is_default">Default</label>
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
        const editModal = document.getElementById('editLanguageModal');
        editModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const code = button.getAttribute('data-code');
            const name = button.getAttribute('data-name');
            const is_active = button.getAttribute('data-is_active');
            const is_default = button.getAttribute('data-is_default');

            const form = document.getElementById('editLanguageForm');
            form.action = "{{ url('master/languages') }}/" + id + "/update";

            document.getElementById('edit_code').value = code;
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_is_active').checked = is_active == 1;
            document.getElementById('edit_is_default').checked = is_default == 1;
        });
    </script>
@endsection