@extends('admin.admin_master')
@section('admin')

{{-- CSS Kustom untuk Panel Aksi Floating --}}
<style>
    .validation-panel {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background-color: #ffffff;
        border-top: 1px solid #e0e0e0;
        padding: 15px 30px;
        box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        display: flex;
        justify-content: flex-end; /* Mengatur item ke kanan */
        align-items: center;
        gap: 15px; /* Jarak antar elemen */
    }

    .validation-panel .form-control {
        flex-grow: 1; /* Membuat textarea mengambil sisa ruang */
    }
</style>

<div class="content">

    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Detail Laporan IKK</h4>
            </div>

            <div class="text-end">
                <ol class="breadcrumb m-0">
                    {{-- Ganti route ini sesuai dengan halaman daftar validasi --}}
                    <a href="{{ route('dashboard') }}" class="btn btn-dark">Kembali</a>
                </ol>
            </div>
        </div>

        @if ($report->status === 'Revisi')
            <div class="alert alert-danger" role="alert">
                <strong>Catatan Perbaikan:</strong> {{ $report->keterangan }}
            </div>
        @elseif ($report->status === 'Dikirim Ulang')
            <div class="alert alert-info" role="alert">
                Laporan ini telah dikirim ulang dan menunggu validasi.
            </div>
        @elseif ($report->status === 'Disetujui')
            <div class="alert alert-success" role="alert">
                Laporan ini telah disetujui.
            </div>
        @else
            <div class="alert alert-warning" role="alert">
                Laporan ini menunggu validasi.
            </div>
        @endif

        <div class="row">
            {{-- Kolom Kiri: Detail Laporan --}}
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="card-title mb-0">{{ $report->ikkMaster->ikk_outcome }}</h5>
                    </div>

                    <div class="card-body">
                        {{-- Data laporan dibuat read-only --}}
                        <div class="form-group mb-3">
                            <label for="ikk_output" class="form-label">IKK Output</label>
                            <textarea class="form-control" id="ikk_output" rows="5" disabled readonly>{!! $report->ikk_output !!}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">{{ $report->ikkMaster->definisi_pembilang }}</label>
                            <input type="text" class="form-control" value="{{ (float)$report->nilai_pembilang }}" disabled readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">{{ $report->ikkMaster->definisi_penyebut }}</label>
                            <input type="text" class="form-control" value="{{ (float)$report->nilai_penyebut }}" disabled readonly>
                        </div>

                        <div class="form-group">
                            <label for="capaian" class="form-label">Capaian</label>
                            <div class="input-group">
                                <input type="text" class="form-control" value="{{ (float)$report->capaian }}" disabled readonly>
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>
                </div> 
            </div> 

            {{-- Kolom Kanan: Preview File PDF --}}
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="card-title mb-0">Data Dukung</h5>
                    </div>
                    <div class="card-body">
                        @if($report->file)
                            <embed type="application/pdf" src="{{ asset('upload/laporan/' . $report->file) }}" width="100%" class="vh-100"/>
                        @else
                            <div class="text-center p-5">
                                <p class="text-muted">Tidak ada data dukung yang diunggah.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

@if (Auth::user()->hasRole('APIP'))
    {{-- Panel Aksi Validasi Floating --}}
    <div class="validation-panel">
        {{-- Form ini akan mengirimkan data validasi ke controller --}}
        <form id="validationForm" action="{{ route('laporan-pengawas.update', $report->id) }}" method="POST" class="d-flex w-100 align-items-center" style="gap: 15px;">
            @csrf
            {{-- <input type="hidden" name="report_id" value="{{ $report->id }}"> --}}
            
            <textarea name="keterangan" id="keterangan" class="form-control" placeholder="Klik tombol Minta Perbaikan, lalu tuliskan catatan perbaikan di sini..." rows="1" disabled></textarea>
            
            {{-- Tombol Aksi --}}
            <button id="requestRevisionBtn" type="submit" name="action" value="Revisi" class="btn btn-warning flex-shrink-0">
                🔄 Minta Perbaikan
            </button>
            <button id="approveBtn" type="submit" name="action" value="Setuju" class="btn btn-success flex-shrink-0">
                ✅ Setujui Laporan
            </button>
        </form>
    </div>
@endif

{{-- Script untuk interaktivitas panel --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    const validationForm = $('#validationForm');
    const catatanTextarea = $('#keterangan');

    // Aksi ketika tombol "Minta Perbaikan" di-klik
    $('#requestRevisionBtn').on('click', function(e) {
        // Aktifkan dan wajibkan textarea
        catatanTextarea.prop('disabled', false);
        catatanTextarea.prop('required', true);

        // Jika textarea kosong saat tombol diklik, hentikan submit dan beri fokus
        if (catatanTextarea.val().trim() === '') {
            e.preventDefault(); // Mencegah form untuk submit
            catatanTextarea.focus();
            // Anda bisa menambahkan notifikasi yang lebih baik seperti SweetAlert di sini
            alert('Catatan perbaikan wajib diisi!');
        }
    });

    // Aksi ketika tombol "Setujui Laporan" di-klik
    $('#approveBtn').on('click', function() {
        // Kosongkan, non-aktifkan, dan hapus atribut 'required'
        catatanTextarea.val('');
        catatanTextarea.prop('disabled', true);
        catatanTextarea.prop('required', false);
    });

    // Validasi akhir sebelum form disubmit
    validationForm.on('submit', function(e) {
        const action = $(document.activeElement).val();
        if (action === 'Revisi' && catatanTextarea.val().trim() === '') {
            e.preventDefault();
            catatanTextarea.focus();
            alert('Catatan perbaikan wajib diisi!');
        }
    });
});
</script>
@endsection