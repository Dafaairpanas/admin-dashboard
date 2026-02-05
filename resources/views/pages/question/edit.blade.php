@extends('layouts.vertical', ['title' => $question ? 'Edit Question' : 'Create Question'])

@section('css')
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                <h4 class="page-title">{{ $question ? 'Edit Question' : 'Create Question' }}</h4>
                <div class="">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Management</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('master.questions.index') }}">Questions</a></li>
                        <li class="breadcrumb-item active">{{ $question ? 'Edit' : 'Create' }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ $question ? route('master.questions.update', $question->id) : route('master.questions.store') }}" method="POST">
        @csrf
        @if($question)
            @method('PUT')
        @endif
        <input type="hidden" name="survey_id" value="{{ $surveyId }}">

        <div class="row">
            <!-- General Settings -->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">General Settings</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Type</label>
                                <select name="type_question_id" id="type_question_id" class="form-select" required>
                                    <option value="">Select Type</option>
                                    @foreach($types as $type)
                                        <option value="{{ $type->id }}" data-has-options="{{ $type->has_options }}" {{ ($question && $question->type_question_id == $type->id) ? 'selected' : '' }}>
                                            {{ $type->name }} ({{ $type->code }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label">Order (Urutan)</label>
                                <input type="number" name="urutan" class="form-control" value="{{ $question->urutan ?? 0 }}"
                                    required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Key (Auto-generated)</label>
                                <input type="text" name="key" id="key_input" class="form-control bg-light"
                                    value="{{ $question->key ?? '' }}" readonly>
                                <small class="text-muted">Auto-generated from Indonesian question text</small>
                            </div>

                            <div class="col-md-2 mb-3 d-flex align-items-end">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                        value="1" {{ (!$question || $question->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">Active</label>
                                </div>
                            </div>
                            <div class="col-md-2 mb-3 d-flex align-items-end">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_required" name="is_required"
                                        value="1" {{ ($question && $question->is_required) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_required">Required</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Question Content -->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Question Text</h4>
                    </div>
                    <div class="card-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            @foreach($languages as $index => $lang)
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link {{ $index === 0 ? 'active' : '' }}" data-bs-toggle="tab"
                                        href="#tab_q_{{ $lang->code }}" role="tab"
                                        aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                                        @if($lang->flag) <img src="{{ asset($lang->flag) }}" class="me-1" height="12"> @endif
                                        {{ $lang->name }} ({{ strtoupper($lang->code) }})
                                        @if($lang->is_default) <span class="badge bg-primary ms-1">Default</span> @endif
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content pt-3">
                            @foreach($languages as $index => $lang)
                                @php
                                    $val = $question ? ($question->refQuestionTranslations->where('language_code', $lang->code)->first()->question_text ?? '') : '';
                                @endphp
                                <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}" id="tab_q_{{ $lang->code }}"
                                    role="tabpanel">
                                    <div class="mb-3">
                                        <label class="form-label">Question Text ({{ $lang->name }})</label>
                                        <textarea name="translations[{{ $lang->code }}][question_text]" class="form-control"
                                            rows="3">{{ old('translations.' . $lang->code . '.question_text', $val) }}</textarea>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3" id="max_selections_container" style="display: none;">
                    <label class="form-label">Selection Mode</label>
                    <select name="max_selections" class="form-select">
                        <option value="" {{ !$question || $question->max_selections === null ? 'selected' : '' }}>
                            Multiple Options
                            (Unlimited)</option>
                        <option value="1" {{ $question && $question->max_selections === 1 ? 'selected' : '' }}>Single
                            Option (Limit 1)</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3" id="grid_columns_container" style="display: none;">
                    <label class="form-label">Grid Columns</label>
                    <input type="number" name="grid_columns" class="form-control" min="1" max="12"
                        value="{{ $question->grid_columns ?? 1 }}">
                    <small class="text-muted">1 = Vertical List, 2 = 2 Columns, etc.</small>
                </div>
            </div>

            <!-- Options Section (Dynamic) -->
            <div class="col-lg-12" id="options_section" style="display: none;">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Options</h4>
                        <button type="button" class="btn btn-sm btn-primary" id="btn_add_option">
                            <i class="fas fa-plus"></i> Add Option
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="options_table">
                                <thead>
                                    <tr>
                                        <th style="width: 80px;">Order</th>
                                        @foreach($languages as $lang)
                                            <th>
                                                @if($lang->flag) <img src="{{ asset($lang->flag) }}" class="me-1" height="12"> @endif
                                                {{ strtoupper($lang->code) }} Text
                                            </th>
                                        @endforeach
                                        <th style="width: 60px;">X</th>
                                    </tr>
                                </thead>
                                <tbody id="options_body">
                                    @if($question && $question->refQuestionOptions->count() > 0)
                                        @foreach($question->refQuestionOptions as $optIndex => $opt)
                                            <tr class="option-row" data-index="{{ $optIndex }}">
                                                <input type="hidden" name="options[{{ $optIndex }}][id]" value="{{ $opt->id }}">
                                                <td>
                                                    <input type="number" name="options[{{ $optIndex }}][urutan]"
                                                        class="form-control" value="{{ $opt->urutan }}" required>
                                                </td>
                                                @foreach($languages as $lang)
                                                    @php
                                                        $optVal = $opt->refQuestionOptionTranslations->where('language_code', $lang->code)->first()->option_text ?? '';
                                                    @endphp
                                                    <td>
                                                        <input type="text"
                                                            name="options[{{ $optIndex }}][translations][{{ $lang->code }}][option_text]"
                                                            class="form-control mb-1" value="{{ $optVal }}" placeholder="Option Text">
                                                        @php
                                                            $descVal = $opt->refQuestionOptionTranslations->where('language_code', $lang->code)->first()->description ?? '';
                                                        @endphp
                                                        <textarea
                                                            name="options[{{ $optIndex }}][translations][{{ $lang->code }}][description]"
                                                            class="form-control" rows="2"
                                                            placeholder="Description (Optional)">{{ $descVal }}</textarea>
                                                    </td>
                                                @endforeach
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-soft-danger btn-remove-option"><i
                                                            class="las la-trash"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <!-- No options initially -->
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 mb-4">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Save Question</button>
                <a href="{{ route('master.questions.index') }}" class="btn btn-secondary ms-2">Cancel</a>
            </div>
        </div>
    </form>

@endsection

@section('script-bottom')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const typeSelect = document.getElementById('type_question_id');
            const optionsSection = document.getElementById('options_section');
            const optionsBody = document.getElementById('options_body');
            const btnAddOption = document.getElementById('btn_add_option');

            // Initial check
            checkTypeForOptions();

            typeSelect.addEventListener('change', checkTypeForOptions);

            function checkTypeForOptions() {
                const selectedOption = typeSelect.options[typeSelect.selectedIndex];
                const hasOptions = selectedOption.getAttribute('data-has-options');
                const typeText = selectedOption.innerText.toLowerCase();

                // Toggle Options Section
                if (hasOptions == '1') {
                    optionsSection.style.display = 'block';
                } else {
                    optionsSection.style.display = 'none';
                }

                // Toggle Selection Mode & Grid Columns
                // Show only for Checkbox and Radio types
                const maxSelectionsContainer = document.getElementById('max_selections_container');
                const gridColumnsContainer = document.getElementById('grid_columns_container');

                if (typeText.includes('checkbox') || typeText.includes('radio')) {
                    maxSelectionsContainer.style.display = 'block';
                    gridColumnsContainer.style.display = 'block';
                } else {
                    maxSelectionsContainer.style.display = 'none';
                    gridColumnsContainer.style.display = 'none';
                    // Reset value if hidden
                    document.querySelector('select[name="max_selections"]').value = "";
                    document.querySelector('input[name="grid_columns"]').value = "1";
                }
            }

            // Add Option Logic
            let optionIndex = {{ $question ? $question->refQuestionOptions->count() : 0 }};

            btnAddOption.addEventListener('click', function () {
                const newRow = document.createElement('tr');
                newRow.classList.add('option-row');
                newRow.dataset.index = optionIndex;

                let html = `<td><input type="number" name="options[${optionIndex}][urutan]" class="form-control" value="${optionIndex + 1}" required></td>`;

                @foreach($languages as $lang)
                    html += `<td>
                                        <input type="text" name="options[${optionIndex}][translations][{{ $lang->code }}][option_text]" class="form-control mb-1" placeholder="Option Text">
                                        <textarea name="options[${optionIndex}][translations][{{ $lang->code }}][description]" class="form-control" rows="2" placeholder="Description (Optional)"></textarea>
                                    </td>`;
                @endforeach

                html += `<td><button type="button" class="btn btn-sm btn-soft-danger btn-remove-option"><i class="las la-trash"></i></button></td>`;

                newRow.innerHTML = html;
                optionsBody.appendChild(newRow);
                optionIndex++;
            });

            // Remove Option Logic (Delegated)
            optionsBody.addEventListener('click', function (e) {
                if (e.target.closest('.btn-remove-option')) {
                    e.target.closest('tr').remove();
                }
            });

            // Auto-generate Key from Indonesian Question Text
            const questionTextId = document.querySelector('textarea[name="translations[id][question_text]"]');
            const keyInput = document.getElementById('key_input');

            if (questionTextId && keyInput) {
                questionTextId.addEventListener('input', function () {
                    let text = this.value.trim();

                    // Convert to lowercase and replace spaces with underscores
                    let key = text.toLowerCase()
                        .replace(/[^a-z0-9\s]/g, '') // Remove special characters
                        .replace(/\s+/g, '_')         // Replace spaces with underscore
                        .substring(0, 50);            // Limit to 50 characters

                    keyInput.value = key;
                });
            }
        });
    </script>
@endsection
