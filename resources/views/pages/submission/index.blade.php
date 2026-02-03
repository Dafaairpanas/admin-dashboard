@extends('layouts.vertical', ['title' => 'Inbox (Submissions)'])

@section('css')
    <style>
        /* Mimic Form Styling inside Modal */
        .form-label-custom {
            display: block;
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: #333;
        }

        .form-control-custom {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 0.75rem 1rem;
            background-color: #f9f9f9;
        }

        .option-item {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            border: 1px solid #eee;
            border-radius: 8px;
            margin-bottom: 10px;
            background: #fff;
        }

        .option-item.selected {
            background-color: #FFF5EC;
            border-color: #FF7F50;
        }

        .option-checkbox {
            width: 20px;
            height: 20px;
            border: 2px solid #ddd;
            border-radius: 50%;
            /* Circle for radio look, square for checkbox */
            margin-right: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .option-item.selected .option-checkbox {
            background-color: #FF7F50;
            border-color: #FF7F50;
        }

        .furniture-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
        }

        .furniture-card {
            border: 1px solid #eee;
            border-radius: 10px;
            padding: 15px;
            cursor: default;
        }

        .furniture-card.selected {
            border-color: #FF7F50;
            background-color: #FFF5EC;
        }
    </style>
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                <h4 class="page-title">Inbox</h4>
                <div class="">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Management</a></li>
                        <li class="breadcrumb-item active">Inbox</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Messages List</h4>
                        </div>
                    </div>

                    <form action="{{ route('submissions.index') }}" method="GET" class="mt-3">
                        <div class="input-group">
                            <input type="text" name="search_value" class="form-control"
                                placeholder="Search by name, email, company..." value="{{ $search ?? '' }}">
                            <button class="btn btn-outline-secondary" type="submit">Search</button>
                        </div>
                    </form>
                </div>

                <div class="card-body pt-0">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table mb-0 table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Date</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $item)
                                    <tr>
                                        <td>{{ $item->created_at->format('d M Y H:i') }}</td>
                                        <td>
                                            <h6 class="m-0">{{ $item->full_name }}</h6>
                                            <div class="small text-muted">{{ $item->email }}</div>
                                        </td>
                                        <td>
                                            @if($item->kategori_pengunjung == 'b2b')
                                                <span class="badge bg-purple">Instansi (B2B)</span>
                                                <div class="mt-1 small fw-bold">{{ $item->nama_perusahaan }}</div>
                                            @else
                                                <span class="badge bg-info">Perseorangan</span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <button class="btn btn-sm btn-soft-primary btn-view" data-bs-toggle="modal"
                                                data-bs-target="#viewSubmissionModal" data-json="{{ json_encode($item) }}">
                                                <i class="las la-eye fs-18"></i> View
                                            </button>

                                            <form action="{{ route('submissions.destroy', $item->id) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm('Delete this message?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-soft-danger">
                                                    <i class="las la-trash-alt fs-18"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No messages found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-3">
                        {{ $data->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- View Detail Modal (Form Style) -->
    <div class="modal fade" id="viewSubmissionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Submission Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-light">
                    <!-- Form Container Mimic -->
                    <div class="p-3 bg-white rounded shadow-sm">

                        <!-- Step 1: Personal Info -->
                        <h5 class="mb-3 text-primary">Personal Info</h5>
                        <div class="mb-3">
                            <label class="form-label-custom">Nama Lengkap</label>
                            <input type="text" id="view_nama_lengkap" class="form-control form-control-custom" readonly>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">WhatsApp</label>
                                <input type="text" id="view_whatsapp" class="form-control form-control-custom" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Email</label>
                                <input type="text" id="view_email" class="form-control form-control-custom" readonly>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label-custom">Kategori Pengunjung</label>
                            <input type="text" id="view_kategori_pengunjung" class="form-control form-control-custom"
                                readonly>
                        </div>

                        <div id="view_b2b_fields" style="display: none;">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label-custom">Nama Perusahaan</label>
                                    <input type="text" id="view_nama_perusahaan" class="form-control form-control-custom"
                                        readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label-custom">Posisi / Jabatan</label>
                                    <input type="text" id="view_posisi_jabatan" class="form-control form-control-custom"
                                        readonly>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Dynamic Questions -->
                        <h5 class="my-3 text-primary">Need Assessment</h5>

                        @foreach($questions as $q)
                            <div class="mb-4">
                                <label
                                    class="form-label-custom">{{ $q->refQuestionTranslations->first()->question_text ?? 'Question' }}</label>

                                {{-- Rendering Logic adapted for Read-Only --}}
                                @if($q->refTypeQuestion->code == 'checkbox_card')
                                    <div class="furniture-cards">
                                        @foreach($q->refQuestionOptions as $opt)
                                            <div class="furniture-card view-option-card" data-key="{{ $q->key }}"
                                                data-value="{{ $opt->refQuestionOptionTranslations->first()->option_text ?? $opt->id }}">
                                                <div class="d-flex align-items-center">
                                                    <div class="option-checkbox me-2"></div>
                                                    <span>{{ $opt->refQuestionOptionTranslations->first()->option_text ?? '' }}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                @elseif($q->refTypeQuestion->code == 'textarea')
                                    <textarea id="view_q_{{ $q->key }}" class="form-control form-control-custom" rows="3"
                                        readonly></textarea>

                                @elseif($q->refTypeQuestion->code == 'text')
                                    <input type="text" id="view_q_{{ $q->key }}" class="form-control form-control-custom" readonly>

                                @elseif($q->refTypeQuestion->code == 'radio' || $q->refTypeQuestion->code == 'checkbox')
                                    <div class="d-flex flex-column gap-2">
                                        @foreach($q->refQuestionOptions as $opt)
                                            <div class="option-item view-option-item" data-key="{{ $q->key }}"
                                                data-value="{{ $opt->refQuestionOptionTranslations->first()->option_text ?? $opt->id }}">
                                                <div class="option-checkbox"></div>
                                                <span>{{ $opt->refQuestionOptionTranslations->first()->option_text ?? '' }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endforeach

                        <!-- Extra Fields that might not be in Questions (e.g. Other Business Type) -->
                        <div class="mb-3">
                            <label class="form-label-custom">Bisnis Lainnya</label>
                            <input type="text" id="view_jenis_bisnis_lainnya" class="form-control form-control-custom"
                                readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script-bottom')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const viewModal = document.getElementById('viewSubmissionModal');
            viewModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const dataStr = button.getAttribute('data-json');
                let data = {};
                try { data = JSON.parse(dataStr); } catch (e) { console.error(e); }

                // Reset all selected states
                document.querySelectorAll('.view-option-card, .view-option-item').forEach(el => {
                    el.classList.remove('selected');
                    // Reset checkbox inner
                    el.querySelector('.option-checkbox').innerHTML = '';
                });

                // Populate Static Fields
                document.getElementById('view_nama_lengkap').value = data.full_name || '-';
                document.getElementById('view_whatsapp').value = data.phone_number || '-';
                document.getElementById('view_email').value = data.email || '-';

                // Category
                const isB2B = data.kategori_pengunjung === 'b2b';
                document.getElementById('view_kategori_pengunjung').value = isB2B ? 'Instansi / Perusahaan (B2B)' : 'Perseorangan';

                const b2bDiv = document.getElementById('view_b2b_fields');
                if (isB2B) {
                    b2bDiv.style.display = 'block';
                    document.getElementById('view_nama_perusahaan').value = data.nama_perusahaan || '-';
                    document.getElementById('view_posisi_jabatan').value = data.posisi_jabatan || '-';
                } else {
                    b2bDiv.style.display = 'none';
                }

                document.getElementById('view_jenis_bisnis_lainnya').value = data.jenis_bisnis_lainnya || '-';

                // Helper to parse JSON fields
                const getList = (key) => {
                    const field = data[key];
                    if (!field) return [];
                    if (Array.isArray(field)) return field;
                    try {
                        const parsed = JSON.parse(field);
                        return Array.isArray(parsed) ? parsed : [parsed];
                    } catch (e) { return [field]; }
                };

                const getString = (key) => {
                    return data[key] || '';
                }

                // Populate Dynamic Fields via Key Matching
                // Iterate over all data keys to find matching input elements
                for (const [key, value] of Object.entries(data)) {
                    // Try to find text element (textarea or input) with id 'view_q_{key}'
                    const textEl = document.getElementById('view_q_' + key);
                    if (textEl) {
                        textEl.value = value || '';
                    }
                }

                // Option Selects (Radio/Checkbox)
                // They have class .view-option-item or .view-option-card and data-key="{key}" data-value="{value}"
                // We iterate all options in the dom and check if their value exists in the data[key]

                document.querySelectorAll('[data-key]').forEach(el => {
                    const key = el.dataset.key;
                    const val = el.dataset.value;

                    // Get data for this key
                    // The data could be a string (for radio/single) or array (json string)
                    const dataVals = getList(key); // Always treat as list for inclusion check

                    if (dataVals.includes(val)) {
                        el.classList.add('selected');
                        el.querySelector('.option-checkbox').innerHTML = '<i class="fas fa-check" style="color: white; font-size: 12px;"></i>';
                    }

                    // Special case for Business Type "Lainnya"
                    // If 'lainnya' is selected, check it.
                    if (key === 'jenis_bisnis' && val === 'lainnya' && dataVals.includes('lainnya')) {
                        el.classList.add('selected');
                    }
                });
            });
        });
    </script>
@endsection