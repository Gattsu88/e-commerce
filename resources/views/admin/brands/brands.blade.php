@extends('layouts.admin_layout.admin_layout')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Catalogues</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Brands</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        @if(Session::has('success_message'))
                            <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                                {{ Session::get('success_message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Brands</h3>
                                <a href="{{ url('admin/add-edit-brand') }}" style="max-width: 150px; float: right; display: inline-block;" class="btn btn-block btn-success">Add Brand</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="products" class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>      
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($brands as $brand)
                                            <tr>
                                                <td>{{ $brand->id }}</td> 
                                                <td>{{ $brand->name }}</td>
                                                <td>
                                                    @if($brand->status == 1)
                                                        <a href="javascript:void(0)" id="brand-{{ $brand->id }}" brand_id="{{ $brand->id }}" class="updateBrandStatus"><i class="fas fa-toggle-on fa-lg" aria-hidden="true" status="Active"></i></a>
                                                    @else
                                                        <a href="javascript:void(0)" id="brand-{{ $brand->id }}" brand_id="{{ $brand->id }}" class="updateBrandStatus"><i class="fas fa-toggle-off fa-lg" aria-hidden="true" status="Inactive"></i></a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a title="Edit Product" href="{{ url('admin/add-edit-brand/'.$brand->id) }}"><i class="fas fa-edit fa-lg"></i></a>&nbsp;
                                                    <a title="Remove Brand" href="javascript:void(0)" class="confirmDelete" record="brand" recordid="{{ $brand->id }}"><i class="fas fa-trash fa-lg"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection