@extends('admin.admin_master')
@section('admin')

<div class="content">

    <!-- Start Content-->
    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Dashboard SKPD</h4>
            </div>

            <div class="text-end">
                <span class="badge badge-outline-primary fs-12">{{ $user->agency->name }}</span>
            </div>
        </div>

        {{-- Informasi Sistem Pelaporan sedang dikunci --}}
        @if ($reportLockStatus->value == 'Locked')
            <div class="alert alert-danger" role="alert">
                <strong>Pemberitahuan:</strong> Sistem pelaporan sedang dikunci. Anda tidak dapat membuat atau mengedit laporan saat ini.
            </div>
        @endif

        <!-- start row -->
        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="row g-3">

                    <div class="col-md-6 col-xl-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="fs-14 mb-1">Urusan</div>
                                </div>

                                <div class="d-flex align-items-baseline mb-2">
                                    <div class="fs-22 mb-0 me-2 fw-semibold text-black">{{ $totalUrusan }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="fs-14 mb-1">Indikator</div>
                                </div>

                                <div class="d-flex align-items-baseline mb-2">
                                    <div class="fs-22 mb-0 me-2 fw-semibold text-black">{{ $totalIndikator }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="fs-14 mb-1">Laporan Dibuat</div>
                                </div>

                                <div class="d-flex align-items-baseline mb-2">
                                    <div class="fs-22 mb-0 me-2 fw-semibold text-black">{{ $laporanDibuat }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="fs-14 mb-1">Menunggu Validasi</div>
                                </div>

                                <div class="d-flex align-items-baseline mb-2">
                                    <div class="fs-22 mb-0 me-2 fw-semibold text-black">{{ $laporanMenunggu }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="fs-14 mb-1">Laporan Disetujui</div>
                                </div>

                                <div class="d-flex align-items-baseline mb-2">
                                    <div class="fs-22 mb-0 me-2 fw-semibold text-black">{{ $laporanDisetujui }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="fs-14 mb-1">Perlu Revisi</div>
                                </div>

                                <div class="d-flex align-items-baseline mb-2">
                                    <div class="fs-22 mb-0 me-2 fw-semibold text-black">{{ $laporanRevisi }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end sales -->
        </div> <!-- end row -->

        {{-- Riwayat Laporan SKPD --}}
        <div class="row mt-4">
            <div class="col-12">
                <div class="card"> 
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">Riwayat Laporan SKPD Tahun {{ date('Y') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>IKK Outcome</th>
                                        <th>Status Laporan</th>
                                        <th>Tanggal Dibuat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($skpdHistoryReport as $key => $report)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $report->ikkReport->ikkMaster->ikk_outcome }}</td>
                                            <td>{{ $report->status }} @if ($report->keterangan != null)
                                                ({{ $report->keterangan }})
                                            @endif</td>
                                            <td>{{ $report->created_at->locale('id')->translatedFormat('d F Y, H:i') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

         

    </div> <!-- container-fluid -->
</div>



@endsection