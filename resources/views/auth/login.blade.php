<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>RealStudio | Login</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@100;200;300;400;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets')}}/plugins/toastr/toastr.min.css">

</head>

<body class="hold-transition login-page" style="font-family:Nunito;">
    <div class="login-box">
        <!-- <div class="login-logo">
      <a href="{{asset('assets/index2.html')}}"><b>Pain</b>MAP</a>
    </div> -->
        <!-- <div class="login-logo mb-0">
            <img src="{{ asset('assets/front/images/pain_map_logo_back.png') }}" width="120px" class="brand-image img-circle" alt="PainMap" alt="User Image">
        </div> -->
        <!-- /.login-logo -->
        <div class="card card-outline card-primary mt-n3">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form id="loginForm" method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="input-group mb-3">
                        <input name="email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" :value="old('email')" required autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @error('email')
                        <span class="invalid-feedback is-invalid" role="alert">
                            <strong class="font-weight-light">{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input name="password" id="password" type="password" class="form-control" placeholder="Password" required autocomplete="current-password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input id="remember_me" type="checkbox" class="form-checkbox" name="remember">
                                <label for="remember_me">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <!-- <p class="mb-1">
                    @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        I forgot my password
                    </a>
                    @endif
                </p> -->
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/dist/js/adminlte.min.js')}}"></script>

    <script src="{{asset('assets')}}/plugins/toastr/toastr.min.js"></script>

</body>

</html>