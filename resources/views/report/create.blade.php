@extends('admin.admin_master')
@section('admin')

<div class="content">

    <!-- Start Content-->
    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Pelaporan IKK</h4>
            </div>

            <div class="text-end">
                <ol class="breadcrumb m-0">
                     <a href="{{ route('laporan.index') }}" class="btn btn-dark">Kembali</a>
                </ol>
            </div>

            {{-- <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    
                    <li class="breadcrumb-item active">Tambah Urusan</li>
                </ol>
            </div> --}}
        </div>

        <!-- Form Validation -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">{{ $item->ikk_outcome }}</h5>
                    </div><!-- end card header -->

<div class="card-body">
    <form id="myForm" action="{{ route('laporan.store') }}" method="post" class="row g-3" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="ikk_master_id" value="{{ $item->id }}">
        <div class="form-group col-md-12">
            <label for="ikk_output" class="form-label">IKK Output <span class="text-danger">*</span></label>
            <textarea class="form-control" name="ikk_output" id="ikk_output" cols="30" rows="5" required>{{ old('ikk_output') }}</textarea>
            @error('ikk_output')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <!-- Dynamic calculation inputs will be injected here -->
        <div id="calculation-inputs" class="row"></div>

        <div class="form-group col-md-12">
            <label for="file" class="form-label">File Bukti <span class="text-danger">*</span></label>
            <input class="form-control" type="file" name="file" id="file">
            @error('file')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        
 
            
        <div class="col-12 text-end">
            <button class="btn btn-primary" type="submit">Kirim Laporan</button>
        </div>
    </form>
</div> <!-- end card-body -->
                </div> <!-- end card-->
            </div> <!-- end col -->

          
        </div>

        

    </div> <!-- container-fluid -->

</div>
 
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const item = @json($item);
        const container = document.getElementById('calculation-inputs');
        
        container.innerHTML = '';

        if (item.calculation_type === 'formula') {
            container.innerHTML = `
                <div class="form-group col-md-6 mt-3">
                    <label for="nilai_pembilang" class="form-label">${item.definisi_pembilang} <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="nilai_pembilang" placeholder="Jika ribuan, masukkan angka tanpa tanda pemisah titik" value="{{ old('nilai_pembilang') }}">
                    @error('nilai_pembilang')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group col-md-6 mt-3">
                    <label for="nilai_penyebut" class="form-label">${item.definisi_penyebut} <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="nilai_penyebut" placeholder="Jika ribuan, masukkan angka tanpa tanda pemisah titik" value="{{ old('nilai_penyebut') }}">
                    @error('nilai_penyebut')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            `;
        } else if (item.calculation_type === 'checklist') {
            const meta = JSON.parse(item.calculation_meta);
            if (meta.questions) {
                meta.questions.forEach((question, index) => {
                    const questionDiv = document.createElement('div');
                    questionDiv.classList.add('form-group', 'col-md-3', 'mt-3');
                    questionDiv.innerHTML = `
                        <label for="category" class="form-label">${question.q}</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="checklist[${index}]" id="checklist_yes_${index}" value="1">
                            <label class="form-check-label" for="checklist_yes_${index}">Ya</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="checklist[${index}]" id="checklist_no_${index}" value="0">
                            <label class="form-check-label" for="checklist_no_${index}">Tidak</label>
                        </div>
                    `;
                    container.appendChild(questionDiv);
                });
            }
        } else { // direct_input
            container.innerHTML = `
                <div class="form-group col-md-6 mt-3">
                    <label for="capaian" class="form-label">Capaian <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="capaian" placeholder="Jika ribuan, masukkan angka tanpa tanda pemisah titik" value="{{ old('capaian') }}">
                    @error('capaian')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            `;
        }
    });
</script>

@endsection