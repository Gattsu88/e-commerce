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
                                        <input style="width: 120px;" type="text" name="size[]" id="size" placeholder="Size" value="">
                                        <input style="width: 120px;" type="text" name="sku[]" id="sku" placeholder="SKU" value="">
                                        <input style="width: 120px;" type="text" name="price[]" id="price" placeholder="Price" value="">
                                        <input style="width: 120px;" type="text" name="stock[]" id="stock" placeholder="Stock" value="">
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
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection