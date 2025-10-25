@extends('admin.admin_master')
@section('admin')

<div class="content">

    <!-- Start Content-->
    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Laporan IKK</h4>
            </div>
            @if (Auth::user()->hasRole('User'))
                <div class="text-end">
                    <span class="badge badge-outline-primary fs-12">{{ Auth::user()->agency->name }}</span>
                </div>
            @endif
        </div>

        <!-- Datatables  -->
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <div class="table-responsive">
                            @if (Auth::user()->hasRole('User'))
                                <table class="table table-bordered table-striped dt-responsive table-responsive nowrap">
                                    <thead>
                                    <tr>
                                        <th>Urusan</th>
                                        <th class="text-center" >No. IKK</th>
                                        <th>Outcome</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($ikkMaster as $item)
                                        @php
                                            // 1. Cari laporan yang sesuai dan simpan ke dalam variabel $report
                                            $report = $item->ikkReports->where('user_id', Auth::user()->id)->where('year', date('Y'))->first();
                                        @endphp
                                        <tr>
                                            <td>{{ $item->matter->name }}</td>
                                            <td class="text-center">{{ $item->matter->category_id }}.{{ $item->matter->kode_urusan }}.{{ $item->urutan }}</td>
                                            <td>{{ $item->ikk_outcome }}</td>
                                            <td>
                                                @if ($report)
                                                    @if ($report->reviu != null)
                                                        <span class="badge bg-primary">{{ $report->reviu }}</span>
                                                    @else
                                                        <span class="badge bg-info">Menunggu</span>
                                                    @endif
                                                @else
                                                    <span class="badge bg-danger">Belum Lapor</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if (!$report)
                                                    {{-- Tombol "Buat" tetap menggunakan ID dari IkkMaster --}}
                                                    <a href="{{ route('laporan.create', $item->id) }}" class="btn btn-secondary btn-sm">Buat</a>
                                                @else
                                                    {{-- 2. Tombol "Edit" sekarang menggunakan ID dari laporan yang ditemukan ($report->id) --}}
                                                    <a href="{{ route('laporan.edit', $report->id) }}" class="btn btn-success btn-sm">Edit</a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <table id="datatable" class="table table-bordered table-striped dt-responsive table-responsive">
                                    <thead>
                                    <tr>
                                        <th>Urusan</th>
                                        <th class="text-center" >No. IKK</th>
                                        <th>Outcome</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($ikkMaster as $item)
                                        @php
                                            // 1. Cari laporan yang sesuai dan simpan ke dalam variabel $report
                                            $report = $item->ikkReports->where('year', date('Y'))->first();
                                        @endphp
                                        <tr>
                                            <td>{{ $item->matter->name }}</td>
                                            <td class="text-center">{{ $item->matter->category_id }}.{{ $item->matter->kode_urusan }}.{{ $item->urutan }}</td>
                                            <td>{{ $item->ikk_outcome }}</td>
                                            <td>
                                                @if ($report)
                                                    @if ($report->reviu != null)
                                                        <span class="badge bg-primary">{{ $report->reviu }}</span>
                                                    @else
                                                        <span class="badge bg-info">Menunggu</span>
                                                    @endif
                                                @else
                                                    <span class="badge bg-danger">Belum Lapor</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($report)
                                                    {{-- Tombol "Buat" tetap menggunakan ID dari IkkMaster --}}
                                                    <a href="{{ route('laporan-pengawas.show', $report->id) }}" class="btn btn-success btn-sm">Lihat</a>
                                                @else
                                                    <a href="#" class="btn btn-dark btn-sm">Lihat</a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div> <!-- container-fluid -->
</div> <!-- content -->
@endsection

@push('scripts')
        <script>
        $("#datatable").dataTable({
            "columnDefs": [{
                "sortable": false,
                "targets": [2,4]
            }],
            "order": [[0, "desc"]]
        });
    </script>
@endpush