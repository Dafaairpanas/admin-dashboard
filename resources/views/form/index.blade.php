<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Form Pendaftaran - BD Living</title>

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
                            <img src="{{ asset('images/logos/engflag.png') }}" alt="English" class="flag-circle">
                            <span class="chevron">▼</span>
                        </div>
                        <div class="language-options" id="langOptions">
                            <div class="lang-option" data-lang="id" data-flag="https://flagcdn.com/w40/id.png">
                                <img src="{{ asset('images/logos/idflag.png') }}" alt="Indonesia" class="flag-circle">
                                <div class="lang-text">
                                    <span class="lang-name">Indonesia</span>
                                    <span class="lang-code">ID</span>
                                </div>
                                <span class="checkmark">✓</span>
                            </div>
                            <div class="lang-option" data-lang="en" data-flag="https://flagcdn.com/w40/gb.png">
                                <img src="{{ asset('images/logos/engflag.png') }}" alt="English" class="flag-circle">
                                <div class="lang-text">
                                    <span class="lang-name">English</span>
                                    <span class="lang-code">EN</span>
                                </div>
                                <span class="checkmark">✓</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="success-message">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            </div>
        @endif

        <form action="{{ route('form.submit') }}" method="POST" id="multiStepForm" novalidate>
            @csrf

            <!-- Step 1 -->
            <div class="form-step active" id="step1">
                <h1 class="step-title" data-i18n="step1">Step 1</h1>

                <!-- Nama Lengkap -->
                <div class="form-section">
                    <label class="form-label-custom"><span data-i18n="nama_lengkap">Nama lengkap</span> <span
                            class="required">*</span></label>
                    <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control form-control-custom">
                    <div class="error-message" id="error_nama_lengkap"></div>
                </div>

                <!-- Nomor WhatsApp -->
                <div class="form-section">
                    <label class="form-label-custom"><span data-i18n="nomor_whatsapp">Nomor Whatsapp / Telepon</span>
                        <span class="required">*</span></label>
                    <input type="tel" name="whatsapp" id="whatsapp" class="form-control form-control-custom"
                        inputmode="numeric" maxlength="16" minlength="9"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                    <div class="error-message" id="error_whatsapp"></div>
                </div>

                <!-- Email -->
                <div class="form-section">
                    <label class="form-label-custom"><span data-i18n="alamat_email">Alamat Email</span> <span
                            class="required">*</span></label>
                    <input type="email" name="email" id="email" class="form-control form-control-custom">
                    <div class="error-message" id="error_email"></div>
                </div>

                <!-- Kategori Pengunjung -->
                <div class="form-section">
                    <label class="form-label-custom"><span data-i18n="kategori_pengunjung">Kategori Pengunjung</span>
                        <span class="required">*</span></label>

                    <div class="option-item" data-radio="kategori" data-value="perseorangan">
                        <div class="option-radio"></div>
                        <span class="option-label" data-i18n="perseorangan">Perseorangan</span>
                    </div>

                    <div class="option-item" data-radio="kategori" data-value="b2b">
                        <div class="option-radio"></div>
                        <span class="option-label" data-i18n="b2b">Instansi / Perusahaan (B2B)</span>
                    </div>

                    <input type="hidden" name="kategori_pengunjung" id="kategori_pengunjung">
                    <div class="error-message" id="error_kategori_pengunjung"></div>

                    <!-- Conditional B2B Fields -->
                    <div class="conditional-fields" id="b2bFields">
                        <div class="mb-3">
                            <label class="form-label-custom" data-i18n="nama_perusahaan">Nama perusahaan</label>
                            <input type="text" name="nama_perusahaan" id="nama_perusahaan"
                                class="form-control form-control-custom">
                            <div class="error-message" id="error_nama_perusahaan"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label-custom" data-i18n="posisi_jabatan">Posisi / Jabatan</label>
                            <input type="text" name="posisi_jabatan" id="posisi_jabatan"
                                class="form-control form-control-custom">
                            <div class="error-message" id="error_posisi_jabatan"></div>
                        </div>
                    </div>
                </div>

                <!-- Jenis Bisnis -->
                <div class="form-section">
                    <label class="form-label-custom"><span data-i18n="jenis_bisnis">Jenis Bisnis</span> <span
                            class="required">*</span></label>

                    <div class="option-item" data-checkbox="jenis_bisnis" data-value="hotel_resort" data-max="1">
                        <div class="option-checkbox"></div>
                        <span class="option-label" data-i18n="hotel_resort">Hotel / Resort</span>
                    </div>

                    <div class="option-item" data-checkbox="jenis_bisnis" data-value="villa" data-max="1">
                        <div class="option-checkbox"></div>
                        <span class="option-label" data-i18n="villa">Villa</span>
                    </div>

                    <div class="option-item" data-checkbox="jenis_bisnis" data-value="cafe_restaurant" data-max="1">
                        <div class="option-checkbox"></div>
                        <span class="option-label" data-i18n="cafe_restaurant">Cafe / Restaurant / Beach Club</span>
                    </div>

                    <div class="option-item" data-checkbox="jenis_bisnis" data-value="developer" data-max="1">
                        <div class="option-checkbox"></div>
                        <span class="option-label" data-i18n="developer">Developer / Kontraktor</span>
                    </div>

                    <div class="option-item" data-checkbox="jenis_bisnis" data-value="designer" data-max="1">
                        <div class="option-checkbox"></div>
                        <span class="option-label" data-i18n="designer">Designer Interior</span>
                    </div>

                    <div class="option-item" data-checkbox="jenis_bisnis" data-value="lainnya" data-max="1"
                        id="lainnyaOption">
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
                    <button type="button" class="btn btn-primary-custom" onclick="nextStep()"
                        data-i18n="btn_lanjut">Lanjut</button>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="form-step" id="step2">
                <h1 class="step-title" data-i18n="step2">Step 2</h1>

                <!-- Kebutuhan Furniture -->
                <div class="form-section">
                    <label class="form-label-custom" data-i18n="kebutuhan_furniture">Kebutuhan Furniture</label>
                    <div class="furniture-cards">
                        <div class="furniture-card" data-value="indoor">
                            <div class="d-flex align-items-start">
                                <div class="option-checkbox me-3"></div>
                                <div>
                                    <div class="card-title" data-i18n="indoor_furniture">Indoor Furniture</div>
                                    <div class="card-desc" data-i18n="indoor_desc">Living Room, Bedroom, Dining, dll
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="furniture-card" data-value="outdoor">
                            <div class="d-flex align-items-start">
                                <div class="option-checkbox me-3"></div>
                                <div>
                                    <div class="card-title" data-i18n="outdoor_furniture">Outdoor Furniture</div>
                                    <div class="card-desc" data-i18n="outdoor_desc">Poolside, Garden, Terrace, Patio
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Detail Kebutuhan -->
                <div class="form-section">
                    <label class="form-label-custom" data-i18n="detail_kebutuhan">Detail Kebutuhan Furniture</label>
                    <textarea name="detail_kebutuhan" class="form-control form-control-custom auto-resize" rows="3"
                        placeholder="Contoh: Sofa 3-seater, Meja Makan 8 kursi, Daybed untuk Villa, dll"
                        data-i18n="detail_placeholder"></textarea>
                </div>

                <!-- Estimasi Budget -->
                <div class="form-section">
                    <label class="form-label-custom" data-i18n="estimasi_budget">Estimasi Budget</label>

                    <div class="option-item" data-checkbox="estimasi_budget" data-value="<10jt" data-max="1">
                        <div class="option-checkbox"></div>
                        <span class="option-label" data-i18n="budget_10jt">&lt; Rp10 juta</span>
                    </div>

                    <div class="option-item" data-checkbox="estimasi_budget" data-value="10-50jt" data-max="1">
                        <div class="option-checkbox"></div>
                        <span class="option-label" data-i18n="budget_10_50jt">Rp10 - 50 juta</span>
                    </div>

                    <div class="option-item" data-checkbox="estimasi_budget" data-value="50-200jt" data-max="1">
                        <div class="option-checkbox"></div>
                        <span class="option-label" data-i18n="budget_50_200jt">Rp50 - 200 juta</span>
                    </div>

                    <div class="option-item" data-checkbox="estimasi_budget" data-value=">200jt" data-max="1">
                        <div class="option-checkbox"></div>
                        <span class="option-label" data-i18n="budget_200jt">&gt; Rp200 juta</span>
                    </div>
                </div>

                <!-- Estimasi Waktu -->
                <div class="form-section">
                    <label class="form-label-custom" data-i18n="estimasi_waktu">Estimasi Waktu proyek /
                        Pembelian</label>

                    <div class="option-item" data-checkbox="estimasi_waktu" data-value="segera" data-max="1">
                        <div class="option-checkbox"></div>
                        <span class="option-label" data-i18n="waktu_segera">Segera (1 - 3 bulan ke depan)</span>
                    </div>

                    <div class="option-item" data-checkbox="estimasi_waktu" data-value="menengah" data-max="1">
                        <div class="option-checkbox"></div>
                        <span class="option-label" data-i18n="waktu_menengah">Jangka Menengah (3 - 6 bulan ke
                            depan)</span>
                    </div>

                    <div class="option-item" data-checkbox="estimasi_waktu" data-value="melihat" data-max="1">
                        <div class="option-checkbox"></div>
                        <span class="option-label" data-i18n="waktu_melihat">Hanya melihat-lihat / Mencari
                            Referensi</span>
                    </div>
                </div>

                <!-- Estimasi Jumlah -->
                <div class="form-section">
                    <label class="form-label-custom" data-i18n="estimasi_jumlah">Estimasi Jumlah / Item</label>

                    <div class="option-item" data-checkbox="estimasi_jumlah" data-value="1set" data-max="1">
                        <div class="option-checkbox"></div>
                        <span class="option-label" data-i18n="jumlah_1set">1 Set</span>
                    </div>

                    <div class="option-item" data-checkbox="estimasi_jumlah" data-value="<5pcs" data-max="1">
                        <div class="option-checkbox"></div>
                        <span class="option-label" data-i18n="jumlah_5pcs">&lt; 5 Pcs</span>
                    </div>

                    <div class="option-item" data-checkbox="estimasi_jumlah" data-value="5-20pcs" data-max="1">
                        <div class="option-checkbox"></div>
                        <span class="option-label" data-i18n="jumlah_5_20pcs">5 - 20 Pcs</span>
                    </div>

                    <div class="option-item" data-checkbox="estimasi_jumlah" data-value=">20pcs" data-max="1">
                        <div class="option-checkbox"></div>
                        <span class="option-label" data-i18n="jumlah_20pcs">&gt; 20 Pcs</span>
                    </div>
                </div>

                <!-- Preferensi Brand -->
                <div class="form-section">
                    <label class="form-label-custom"><span data-i18n="preferensi_brand">Apa yang paling Anda cari dari
                            sebuah brand furniture?</span><br><small data-i18n="preferensi_max">(Pilih maks.
                            2):</small></label>

                    <div class="option-item" data-checkbox="preferensi_brand" data-value="desain" data-max="2">
                        <div class="option-checkbox"></div>
                        <span class="option-label" data-i18n="pref_desain">Desain yang unik & Estetik</span>
                    </div>

                    <div class="option-item" data-checkbox="preferensi_brand" data-value="durability" data-max="2">
                        <div class="option-checkbox"></div>
                        <span class="option-label" data-i18n="pref_durability">Daya tahan material (Durability)</span>
                    </div>

                    <div class="option-item" data-checkbox="preferensi_brand" data-value="harga" data-max="2">
                        <div class="option-checkbox"></div>
                        <span class="option-label" data-i18n="pref_harga">Harga yang kompetitif</span>
                    </div>

                    <div class="option-item" data-checkbox="preferensi_brand" data-value="custom" data-max="2">
                        <div class="option-checkbox"></div>
                        <span class="option-label" data-i18n="pref_custom">Kemudahan kustomisasi (Custom-made)</span>
                    </div>
                </div>

                <!-- Consent -->
                <div class="form-section">
                    <div class="simple-checkbox-item" id="consentCheckbox" onclick="toggleConsent()">
                        <div class="option-checkbox" id="consentBox"></div>
                        <span class="option-label" style="color: #666;"><span data-i18n="consent_text">Saya bersedia
                                dihubungi untuk
                                informasi produk, promo, dan event selanjutnya.</span> <span
                                class="required">*</span></span>
                    </div>
                    <input type="hidden" name="consent" id="consentInput" required>
                    <div id="consentError" class="text-danger mt-2"
                        style="display: none; font-size: 13px; font-weight: 500;">
                        <i class="fas fa-exclamation-circle me-1"></i> <span
                            data-i18n="error_consent_required">Checklist persetujuan wajib dicentang!</span>
                    </div>
                </div>

                <div class="buttons-container">
                    <button type="button" class="btn btn-secondary-custom" onclick="prevStep()"
                        data-i18n="btn_kembali">Kembali</button>
                    <button type="submit" class="btn btn-primary-custom" data-i18n="btn_kirim">Kirim</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-contact">
            email@example.com | 081234567890 | Pati
        </div>
        <div class="footer-credit" data-i18n="footer_credit">
            Dibuat oleh Adit cihuy
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script src="{{ asset('js/form-custom.js') }}"></script>
</body>

</html>