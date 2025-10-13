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

        <!-- Form Validation -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card">

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

        <div class="form-group col-md-6">
            <label for="nilai_pembilang" class="form-label">{{ $report->definisi_pembilang }}</label>
            <input type="number" class="form-control" name="nilai_pembilang" value="{{ $report->nilai_pembilang }}"> 
            @error('nilai_pembilang')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group col-md-6">
            <label for="nilai_penyebut" class="form-label">{{ $report->definisi_penyebut }}</label>
            <input type="number" class="form-control" name="nilai_penyebut" value="{{ $report->nilai_penyebut }}"> 
            @error('nilai_penyebut')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group col-md-12">
            <label for="file" class="form-label">File Bukti</label>
            <input class="form-control" type="file" name="file" id="file" value="{{ $report->file }}">
            @error('file')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="col-12">
            <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
        </div>
    </form>
</div> <!-- end card-body -->
                </div> <!-- end card-->
            </div> <!-- end col -->


        </div>



    </div> <!-- container-fluid -->

</div>


@endsection