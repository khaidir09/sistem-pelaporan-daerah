@extends('admin.admin_master')
@section('admin')

<div class="content">

    <!-- Start Content-->
    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Tambah IKK Outcome</h4>
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
    <form id="myForm" action="{{ route('outcome.store') }}" method="post" class="row g-3">
        @csrf

        <div class="form-group col-md-6">
            <label for="matter_id" class="form-label">Pilih Urusan</label>
            <select name="matter_id" id="matter_id" class="form-control">
                <option value="" selected>-- Pilih Urusan --</option>
                @foreach ($matters as $matter)
                    <option value="{{ $matter->id }}">{{ $matter->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-md-6">
            <label for="validationDefault01" class="form-label">Urutan</label>
            <input type="text" class="form-control" name="urutan"  > 
        </div>

        <div class="form-group col-md-12">
            <label for="validationDefault01" class="form-label">IKK Outcome</label>
            <input type="text" class="form-control" name="ikk_outcome"  > 
        </div>

        <div class="form-group col-md-6">
            <label for="validationDefault01" class="form-label">Definisi Pembilang</label>
            <input type="text" class="form-control" name="definisi_pembilang"  > 
        </div>

        <div class="form-group col-md-6">
            <label for="validationDefault01" class="form-label">Definisi Penyebut</label>
            <input type="text" class="form-control" name="definisi_penyebut"  > 
        </div>

        <div class="col-12 text-end">
            <button class="btn btn-primary" type="submit">Simpan</button>
        </div>
    </form>
</div> <!-- end card-body -->
                </div> <!-- end card-->
            </div> <!-- end col -->

          
        </div>

        

    </div> <!-- container-fluid -->

</div>

{{-- <script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                name: {
                    required : true,
                },
                
            },
            messages :{
                name: {
                    required : 'Please Enter Customer Name',
                },

            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
    
</script> --}}
 

@endsection