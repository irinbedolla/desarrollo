<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>Sí Conciliación</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 4.1.1 -->
    <link href="../public/assets_seer/assets/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <!-- Ionicons -->
    <link href="//fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <link href="../public/assets/css/@fortawesome/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
    <link href="../public/assets/css/iziToast.min.css" rel="stylesheet">
    <link href="../public/assets/css/sweetalert.css" rel="stylesheet" type="text/css"/>
    <link href="../public/assets/css/select2.min.css" rel="stylesheet" type="text/css"/>
    
    <!-- Agregados para los Select del Formulario Personas-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.5/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.1.5/js/dataTables.js"></script>



    @livewireStyles


@yield('page_css')
    <!-- Template CSS -->
    <link rel="stylesheet" href="../public/web/css/style.css">
    <link rel="stylesheet" href="../public/web/css/components.css">
    @yield('page_css')

    @yield('css')
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
@livewireScripts
</body>
<script src="../public/assets/js/jquery.min.js"></script>
<script src="../public/assets/js/popper.min.js"></script>
<script src="../public/assets/js/bootstrap.min.js"></script>
<script src="../public/assets/js/sweetalert.min.js"></script>
<script src="../public/assets/js/iziToast.min.js'"></script>
<script src="../public/assets/js/select2.min.js"></script>
<script src="../public/assets/js/jquery.nicescroll.js"></script>

<!-- Template JS File -->
<script src="../public/web/js/stisla.js"></script>
<script src="../public/web/js/scripts.js"></script>
<script src="../public/assets/js/profile.js"></script>
<script src="../public/assets/js/custom/custom.js"></script>
@yield('page_js')
@yield('scripts')
<script>
    let loggedInUser =@json(\Illuminate\Support\Facades\Auth::user());
    let loginUrl = '{{ route('login') }}';
    const userUrl = '{{url('users')}}';
    // Loading button plugin (removed from BS4)
    (function ($) {
        $.fn.button = function (action) {
            if (action === 'loading' && this.data('loading-text')) {
                this.data('original-text', this.html()).html(this.data('loading-text')).prop('disabled', true);
            }
            if (action === 'reset' && this.data('original-text')) {
                this.html(this.data('original-text')).prop('disabled', false);
            }
        };
    }(jQuery));
</script>
</html>
