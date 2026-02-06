@extends('layouts.vertical', ['title' => 'Questions'])

@section('css')
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                <h4 class="page-title">Questions</h4>
                <div class="">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Management</a></li>
                        <li class="breadcrumb-item active">Questions</li>
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
                            <h4 class="card-title">Questions List</h4>
                        </div>
                        <div class="col-auto">
                            @if(\App\Helper::hasPermission('QUESTIONS', 'create'))
                                <a href="{{ route('QUESTIONS.create.form') }}" class="btn bg-primary text-white">
                                    <i class="fas fa-plus me-1"></i> Add Question
                                </a>
                            @endif
                        </div>
                    </div>

                    <form action="{{ route('QUESTIONS.read') }}" method="GET" class="mt-3">
                        <div class="input-group">
                            <input type="text" name="search_value" class="form-control" placeholder="Search..."
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

                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Order</th>
                                    <th>Type</th>
                                    <th>Question Text ({{ strtoupper($defaultLang) }})</th>
                                    <th>Active</th>
                                    @if(\App\Helper::hasPermission('QUESTIONS', 'update') || \App\Helper::hasPermission('QUESTIONS', 'delete'))
                                    <th class="text-end">Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $q)
                                    @php
                                        $trans = $q->refQuestionTranslations->where('language_code', $defaultLang)->first();
                                        $text = $trans ? Str::limit($trans->question_text, 50) : '-';

                                        // Get type code from eager loaded relationship or query fallback
                                        $typeCode = $q->refTypeQuestion ? $q->refTypeQuestion->code : (\App\Models\TypeQuestion::find($q->type_question_id)->code ?? '-');

                                        $badgeClass = match ($typeCode) {
                                            'text' => 'bg-primary',
                                            'textarea' => 'bg-secondary',
                                            'radio' => 'bg-success',
                                            'checkbox' => 'bg-warning',
                                            'dropdown' => 'bg-info',
                                            'number' => 'bg-dark',
                                            'checkbox_card' => 'bg-danger',
                                            default => 'bg-soft-primary text-primary'
                                        };
                                    @endphp
                                    <tr>
                                        <td>{{ $q->urutan }}</td>
                                        <td><span class="badge {{ $badgeClass }}">{{ $typeCode }}</span></td>
                                        <td>{{ $text }}</td>
                                        <td>
                                            @if($q->is_active)
                                                <i class="fas fa-check-circle text-success"></i>
                                            @else
                                                <i class="fas fa-times-circle text-danger"></i>
                                            @endif
                                        </td>
                                        @IF(\App\Helper::hasPermission('QUESTIONS', 'update') || \App\Helper::hasPermission('QUESTIONS', 'delete'))
                                        <td class="text-end">
                                            @if(\App\Helper::hasPermission('QUESTIONS', 'update'))
                                                <a href="{{ route('QUESTIONS.update.form', $q->id) }}"
                                                    class="btn btn-sm btn-soft-info">
                                                    <i class="las la-pen fs-18"></i>
                                                </a>
                                            @endif

                                            @if(\App\Helper::hasPermission('QUESTIONS', 'delete'))
                                                <form action="{{ route('QUESTIONS.delete', $q->id) }}" method="POST"
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
                                        <td colspan="5" class="text-center">No questions found.</td>
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
@endsection
