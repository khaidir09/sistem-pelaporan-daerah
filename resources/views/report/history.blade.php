@extends('admin.admin_master')
@section('admin')

<div class="content">

    <!-- Start Content-->
    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Riwayat Penilaian Laporan IKK</h4>
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
                            <table id="datatable" class="table table-bordered table-striped dt-responsive table-responsive">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Urusan</th>
                                    <th>IKK Outcome</th>
                                    <th>Status Laporan</th>
                                    <th>Tanggal Dibuat</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($historyReport as $key => $report)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $report->ikkReport->ikkMaster->matter->name }}</td>
                                            <td>{{ $report->ikkReport->ikkMaster->ikk_outcome }}</td>
                                            @if ($report->status == 'Revisi')
                                                <td>
                                                    <span class="badge bg-danger">{{ $report->status }} ({{ $report->keterangan }})</span>
                                                </td>
                                            @else
                                                <td>
                                                    <span class="badge bg-primary">{{ $report->status }}</span>
                                                </td>
                                            @endif
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
</div> <!-- content -->
@endsection

@push('scripts')
        <script>
        $("#datatable").dataTable({
            "columnDefs": [{
                "sortable": true,
            }],
        });
    </script>
@endpush