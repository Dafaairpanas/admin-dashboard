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

    <!-- Selectr CSS -->
    <link href="https://cdn.jsdelivr.net/npm/mobius1-selectr@latest/dist/selectr.min.css" rel="stylesheet"
        type="text/css">
    <!-- Custom CSS -->
    <link href="{{ asset('css/form-custom.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/mobius1-selectr@latest/dist/selectr.min.js"
        type="text/javascript"></script>
</head>

<body>
    <div class="main-container">
        <!-- Header -->
        <div class="header" style="justify-content: center; position: relative;">
            <div class="logo" style="margin: 0;">
                <img src="{{ asset('images/logos/broliving.svg') }}" alt="Bro Living" class="logo-img"
                    style="height: 40px;">
            </div>

            <div class="header-right" style="position: absolute; right: 2rem;">
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
                                    data-flag="{{ $lang->flag ? asset($lang->flag) : asset('images/logos/idflag.png') }}"
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
            {{-- Success Modal --}}
            <div class="success-modal-overlay" id="successModalOverlay">
                <div class="success-modal">
                    <div class="success-modal-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h3 class="success-modal-title">Berhasil!</h3>
                    <p class="success-modal-message">{{ session('success') }}</p>
                    <div class="success-modal-timer">
                        <div class="timer-bar" id="timerBar"></div>
                    </div>
                </div>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const overlay = document.getElementById('successModalOverlay');
                    const timerBar = document.getElementById('timerBar');

                    // Animate timer bar
                    setTimeout(() => {
                        timerBar.style.width = '0%';
                    }, 100);

                    // Auto close after 3 seconds
                    setTimeout(() => {
                        overlay.classList.add('fade-out');
                        setTimeout(() => {
                            overlay.style.display = 'none';
                        }, 300);
                    }, 3000);

                    // Click to close
                    overlay.addEventListener('click', function (e) {
                        if (e.target === overlay) {
                            overlay.classList.add('fade-out');
                            setTimeout(() => {
                                overlay.style.display = 'none';
                            }, 300);
                        }
                    });
                });
            </script>
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