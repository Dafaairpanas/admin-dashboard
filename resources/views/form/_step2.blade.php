{{-- Step 2: Pertanyaan Dinamis dari Database --}}
<div class="form-step" id="step2">
    <h1 class="step-title" data-i18n="step2">Step 2</h1>

    {{-- Dynamic Questions from Database --}}
    @if (isset($questions) && count($questions) > 0)
        @foreach ($questions as $q)
            <div class="form-section question-section" data-question-id="{{ $q->id }}">
                <label class="form-label-custom question-label"
                    data-question-id="{{ $q->id }}"
                    data-text-id="{{ $q->refQuestionTranslation('id')->first()->question_text ?? '' }}"
                    data-text-en="{{ $q->refQuestionTranslation('en')->first()->question_text ?? '' }}"
                    data-text-jp="{{ $q->refQuestionTranslation('jp')->first()->question_text ?? '' }}">
                    {{ $q->refQuestionTranslation($current_lang)->first()->question_text ?? $q->question_text }}
                    @if ($q->is_required)
                        <span class="required">*</span>
                    @endif
                </label>

                {{-- Render based on Type --}}
                @if ($q->refTypeQuestion->code == 'text')
                    {{-- Text Input --}}
                    <input type="text"
                           name="question_{{ $q->id }}"
                           id="question_{{ $q->id }}"
                           class="form-control form-control-custom"
                           {{ $q->is_required ? 'required' : '' }}>
                    <div class="error-message" id="error_question_{{ $q->id }}"></div>

                @elseif($q->refTypeQuestion->code == 'number')
                    {{-- Number Input --}}
                    <input type="number"
                           name="question_{{ $q->id }}"
                           id="question_{{ $q->id }}"
                           class="form-control form-control-custom"
                           inputmode="numeric"
                           {{ $q->is_required ? 'required' : '' }}>
                    <div class="error-message" id="error_question_{{ $q->id }}"></div>

                @elseif($q->refTypeQuestion->code == 'textarea')
                    {{-- Textarea --}}
                    <textarea name="question_{{ $q->id }}"
                              id="question_{{ $q->id }}"
                              class="form-control form-control-custom auto-resize"
                              rows="3"
                              {{ $q->is_required ? 'required' : '' }}></textarea>
                    <div class="error-message" id="error_question_{{ $q->id }}"></div>

                @elseif($q->refTypeQuestion->code == 'checkbox_card')
                    {{-- Checkbox Cards (untuk furniture, dll) --}}
                    <div class="furniture-cards" style="display: grid; grid-template-columns: repeat({{ $q->grid_columns ?? 1 }}, 1fr); gap: 0.5rem;">
                        @foreach ($q->refQuestionOptions as $opt)
                            <div class="furniture-card h-100"
                                 data-checkbox="question_{{ $q->id }}"
                                 data-value="{{ $opt->id }}"
                                 data-max="{{ $q->max_selections ?? null }}">
                                <div class="d-flex align-items-start">
                                    <div class="option-checkbox me-3"></div>
                                    <div>
                                        <div class="card-title option-label"
                                            data-text-id="{{ $opt->refQuestionOptionTranslation('id')->first()->option_text ?? '' }}"
                                            data-text-en="{{ $opt->refQuestionOptionTranslation('en')->first()->option_text ?? '' }}">
                                            {{ $opt->refQuestionOptionTranslation($current_lang)->first()->option_text ?? $opt->option_text }}
                                        </div>
                                        @php
                                            $descId = $opt->refQuestionOptionTranslation('id')->first()->description ?? null;
                                            $descEn = $opt->refQuestionOptionTranslation('en')->first()->description ?? null;
                                            $descCurrent = $opt->refQuestionOptionTranslation($current_lang)->first()->description ?? null;
                                        @endphp
                                        @if($descCurrent)
                                            <div class="card-desc"
                                                data-text-id="{{ $descId }}"
                                                data-text-en="{{ $descEn }}">
                                                {{ $descCurrent }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <input type="hidden" name="question_{{ $q->id }}" id="question_{{ $q->id }}_hidden">
                    <div class="error-message" id="error_question_{{ $q->id }}"></div>

                @elseif($q->refTypeQuestion->code == 'radio')
                    {{-- Radio Buttons --}}
                    <div style="display: grid; grid-template-columns: repeat({{ $q->grid_columns ?? 1 }}, 1fr); gap: 0.5rem;">
                        @foreach ($q->refQuestionOptions as $opt)
                            <div class="option-item"
                                 data-radio="question_{{ $q->id }}"
                                 data-value="{{ $opt->id }}"
                                 data-max="{{ $q->max_selections ?? 1 }}">
                                <div class="option-radio"></div>
                                <span class="option-label"
                                    data-text-id="{{ $opt->refQuestionOptionTranslation('id')->first()->option_text ?? '' }}"
                                    data-text-en="{{ $opt->refQuestionOptionTranslation('en')->first()->option_text ?? '' }}"
                                    data-text-jp="{{ $opt->refQuestionOptionTranslation('jp')->first()->option_text ?? '' }}">
                                    {{ $opt->refQuestionOptionTranslation($current_lang)->first()->option_text ?? $opt->option_text }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                    <input type="hidden" name="question_{{ $q->id }}" id="question_{{ $q->id }}_hidden">
                    <div class="error-message" id="error_question_{{ $q->id }}"></div>

                @elseif($q->refTypeQuestion->code == 'checkbox')
                    {{-- Checkboxes --}}
                    <div style="display: grid; grid-template-columns: repeat({{ $q->grid_columns ?? 1 }}, 1fr); gap: 0.5rem;">
                        @foreach ($q->refQuestionOptions as $opt)
                            <div class="option-item"
                                 data-checkbox="question_{{ $q->id }}"
                                 data-value="{{ $opt->id }}"
                                 data-max="{{ $q->max_selections ?? null }}">
                                <div class="option-checkbox"></div>
                                <div style="flex: 1;">
                                    <span class="option-label"
                                        data-text-id="{{ $opt->refQuestionOptionTranslation('id')->first()->option_text ?? '' }}"
                                        data-text-en="{{ $opt->refQuestionOptionTranslation('en')->first()->option_text ?? '' }}"
                                        data-text-jp="{{ $opt->refQuestionOptionTranslation('jp')->first()->option_text ?? '' }}">
                                        {{ $opt->refQuestionOptionTranslation($current_lang)->first()->option_text ?? $opt->option_text }}
                                    </span>
                                    @php
                                        $desc = $opt->refQuestionOptionTranslation($current_lang)->first()->description ?? null;
                                    @endphp
                                    @if($desc)
                                        <div class="option-description" style="font-size: 0.875rem; color: #666; margin-top: 0.25rem;">
                                            {{ $desc }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <input type="hidden" name="question_{{ $q->id }}" id="question_{{ $q->id }}_hidden">
                    <div class="error-message" id="error_question_{{ $q->id }}"></div>

                @elseif($q->refTypeQuestion->code == 'dropdown')
                    {{-- Dropdown/Select --}}
                    <select name="question_{{ $q->id }}"
                            id="question_{{ $q->id }}"
                            class="form-control form-control-custom"
                            {{ $q->is_required ? 'required' : '' }}>
                        <option value="">-- Pilih --</option>
                        @foreach ($q->refQuestionOptions as $opt)
                            <option value="{{ $opt->id }}"
                                data-text-id="{{ $opt->refQuestionOptionTranslation('id')->first()->option_text ?? '' }}"
                                data-text-en="{{ $opt->refQuestionOptionTranslation('en')->first()->option_text ?? '' }}"
                                data-text-jp="{{ $opt->refQuestionOptionTranslation('jp')->first()->option_text ?? '' }}">
                                {{ $opt->refQuestionOptionTranslation($current_lang)->first()->option_text ?? $opt->option_text }}
                            </option>
                        @endforeach
                    </select>
                    <div class="error-message" id="error_question_{{ $q->id }}"></div>

                @endif
            </div>
        @endforeach
    @endif

    {{-- Consent Checkbox --}}
    <div class="form-section">
        <div class="simple-checkbox-item" id="consentCheckbox" onclick="toggleConsent()">
            <div class="option-checkbox" id="consentBox"></div>
            <span class="option-label" style="color: #666;">
                <span data-i18n="consent_text">Saya bersedia dihubungi untuk informasi produk, promo, dan
                    event selanjutnya.</span>
                <span class="required">*</span>
            </span>
        </div>
        <input type="hidden" name="consent" id="consentInput" required>
        <div id="consentError" class="text-danger mt-2"
            style="display: none; font-size: 13px; font-weight: 500;">
            <i class="fas fa-exclamation-circle me-1"></i>
            <span data-i18n="error_consent_required">Checklist persetujuan wajib dicentang!</span>
        </div>
    </div>

    {{-- Buttons --}}
    <div class="buttons-container">
        <button type="button" class="btn btn-secondary-custom" onclick="prevStep()"
            data-i18n="btn_kembali">Kembali</button>
        <button type="submit" class="btn btn-primary-custom" data-i18n="btn_kirim">Kirim</button>
    </div>
</div>
