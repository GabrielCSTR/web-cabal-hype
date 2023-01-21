<!DOCTYPE html>
<html class="loading" lang="pt-BR" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="author" content="Codebased">
    <title>Cabal Millennium - Painel</title>
    <link rel="apple-touch-icon" href="{{ asset('panel/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('panel/images/ico/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('panel/css/vendors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('panel/vendors/css/tables/datatable/datatables.min.css') }}">
    <!-- END VENDOR CSS-->
    <!-- BEGIN MODERN CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('panel/css/app.css') }}">
    <!-- END MODERN CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('panel/css/core/menu/menu-types/vertical-menu-modern.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('panel/css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('panel/vendors/css/charts/jquery-jvectormap-2.0.3.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('panel/vendors/css/charts/morris.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('panel/fonts/simple-line-icons/style.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('panel/vendors/css/cryptocoins/cryptocoins.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('panel/css/core/colors/palette-callout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('panel/css/plugins/loaders/loaders.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('panel/css/plugins/animate/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('panel/css/pages/users.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('panel/css/plugins/forms/extended/form-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('panel/css/plugins/forms/checkboxes-radios.css') }}">
    @yield('page_level_css')
    <!-- END Page Level CSS-->

    <!-- BEGIN Custom CSS-->
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('panel/web/css/style.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('panel/css/style.css') }}">
    <!-- END Custom CSS-->
    {{--  TOAST NOTIFICATION  --}}
    <!-- CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">
</head>

<body class="vertical-layout vertical-menu-modern 2-columns fixed-navbar  menu-expanded pace-done" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns"
    style="background-image: none;">

    <!-- PRELOADER -->
    <div id="preloaderLecionar">
        <div class="loader-wrapper">
            <div class="loader-container">
                <div class="ball-clip-rotate-multiple loader-white">
                    <div></div>
                    <div></div>
                </div>
            </div>
        </div>
    </div>

    <!-- fixed-top-->
    @include('painel.layouts.components.navbar')

    <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow expanded" data-scroll-to-active="true">

        @include('painel.layouts.components.sidebar')

        <div class="app-content content">

            <div class="content-wrapper">

                <div class="content-header row">
                    @yield('header')
                </div>

                <div class="content-body">

                    @yield('content')

                </div>
            </div>
    </div>

    @include('painel.layouts.components.footer')

    <!-- BEGIN VENDOR JS-->
    <script src="{{ asset('panel/vendors/js/vendors.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('panel/vendors/js/tables/datatable/datatables.min.js') }}" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{ asset('panel/js/scripts/tables/datatables/datatable-basic.js') }}" type="text/javascript"></script>
    <script src="{{ asset('panel/vendors/js/extensions/jquery.knob.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('panel/vendors/js/charts/chart.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('panel/vendors/js/charts/raphael-min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('panel/vendors/js/charts/morris.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('panel/vendors/js/charts/jquery.sparkline.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('panel/vendors/js/charts/jvector/jquery-jvectormap-2.0.3.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('panel/vendors/js/charts/jvector/jquery-jvectormap-world-mill.js') }}" type="text/javascript"></script>
    {{-- <script src="{{ asset('panel/data/jvector/visitor-data.js') }}" type="text/javascript"></script> --}}
    <script src="{{ asset('panel/vendors/js/forms/extended/formatter/formatter.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('panel/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN MODERN JS-->
    <script src="{{ asset('panel/js/core/app-menu.js') }}" type="text/javascript"></script>
    <script src="{{ asset('panel/js/core/app.js') }}" type="text/javascript"></script>
    <script src="{{ asset('panel/js/scripts/customizer.js') }}" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.js"></script>
    <script src="{{ asset('panel/js/scripts/forms/extended/form-formatter.js') }}" type="text/javascript"></script>
    <script src="{{ asset('panel/js/scripts/forms/checkbox-radio.js') }}" type="text/javascript"></script>
    <!-- END MODERN JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    @yield('page_level_js')
    <!-- END PAGE LEVEL JS-->

    @yield('scripts')

    <!-- JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>


    <script>
        $(document).ready(function() {
            toastr.options.timeOut = 10000;
            @if (Session::has('error'))
                toastr.error('{{ Session::get('error') }}');
            @elseif(Session::has('success'))
                toastr.success('{{ Session::get('success') }}');
            @endif
        });

    </script>

    <script>
        /**
        * Remove o preloader
        */
        $('document').ready(function(){
            let preloader = $('#preloaderLecionar');
            preloader.fadeOut('slow',function(){$(this).remove();});
        });

        /**
        * spinner em submits
        */
        $('form button[type="submit"]').click(function(){
            $(this).find('i').css('display', 'inline-block');
            setInterval(function(){
                $('form button[type="submit"] i').css('display', 'none');
            }, 1000);
        });
    </script>


</body>
</html>
