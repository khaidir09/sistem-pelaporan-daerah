@extends('admin.admin_master')
@section('admin')

<div class="content">

    <!-- Start Content-->
    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Edit IKK Outcome</h4>
            </div>

            <div class="text-end">
                <ol class="breadcrumb m-0">
                     <a href="{{ route('outcome.index') }}" class="btn btn-dark">Kembali</a>
                </ol>
            </div>
        </div>

        <!-- Form Validation -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card">

<div class="card-body">
    <form id="myForm" action="{{ route('outcome.update', $ikkMaster->id) }}" method="post" class="row g-3">
        @csrf

        <div class="form-group col-md-6">
            <label for="validationDefault01" class="form-label">Urusan</label>
            <select name="matter_id" id="matter_id" class="form-select" aria-label="Default select example">
                <option selected="">Pilih Urusan</option>
                @foreach($matters as $mat) 
                    <option value="{{ $mat->id }}" {{ $mat->id == $ikkMaster->matter_id ? 'selected' : '' }}>{{ $mat->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-md-6">
            <label for="validationDefault02" class="form-label">Urutan</label>
            <input type="number" class="form-control" name="urutan" value="{{ $ikkMaster->urutan }}"> 
        </div>

        <div class="form-group col-md-12">
            <label for="validationDefault03" class="form-label">IKK Outcome</label>
            <textarea name="ikk_outcome" id="ikk_outcome" cols="30" rows="10" class="form-control">{!! $ikkMaster->ikk_outcome !!}</textarea>
        </div>

        <div class="form-group col-md-6">
            <label for="validationDefault04" class="form-label">Definisi Pembilang</label>
            <input type="text" class="form-control" name="definisi_pembilang" value="{{ $ikkMaster->definisi_pembilang }}"> 
        </div>

        <div class="form-group col-md-6">
            <label for="validationDefault05" class="form-label">Definisi Penyebut</label>
            <input type="text" class="form-control" name="definisi_penyebut" value="{{ $ikkMaster->definisi_penyebut }}"> 
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