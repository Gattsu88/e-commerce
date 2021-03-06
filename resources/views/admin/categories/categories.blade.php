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
                                <h3 class="card-title">Categories</h3>
								<a href="{{ url('admin/add-edit-category') }}" style="max-width: 150px; float: right; display: inline-block;" class="btn btn-block btn-success">Add Category</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="categories" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category</th>
                                        <th>Parent Category</th>   
                                        <th>Section</th>    
										<th>URL</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($categories as $category)
                                            @if(!isset($category->parentCategory->category_name))
                                                <?php $parent_category = "Root"; ?>
                                            @else
                                                <?php $parent_category = $category->parentCategory->category_name; ?>
                                            @endif
                                                <tr>
                                                    <td>{{ $category->id }}</td> 
                                                    <td>{{ $category->category_name }}</td>
                                                    <td>{{ $parent_category }}</td>
                                                    <td>{{ $category->section->name }}</td>  
    												<td>{{ $category->url }}</td>
                                                    <td>
                                                        @if($category->status == 1)
                                                            <a title="Change Status" href="javascript:void(0)" id="category-{{ $category->id }}" category_id="{{ $category->id }}" class="updateCategoryStatus"><i class="fas fa-toggle-on fa-lg" aria-hidden="true" status="Active"></i></a>
                                                        @else
                                                            <a title="Change Status" href="javascript:void(0)" id="category-{{ $category->id }}" category_id="{{ $category->id }}" class="updateCategoryStatus"><i class="fas fa-toggle-off fa-lg" aria-hidden="true" status="Inactive"></i></a>
                                                        @endif&nbsp;
                                                        <a title="Edit Category" href="{{ url('admin/add-edit-category/'.$category->id) }}"><i class="fas fa-edit fa-lg"></i></a>&nbsp;
                                                        <a title="Remove Category" href="javascript:void(0)" class="confirmDelete" record="category" recordid="{{ $category->id }}"><i class="fas fa-trash fa-lg"></i></a>
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