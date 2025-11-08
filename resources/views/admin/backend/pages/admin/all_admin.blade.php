@extends('admin.admin_master')
@section('admin')

<div class="content">

    <!-- Start Content-->
    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Pengguna</h4>
            </div>

            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                     <a href="{{ route('add.admin') }}" class="btn btn-primary">Tambah Pengguna</a>
                </ol>
            </div>
        </div>

        <!-- Datatables  -->
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Email</th> 
                                <th>Peran</th> 
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($alladmin as $key=> $item) 
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->username }}</td>
                                    <td>{{ $item->email }}</td> 
                                    <td> 
                                        @if ($item->agency)
                                            <span class="badge badge-pill bg-primary fs-12">{{ $item->agency->name }}</span>
                                        @else
                                            @foreach ($item->roles as $role)
                                                <span class="badge badge-pill bg-secondary fs-12">{{ $role->name ?? 'N/A' }}</span>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                <a href="{{ route('edit.admin',$item->id) }}" class="btn btn-dark btn-sm">Edit</a>  
                                <a href="{{ route('delete.admin',$item->id) }}" class="btn btn-danger btn-sm" id="delete">Hapus</a>    
                                    </td> 
                                </tr>
                                @endforeach 
                                    
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>


     

    </div> <!-- container-fluid -->

</div> <!-- content -->



@endsection