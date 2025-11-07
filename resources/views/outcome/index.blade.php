@extends('admin.admin_master')
@section('admin')

<div class="content">

    <!-- Start Content-->
    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Outcome</h4>
            </div>

            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                     <a href="{{ route('outcome.create') }}" class="btn btn-primary">Tambah Outcome</a>
                </ol>
            </div>
        </div>

        <!-- Datatables  -->
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <div class="table-responsive">
                        <table id="datatable" class="table table-bordered dt-responsive table-responsive dt-nowrap">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>No.</th>
                                <th>Urusan</th>
                                <th>Deskripsi Outcome</th>
                                <th>Rumus Pembilang</th>
                                <th>Rumus Penyebut</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($ikkMaster as $key=> $item) 
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->matter->category->id }}.{{ $item->matter->kode_urusan }}.{{ $item->urutan }}</td>
                                    <td>{{ $item->matter->name }}</td>
                                    <td>{{ $item->ikk_outcome }}</td>
                                    <td>{{ $item->definisi_pembilang }}</td>
                                    <td>{{ $item->definisi_penyebut }}</td>
                                    <td>
                                        <a href="{{ route('outcome.edit', $item->id) }}" class="btn btn-dark btn-sm">Edit</a>  
                                        <a href="{{ route('outcome.destroy',$item->id) }}" class="btn btn-danger btn-sm" id="delete">Hapus</a>    
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

@push('scripts')
    <script>
        $("#datatable").dataTable({
            "columnDefs": [{
                "sortable": false,
                "targets": [3]
            }],
        });
    </script>
@endpush