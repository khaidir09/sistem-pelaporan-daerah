@extends('admin.admin_master')
@section('admin')

<div class="content">

    <!-- Start Content-->
    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Pelaporan IKK</h4>
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
            <label for="ikk_output" class="form-label">IKK Output</label>
            <textarea class="form-control" name="ikk_output" id="ikk_output" cols="30" rows="5">{{ old('ikk_output') }}</textarea>
            @error('ikk_output')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        @if ($item->calculation_type == 'formula')
            <div class="form-group col-md-6">
                <label for="nilai_pembilang" class="form-label">{{ $item->definisi_pembilang }}</label>
                <input type="number" class="form-control" name="nilai_pembilang" placeholder="Jika ribuan, masukkan angka tanpa tanda pemisah titik" value="{{ old('nilai_pembilang') }}"> 
                @error('nilai_pembilang')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group col-md-6">
                <label for="nilai_penyebut" class="form-label">{{ $item->definisi_penyebut }}</label>
                <input type="number" class="form-control" name="nilai_penyebut" placeholder="Jika ribuan, masukkan angka tanpa tanda pemisah titik" value="{{ old('nilai_penyebut') }}"> 
                @error('nilai_penyebut')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        @elseif ($item->calculation_type == 'checklist')
            <div class="form-group col-md-3">
                <label for="category" class="form-label">Apakah ada daftar asset tetap?</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="category_id" id="category1" value="Ya">
                    <label class="form-check-label" for="category1">
                        Ya
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="category_id" id="category2" value="Tidak">
                    <label class="form-check-label" for="category2">
                        Tidak
                    </label>
                </div>
            </div>
            <div class="form-group col-md-3">
                <label for="category" class="form-label">Apakah ada manual untuk menyusun daftar asset tetap?</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="category_id" id="category1" value="Ya">
                    <label class="form-check-label" for="category1">
                        Ya
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="category_id" id="category2" value="Tidak">
                    <label class="form-check-label" for="category2">
                        Tidak
                    </label>
                </div>
            </div>
            <div class="form-group col-md-3">
                <label for="category" class="form-label">Apakah ada proses inventarisasi asset tahunan?</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="category_id" id="category1" value="Ya">
                    <label class="form-check-label" for="category1">
                        Ya
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="category_id" id="category2" value="Tidak">
                    <label class="form-check-label" for="category2">
                        Tidak
                    </label>
                </div>
            </div>
            <div class="form-group col-md-3">
                <label for="category" class="form-label">Apakah nilai asset tercantum dalam laporan anggaran?</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="category_id" id="category1" value="Ya">
                    <label class="form-check-label" for="category1">
                        Ya
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="category_id" id="category2" value="Tidak">
                    <label class="form-check-label" for="category2">
                        Tidak
                    </label>
                </div>
            </div>
        @else
            <div class="form-group col-md-6">
                <label for="nilai_penyebut" class="form-label">Capaian</label>
                <input type="number" class="form-control" name="nilai_penyebut" placeholder="Jika ribuan, masukkan angka tanpa tanda pemisah titik" value="{{ old('nilai_penyebut') }}"> 
                @error('nilai_penyebut')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        @endif

        <div class="form-group col-md-12">
            <label for="file" class="form-label">File Bukti</label>
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
 

@endsection