@extends('admin.admin_master')
@section('admin')

<div class="content">

    <!-- Start Content-->
    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Dashboard Admin</h4>
            </div>
        </div>

        <!-- start row -->
        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="row g-3">

                    <div class="col-md-6 col-xl-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="fs-14 mb-1">SKPD</div>
                                </div>

                                <div class="d-flex align-items-baseline mb-2">
                                    <div class="fs-22 mb-0 me-2 fw-semibold text-black">{{ $jumlahSkpd }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="fs-14 mb-1">Urusan</div>
                                </div>

                                <div class="d-flex align-items-baseline mb-2">
                                    <div class="fs-22 mb-0 me-2 fw-semibold text-black">{{ $jumlahUrusan }}</div>
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
                                    <div class="fs-22 mb-0 me-2 fw-semibold text-black">{{ $dibuat }}</div>
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
                                    <div class="fs-22 mb-0 me-2 fw-semibold text-black">{{ $menunggu }}</div>
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
                                    <div class="fs-22 mb-0 me-2 fw-semibold text-black">{{ $disetujui }}</div>
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
                                    <div class="fs-22 mb-0 me-2 fw-semibold text-black">{{ $revisi }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">Antrian Validasi</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        <table id="datatable" class="table table-bordered dt-responsive table-responsive">
                            <thead>
                            <tr>
                                <th>SKPD</th>
                                <th>Urusan</th>
                                <th>Outcome</th>
                                <th>Status</th>
                                <th>Tanggal Kirim</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($data as $key=> $item) 
                                <tr>
                                    <th>{{ $item->user->agency->name }}</th>
                                    <td>{{ $item->ikkMaster->matter->name }}</td>
                                    <td><span class="text-primary">({{ $item->ikkMaster->matter->category_id }}.{{ $item->ikkMaster->matter->kode_urusan }}.{{ $item->ikkMaster->urutan }})</span> {{ $item->ikkMaster->ikk_outcome }}</td>
                                    <td>
                                        @if ($item->status === 'Revisi')
                                            <span class="badge bg-danger">Revisi</span>
                                        @elseif ($item->status === 'Dikirim Ulang')
                                            <span class="badge bg-info">Dikirim Ulang</span>
                                        @else
                                            <span class="badge bg-warning">Menunggu Validasi</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                    <td>
                                        <a href="{{ route('laporan-pengawas.show', $item->id) }}" class="btn btn-primary btn-sm">Validasi Sekarang</a>
                                    </td> 
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