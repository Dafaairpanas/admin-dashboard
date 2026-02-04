<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="current-lang" content="{{ $current_lang }}">
    <link rel="shortcut icon" href="/images/BroLogo.png">
    <title>BRO LIVING</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/form-custom.css') }}" rel="stylesheet">
</head>

<body>
    <div class="main-container">
        <!-- Header -->
        <div class="header">
            <div class="logo">
                <img src="{{ asset('images/logos/broliving.svg') }}" alt="Bro Living" class="logo-img">
            </div>
            <div class="header-right">
                <div class="progress-section">
                    <div class="progress-bar-custom">
                        <div class="progress-bar-fill" id="progressBar" style="width: 50%"></div>
                    </div>
                    <div class="progress-text" id="progressText">Step 1 of 2</div>
                </div>
                <div class="language-selector">
                    <div class="language-dropdown" id="langDropdown">
                        <div class="selected-lang" id="selectedLang">
                            @php
                                $currCode = session('selected_language') ?? 'en';
                                // Find current lang object
                                $currLangObj = $available_languages->where('code', $currCode)->first();
                                $flagUrl = $currLangObj && $currLangObj->flag ? asset($currLangObj->flag) :
                                    asset('images/logos/engflag.png');
                            @endphp
                            <img src="{{ $flagUrl }}" alt="{{ $currCode }}" class="flag-circle">
                            <span class="chevron">▼</span>
                        </div>
                        <div class="language-options" id="langOptions">
                            @foreach($available_languages as $lang)
                                <div class="lang-option" data-lang="{{ $lang->code }}"
                                    data-flag="{{ $lang->flag ? asset($lang->flag) : asset('images/logos/engflag.png') }}"
                                    data-name="{{ $lang->name }}">
                                    <img src="{{ $lang->flag ? asset($lang->flag) : asset('images/logos/engflag.png') }}"
                                        alt="{{ $lang->name }}" class="flag-circle">
                                    <div class="lang-text">
                                        <span class="lang-name">{{ $lang->name }}</span>
                                        <span class="lang-code">{{ strtoupper($lang->code) }}</span>
                                    </div>
                                    <span class="checkmark">✓</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="success-message">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            </div>
        @endif

        <form action="{{ route('form.submit') }}" method="POST" id="multiStepForm" novalidate>
            @csrf

            {{-- Step 1: Include Partial --}}
            @include('form._step1')

            {{-- Step 2: Include Partial (Dynamic) --}}
            @include('form._step2')
        </form>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-contact">
            hello@brolivingid.com | 081234567890 | Pati
        </div>
        <div class="footer-credit" data-i18n="footer_credit">
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Initialize visitor translations from backend
        window.visitorTranslations = {
            @foreach ($visitors as $visitor)
                            "{{ $visitor['id'] }}": {
                    "id": "{{ $master_visitor_category_translations->where('visitor_category_id', $visitor['id'])->where('language_code', 'id')->first()->name ?? $visitor['name'] }}",
                    "en": "{{ $master_visitor_category_translations->where('visitor_category_id', $visitor['id'])->where('language_code', 'en')->first()->name ?? $visitor['name'] }}"
                }
                            {{ $loop->last ? '' : ',' }}
            @endforeach
        };
    </script>

    <!-- Custom JS -->
    <script src="{{ asset('js/form-custom.js') }}"></script>
</body>

</html>