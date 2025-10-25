@extends('admin.admin_master')
@section('admin')

<div class="content">

    <!-- Start Content-->
    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Dashboard Pengawas</h4>
            </div>
        </div>

        <!-- start row -->
        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="row g-3">

                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="fs-14 mb-1">Perlu Divalidasi</div>
                                </div>

                                <div class="d-flex align-items-baseline mb-2">
                                    <div class="fs-22 mb-0 me-2 fw-semibold text-black">{{ $perluValidasi }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="fs-14 mb-1">Sudah Disetujui</div>
                                </div>

                                <div class="d-flex align-items-baseline mb-2">
                                    <div class="fs-22 mb-0 me-2 fw-semibold text-black">{{ $sudahValidasi }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="fs-14 mb-1">Diminta Perbaikan</div>
                                </div>

                                <div class="d-flex align-items-baseline mb-2">
                                    <div class="fs-22 mb-0 me-2 fw-semibold text-black">{{ $dimintaPerbaikan }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="fs-14 mb-1">Sudah Perbaikan</div>
                                </div>

                                <div class="d-flex align-items-baseline mb-2">
                                    <div class="fs-22 mb-0 me-2 fw-semibold text-black">{{ $kirimUlang }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end sales -->
        </div> <!-- end row -->

        <!-- Datatables  -->
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
                                        <a href="{{ route('laporan-pengawas.show', $item->id) }}" class="btn btn-secondary btn-sm">Validasi Sekarang</a>
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

        <!-- Start Monthly Sales -->
        {{-- <div class="row">
            <div class="col-md-6 col-xl-8">
                <div class="card">
                    
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div class="border border-dark rounded-2 me-2 widget-icons-sections">
                                <i data-feather="bar-chart" class="widgets-icons"></i>
                            </div>
                            <h5 class="card-title mb-0">Monthly Sales</h5>
                        </div>
                    </div>

                    <div class="card-body">
                        <div id="monthly-sales" class="apex-charts"></div>
                    </div>
                    
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="card overflow-hidden">

                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div class="border border-dark rounded-2 me-2 widget-icons-sections">
                                <i data-feather="tablet" class="widgets-icons"></i>
                            </div>
                            <h5 class="card-title mb-0">Best Traffic Source</h5>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-traffic mb-0">
                                <tbody>
                                    <thead>
                                        <tr>
                                            <th>Network</th>
                                            <th colspan="2">Visitors</th>
                                        </tr>
                                    </thead>

                                    <tr>
                                        <td>Instagram</td>
                                        <td>3,550</td>
                                        <td class="w-50">
                                            <div class="progress progress-md mt-0">
                                                <div class="progress-bar bg-danger" style="width: 80.0%"></div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Facebook</td>
                                        <td>1,245</td>
                                        <td class="w-50">
                                            <div class="progress progress-md mt-0">
                                                <div class="progress-bar bg-primary" style="width: 55.9%"></div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Twitter</td>
                                        <td>1,798</td>
                                        <td class="w-50">
                                            <div class="progress progress-md mt-0">
                                                <div class="progress-bar bg-secondary" style="width: 67.0%"></div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>YouTube</td>
                                        <td>986</td>
                                        <td class="w-50">
                                            <div class="progress progress-md mt-0">
                                                <div class="progress-bar bg-success" style="width: 38.72%"></div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Pinterest</td>
                                        <td>854</td>
                                        <td class="w-50">
                                            <div class="progress progress-md mt-0">
                                                <div class="progress-bar bg-danger" style="width: 45.08%"></div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Linkedin</td>
                                        <td>650</td>
                                        <td class="w-50">
                                            <div class="progress progress-md mt-0">
                                                <div class="progress-bar bg-warning" style="width: 68.0%"></div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Nextdoor</td>
                                        <td>420</td>
                                        <td class="w-50">
                                            <div class="progress progress-md mt-0">
                                                <div class="progress-bar bg-info" style="width: 56.4%"></div>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div> --}}
        <!-- End Monthly Sales -->

         

    </div> <!-- container-fluid -->
</div>



@endsection

@push('scripts')
    <script>
        $("#datatable").dataTable({
            "columnDefs": [{
                "sortable": false,
                "targets": [5]
            }],
            "order": [[0, "asc"]]
        });
    </script>
@endpush