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
                        <li class="breadcrumb-item"><a href="{{ route('SUBMISSIONS.read') }}">Submissions</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="main-container">
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

                    @if(!$isPerorangan && ($submission->company_name || $submission->job_title))
                        <div class="form-section">
                            <label class="form-label-custom">Company Name</label>
                            <input type="text" class="form-control form-control-custom" value="{{ $submission->company_name ?? '-' }}" readonly>
                        </div>

                        <div class="form-section">
                            <label class="form-label-custom">Job Title</label>
                            <input type="text" class="form-control form-control-custom" value="{{ $submission->job_title ?? '-' }}" readonly>
                        </div>
                    @endif

                    <div class="form-section">
                        <label class="form-label-custom">Business Type</label>
                        @php
                            $businessTypes = is_string($submission->business_type)
                                ? json_decode($submission->business_type, true)
                                : $submission->business_type;

                            $businessTypeArray = [];

                            $businessTypeMapping = [
                                'hotel_resort' => 'Hotel / Resort',
                                'villa' => 'Villa',
                                'cafe_restaurant' => 'Cafe / Restaurant / Beach Club',
                                'developer' => 'Developer / Kontraktor',
                                'designer' => 'Designer Interior',
                            ];

                            if (is_array($businessTypes)) {
                                foreach ($businessTypes as $type) {
                                    // Check if type exists in mapping, otherwise use the value as is (for custom 'lainnya' input)
                                    $label = $businessTypeMapping[$type] ?? ucwords(str_replace('_', ' ', $type));
                                    $businessTypeArray[] = $label;
                                }
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
                                        $questionText = $questionTranslation->question_text ?? $question->key ?? 'Question #' . $questionId;
                                    @endphp
                                    {{ $questionText }}
                                    @if($question->trashed())
                                        <span class="text-danger" style="font-size: 0.8em;">(Deleted)</span>
                                    @endif
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
                                    <div style="display: grid; grid-template-columns: repeat({{ $question->grid_columns ?? 1 }}, 1fr); gap: 0.5rem;">
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
                                    </div>

                                @elseif($question->refTypeQuestion->code == 'checkbox')
                                    {{-- Checkboxes --}}
                                    <div style="display: grid; grid-template-columns: repeat({{ $question->grid_columns ?? 1 }}, 1fr); gap: 0.5rem;">
                                        @foreach($question->refQuestionOptions as $opt)
                                            @php
                                                $isSelected = $answers->contains('question_option_id', $opt->id);
                                                $optionTranslation = $opt->refQuestionOptionTranslation($defaultLang)->first();
                                                $descriptionText = $optionTranslation->description ?? null;
                                            @endphp
                                            <div class="option-item {{ $isSelected ? 'selected' : '' }}" style="pointer-events: none;">
                                                <div class="option-checkbox">
                                                    @if($isSelected)
                                                        <i class="fas fa-check" style="color: white; font-size: 12px;"></i>
                                                    @endif
                                                </div>
                                                <div style="flex: 1;">
                                                    <span class="option-label">
                                                        {{ $optionTranslation->option_text ?? $opt->option_text }}
                                                    </span>
                                                    @if($descriptionText)
                                                        <div class="option-description" style="font-size: 0.875rem; color: #666; margin-top: 0.25rem;">
                                                            {{ $descriptionText }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

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
                                    <div class="furniture-cards" style="display: grid; grid-template-columns: repeat({{ $question->grid_columns ?? 1 }}, 1fr); gap: 0.5rem;">
                                        @foreach($question->refQuestionOptions as $opt)
                                            @php
                                                $isSelected = $answers->contains('question_option_id', $opt->id);
                                                $optionTranslation = $opt->refQuestionOptionTranslation($defaultLang)->first();
                                                $descriptionText = $optionTranslation->description ?? null;
                                            @endphp
                                            <div class="furniture-card h-100 {{ $isSelected ? 'selected' : '' }}" style="pointer-events: none;">
                                                <div class="d-flex align-items-start">
                                                    <div class="option-checkbox me-3" style="{{ $isSelected ? 'background-color: var(--primary-orange); border-color: var(--primary-orange);' : '' }}">
                                                        @if($isSelected)
                                                            <i class="fas fa-check" style="color: white; font-size: 12px;"></i>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <div class="card-title">
                                                            {{ $optionTranslation->option_text ?? $opt->option_text }}
                                                        </div>
                                                        @if($descriptionText)
                                                            <div class="card-desc">{{ $descriptionText }}</div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @else
                            {{-- Question deleted permanently (force deleted) --}}
                            <div class="form-section">
                                <label class="form-label-custom text-muted">
                                    <i class="las la-exclamation-triangle"></i> Question #{{ $questionId }} (Permanently Deleted)
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
                    <a href="{{ route('SUBMISSIONS.read') }}" class="btn btn-secondary btn-lg">
                        <i class="las la-arrow-left me-1"></i> Back
                    </a>
                    @if(\App\Helper::hasPermission('SUBMISSIONS', 'delete'))
                    <form action="{{ route('SUBMISSIONS.delete', $submission->id) }}"
                          method="POST"
                          class="d-inline"
                          onsubmit="return confirm('Are you sure you want to delete this submission?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-lg">
                            <i class="las la-trash me-1"></i> Delete
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
