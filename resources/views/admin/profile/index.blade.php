@extends('admin.templates.template')

@section('body')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                My Profile
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active">User profile</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            @if (session('status'))
                <div class="alert alert-{!! session('status') !!} alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    {!! session('message') !!}
                </div>
            @endif
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle"
                                src="https://ui-avatars.com/api/?name={{ \Auth::user()->name }}"
                                alt="User profile picture">

                            <h3 class="profile-username text-center">{{ \Auth::user()->name }}</h3>

                            <p class="text-muted text-center">{{ \Auth::user()->email }}</p>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->


                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#profile" data-toggle="tab">Profile</a></li>
                            <li class=""><a href="#password" data-toggle="tab">Password</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="active tab-pane" id="profile">
                                <form action="{{ route('dashboard.profile.put') }}" method="POST" class="form-horizontal">
                                    @csrf
                                    @method('put')
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label">Name</label>

                                        <div class="col-sm-10">
                                            <input type="text" name="name" value="{{ \Auth::user()->name }}"
                                                class="form-control" id="inputName" placeholder="Name">
                                        </div>
                                        @error('name')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-danger">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="password">
                                <form action="{{ route('dashboard.profile.password') }}" method="POST"
                                    class="form-horizontal">
                                    @csrf
                                    @method('put')
                                    <div class="form-group">
                                        <label for="inputPassword" class="col-sm-2 control-label">Password</label>

                                        <div class="col-sm-10">
                                            <input type="password" name="password" class="form-control" id="inputPassword"
                                                placeholder="Password">
                                            @error('password')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputNewPassword" class="col-sm-2 control-label">New Password</label>

                                        <div class="col-sm-10">
                                            <input type="password" name="new_password" class="form-control"
                                                id="inputNewPassword" placeholder="New Password">
                                            @error('new_password')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputNewPasswordConfirmation" class="col-sm-2 control-label">Confirm New
                                            Password</label>

                                        <div class="col-sm-10">
                                            <input type="password" name="new_password_confirmation" class="form-control"
                                                id="inputNewPasswordConfirmation" placeholder="Confirm New Password">
                                            @error('name')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-danger">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
