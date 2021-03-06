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

        	<form @if(empty($productData['id'])) action="{{ url('admin/add-edit-product') }}" @else action="{{ url('admin/add-edit-product/'.$productData['id']) }}" @endif method="post" name="productForm" id="productForm" enctype="multipart/form-data">
                  @csrf
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">{{ $title }}</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
    			        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select Category:</label>
                                <select name="category_id" id="category_id" class="form-control select2" style="width: 100%;">
                                    <option value="">Select</option>
                                    @foreach($categories as $section)
                                        <optgroup label="{{ $section['name'] }}"></optgroup>

                                        @foreach($section['categories'] as $category)
                                            <option value="{{ $category['id'] }}" @if(!empty(@old('category_id')) && $category['id'] == @old('category_id')) selected @elseif(!empty($productData['category_id']) && $productData['category_id'] == $category['id']) selected @endif>&nbsp;--&nbsp; {{ $category['category_name'] }}</option>

                                            @foreach($category['subcategories'] as $subcategory)
                                              <option value="{{ $subcategory['id'] }}"  @if(!empty(@old('category_id')) && $subcategory['id'] == @old('category_id')) selected @elseif(!empty($productData['category_id']) && $productData['category_id'] == $subcategory['id']) selected @endif>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp; {{ $subcategory['category_name'] }}</option>
                                            @endforeach

                                        @endforeach

                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Select Brand:</label>
                                <select name="brand_id" id="brand_id" class="form-control select2" style="width: 100%;">
                                  <option value="">Select Brand</option>
                                  @foreach($brands as $brand)
                                      <option value="{{ $brand->id }}" @if(!empty($productData['brand_id']) && $productData['brand_id'] == $brand->id) selected @endif>{{ $brand->name }}</option>
                                  @endforeach
                                </select>
                            </div>                 			
        	            </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="product_name">Product Name</label>
                                <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Enter Product Name" @if(!empty($productData['product_name'])) value="{{ $productData['product_name'] }}" @else value="{{ old('product_name') }}" @endif>
                            </div>
                            <div class="form-group">
                                <label for="product_code">Product Code</label>
                                <input type="text" class="form-control" name="product_code" id="product_code" placeholder="Enter Product Code" @if(!empty($productData['product_code'])) value="{{ $productData['product_code'] }}" @else value="{{ old('product_code') }}" @endif>
                            </div>                            
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="product_color">Product Color</label>
                                <input type="text" class="form-control" name="product_color" id="product_color" placeholder="Enter Product Color" @if(!empty($productData['product_color'])) value="{{ $productData['product_color'] }}" @else value="{{ old('product_color') }}" @endif>
                            </div>
                            <div class="form-group">
                                <label for="product_price">Product Price</label>
                                <input type="text" class="form-control" name="product_price" id="product_price" placeholder="Enter Product Price" @if(!empty($productData['product_price'])) value="{{ $productData['product_price'] }}" @else value="{{ old('product_price') }}" @endif>
                            </div>
                            <div class="form-group">
                                <label for="product_discount">Product Discount (%)</label>
                                <input type="text" class="form-control" name="product_discount" id="product_discount" placeholder="Enter Product Discount" @if(!empty($productData['product_discount'])) value="{{ $productData['product_discount'] }}" @else value="{{ old('product_discount') }}" @endif>
                            </div>                            
                        </div>                 
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="product_weight">Product Weight</label>
                                <input type="text" class="form-control" name="product_weight" id="product_weight" placeholder="Enter Product Weight" @if(!empty($productData['product_weight'])) value="{{ $productData['product_weight'] }}" @else value="{{ old('product_weight') }}" @endif>
                            </div>
                            <div class="form-group">
                                <label for="main_image">Product Main Image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="main_image" id="main_image">
                                        <label class="custom-file-label" for="main_image">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="">Upload</span>
                                    </div>                                     
                                </div>
                                <div>Recommended Image Size: Width:1040px, Height:1200px</div>
                                @if(!empty($productData['main_image']))
                                    <div>
                                        <img src="{{ asset('images/product_images/small/'.$productData['main_image']) }}" alt="" style="width: 80px; margin-top: 5px;">&nbsp;&nbsp;
                                        <a href="javascript:void(0)" class="confirmDelete" record="product-image" recordid="{{ $productData['id'] }}">Delete Image</a>
                                    </div>
                                @endif
                            </div>                                                      
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="product_video">Product Video</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" name="product_video" id="product_video">
                                      <label class="custom-file-label" for="product_video">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="">Upload</span>
                                    </div>                        
                                </div>
                                @if(!empty($productData['product_video']))
                                    <div>
                                        <a href="{{ url('videos/product_videos/'.$productData['product_video']) }}" download>Download</a>
                                        <a href="javascript:void(0)" class="confirmDelete" record="product-video" recordid="{{ $productData['id'] }}"> | Delete Video</a>
                                    </div>
                                @endif
                            </div>                                                         
                            <div class="form-group">
                                <label for="description">Product Description</label>
                                <textarea class="form-control" name="description" id="description" rows="3" placeholder="Enter Product Description">@if(!empty($productData['description'])) {{ $productData['description'] }} @else {{ old('description') }} @endif</textarea>
                            </div>                                                       
                        </div>
                        <div class="col-12 col-sm-6">                            
                            <div class="form-group">
                                <label for="wash_care">Wash Care</label>
                                <textarea class="form-control" name="wash_care" id="wash_care" rows="3" placeholder="Enter Wash Care">@if(!empty($productData['wash_care'])) {{ $productData['wash_care'] }} @else {{ old('wash_care') }} @endif</textarea>
                            </div>
                            <div class="form-group">
                                <label>Select Fabric:</label>
                                <select name="fabric" id="fabric" class="form-control select2" style="width: 100%;">
                                  <option value="">Select Fabric</option>
                                  @foreach($fabricArray as $fabric)
                                      <option value="{{ $fabric }}" @if(!empty($productData['fabric']) && $productData['fabric'] == $fabric) selected @endif>{{ $fabric }}</option>
                                  @endforeach
                                </select>
                            </div>                                                          
                        </div>
                        <div class="col-12 col-sm-6">                            
                            <div class="form-group">
                                <label>Select Sleeve:</label>
                                <select name="sleeve" id="sleeve" class="form-control select2" style="width: 100%;">
                                <option value="">Select Sleeve</option>
                                @foreach($sleeveArray as $sleeve)
                                    <option value="{{ $sleeve }}" @if(!empty($productData['sleeve']) && $productData['sleeve'] == $sleeve) selected @endif>{{ $sleeve }}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="form-group">
                                <label>Select Pattern:</label>
                                <select name="pattern" id="pattern" class="form-control select2" style="width: 100%;">
                                <option value="">Select Pattern</option>
                                    @foreach($patternArray as $pattern)
                                        <option value="{{ $pattern }}" @if(!empty($productData['pattern']) && $productData['pattern'] == $pattern) selected @endif>{{ $pattern }}</option>
                                    @endforeach
                              </select>
                            </div>                                    
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Select Fit:</label>
                                <select name="fit" id="fit" class="form-control select2" style="width: 100%;">
                                  <option value="">Select Fit</option>
                                  @foreach($fitArray as $fit)
                                      <option value="{{ $fit }}" @if(!empty($productData['fit']) && $productData['fit'] == $fit) selected @endif>{{ $fit }}</option>
                                  @endforeach
                                </select>
                            </div> 
                            <div class="form-group">
                                <label>Select Occasion:</label>
                                <select name="occasion" id="occasion" class="form-control select2" style="width: 100%;">
                                  <option value="">Select Occasion</option>
                                  @foreach($occasionArray as $occasion)
                                      <option value="{{ $occasion }}" @if(!empty($productData['occasion']) && $productData['occasion'] == $occasion) selected @endif>{{ $occasion }}</option>
                                  @endforeach
                                </select>
                            </div>                                                    
                        </div>
                        <div class="col-12 col-sm-6">                            
                            <div class="form-group">
                                <label for="meta_title">Meta Title</label>
                                <textarea class="form-control" name="meta_title" id="meta_title" rows="3" placeholder="Enter ...">@if(!empty($productData['meta_title'])) {{ $productData['meta_title'] }} @else {{ old('meta_title') }} @endif</textarea>
                            </div>
                            <div class="form-group">
                                <label for="meta_keywords">Meta Keywords</label>
                                <textarea class="form-control" name="meta_keywords" id="meta_keywords" rows="3" placeholder="Enter ...">@if(!empty($productData['meta_keywords'])) {{ $productData['meta_keywords'] }} @else {{ old('meta_keywords') }} @endif</textarea>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="meta_description">Meta Description</label>
                                <textarea class="form-control" name="meta_description" id="meta_description" rows="3" placeholder="Enter ...">@if(!empty($productData['meta_description'])) {{ $productData['meta_description'] }} @else {{ old('meta_description') }} @endif</textarea>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="is_featured">Featured Item</label>
                                <input type="checkbox" name="is_featured" id="is_featured" value="Yes" @if(!empty($productData['is_featured']) && $productData['is_featured'] == "Yes") checked @endif>
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