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
              <li class="breadcrumb-item active">Categories</li>
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

		  <form @if(empty($categoryData['id'])) action="{{ url('admin/add-edit-category') }}" @else action="{{ url('admin/add-edit-category/'.$categoryData['id']) }}" @endif method="post" name="categoryForm" id="categoryForm" enctype="multipart/form-data">
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
						<label for="category_name">Category Name</label>
						<input type="text" class="form-control" name="category_name" id="category_name" placeholder="Enter Category Name" @if(!empty($categoryData['category_name'])) value="{{ $categoryData['category_name'] }}" @else value="{{ old('category_name') }}" @endif>
					</div>
					<div id="appendCategoriesLevel">
                        @include('admin.categories.append_categories_level')               
                    </div>
				  </div>
				  <div class="col-md-6">
					<div class="form-group">
					  <label>Select Section:</label>
					  <select name="section_id" id="section_id" class="form-control select2" style="width: 100%;">
						<option value="">Select</option>
						@foreach($sections as $section)
							<option value="{{ $section->id }}" @if(!empty($categoryData['section_id']) && $categoryData['section_id'] == $section->id) selected @endif>{{ $section->name }}</option>
						@endforeach
					  </select>
					</div>
					<div class="form-group">
						<label for="category_image">Category Image</label>
						<div class="input-group">
						  <div class="custom-file">
							<input type="file" class="custom-file-input" name="category_image" id="category_image">
							<label class="custom-file-label" for="category_image">Choose file</label>
						  </div>
						  <div class="input-group-append">
							<span class="input-group-text" id="">Upload</span>
						  </div>                          
						</div>
                        @if(!empty($categoryData['category_image']))
                            <div>
                                <img src="{{ asset('images/category_images/'.$categoryData['category_image']) }}" alt="" style="width: 80px; margin-top: 5px;">&nbsp;<a href="javascript:void(0)" class="confirmDelete" record="category-image" recordid="{{ $categoryData['id'] }}">Delete Image</a>
                            </div>
                        @endif
					</div>
				</div>
              </div>
			  <div class="row">
				  <div class="col-12 col-sm-6">
					<div class="form-group">
						<label for="category_discount">Category Discount</label>
						<input type="text" class="form-control" name="category_discount" id="category_discount" placeholder="Enter Category Discount" @if(!empty($categoryData['category_discount'])) value="{{ $categoryData['category_discount'] }}" @else value="{{ old('category_discount') }}" @endif>
					</div>
					<div class="form-group">
						<label for="description">Category Description</label>
						<textarea class="form-control" name="description" id="description" rows="3" placeholder="Enter Category Description">@if(!empty($categoryData['description'])) {{ $categoryData['description'] }} @else {{ old('description') }} @endif</textarea>
					</div>
				  </div>
				  <div class="col-12 col-sm-6">
					<div class="form-group">
						<label for="url">Category URL</label>
						<input type="text" class="form-control" name="url" id="url" placeholder="Enter Category URL" @if(!empty($categoryData['url'])) value="{{ $categoryData['url'] }}" @else value="{{ old('url') }}" @endif>
					</div>
					<div class="form-group">
						<label for="meta_title">Meta Title</label>
						<textarea class="form-control" name="meta_title" id="meta_title" rows="3" placeholder="Enter ...">@if(!empty($categoryData['meta_title'])) {{ $categoryData['meta_title'] }} @else {{ old('meta_title') }} @endif</textarea>
					</div>
				  </div>
				  <div class="col-12 col-sm-6">
					<div class="form-group">
						<label for="meta_description">Meta Description</label>
						<textarea class="form-control" name="meta_description" id="meta_description" rows="3" placeholder="Enter ...">@if(!empty($categoryData['meta_description'])) {{ $categoryData['meta_description'] }} @else {{ old('meta_description') }} @endif</textarea>
					</div>
				  </div>
				  <div class="col-12 col-sm-6">
					<div class="form-group">
						<label for="meta_keywords">Meta Keywords</label>
						<textarea class="form-control" name="meta_keywords" id="meta_keywords" rows="3" placeholder="Enter ...">@if(!empty($categoryData['meta_keywords'])) {{ $categoryData['meta_keywords'] }} @else {{ old('meta_keywords') }} @endif</textarea>
					</div>
				  </div>
			  </div>
            </div>
			<div class="card-footer">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
        </div>
		  </form>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection