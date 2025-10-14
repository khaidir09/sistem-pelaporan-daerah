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
                        <a href="{{ route('dashboard') }}" class="btn btn-dark">Kembali</a>
                </ol>
            </div>
        </div>

        <!-- Form Validation -->
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="card-title mb-0">{{ $report->ikkMaster->ikk_outcome }}</h5>
                    </div>

                    <div class="card-body">
                        <form id="myForm" action="{{ route('laporan.store') }}" method="post" class="row g-3" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="ikk_master_id" value="{{ $report->id }}">
                            <div class="form-group col-md-12">
                                <label for="ikk_output" class="form-label">IKK Output</label>
                                <textarea class="form-control" name="ikk_output" id="ikk_output" cols="30" rows="5" disabled readonly>{!! $report->ikk_output !!}</textarea>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="nilai_pembilang" class="form-label">{{ $report->ikkMaster->definisi_pembilang }}</label>
                                <input type="number" class="form-control" name="nilai_pembilang" value="{{ number_format($report->nilai_pembilang, 0, ',', '.') }}" disabled readonly>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="nilai_penyebut" class="form-label">{{ $report->ikkMaster->definisi_penyebut }}</label>
                                <input type="number" class="form-control" name="nilai_penyebut" value="{{ number_format($report->nilai_penyebut, 0, ',', '.') }}" disabled readonly>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="capaian" class="form-label">Capaian</label>
                                <input type="number" class="form-control" name="capaian" value="{{ $report->capaian }}" disabled readonly>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Setujui Laporan</button>
                            </div>
                        </form>
                    </div>
                </div> 
            </div> 

            <div class="col-lg-6">
                {{-- Embedded View  --}}
                <div class="card">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="card-title mb-0">Data Dukung</h5>
                    </div>
                    <div class="card-body">
                        <embed type="application/pdf" src="{{ asset('upload/laporan/' . $report->file) }}" width="100%" class="vh-100"/>
                    </div>
                </div>
            </div>

          
        </div>

        

    </div>

</div>
 

@endsection