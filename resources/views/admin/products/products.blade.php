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
                            <li class="breadcrumb-item active">Products</li>
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
                                <h3 class="card-title">Products</h3>
								<a href="{{ url('admin/add-edit-product') }}" style="max-width: 150px; float: right; display: inline-block;" class="btn btn-block btn-success">Add Product</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="products" class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Product Name</th>
                                        <th>Product Code</th>   
                                        <th>Product Color</th>
                                        <th>Product Image</th>
                                        <th>Category</th>    
                                        <th>Section</th>       
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($products as $product)
                                            <tr>
                                                <td>{{ $product->id }}</td> 
                                                <td>{{ $product->product_name }}</td>
                                                <td>{{ $product->product_code }}</td>  
												<td>{{ $product->product_color }}</td>
                                                <td style="padding-right: 0px;">
                                                    <?php $product_image_path = 'images/product_images/small/'.$product->main_image; ?>
                                                    @if(!empty($product->main_image) && file_exists($product_image_path))
                                                        <img style="width: 100px;" src="{{ asset('images/product_images/small/'.$product->main_image) }}" alt="">
                                                    @else
                                                        <img style="width: 100px;" src="{{ asset('images/product_images/small/no-image.png') }}" alt="">
                                                    @endif
                                                </td>
                                                <td>{{ $product->category->category_name }}</td>
                                                <td>{{ $product->section->name }}</td>
                                                <td>
                                                    @if($product->status == 1)
                                                        <a title="Change Status" href="javascript:void(0)" id="product-{{ $product->id }}" product_id="{{ $product->id }}" class="updateProductStatus"><i class="fas fa-toggle-on fa-lg" aria-hidden="true" status="Active"></i></a>
                                                    @else
                                                        <a title="Change Status" href="javascript:void(0)" id="product-{{ $product->id }}" product_id="{{ $product->id }}" class="updateProductStatus"><i class="fas fa-toggle-off fa-lg" aria-hidden="true" status="Inactive"></i></a>
                                                    @endif&nbsp;
                                                    <a title="Add/Edit Attributes" href="{{ url('admin/add-attributes/'.$product->id) }}"><i class="fas fa-plus fa-lg"></i></a>&nbsp;
                                                    <a title="Add/Edit Images" href="{{ url('admin/add-images/'.$product->id) }}"><i class="fas fa-images fa-lg"></i></a>&nbsp;
                                                    <a title="Edit Product" href="{{ url('admin/add-edit-product/'.$product->id) }}"><i class="fas fa-edit fa-lg"></i></a>&nbsp;
                                                    <a title="Remove Product" href="javascript:void(0)" class="confirmDelete" record="product" recordid="{{ $product->id }}"><i class="fas fa-trash fa-lg"></i></a>
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