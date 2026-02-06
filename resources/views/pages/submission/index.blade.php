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

                    <form action="{{ route('SUBMISSIONS.read') }}" method="GET" class="mt-3">
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
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Visitor Category</th>
                                    <th>Company</th>
                                    <th>Submitted At</th>
                                    @if (\App\Helper::hasPermission('SUBMISSIONS', 'update') || \App\Helper::hasPermission('SUBMISSIONS', 'delete'))
                                    <th class="text-center">Actions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($submissions as $key => $submission)
                                    <tr>
                                        <td>{{ $attributes['from'] + $key }}</td>
                                        <td>{{ $submission['full_name'] }}</td>
                                        <td>{{ $submission['email'] ?? '-' }}</td>
                                        <td>{{ $submission['phone_number'] }}</td>
                                        <td>{{ $submission['visitor_category_name'] ?? '-' }}</td>
                                        <td>{{ $submission['company_name'] ?? '-' }}</td>
                                        <td>{{ $submission['created_at'] }}</td>
                                        @if (\App\Helper::hasPermission('SUBMISSIONS', 'update') || \App\Helper::hasPermission('SUBMISSIONS', 'delete'))
                                        <td class="text-center text-nowrap">
                                            @if (\App\Helper::hasPermission('SUBMISSIONS', 'update'))
                                                <a href="{{ route('SUBMISSIONS.update', ['id' => $submission['id']]) }}"
                                                    class="btn btn-sm btn-soft-primary" title="View Details">
                                                    <i class="las la-eye"></i>
                                                </a>
                                            @endif
                                            @if (\App\Helper::hasPermission('SUBMISSIONS', 'delete'))
                                                <form action="{{ route('SUBMISSIONS.delete', $submission['id']) }}" method="POST"
                                                    class="d-inline delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-soft-danger" title="Delete">
                                                        <i class="las la-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                        @endif
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
                        @if($attributes['total'] > 0)
                            <p class="mb-0">Showing {{ $attributes['from'] }} to {{ $attributes['total'] }} of
                                {{ $attributes['total'] }} entries</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
