@extends('layouts.admin_layout.admin_layout')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Settings</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Admin Settings</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Update Password</h3>
                        </div>
                        <!-- /.card-header -->

                        @if(Session::has('error_message'))
                            <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                {{ Session::get('error_message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
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

                        <!-- form start -->
                        <form role="form" method="POST" action="{{ url('/admin/update-admin-password') }}" name="updateAdminPassword" id="updateAdminPassword">
                            @csrf

                            <div class="card-body">
                                {{--<div class="form-group">
                                    <label for="name">Admin Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $adminDetails->name }}" placeholder="Enter Admin/SubAdmin Name">
                                </div>--}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Admin Email</label>
                                    <input class="form-control" value="{{ $adminDetails->email }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Admin Type</label>
                                    <input class="form-control" value="{{ $adminDetails->type }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="currentPassword">Current Password</label>
                                    <input type="password" class="form-control" id="currentPassword" name="currentPassword" placeholder="Enter Current Password" required>
                                    <span id="currentPasswordStatus"></span>
                                </div>
                                <div class="form-group">
                                    <label for="newPassword">New Password</label>
                                    <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Enter New Password" required>
                                </div>
                                <div class="form-group">
                                    <label for="confirmPassword">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm New Password" required>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->

                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->

@endsection