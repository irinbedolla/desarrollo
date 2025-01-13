<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}"/>
        <title>Sí Conciliación</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Ionicons -->
        <link href="../public/assets_seer/assets/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="//fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
        <link href="../public/assets/css/@fortawesome/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
        <link href="../public/assets/css/iziToast.min.css" rel="stylesheet">
        <link href="../public/assets/css/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link href="../public/assets/css/select2.min.css" rel="stylesheet" type="text/css"/>
        <!-- Agregados para los Select del Formulario Personas-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
        <link href="https://cdn.datatables.net/2.2.1/css/dataTables.bootstrap5.css">

        <style>
            .loader {
                position: fixed;
                left: 0px;
                top: 0px;
                width: 100%;
                height: 100%;
                z-index: 9999;
                background: url('../public/assets/images/pageLoader.gif') 50% 50% no-repeat rgb(249,249,249);
                opacity: .8;
            }
        </style>
        
        @livewireStyles

        @yield('page_css')
<!-- Template CSS -->
    <link rel="stylesheet" href="../public/web/css/style.css">
    <link rel="stylesheet" href="../public/web/css/components.css">
    @yield('page_css')

        @yield('page_css')
        <!-- Template CSS -->
        @yield('page_css')
    </head>
    <body>

        <div id="app">
            <div class="main-wrapper main-wrapper-1">
                <div class="navbar-bg"></div>
                <nav class="navbar navbar-expand-lg main-navbar" style="background-color: #6A0F49">
                    @include('layouts.header')

                </nav>
                <div class="main-sidebar main-sidebar-postion">
                    @include('layouts.sidebar')
                </div>
                <!-- Main Content -->
                <div class="main-content">
                    @yield('content')
                </div>
                <footer class="main-footer">
                    @include('layouts.footer')
                </footer>
            </div>
        </div>


        @include('profile.change_password')
        @include('profile.edit_profile')

    </body>
        
    
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.bootstrap4.js"></script>
    <script>
        $('#example').DataTable({
            info: false,
            ordering: false,
            paging: true
        });
    </script>

@yield('page_js')


@yield('scripts')

</html>
