@extends('layouts.auth')

@section('login')
    <div class="login-box">
        <div class="login-logo">
            <center>
                <a href="{{ url('#') }}"><img src="{{ url($setting->path_logo) }}" class="img-responsive"
                        style="max-width: 100px;" alt="Logo"></a>
            </center>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg"><strong>{{ $setting->nama_perusahaan }}</strong></p>

            @if (session('message'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close custom-close" data-dismiss="alert" aria-hidden="true">
                        <span>×</span>
                    </button>
                    <h4><i class="icon fa fa-info"></i> Berhasil logout!</h4>
                    {{ session('message') }}
                </div>
            @else
                <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close custom-close" data-dismiss="alert" aria-hidden="true">
                        <span>×</span>
                    </button>
                    <h4><i class="icon fa fa-bullhorn"></i> Selamat datang!</h4>
                    Silahkan login terlebih dahulu.
                </div>
            @endif

            <form action="{{ route('login') }}" method="post" class="form-login">
                @csrf
                <div class="form-group has-feedback @error('username') has-error @enderror">
                    <input type="text" class="form-control" name="username" placeholder="Username"
                        value="{{ old('username') }}" autofocus>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    @error('username')
                        <small class="help-block">{{ $message }}</small>
                    @else
                        <span class="help-block with-errors"></span>
                    @enderror
                </div>
                <div class="form-group has-feedback @error('password') has-error @enderror">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @error('password')
                        <small class="help-block">{{ $message }}</small>
                    @else
                        <span class="help-block with-errors"></span>
                    @enderror
                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">LOGIN</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

        </div>
        <!-- /.login-box-body -->
    </div>
@endsection
