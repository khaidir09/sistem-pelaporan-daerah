@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="content">

    <!-- Start Content-->
    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Pengaturan Sistem</h4>
            </div>
        </div>

        <!-- Form Validation -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card">

<div class="card-body">
    <form action="{{ route('system.setting.update') }}" method="post" class="row g-3">
        @csrf
        <div class="form-group">
            <label for="report_lock_status" class="form-label">Status Penguncian Laporan</label>
            <select name="status" id="report_lock_status" class="form-select">
                <option value="Unlocked" {{ $setting?->value == 'Unlocked' ? 'selected' : '' }}>Unlocked</option>
                <option value="Locked" {{ $setting?->value == 'Locked' ? 'selected' : '' }}>Locked</option>
            </select>
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
 

@endsection