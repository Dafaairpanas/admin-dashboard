@extends('layouts.vertical', ['title' => 'Submission Detail'])

@section('css')
    <link href="{{ asset('css/form-custom.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                <h4 class="page-title">Submission Detail</h4>
                <div class="">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Management</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('submissions.index') }}">Submissions</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="form-container">
                {{-- Header --}}
                <div class="form-header">
                    <h1 class="form-title">Form Submission - Read Only</h1>
                    <p class="form-subtitle">Submitted: {{ $submission->created_at->format('d F Y, H:i') }}</p>
                </div>

                {{-- Step 1: Contact Information --}}
                <div class="form-step active">
                    <h1 class="step-title">Step 1: Contact Information</h1>

                    <div class="form-section">
                        <label class="form-label-custom">Full Name <span class="required">*</span></label>
                        <input type="text" class="form-control form-control-custom" value="{{ $submission->full_name }}" readonly>
                    </div>

                    <div class="form-section">
                        <label class="form-label-custom">Email</label>
                        <input type="email" class="form-control form-control-custom" value="{{ $submission->email ?? '-' }}" readonly>
                    </div>

                    <div class="form-section">
                        <label class="form-label-custom">WhatsApp Number <span class="required">*</span></label>
                        <input type="tel" class="form-control form-control-custom" value="{{ $submission->phone_number }}" readonly>
                    </div>

                    <div class="form-section">
                        <label class="form-label-custom">Visitor Category <span class="required">*</span></label>
                        @php
                            $visitorCategoryName = $submission->refMasterVisitorCategory->name ?? $submission->kategori_pengunjung ?? '-';
                        @endphp
                        <input type="text" class="form-control form-control-custom" value="{{ $visitorCategoryName }}" readonly>
                    </div>

                    @php
                        $isPerorangan = strtolower($visitorCategoryName) === 'perorangan';
                    @endphp

                    @if(!$isPerorangan && ($submission->nama_perusahaan || $submission->posisi_jabatan))
                        <div class="form-section">
                            <label class="form-label-custom">Company Name</label>
                            <input type="text" class="form-control form-control-custom" value="{{ $submission->nama_perusahaan ?? '-' }}" readonly>
                        </div>

                        <div class="form-section">
                            <label class="form-label-custom">Job Title</label>
                            <input type="text" class="form-control form-control-custom" value="{{ $submission->posisi_jabatan ?? '-' }}" readonly>
                        </div>
                    @endif

                    <div class="form-section">
                        <label class="form-label-custom">Business Type</label>
                        @php
                            $businessTypes = is_string($submission->jenis_bisnis) 
                                ? json_decode($submission->jenis_bisnis, true) 
                                : $submission->jenis_bisnis;
                            
                            $businessTypeArray = [];
                            
                            if (is_array($businessTypes)) {
                                foreach ($businessTypes as $type) {
                                    // Skip "lainnya" karena akan diganti dengan detail
                                    if (strtolower($type) !== 'lainnya') {
                                        $businessTypeArray[] = ucwords(str_replace('_', ' ', $type));
                                    }
                                }
                            }
                            
                            // Replace "Lainnya" dengan detail bisnis yang diinput
                            if ($submission->jenis_bisnis_lainnya) {
                                $businessTypeArray[] = $submission->jenis_bisnis_lainnya;
                            }
                            
                            $businessTypeText = !empty($businessTypeArray) ? implode(', ', $businessTypeArray) : '-';
                        @endphp
                        <input type="text" class="form-control form-control-custom" value="{{ $businessTypeText }}" readonly>
                    </div>
                </div>

                {{-- Step 2: Dynamic Questions --}}
                <div class="form-step active">
                    <h1 class="step-title">Step 2: Additional Information</h1>

                    @php
                        $defaultLang = 'id';
                        // Group answers by question_id
                        $groupedAnswers = $submission->refSubmissionAnswers->groupBy('question_id');
                    @endphp

                    @foreach($groupedAnswers as $questionId => $answers)
                        @php
                            $firstAnswer = $answers->first();
                            $question = $firstAnswer->refQuestion;
                        @endphp

                        @if($question)
                            <div class="form-section question-section">
                                <label class="form-label-custom">
                                    @php
                                        $questionTranslation = $question->refQuestionTranslation($defaultLang)->first();
                                    @endphp
                                    {{ $questionTranslation->question_text ?? $question->key ?? 'Question #' . $questionId }}
                                    @if($question->is_required)
                                        <span class="required">*</span>
                                    @endif
                                </label>

                                @if($question->refTypeQuestion->code == 'text')
                                    {{-- Text Input --}}
                                    <input type="text" class="form-control form-control-custom" 
                                           value="{{ $firstAnswer->answer_text }}" readonly>

                                @elseif($question->refTypeQuestion->code == 'textarea')
                                    {{-- Textarea --}}
                                    <textarea class="form-control form-control-custom" rows="4" readonly>{{ $firstAnswer->answer_text }}</textarea>

                                @elseif($question->refTypeQuestion->code == 'number')
                                    {{-- Number Input --}}
                                    <input type="number" class="form-control form-control-custom" 
                                           value="{{ $firstAnswer->answer_text }}" readonly>

                                @elseif($question->refTypeQuestion->code == 'radio')
                                    {{-- Radio Buttons --}}
                                    @foreach($question->refQuestionOptions as $opt)
                                        @php
                                            $isSelected = $answers->contains('question_option_id', $opt->id);
                                            $optionTranslation = $opt->refQuestionOptionTranslation($defaultLang)->first();
                                        @endphp
                                        <div class="option-item {{ $isSelected ? 'selected' : '' }}" style="pointer-events: none;">
                                            <div class="option-radio"></div>
                                            <span class="option-label">
                                                {{ $optionTranslation->option_text ?? $opt->option_text }}
                                            </span>
                                        </div>
                                    @endforeach

                                @elseif($question->refTypeQuestion->code == 'checkbox')
                                    {{-- Checkboxes --}}
                                    @foreach($question->refQuestionOptions as $opt)
                                        @php
                                            $isSelected = $answers->contains('question_option_id', $opt->id);
                                            $optionTranslation = $opt->refQuestionOptionTranslation($defaultLang)->first();
                                        @endphp
                                        <div class="option-item {{ $isSelected ? 'selected' : '' }}" style="pointer-events: none;">
                                            <div class="option-checkbox"></div>
                                            <span class="option-label">
                                                {{ $optionTranslation->option_text ?? $opt->option_text }}
                                            </span>
                                        </div>
                                    @endforeach

                                @elseif($question->refTypeQuestion->code == 'dropdown')
                                    {{-- Dropdown --}}
                                    <select class="form-control form-control-custom" disabled>
                                        @foreach($question->refQuestionOptions as $opt)
                                            @php
                                                $isSelected = $answers->contains('question_option_id', $opt->id);
                                                $optionTranslation = $opt->refQuestionOptionTranslation($defaultLang)->first();
                                            @endphp
                                            <option value="{{ $opt->id }}" {{ $isSelected ? 'selected' : '' }}>
                                                {{ $optionTranslation->option_text ?? $opt->option_text }}
                                            </option>
                                        @endforeach
                                    </select>

                                @elseif($question->refTypeQuestion->code == 'checkbox_card')
                                    {{-- Checkbox Cards --}}
                                    <div class="checkbox-card-grid">
                                        @foreach($question->refQuestionOptions as $opt)
                                            @php
                                                $isSelected = $answers->contains('question_option_id', $opt->id);
                                                $optionTranslation = $opt->refQuestionOptionTranslation($defaultLang)->first();
                                            @endphp
                                            <div class="checkbox-card {{ $isSelected ? 'selected' : '' }}" style="pointer-events: none;">
                                                <div class="d-flex align-items-start">
                                                    <div class="option-checkbox me-3"></div>
                                                    <div>
                                                        <div class="card-title">
                                                            {{ $optionTranslation->option_text ?? $opt->option_text }}
                                                        </div>
                                                        @if($opt->description)
                                                            <div class="card-description">{{ $opt->description }}</div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @else
                            {{-- Question deleted --}}
                            <div class="form-section">
                                <label class="form-label-custom text-muted">
                                    <i class="las la-exclamation-triangle"></i> Question #{{ $questionId }} (Deleted)
                                </label>
                                @if($firstAnswer->answer_text)
                                    <input type="text" class="form-control form-control-custom" 
                                           value="{{ $firstAnswer->answer_text }}" readonly>
                                @else
                                    <p class="text-muted mb-0">Option ID: {{ $firstAnswer->question_option_id }}</p>
                                @endif
                            </div>
                        @endif
                    @endforeach
                </div>

                {{-- Action Buttons --}}
                <div class="text-center mt-4">
                    <a href="{{ route('submissions.index') }}" class="btn btn-secondary btn-lg">
                        <i class="las la-arrow-left me-1"></i> Back to List
                    </a>
                    <form action="{{ route('submissions.destroy', $submission->id) }}" 
                          method="POST" 
                          class="d-inline"
                          onsubmit="return confirm('Are you sure you want to delete this submission?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-lg">
                            <i class="las la-trash me-1"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection