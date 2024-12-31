<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $setting->nama_perusahaan }} | @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Favicons -->
    <link rel="icon" href="{{ url($setting->path_logo) }}" type="image/png">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-2/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-2/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-2/dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-2/dist/css/skins/_all-skins.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet"
        href="{{ asset('AdminLTE-2/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css"> --}}
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"> --}}
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css"> --}}

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet"
        href="{{ asset('AdminLTE-2/bower_components/datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css') }}">
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/colvis/1.5.6/css/dataTables.colVis.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/preloader.css') }}">
    @stack('css')
</head>

<body class="hold-transition skin-purple-light sidebar-mini">
    <!-- Preloader Overlay -->
    <div class="preloader-overlay"></div>
    <!-- Preloader -->
    <div class="preloader">
        <div class="loader">
            <div class="bounce bounce1"></div>
            <div class="bounce bounce2"></div>
            <div class="bounce bounce3"></div>
            {{-- <div class="bounce bounce4"></div> --}}
        </div>
    </div>
    <!-- /.Preloader -->

    <div class="wrapper" id="app">

        <!-- HEADER -->
        @includeIf('layouts.header')

        <!-- Left side column. contains the logo and sidebar -->
        @includeIf('layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    @yield('title')
                </h1>
                <ol class="breadcrumb">
                    @section('breadcrumb')
                        <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                    @show
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                @yield('content')

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- FOOTER -->
        @includeIf('layouts.footer')

    </div>
    <!-- ./wrapper -->

    <!-- jQuery 3 -->
    <script src="{{ asset('AdminLTE-2/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('AdminLTE-2/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- Moment -->
    <script src="{{ asset('AdminLTE-2/bower_components/moment/min/moment.min.js') }}"></script>

    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/colvis/1.5.6/js/dataTables.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js"></script>

    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    {{-- <script src="{{ asset('AdminLTE-2/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script> --}}
    <script src="{{ asset('AdminLTE-2/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

    <!-- AdminLTE App -->
    <script src="{{ asset('AdminLTE-2/dist/js/adminlte.min.js') }}"></script>
    <!-- Validator -->
    <script src="{{ asset('js/validator.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
            });
        </script>
    @endif
    <script>
        document.getElementById('logout-button').addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah aksi default tombol

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda akan keluar dari aplikasi!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#00a65a',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Keluar',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit(); // Submit form jika konfirmasi
                }
            });
        });
    </script>

    <!-- Preloader -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var preloader = document.querySelector('.preloader');
            var preloaderOverlay = document.querySelector('.preloader-overlay');

            preloader.style.visibility = 'visible';
            preloaderOverlay.style.visibility = 'visible';

            setTimeout(function() {
                preloader.style.visibility = 'hidden';
                preloaderOverlay.style.visibility = 'hidden';
            }, 1000); // Menampilkan preloader selama 1 detik
        });
    </script>

    <script>
        function preview(selector, temporaryFile, width = 200) {
            $(selector).empty();
            $(selector).append(`<img src="${window.URL.createObjectURL(temporaryFile)}" width="${width}">`);
        }
    </script>

    @stack('scripts')
</body>

</html>
