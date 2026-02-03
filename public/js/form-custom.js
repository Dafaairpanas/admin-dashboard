let currentStep = 1;
const totalSteps = 2;

// Form data storage
let formData = {
    jenis_bisnis: [],
    kebutuhan_furniture: [],
    estimasi_jumlah: [],
    preferensi_brand: []
};

// Language System
let currentLang = localStorage.getItem('selectedLanguage') || 'en'; // Default English

const translations = {
    id: {
        // Progress
        step_of: 'Langkah {current} dari {total}',

        // Step titles
        step1: 'Langkah 1',
        step2: 'Langkah 2',

        // Labels
        nama_lengkap: 'Nama lengkap',
        nomor_whatsapp: 'Nomor Whatsapp / Telepon',
        alamat_email: 'Alamat Email',
        kategori_pengunjung: 'Kategori Pengunjung',
        nama_perusahaan: 'Nama perusahaan',
        posisi_jabatan: 'Posisi / Jabatan',
        jenis_bisnis: 'Jenis Bisnis',
        kebutuhan_furniture: 'Kebutuhan Furniture',
        detail_kebutuhan: 'Detail Kebutuhan Furniture',
        estimasi_budget: 'Estimasi Budget',
        estimasi_waktu: 'Estimasi Waktu proyek / Pembelian',
        estimasi_jumlah: 'Estimasi Jumlah / Item',
        preferensi_brand: 'Apa yang paling Anda cari dari sebuah brand furniture?',
        preferensi_max: '(Pilih maks. 2):',
        consent_text: 'Saya bersedia dihubungi untuk informasi produk, promo, dan event selanjutnya.',

        // Options - Kategori
        perseorangan: 'Perseorangan',
        b2b: 'Instansi / Perusahaan (B2B)',

        // Options - Jenis Bisnis
        hotel_resort: 'Hotel / Resort',
        villa: 'Villa',
        cafe_restaurant: 'Cafe / Restaurant / Beach Club',
        developer: 'Developer / Kontraktor',
        designer: 'Designer Interior',
        lainnya: 'Lainnya',
        jenis_bisnis_placeholder: 'Sebutkan jenis bisnis lainnya...',

        // Furniture
        indoor_furniture: 'Indoor Furniture',
        indoor_desc: 'Living Room, Bedroom, Dining, dll',
        outdoor_furniture: 'Outdoor Furniture',
        outdoor_desc: 'Poolside, Garden, Terrace, Patio',
        detail_placeholder: 'Contoh: Sofa 3-seater, Meja Makan 8 kursi, Daybed untuk Villa, dll',

        // Budget
        budget_10jt: '< Rp10 juta',
        budget_10_50jt: 'Rp10 - 50 juta',
        budget_50_200jt: 'Rp50 - 200 juta',
        budget_200jt: '> Rp200 juta',

        // Waktu
        waktu_segera: 'Segera (1 - 3 bulan ke depan)',
        waktu_menengah: 'Jangka Menengah (3 - 6 bulan ke depan)',
        waktu_melihat: 'Hanya melihat-lihat / Mencari Referensi',

        // Jumlah
        jumlah_1set: '1 Set',
        jumlah_5pcs: '< 5 Pcs',
        jumlah_5_20pcs: '5 - 20 Pcs',
        jumlah_20pcs: '> 20 Pcs',

        // Preferensi
        pref_desain: 'Desain yang unik & Estetik',
        pref_durability: 'Daya tahan material (Durability)',
        pref_harga: 'Harga yang kompetitif',
        pref_custom: 'Kemudahan kustomisasi (Custom-made)',

        // Buttons
        btn_lanjut: 'Lanjut',
        btn_kembali: 'Kembali',
        btn_kirim: 'Kirim',

        // Footer
        footer_credit: 'Dibuat oleh Rajawali Perkasa Furniture',

        // Validation
        alert_fill_fields: 'Mohon lengkapi Nama, WhatsApp, dan Email',
        alert_kategori: 'Mohon pilih Kategori Pengunjung',
        alert_jenis_bisnis: 'Mohon pilih Jenis Bisnis',
        alert_max: 'Maksimal {max} pilihan',

        // Validation Messages
        error_nama_required: 'Mohon isi Nama Lengkap Anda',
        error_whatsapp_required: 'Mohon isi Nomor WhatsApp / Telepon Anda',
        error_whatsapp_min: 'Nomor WhatsApp minimal 9 digit',
        error_whatsapp_max: 'Nomor WhatsApp maksimal 16 digit',
        error_email_required: 'Mohon isi Alamat Email Anda',
        error_email_invalid: 'Format email tidak valid. Contoh: nama@email.com',
        error_kategori_required: 'Mohon pilih Kategori Pengunjung (Perseorangan atau Instansi/Perusahaan)',
        error_perusahaan_required: 'Mohon isi Nama Perusahaan',
        error_posisi_required: 'Mohon isi Posisi / Jabatan Anda',
        error_jenis_bisnis_required: 'Mohon pilih Jenis Bisnis Anda',
        error_jenis_bisnis_lainnya: 'Mohon isi jenis bisnis Anda',
        error_consent_required: 'Checklist persetujuan wajib dicentang!'
    },
    en: {
        // Progress
        step_of: 'Step {current} of {total}',

        // Step titles
        step1: 'Step 1',
        step2: 'Step 2',

        // Labels
        nama_lengkap: 'Full Name',
        nomor_whatsapp: 'WhatsApp / Phone Number',
        alamat_email: 'Email Address',
        kategori_pengunjung: 'Visitor Category',
        nama_perusahaan: 'Company Name',
        posisi_jabatan: 'Position / Title',
        jenis_bisnis: 'Business Type',
        kebutuhan_furniture: 'Furniture Needs',
        detail_kebutuhan: 'Furniture Details',
        estimasi_budget: 'Estimated Budget',
        estimasi_waktu: 'Project / Purchase Timeline',
        estimasi_jumlah: 'Estimated Quantity / Items',
        preferensi_brand: 'What do you look for most in a furniture brand?',
        preferensi_max: '(Choose max. 2):',
        consent_text: 'I agree to be contacted for product information, promotions, and upcoming events.',

        // Options - Kategori
        perseorangan: 'Individual',
        b2b: 'Company / Institution (B2B)',

        // Options - Jenis Bisnis
        hotel_resort: 'Hotel / Resort',
        villa: 'Villa',
        cafe_restaurant: 'Cafe / Restaurant / Beach Club',
        developer: 'Developer / Contractor',
        designer: 'Interior Designer',
        lainnya: 'Others',
        jenis_bisnis_placeholder: 'Enter your business type...',

        // Furniture
        indoor_furniture: 'Indoor Furniture',
        indoor_desc: 'Living Room, Bedroom, Dining, etc.',
        outdoor_furniture: 'Outdoor Furniture',
        outdoor_desc: 'Poolside, Garden, Terrace, Patio',
        detail_placeholder: 'Example: 3-seater Sofa, Dining Table for 8, Daybed for Villa, etc.',

        // Budget
        budget_10jt: '< IDR 10 million',
        budget_10_50jt: 'IDR 10 - 50 million',
        budget_50_200jt: 'IDR 50 - 200 million',
        budget_200jt: '> IDR 200 million',

        // Waktu
        waktu_segera: 'Immediately (1 - 3 months)',
        waktu_menengah: 'Medium Term (3 - 6 months)',
        waktu_melihat: 'Just browsing / Looking for references',

        // Jumlah
        jumlah_1set: '1 Set',
        jumlah_5pcs: '< 5 Pcs',
        jumlah_5_20pcs: '5 - 20 Pcs',
        jumlah_20pcs: '> 20 Pcs',

        // Preferensi
        pref_desain: 'Unique & Aesthetic Design',
        pref_durability: 'Material Durability',
        pref_harga: 'Competitive Pricing',
        pref_custom: 'Easy Customization (Custom-made)',

        // Buttons
        btn_lanjut: 'Next',
        btn_kembali: 'Back',
        btn_kirim: 'Submit',

        // Footer
        footer_credit: 'Made by Rajawali Perkasa Furniture',

        // Validation
        alert_fill_fields: 'Please fill in Name, WhatsApp, and Email',
        alert_kategori: 'Please select Visitor Category',
        alert_jenis_bisnis: 'Please select Business Type',
        alert_max: 'Maximum {max} selections',

        // Validation Messages
        error_nama_required: 'Please enter your Full Name',
        error_whatsapp_required: 'Please enter your WhatsApp / Phone Number',
        error_whatsapp_min: 'WhatsApp number must be at least 9 digits',
        error_whatsapp_max: 'WhatsApp number cannot exceed 16 digits',
        error_email_required: 'Please enter your Email Address',
        error_email_invalid: 'Invalid email format. Example: name@email.com',
        error_kategori_required: 'Please select Visitor Category (Individual or Company/Institution)',
        error_perusahaan_required: 'Please enter Company Name',
        error_posisi_required: 'Please enter your Position / Title',
        error_jenis_bisnis_required: 'Please select your Business Type',
        error_jenis_bisnis_lainnya: 'Please enter your business type',
        error_consent_required: 'Consent checkbox must be checked!'
    }
};

// Merge Dynamic Translations if available
if (window.dynamicTranslations) {
    if (window.dynamicTranslations.id) {
        Object.assign(translations.id, window.dynamicTranslations.id);
    }
    if (window.dynamicTranslations.en) {
        Object.assign(translations.en, window.dynamicTranslations.en);
    }
}

function t(key) {
    return translations[currentLang][key] || key;
}

function switchLanguage(lang) {
    currentLang = lang;

    // Simpan ke localStorage
    localStorage.setItem('selectedLanguage', lang);

    // Update flag
    updateFlag(lang);

    // Update all translatable elements
    document.querySelectorAll('[data-i18n]').forEach(el => {
        const key = el.dataset.i18n;
        if (el.tagName === 'INPUT' || el.tagName === 'TEXTAREA') {
            el.placeholder = t(key);
        } else {
            el.innerHTML = t(key);
        }
    });

    // Update progress text
    updateProgress();
}

function updateFlag(lang) {
    const selectedLang = document.getElementById('selectedLang');
    if (!selectedLang) return;

    const flagImg = selectedLang.querySelector('.flag-circle');
    const flagUrl = lang === 'id'
        ? '/images/logos/idflag.png'
        : '/images/logos/engflag.png';
    const flagAlt = lang === 'id' ? 'Indonesia' : 'English';

    if (flagImg) {
        flagImg.src = flagUrl;
        flagImg.alt = flagAlt;
    }

    // Update selected option
    document.querySelectorAll('.lang-option').forEach(option => {
        option.classList.remove('selected');
    });

    const selectedOption = document.querySelector(`.lang-option[data-lang="${lang}"]`);
    if (selectedOption) {
        selectedOption.classList.add('selected');
    }
}

// Custom dropdown handlers
document.addEventListener('DOMContentLoaded', function () {
    const langDropdown = document.getElementById('langDropdown');
    const selectedLang = document.getElementById('selectedLang');
    const langOptions = document.querySelectorAll('.lang-option');

    if (!langDropdown || !selectedLang) return;

    // Set initial language
    updateFlag(currentLang);
    switchLanguage(currentLang);

    // Real-time validation for WhatsApp on blur
    const whatsappInput = document.getElementById('whatsapp');
    if (whatsappInput) {
        whatsappInput.addEventListener('blur', function () {
            const val = this.value.trim();
            if (val && (val.length < 9 || val.length > 16)) {
                if (val.length < 9) showError('whatsapp', 'error_whatsapp_min');
                if (val.length > 16) showError('whatsapp', 'error_whatsapp_max');
            } else if (val) {
                // Clear error if valid
                const field = this;
                field.classList.remove('error');
                const errorDiv = document.getElementById('error_' + field.id);
                if (errorDiv) {
                    errorDiv.classList.remove('show');
                    errorDiv.innerHTML = '';
                }
            }
        });
    }

    // Toggle dropdown
    selectedLang.addEventListener('click', function (e) {
        e.stopPropagation();
        langDropdown.classList.toggle('active');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function (e) {
        if (!langDropdown.contains(e.target)) {
            langDropdown.classList.remove('active');
        }
    });

    // Handle language selection
    langOptions.forEach(option => {
        option.addEventListener('click', function (e) {
            e.stopPropagation();
            const selectedLanguage = this.dataset.lang;

            // Update selected state
            langOptions.forEach(opt => opt.classList.remove('selected'));
            this.classList.add('selected');

            // Switch language
            switchLanguage(selectedLanguage);

            // Close dropdown
            langDropdown.classList.remove('active');
        });
    });
});

// Update progress bar
function updateProgress() {
    const progress = (currentStep / totalSteps) * 100;
    document.getElementById('progressBar').style.width = progress + '%';
    document.getElementById('progressText').textContent = t('step_of')
        .replace('{current}', currentStep)
        .replace('{total}', totalSteps);
}

// Navigate to next step
function nextStep() {
    if (validateStep1()) {
        document.getElementById('step1').classList.remove('active');
        document.getElementById('step2').classList.add('active');
        currentStep = 2;
        updateProgress();
        window.scrollTo(0, 0);
    }
}

// Navigate to previous step
function prevStep() {
    document.getElementById('step2').classList.remove('active');
    document.getElementById('step1').classList.add('active');
    currentStep = 1;
    updateProgress();
    window.scrollTo(0, 0);
}

// Helper function untuk menampilkan error
function showError(fieldId, message) {
    const field = document.getElementById(fieldId);
    const errorDiv = document.getElementById('error_' + fieldId);

    // Tambahkan class error ke input
    field.classList.add('error');

    // Tampilkan pesan error
    errorDiv.innerHTML = '<i class="fas fa-exclamation-circle"></i> ' + message;
    errorDiv.classList.add('show');

    // Scroll ke field yang error
    field.scrollIntoView({ behavior: 'smooth', block: 'center' });

    // Focus ke field
    setTimeout(() => field.focus(), 300);
}

// Helper function untuk clear semua error
function clearErrors() {
    document.querySelectorAll('.form-control-custom').forEach(field => {
        field.classList.remove('error');
    });
    document.querySelectorAll('.error-message').forEach(error => {
        error.classList.remove('show');
        error.innerHTML = '';
    });
}

// Helper function to show error
function showError(fieldId, messageKey) {
    const field = document.getElementById(fieldId);
    const errorDiv = document.getElementById('error_' + fieldId);

    // Simpan key translasi di dataset agar bisa diupdate saat ganti bahasa
    // Jika messageKey bukan key translasi yang valid (karena custom text), simpan text aslinya
    // Tapi strategi terbaik adalah selalu pass key ke showError, bukan text
    // Di sini kita asumsikan messageKey adalah translated text, jadi kita perlu ubah call site nya
    // TAPI untuk meminimalisir refactor besar, kita ubah showError agar menerima parameter ke-3 opsional atau kita ubah cara panggilnya

    // Agar alert ngikut language, kita harus simpan translation KEY nya
    // Kita ubah showError agar menerima (fieldId, translationKey)
    // Lalu di sini kita translate

    field.classList.add('error');
    errorDiv.innerHTML = '<i class="fas fa-exclamation-circle"></i> ' + t(messageKey); // messageKey harus berupa KEY sekarang
    errorDiv.classList.add('show');
    errorDiv.dataset.i18nError = messageKey; // Simpan key untuk update nanti

    // Shake animation
    field.style.animation = 'none';
    field.offsetHeight; // Trigger reflow
    field.style.animation = 'shake 0.5s';

    // Focus to first error
    setTimeout(() => field.focus(), 300);
}

// Modify switchLanguage to update errors too
function switchLanguage(lang) {
    currentLang = lang;

    // Simpan ke localStorage
    localStorage.setItem('selectedLanguage', lang);

    // Update flag
    updateFlag(lang);

    // Update all translatable elements
    document.querySelectorAll('[data-i18n]').forEach(el => {
        const key = el.dataset.i18n;
        if (el.tagName === 'INPUT' || el.tagName === 'TEXTAREA') {
            el.placeholder = t(key);
        } else {
            el.innerHTML = t(key);
        }
    });

    // Update visible error messages
    document.querySelectorAll('.error-message.show').forEach(el => {
        const key = el.dataset.i18nError;
        if (key) {
            el.innerHTML = '<i class="fas fa-exclamation-circle"></i> ' + t(key);
        }
    });

    // Update progress text
    updateProgress();
}

// Validate Step 1
function validateStep1() {
    // Clear semua error sebelumnya
    clearErrors();

    const nama = document.getElementById('nama_lengkap').value.trim();
    const whatsapp = document.getElementById('whatsapp').value.trim();
    const email = document.getElementById('email').value.trim();
    const kategori = document.getElementById('kategori_pengunjung').value;

    // Validasi Nama
    if (!nama) {
        showError('nama_lengkap', 'error_nama_required');
        return false;
    }

    // Validasi WhatsApp
    if (!whatsapp) {
        showError('whatsapp', 'error_whatsapp_required');
        return false;
    }

    if (whatsapp.length < 9) {
        showError('whatsapp', 'error_whatsapp_min');
        return false;
    }

    if (whatsapp.length > 16) {
        showError('whatsapp', 'error_whatsapp_max');
        return false;
    }

    // Validasi Email
    if (!email) {
        showError('email', 'error_email_required');
        return false;
    }

    // Validasi format email
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        showError('email', 'error_email_invalid');
        return false;
    }

    // Validasi Kategori
    if (!kategori) {
        const errorDiv = document.getElementById('error_kategori_pengunjung');
        errorDiv.innerHTML = '<i class="fas fa-exclamation-circle"></i> ' + t('error_kategori_required');
        errorDiv.classList.add('show');
        errorDiv.dataset.i18nError = 'error_kategori_required';
        window.scrollTo({ top: document.querySelector('[data-radio="kategori"]').offsetTop - 150, behavior: 'smooth' });
        return false;
    }

    // Validasi B2B Fields (jika kategori adalah B2B)
    if (kategori === 'b2b') {
        const namaPerusahaan = document.getElementById('nama_perusahaan').value.trim();
        const posisiJabatan = document.getElementById('posisi_jabatan').value.trim();

        if (!namaPerusahaan) {
            showError('nama_perusahaan', 'error_perusahaan_required');
            return false;
        }

        if (!posisiJabatan) {
            showError('posisi_jabatan', 'error_posisi_required');
            return false;
        }
    }

    // Validasi Jenis Bisnis
    if (!formData.jenis_bisnis || formData.jenis_bisnis.length === 0) {
        const errorDiv = document.getElementById('error_jenis_bisnis');
        errorDiv.innerHTML = '<i class="fas fa-exclamation-circle"></i> ' + t('error_jenis_bisnis_required');
        errorDiv.classList.add('show');
        errorDiv.dataset.i18nError = 'error_jenis_bisnis_required';
        window.scrollTo({ top: document.querySelector('[data-checkbox="jenis_bisnis"]').offsetTop - 150, behavior: 'smooth' });
        return false;
    }

    // Validasi input "Lainnya" jika dipilih
    if (formData.jenis_bisnis && formData.jenis_bisnis.includes('lainnya')) {
        const lainnyaInput = document.getElementById('jenis_bisnis_lainnya').value.trim();
        if (!lainnyaInput) {
            showError('jenis_bisnis_lainnya', 'error_jenis_bisnis_lainnya');
            return false;
        }
    }

    return true;
}

// Auto-clear error ketika user mulai mengetik
['nama_lengkap', 'whatsapp', 'email', 'nama_perusahaan', 'posisi_jabatan', 'jenis_bisnis_lainnya'].forEach(fieldId => {
    const field = document.getElementById(fieldId);
    const errorDiv = document.getElementById('error_' + fieldId);

    field.addEventListener('input', function () {
        if (this.classList.contains('error')) {
            this.classList.remove('error');
            errorDiv.classList.remove('show');
            errorDiv.innerHTML = '';
        }
    });
});

// Radio button handler
document.querySelectorAll('[data-radio]').forEach(item => {
    item.addEventListener('click', function () {
        const radioName = this.dataset.radio;
        const value = this.dataset.value;

        // Remove selected from siblings
        document.querySelectorAll(`[data-radio="${radioName}"]`).forEach(sibling => {
            sibling.classList.remove('selected');
        });

        // Add selected to clicked
        this.classList.add('selected');

        // Update hidden input
        const hiddenInput = document.getElementById(radioName === 'kategori' ? 'kategori_pengunjung' : radioName);
        if (hiddenInput) {
            hiddenInput.value = value;
        }

        // Clear error untuk kategori pengunjung
        if (radioName === 'kategori') {
            const errorDiv = document.getElementById('error_kategori_pengunjung');
            if (errorDiv) {
                errorDiv.classList.remove('show');
                errorDiv.innerHTML = '';
            }
        }

        // Handle B2B conditional fields
        if (radioName === 'kategori') {
            const b2bFields = document.getElementById('b2bFields');
            if (value === 'b2b') {
                b2bFields.classList.add('show');
            } else {
                b2bFields.classList.remove('show');
            }
        }

        // Handle Lainnya input for jenis_bisnis
        if (radioName === 'jenis_bisnis') {
            const lainnyaInput = document.getElementById('lainnyaInput');
            if (value === 'lainnya') {
                lainnyaInput.classList.add('show');
            } else {
                lainnyaInput.classList.remove('show');
            }
        }
    });
});

// Checkbox handler
document.querySelectorAll('[data-checkbox]').forEach(item => {
    item.addEventListener('click', function () {
        const checkboxName = this.dataset.checkbox;
        const value = this.dataset.value;
        const maxSelect = this.dataset.max ? parseInt(this.dataset.max) : null;

        // For single select (max=1), behave like radio - deselect others first
        if (maxSelect === 1) {
            // If already selected, just deselect
            if (this.classList.contains('selected')) {
                this.classList.remove('selected');
                formData[checkboxName] = [];

                // Handle Lainnya
                if (checkboxName === 'jenis_bisnis') {
                    document.getElementById('lainnyaInput').classList.remove('show');
                }
            } else {
                // Deselect all siblings first
                document.querySelectorAll(`[data-checkbox="${checkboxName}"]`).forEach(sibling => {
                    sibling.classList.remove('selected');
                });

                // Select this one
                this.classList.add('selected');
                formData[checkboxName] = [value];

                // Clear error untuk jenis bisnis
                if (checkboxName === 'jenis_bisnis') {
                    const errorDiv = document.getElementById('error_jenis_bisnis');
                    if (errorDiv) {
                        errorDiv.classList.remove('show');
                        errorDiv.innerHTML = '';
                    }
                }

                // Handle Lainnya visibility
                if (checkboxName === 'jenis_bisnis') {
                    const lainnyaInput = document.getElementById('lainnyaInput');
                    if (value === 'lainnya') {
                        lainnyaInput.classList.add('show');
                    } else {
                        lainnyaInput.classList.remove('show');
                    }
                }
            }
        } else {
            // Multi-select logic
            if (this.classList.contains('selected')) {
                this.classList.remove('selected');
                const index = formData[checkboxName]?.indexOf(value);
                if (index > -1) {
                    formData[checkboxName].splice(index, 1);
                }
            } else {
                // Check max limit
                if (maxSelect && formData[checkboxName]?.length >= maxSelect) {
                    alert(t('alert_max').replace('{max}', maxSelect));
                    return;
                }

                this.classList.add('selected');
                if (!formData[checkboxName]) {
                    formData[checkboxName] = [];
                }
                formData[checkboxName].push(value);
            }

            // Handle Lainnya input visibility for multi-select
            if (checkboxName === 'jenis_bisnis' && value === 'lainnya') {
                const lainnyaInput = document.getElementById('lainnyaInput');
                if (this.classList.contains('selected')) {
                    lainnyaInput.classList.add('show');
                } else {
                    lainnyaInput.classList.remove('show');
                }
            }
        }

        // Update consent hidden input
        if (checkboxName === 'consent') {
            document.getElementById('consent').value = this.classList.contains('selected') ? 'yes' : '';
        }

        // Create/update hidden inputs for array data
        updateArrayInputs(checkboxName);
    });
});

// Create hidden inputs for array data
function updateArrayInputs(name) {
    // Remove existing
    document.querySelectorAll(`input[name="${name}[]"]`).forEach(el => el.remove());

    // Create new ones
    if (formData[name]) {
        formData[name].forEach(value => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = name + '[]';
            input.value = value;
            document.getElementById('multiStepForm').appendChild(input);
        });
    }
}

// Furniture card handler (same as checkbox but different styling)
document.querySelectorAll('.furniture-card').forEach(card => {
    card.addEventListener('click', function () {
        const value = this.dataset.value;
        const checkbox = this.querySelector('.option-checkbox');

        if (this.classList.contains('selected')) {
            this.classList.remove('selected');
            const index = formData.kebutuhan_furniture.indexOf(value);
            if (index > -1) {
                formData.kebutuhan_furniture.splice(index, 1);
            }
        } else {
            this.classList.add('selected');
            formData.kebutuhan_furniture.push(value);
        }

        // Update checkbox visual
        if (checkbox) {
            if (this.classList.contains('selected')) {
                checkbox.style.backgroundColor = 'var(--primary-orange)';
                checkbox.style.borderColor = 'var(--primary-orange)';
                checkbox.innerHTML = '<i class="fas fa-check" style="color: white; font-size: 12px;"></i>';
            } else {
                checkbox.style.backgroundColor = '';
                checkbox.style.borderColor = '';
                checkbox.innerHTML = '';
            }
        }

        updateArrayInputs('kebutuhan_furniture');
    });
});

// Auto-resize textarea (max 6 rows)
document.querySelectorAll('.auto-resize').forEach(textarea => {
    const lineHeight = 24; // approx line height in px
    const maxRows = 6;
    const maxHeight = lineHeight * maxRows;

    textarea.addEventListener('input', function () {
        this.style.height = 'auto';
        const newHeight = Math.min(this.scrollHeight, maxHeight);
        this.style.height = newHeight + 'px';
        this.style.overflowY = this.scrollHeight > maxHeight ? 'auto' : 'hidden';
    });
});
// Toggle Consent Checkbox
function toggleConsent() {
    const consentInput = document.getElementById('consentInput');
    const consentBox = document.getElementById('consentBox');
    const consentError = document.getElementById('consentError');

    if (consentInput.value === '1') {
        consentInput.value = '';
        consentBox.innerHTML = '';
        consentBox.style.backgroundColor = '';
        consentBox.style.borderColor = '';
    } else {
        consentInput.value = '1';
        consentBox.innerHTML = '<i class="fas fa-check" style="color: white; font-size: 12px;"></i>';
        consentBox.style.backgroundColor = 'var(--primary-orange)';
        consentBox.style.borderColor = 'var(--primary-orange)';
        consentError.style.display = 'none';
    }
}

// Form Submit Validation for Consent
document.getElementById('multiStepForm').addEventListener('submit', function (e) {
    const consentInput = document.getElementById('consentInput');
    if (consentInput.value !== '1') {
        e.preventDefault();
        document.getElementById('consentError').style.display = 'block';
        // Scroll to error
        document.getElementById('consentCheckbox').scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
});
