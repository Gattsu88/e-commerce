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

            <form @if(empty($banner['id'])) action="{{ url('admin/add-edit-banner') }}" @else action="{{ url('admin/add-edit-banner/'.$banner['id']) }}" @endif method="post" name="bannerForm" id="bannerForm" enctype="multipart/form-data">
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
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="main_image">Banner Image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="image" id="image">
                                        <label class="custom-file-label" for="image">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="">Upload</span>
                                    </div>                                     
                                </div>
                                <div>Recommended Image Size: Width:1170px, Height:480</div>
                                @if(!empty($banner['image']))
                                    <div>
                                        <img src="{{ asset('images/banner_images/'.$banner['image']) }}" alt="" style="width: 200px; margin-top: 15px;">&nbsp;
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="link">Banner Link</label>
                                <input type="text" class="form-control" name="link" id="link" placeholder="Enter Banner Link" @if(!empty($banner['link'])) value="{{ $banner['link'] }}" @else value="{{ old('link') }}" @endif>
                            </div>                                                                                 
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="title">Banner Title</label>
                                <input type="text" class="form-control" name="title" id="title" placeholder="Enter Banner Title" @if(!empty($banner['title'])) value="{{ $banner['title'] }}" @else value="{{ old('title') }}" @endif>
                            </div>                                                  
                            <div class="form-group">
                                <label for="alt">Banner Alternative Text</label>
                                <input type="text" class="form-control" name="alt" id="alt" placeholder="Enter Banner Alt" @if(!empty($banner['alt'])) value="{{ $banner['alt'] }}" @else value="{{ old('alt') }}" @endif>
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