@extends('admin.admin_master')
@section('admin')

<div class="content">

    <!-- Start Content-->
    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Edit Urusan</h4>
            </div>

           <div class="text-end">
                <ol class="breadcrumb m-0">
                     <a href="{{ route('urusan.index') }}" class="btn btn-dark">Kembali</a>
                </ol>
            </div>
        </div>

        <!-- Form Validation -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card">

<div class="card-body">
    <form id="myForm" action="{{ route('urusan.update', $matter->id) }}" method="post" class="row g-3">
        @csrf

        <div class="form-group">
            <label for="validationDefault01" class="form-label">Nama Urusan</label>
            <input type="text" name="name" class="form-control" value="{{ $matter->name }}">
        </div>
        <div class="form-group">
            <label for="category" class="form-label">Kategori Urusan</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="category" id="category1" value="Urusan Pemerintahan Wajib Berkaitan Pelayanan Dasar" {{ $matter->category == 'Urusan Pemerintahan Wajib Berkaitan Pelayanan Dasar' ? 'checked' : '' }}>
                <label class="form-check-label" for="category1">
                    Urusan Pemerintahan Wajib Berkaitan Pelayanan Dasar
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="category" id="category2" value="Urusan Pemerintahan Wajib Tidak Berkaitan Pelayanan Dasar" {{ $matter->category == 'Urusan Pemerintahan Wajib Tidak Berkaitan Pelayanan Dasar' ? 'checked' : '' }}>
                <label class="form-check-label" for="category2">
                    Urusan Pemerintahan Wajib Tidak Berkaitan Pelayanan Dasar
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="category" id="category3" value="Urusan Pilihan" {{ $matter->category == 'Urusan Pilihan' ? 'checked' : '' }}>
                <label class="form-check-label" for="category3">
                    Urusan Pilihan
                </label>
            </div>
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