<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset=" utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>RealStudios</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@100;200;300;400;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <!-- pace-progress -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/pace-progress/themes/black/pace-theme-flat-top.css') }}">

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">

    @stack('layout-css')

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/toastr/toastr.min.css">

    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->

</head>
<style>
    body {
        font-family: 'Nunito', 'Segoe UI', sans-serif;
    }

    label.error {
        color: #F0E68C;
        font-size: 0.9rem;
        font-weight: 100;
        display: block;
        margin-top: 5px;
    }

    input.error {
        border: 1px dashed red;
        font-weight: 300;
        color: red;
    }
</style>
<!-- <body class="hold-transition sidebar-mini"> -->

<body class="sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed hold-transition pace-primary" style="height: auto;">

    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('/profile') }}" class="nav-link">Profile</a>
                </li>
            </ul>

            <!-- SEARCH FORM -->

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-itemn">
                    <a href="#" class="nav-link" data-target="#register-modal" data-toggle="modal" data-tooltip="tooltip" title="Add New User">
                        <!-- <i class="fas fa-user-plus"></i> -->
                        <i class="fas fa-user-plus" style="font-size:18px"></i>
                    </a>
                </li>

                <!-- Messages Dropdown Menu -->
                <li class="nav-itemn">

                    <a class="nav-link" id="logout" href="/logout-user" data-tooltip="tooltip" title="Log Out">
                        <i class="fas fa-sign-out-alt" style="font-size:18px"></i>
                    </a>

                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->

            <div class="login-logo mt-4">
                <img src="{{ asset('images/gccamp_logo.jpeg') }}" width="60px" class="brand-image img-circle elevation-3" alt="RealStudios">
            </div>

            <!-- Sidebar -->
            <div class="sidebar mt-n2">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img class="brand-image img-circle elevation-2" src="https://ui-avatars.com/api/?name=GC Camp&color=7F9CF5&background=EBF4FF&size=128" alt="{{-- auth()->user()->name --}}">
                    </div>
                    <div class="info">
                        <a href="{{ url('/profile') }}" class="d-block">{{ __('GC Camp')}}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon classwith font-awesome or any other icon font library -->

                        <li class="nav-item">
                            <a href="/" class="nav-link {{ $page_uri == 'dashboard' ? 'active': '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('/company') }}" class="nav-link {{ $page_uri == 'company' ? 'active': '' }} ">
                                <i class="fas fa-user-friends nav-icon"></i>
                                <p>Company</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{url('/employee' )}}" class="nav-link {{ $page_uri == 'employee' ? 'active': '' }}">
                                <i class="fas fa-users nav-icon"></i>
                                <p>Employees</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{url('/users')}}" class="nav-link {{ $page_uri == 'users' ? 'active': '' }}">
                                <i class="fas fa-user-check nav-icon"></i>
                                <p>Users</p>
                            </a>
                        </li>

                        <!-- <li class="nav-item">
                            <a href="{{url('/edit-attendance')}}" class="nav-link {{ $page_uri == 'edit_attendance' ? 'active': '' }}">
                                <i class="fas fa-user-check nav-icon"></i>
                                <p>Edit Attendance</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{url('/reports')}}" class="nav-link {{-- $page_uri == 'therapist_resources' ? 'active': '' --}}">
                                <i class="fas fa-chart-pie nav-icon"></i>
                                <p>Reports</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('/setups') }}" class="nav-link {{ $page_uri == 'setups' ? 'active': '' }}">
                                <i class="nav-icon fas fa-tools"></i>
                                <p>Setups</p>
                            </a>
                        </li> -->
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Main content -->
        @yield("content")

        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright</strong> &copy; 2020 - {{ date('Y') }} <a href="https://realstudiosonline.com/" class="font-family-light"><strong>RealStudiosOnline</strong></a>. All rights
            reserved.
        </footer>

        <!-- /.content -->
    </div>
    <!-- ./wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Sign Up Modal -->
    <div aria-hidden="true" class="modal fade" role="dialog" id="register-modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="background-color: #4ba1e2;">
                <div class="modal-header">
                    <h4 class="modal-title">Add New User</h4>
                </div>
                <!-- Close Start -->
                <div class="modal-body">
                    <form id="internalSignUp">
                        @csrf

                        <div class="form-group">
                            <label class="text-white" for="name">Name</label>
                            <input class="form-control" name="name" id="name" placeholder="eg: James" type="text" :value="old('name')" autofocus autocomplete="name">
                        </div>

                        <div class="form-group">
                            <label class="text-white" for="emailAddress">Email Address</label>
                            <input class="form-control" name="email" id="emailAddress" placeholder="eg: jamessmith@domain.com" type="email" :value="old('email')" autocomplete="email">
                        </div>


                        <!--/.form-group-->
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="text-white" for="password">Password</label>
                                    <input class="form-control" name="password" id="password" placeholder="Type your password" type="password" autocomplete="new-password">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="text-white" for="confirm_password">Confirm Password</label>
                                    <input class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm password" type="password" autocomplete="new-password">
                                </div>
                            </div>
                        </div>

                    </form>
                </div><!-- Register Section End -->
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-light" form="internalSignUp"><i class="fa fa-plus-circle"></i> Add User</button>
                </div>
            </div>
            <!-- Forgot Password Section Start -->
            <!--/.modal-content-->
        </div>
        <!--/.modal-dialog-->
    </div><!-- Login Modal End -->

    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- DataTables -->
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <!-- pace-progress -->
    <script src="{{ asset('assets/plugins/pace-progress/pace.min.js') }}"></script>

    <!-- ChartJS -->
    <script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>

    <!-- AdminLTE App -->
    <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>

    @stack('js')

    <script>
        $("#internalSignUp").validate({
            rules: {
                name: "required",

                emailAddress: {
                    required: true,
                    email: true,
                    remote: "/check-email",
                },
                password: {
                    required: true,
                    minlength: 8,
                },
                confirm_password: {
                    required: true,
                    minlength: 8,
                    equalTo: "#password",
                },
            },

            messages: {
                name: "Please enter your name.",

                email: {
                    required: "Please enter your email.",
                    email: "Email entered is not valid.",
                    remote: "Email is being used by another user"
                },
                password: {
                    required: "Please enter a suitable password for security.",
                    minlength: "Password length cannot be less than 8 characters.",
                },
                confirm_password: {
                    required: "Please confirm your password.",
                    minlength: "Password length cannot be less than 8 characters.",
                    equalTo: "Password confirmation must equal what you typed above.",
                },
            },

            submitHandler: (form) => {
                const post_data = {
                    _token: $("input[name=_token]").val(),
                    email: $("#emailAddress").val(),
                    name: $("#name").val(),
                    password: $("#password").val(),
                    password_confirmation: $("#confirm_password").val()
                }

                alert($("#emailAddress").val());
                const formData = JSON.stringify(post_data);

                $.ajax({
                    url: "/register",
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    contentType: "application/json",
                    success: (responseData) => {
                        console.log(responseData);
                        if (responseData.response_code == 200) {
                            toastr.success(responseData.response_message);
                            $("#register-modal").modal("hide");
                        } else {
                            toastr.error(responseData.response_message);
                            $("#register-modal").modal("hide");
                        }
                    },
                    error: (xhr, status, error) => {
                        const message = xhr.responseText;
                        toastr.error(message);
                    }
                });
            },
            errorClass: "invalid font-weight-light",
        });
    </script>


</body>

</html>