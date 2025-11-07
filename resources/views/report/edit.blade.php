@extends('admin.admin_master')
@section('admin')

<div class="content">

    <!-- Start Content-->
    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Edit Laporan</h4>
            </div>

            <div class="text-end">
                <ol class="breadcrumb m-0">
                     <a href="{{ route('laporan.index') }}" class="btn btn-dark">Kembali</a>
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
        @elseif ($reportLockStatus->value == 'Locked')
            <div class="alert alert-danger" role="alert">
                Sistem pelaporan sedang dikunci. Anda tidak dapat mengedit laporan saat ini.
            </div>
        @else
            <div class="alert alert-warning" role="alert">
                Laporan ini menunggu validasi.
            </div>
        @endif

        <!-- Form Validation -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">{{ $report->ikkMaster->ikk_outcome }}</h5>
                    </div>
<div class="card-body">
    <form id="myForm" action="{{ route('laporan.update', $report->id) }}" method="post" class="row g-3">
        @csrf

        <div class="form-group col-md-12">
            <label for="ikk_output" class="form-label">IKK Output</label>
            <textarea class="form-control" name="ikk_output" id="ikk_output" cols="30" rows="5">{!! $report->ikk_output !!}</textarea>
            @error('ikk_output')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <!-- Dynamic calculation inputs will be injected here -->
        <div id="calculation-inputs" class="row"></div>

        <div class="form-group col-md-12">
            <label for="file" class="form-label">File Bukti</label>
            <input class="form-control" type="file" name="file" id="file" value="{{ $report->file }}">
            @error('file')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group col-md-12">
            @if($report->file)
                <div class="mb-3">
                    <label class="form-label">File Saat Ini:</label>
                    <a href="{{ asset('upload/laporan/' . $report->file) }}" target="_blank" class="btn btn-info btn-sm">
                        <i class="mdi mdi-eye"></i> Lihat File
                    </a>
                    <span class="ms-2">{{ $report->file }}</span>
                </div>
            @else
                <p class="text-muted">Tidak ada file yang diunggah.</p>
            @endif
        </div>

        @if ($report->status === 'Disetujui')
            <div class="col-12 text-end">
                <button class="btn btn-primary" type="submit" disabled>Simpan Perubahan</button>
            </div>
        @elseif ($reportLockStatus->value == 'Locked')
            <div class="col-12 text-end">
                <button class="btn btn-danger" type="submit" disabled>Sistem sedang dikunci.</button>
            </div>
        @else
            <div class="col-12 text-end">
                <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
            </div>
        @endif
    </form>
</div> <!-- end card-body -->
                </div> <!-- end card-->
            </div> <!-- end col -->


        </div>



    </div> <!-- container-fluid -->

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const report = @json($report);
        const item = @json($report->ikkMaster);
        const container = document.getElementById('calculation-inputs');
        
        container.innerHTML = '';

        if (item.calculation_type === 'formula') {
            container.innerHTML = `
                <div class="form-group col-md-6 mt-3">
                    <label for="nilai_pembilang" class="form-label">${item.definisi_pembilang}</label>
                    <input type="number" class="form-control" name="nilai_pembilang" placeholder="Jika ribuan, masukkan angka tanpa tanda pemisah titik" value="${parseFloat(report.nilai_pembilang) || ''}">
                </div>
                <div class="form-group col-md-6 mt-3">
                    <label for="nilai_penyebut" class="form-label">${item.definisi_penyebut}</label>
                    <input type="number" class="form-control" name="nilai_penyebut" placeholder="Jika ribuan, masukkan angka tanpa tanda pemisah titik" value="${parseFloat(report.nilai_penyebut) || ''}">
                </div>
            `;
        } else if (item.calculation_type === 'checklist') {
            const meta = JSON.parse(item.calculation_meta);
            const answers = JSON.parse(report.checklist_answers || '[]');
            if (meta.questions) {
                meta.questions.forEach((question, index) => {
                    const isChecked = answers[index] == 1;
                    const questionDiv = document.createElement('div');
                    questionDiv.classList.add('form-group', 'col-md-3', 'mt-3');
                    questionDiv.innerHTML = `
                        <label class="form-label">${question.q}</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="checklist[${index}]" id="checklist_yes_${index}" value="1" ${isChecked ? 'checked' : ''}>
                            <label class="form-check-label" for="checklist_yes_${index}">Ya</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="checklist[${index}]" id="checklist_no_${index}" value="0" ${!isChecked ? 'checked' : ''}>
                            <label class="form-check-label" for="checklist_no_${index}">Tidak</label>
                        </div>
                    `;
                    container.appendChild(questionDiv);
                });
            }
        } else { // direct_input
            container.innerHTML = `
                <div class="form-group col-md-6 mt-3">
                    <label for="capaian" class="form-label">Capaian</label>
                    <input type="number" class="form-control" name="capaian" placeholder="Jika ribuan, masukkan angka tanpa tanda pemisah titik" value="${parseFloat(report.capaian) || ''}">
                </div>
            `;
        }
    });
</script>

@endsection