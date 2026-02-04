@extends('layouts.vertical', ['title' => 'Submissions'])

@section('css')
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                <h4 class="page-title">Form Submissions</h4>
                <div class="">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Management</a></li>
                        <li class="breadcrumb-item active">Submissions</li>
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
                            <h4 class="card-title">Submissions List</h4>
                        </div>
                    </div>

                    <form action="{{ route('submissions.index') }}" method="GET" class="mt-3">
                        <div class="input-group">
                            <input type="text" name="search_value" class="form-control"
                                placeholder="Search by name, email, phone..." value="{{ $search ?? '' }}">
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

                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Company</th>
                                    <th>Submitted At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $submission)
                                    <tr>
                                        <td>{{ $submission->id }}</td>
                                        <td>{{ $submission->full_name }}</td>
                                        <td>{{ $submission->email ?? '-' }}</td>
                                        <td>{{ $submission->phone_number }}</td>
                                        <td>{{ $submission->nama_perusahaan ?? '-' }}</td>
                                        <td>{{ $submission->created_at->format('d M Y H:i') }}</td>
                                        <td>
                                            <a href="{{ route('submissions.show', $submission->id) }}"
                                                class="btn btn-sm btn-soft-primary" title="View Details">
                                                <i class="las la-eye"></i>
                                            </a>
                                            <form action="{{ route('submissions.destroy', $submission->id) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Are you sure you want to delete this submission?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-soft-danger" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4">
                                            <p class="text-muted mb-0">No submissions found</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $data->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection