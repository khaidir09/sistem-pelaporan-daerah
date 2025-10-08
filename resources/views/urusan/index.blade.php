@extends('admin.admin_master')
@section('admin')

<div class="content">

    <!-- Start Content-->
    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Urusan</h4>
            </div>

            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                     <a href="" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#standard-modal">Tambah Urusan</a>
                </ol>
            </div>
        </div>

        <!-- Datatables  -->
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Urusan</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($matter as $key=> $item) 
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                    <a href="{{ route('urusan.edit',$item->id) }}" class="btn btn-success btn-sm">Edit</a>  
                                    <a href="{{ route('urusan.destroy',$item->id) }}" class="btn btn-danger btn-sm" id="delete">Hapus</a>    
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

<!-- Default Modal -->
<div class="modal fade" id="standard-modal" tabindex="-1" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="standard-modalLabel">Urusan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('urusan.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-3 col-md-12">
                        <label for="input1" class="form-label">Nama Urusan</label>
                        <input type="text" class="form-control" name="name"   id="input1"> 
                    </div> 
                </div>
                <div class="modal-footer"> 
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $("#datatable").dataTable({
            "columnDefs": [{
                "sortable": false,
                "targets": [2]
            }],
            "order": [[0, "asc"]]
        });
    </script>
@endpush