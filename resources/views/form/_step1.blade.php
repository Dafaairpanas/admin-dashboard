{{-- Step 1: Data Pribadi dan Kategori Pengunjung --}}
<div class="form-step active" id="step1">
    <h1 class="step-title" data-i18n="step1">Step 1</h1>

    {{-- Nama Lengkap --}}
    <div class="form-section">
        <label class="form-label-custom"><span data-i18n="nama_lengkap">Nama lengkap</span> <span
                class="required">*</span></label>
        <input type="text" name="full_name" id="nama_lengkap" class="form-control form-control-custom" required>
        <div class="error-message" id="error_nama_lengkap"></div>
    </div>

    {{-- Nomor WhatsApp --}}
    <div class="form-section">
        <label class="form-label-custom"><span data-i18n="nomor_whatsapp">Nomor Whatsapp / Telepon</span>
            <span class="required">*</span></label>
        <input type="tel" name="phone_number" id="whatsapp" class="form-control form-control-custom" inputmode="numeric"
            maxlength="16" minlength="9" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
        <div class="error-message" id="error_whatsapp"></div>
    </div>

    {{-- Email --}}
    <div class="form-section">
        <label class="form-label-custom"><span data-i18n="alamat_email">Alamat Email</span> <span
                class="required">*</span></label>
        <input type="email" name="email" id="email" class="form-control form-control-custom" required>
        <div class="error-message" id="error_email"></div>
    </div>

    {{-- Kategori Pengunjung --}}
    <div class="form-section">
        <label class="form-label-custom">
            <span data-i18n="kategori_pengunjung">Kategori Pengunjung</span>
            <span class="required">*</span>
        </label>

        @foreach ($visitors as $visitor)
            <div class="option-item" data-radio="kategori" data-value="{{ $visitor['id'] }}"
                data-has-extra="{{ $visitor['has_additional_fields'] ? '1' : '0' }}"
                data-name-id="{{ $master_visitor_category_translations->where('visitor_category_id', $visitor['id'])->where('language_code', 'id')->first()->name ?? $visitor['name'] }}"
                data-name-en="{{ $master_visitor_category_translations->where('visitor_category_id', $visitor['id'])->where('language_code', 'en')->first()->name ?? $visitor['name'] }}">
                <div class="option-radio"></div>
                <span class="option-label" data-translatable="visitor_{{ $visitor['id'] }}">
                    {{ $visitor['name'] }}
                </span>
            </div>
        @endforeach

        <input type="hidden" name="visitor_category_id" id="kategori_pengunjung">
        <div class="error-message" id="error_kategori_pengunjung"></div>

        {{-- Conditional B2B Fields --}}
        <div class="conditional-fields" id="b2bFields">
            <div class="mb-3">
                <label class="form-label-custom" data-i18n="nama_perusahaan">Nama perusahaan</label>
                <input type="text" name="company_name" id="nama_perusahaan" class="form-control form-control-custom">
                <div class="error-message" id="error_nama_perusahaan"></div>
            </div>
            <div class="mb-3">
                <label class="form-label-custom" data-i18n="posisi_jabatan">Posisi / Jabatan</label>
                <input type="text" name="job_title" id="posisi_jabatan" class="form-control form-control-custom">
                <div class="error-message" id="error_posisi_jabatan"></div>
            </div>
        </div>
    </div>

    {{-- Jenis Bisnis --}}
    <div class="form-section">
        <label class="form-label-custom"><span data-i18n="jenis_bisnis">Jenis Bisnis</span> <span
                class="required">*</span></label>

        <div class="option-item" data-checkbox="business_type" data-value="hotel_resort" data-max="1">
            <div class="option-checkbox"></div>
            <span class="option-label" data-i18n="hotel_resort">Hotel / Resort</span>
        </div>

        <div class="option-item" data-checkbox="business_type" data-value="villa" data-max="1">
            <div class="option-checkbox"></div>
            <span class="option-label" data-i18n="villa">Villa</span>
        </div>

        <div class="option-item" data-checkbox="business_type" data-value="cafe_restaurant" data-max="1">
            <div class="option-checkbox"></div>
            <span class="option-label" data-i18n="cafe_restaurant">Cafe / Restaurant / Beach Club</span>
        </div>

        <div class="option-item" data-checkbox="business_type" data-value="developer" data-max="1">
            <div class="option-checkbox"></div>
            <span class="option-label" data-i18n="developer">Developer / Kontraktor</span>
        </div>

        <div class="option-item" data-checkbox="business_type" data-value="designer" data-max="1">
            <div class="option-checkbox"></div>
            <span class="option-label" data-i18n="designer">Designer Interior</span>
        </div>

        <div class="option-item" data-checkbox="business_type" data-value="lainnya" data-max="1" id="lainnyaOption">
            <div class="option-checkbox"></div>
            <span class="option-label" data-i18n="lainnya">Lainnya</span>
        </div>

        <div class="lainnya-input-container" id="lainnyaInput">
            <input type="text" name="jenis_bisnis_lainnya" id="jenis_bisnis_lainnya"
                class="form-control form-control-custom" placeholder="Tulis jenis bisnis Anda..."
                data-i18n="jenis_bisnis_placeholder">
            <div class="error-message" id="error_jenis_bisnis_lainnya"></div>
        </div>
        <div class="error-message" id="error_jenis_bisnis"></div>
    </div>

    <div class="buttons-container">
        <button type="button" class="btn btn-primary-custom" onclick="nextStep()" data-i18n="btn_lanjut">Lanjut</button>
    </div>
</div>
