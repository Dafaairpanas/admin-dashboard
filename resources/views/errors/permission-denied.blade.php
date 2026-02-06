@extends('layouts.app')

@section('content')
    <div class="container-xxl">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center py-5">
                        <div class="mb-4">
                            <i class="fas fa-lock text-danger" style="font-size: 5rem;"></i>
                        </div>
                        <h2 class="fw-semibold text-dark mb-3">Akses Ditolak</h2>
                        <p class="text-muted mb-4">
                            Maaf, Anda tidak memiliki izin untuk mengakses halaman ini.<br>
                            Silakan hubungi administrator jika Anda merasa ini adalah kesalahan.
                        </p>
                        @if(session('error'))
                            <div class="alert alert-danger alert-sm d-inline-block px-4">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="mt-4">
                            <a href="{{ url('/dashboard') }}" class="btn btn-primary px-4">
                                <i class="fas fa-home me-2"></i>Kembali ke Dashboard
                            </a>
                            <a href="javascript:history.back()" class="btn btn-outline-secondary px-4 ms-2">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection