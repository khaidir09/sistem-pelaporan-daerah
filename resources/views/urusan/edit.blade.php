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