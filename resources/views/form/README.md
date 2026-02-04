# Struktur Form Modular

## Deskripsi
Form telah dipisahkan menjadi komponen modular untuk memudahkan pengelolaan dan pengembangan.

## Struktur File

### 1. File Utama
- **`index.blade.php`**: File utama yang mengatur layout dan include partial files

### 2. Partial Files
- **`_step1.blade.php`**: Konten Step 1 (Data Pribadi & Kategori)
  - Nama Lengkap
  - Nomor WhatsApp
  - Email
  - Kategori Pengunjung (dengan conditional B2B fields)
  - Jenis Bisnis

- **`_step2.blade.php`**: Konten Step 2 (Pertanyaan Dinamis)
  - Pertanyaan dinamis dari database
  - Support berbagai tipe input:
    - Text
    - Number
    - Textarea
    - Radio buttons
    - Checkboxes
    - Checkbox cards
    - Dropdown/Select
  - Consent checkbox

## Keuntungan Struktur Modular

### 1. **Maintainability**
- Setiap step memiliki file terpisah
- Mudah menemukan dan mengedit kode spesifik
- Mengurangi kompleksitas file utama

### 2. **Reusability**
- Partial dapat digunakan di halaman lain jika diperlukan
- Komponen dapat di-test secara terpisah

### 3. **Scalability**
- Mudah menambah step baru
- Mudah mengubah urutan step
- Mudah menambah tipe pertanyaan baru di Step 2

### 4. **Dynamic Content**
- Step 2 sepenuhnya dinamis dari database
- Tidak perlu edit kode untuk menambah pertanyaan
- Semua dikelola dari admin panel

## Cara Menambah Pertanyaan Baru

### Via Database
1. Buat pertanyaan baru di tabel `questions`
2. Pilih tipe pertanyaan dari `type_questions`
3. Jika ada opsi, tambahkan di `question_options`
4. Tambahkan terjemahan di `question_translations` dan `question_option_translations`

### Tipe Pertanyaan yang Didukung
- `text`: Input teks biasa
- `number`: Input angka
- `textarea`: Input teks panjang
- `radio`: Pilihan tunggal (radio button)
- `checkbox`: Pilihan multiple (checkbox)
- `checkbox_card`: Pilihan multiple dengan card design
- `dropdown`: Dropdown/select

## Catatan Penting
- Semua pertanyaan di Step 2 mendukung multi-bahasa
- Validasi dilakukan di JavaScript (`form-custom.js`)
- Hidden input digunakan untuk menyimpan nilai checkbox dan radio
