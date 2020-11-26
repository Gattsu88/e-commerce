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
                    <li class="breadcrumb-item active">Product Attributes</li>
                </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @if($errors->any())
                <div class="alert alert-danger mt-2">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(Session::has('success_message'))
                <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                    {{ Session::get('success_message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if(Session::has('error_message'))
                <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                    {{ Session::get('error_message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <form method="post" name="attributeForm" id="attributeForm" action="{{ url('admin/add-attributes/'.$productData['id']) }}">

            @csrf

            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">{{ $title }}</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">                    
                            <div class="form-group">
                                <label for="product_name">Product Name:</label> &nbsp; {{ $productData['product_name'] }}
                            </div>
                            <div class="form-group">
                                <label for="product_code">Product Code:</label> &nbsp; {{ $productData['product_code'] }}
                            </div>
                            <div class="form-group">
                                <label for="product_color">Product Color:</label> &nbsp; {{ $productData['product_color'] }}
                            </div>
                        </div>               
                        <div class="col-md-6">               
                            <div class="form-group">
                                <img src="{{ asset('images/product_images/small/'.$productData['main_image']) }}" alt="" style="width: 120px; margin-top: 5px;">
                            </div>
                        </div>
                        <div class="col-md-6">               
                            <div class="form-group">
                                <div class="field_wrapper">
                                    <div>
                                        <input style="width: 120px;" type="text" name="size[]" id="size" placeholder="Size" value="" required>
                                        <input style="width: 120px;" type="text" name="sku[]" id="sku" placeholder="SKU" value="" required>
                                        <input style="width: 120px;" type="number" name="price[]" id="price" placeholder="Price" value="" required>
                                        <input style="width: 120px;" type="number" name="stock[]" id="stock" placeholder="Stock" value="" required>
                                        <a href="javascript:void(0);" class="add_button" title="Add field">Add</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- .card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div><!-- card-default -->
            </form>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Added Product Attributes</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="products" class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Size</th>
                            <th>SKU</th>    
                            <th>Price</th>
                            <th>Stock</th>      
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($productData['attributes'] as $attribute)
                                <tr>
                                    <td>{{ $attribute->id }}</td> 
                                    <td>{{ $attribute->size }}</td>
                                    <td>{{ $attribute->sku }}</td>  
                                    <td>{{ $attribute->price }}</td>
                                    <td>{{ $attribute->stock }}</td>
                                    <td>
                                        {{--<a title="Add/Edit Attributes" href="{{ url('admin/add-attributes/'.$product->id) }}"><i class="fas fa-plus"></i></a>&nbsp;
                                        <a title="Edit Product" href="{{ url('admin/add-edit-product/'.$product->id) }}"><i class="fas fa-edit"></i></a>&nbsp;
                                        <a title="Remove Product" href="javascript:void(0)" class="confirmDelete" record="product" recordid="{{ $product->id }}"><i class="fas fa-trash"></i></a>--}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection