@extends('admin.admin_master')
@section('admin')

<div class="content">

    <!-- Start Content-->
    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Laporan IKK</h4>
            </div>

            {{-- <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                     <a href="" class="btn btn-secondary">Tambah SKPD</a>
                </ol>
            </div> --}}
        </div>

        <!-- Datatables  -->
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <div class="table-responsive">
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
                            @foreach ($ikkMaster as $key=> $item)
                                <tr>
                                    <td>{{ $item->matter->name }}</td>
                                    <td class="text-center">{{ $item->matter->category_id }}.{{ $item->matter->kode_urusan }}.{{ $item->urutan }}</td>
                                    <td>{{ $item->ikk_outcome }}</td>
                                    <td>
                                        @if ($item->reviu != null)
                                            <span class="badge bg-primary">{{ $item->reviu }}</span>
                                        @else
                                            <span class="badge bg-info">Menunggu</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if (!$item->ikkReports->where('user_id', Auth::user()->id)->where('year', date('Y'))->first())
                                            <a href="{{ route('laporan.create', $item->id) }}" class="btn btn-secondary btn-sm">Buat</a>
                                        @else
                                            <a href="{{ route('laporan.edit', $item->id) }}" class="btn btn-success btn-sm">Edit</a>
                                        @endif
                                        {{-- <a href="{{ route('skpd.destroy',$item->id) }}" class="btn btn-danger btn-sm" id="delete">Hapus</a> --}}
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
</div> <!-- content -->
@endsection