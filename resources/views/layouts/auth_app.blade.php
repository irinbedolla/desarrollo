<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title') | SICCL</title>

    <!-- General CSS Files -->
    <link href="public/assets_seer/assets/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

    <!-- Template CSS -->
    <link href="public/web/css/style.css" rel="stylesheet">
    <link href="public/web/css/components.css" rel="stylesheet">
    <link href="public/assets/css/iziToast.min.css" rel="stylesheet">
    <link href="public/assets/css/sweetalert.css" rel="stylesheet" type="text/css"/>
    <link href="public/assets/css/select2.min.css" rel="stylesheet" type="text/css"/>
</head>

<body>
<div id="app">
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="login-brand">
                        <img src="public/assets_seer/images/ccl.png" alt="logo" width="100"
                             class="shadow-light">
                    </div>
                    @yield('content')
                    <div class="simple-footer">
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- General JS Scripts -->
<script src="public/assets/js/jquery.min.js"></script>
<script src="public/assets/js/popper.min.js"></script>
<script src="public/assets/js/bootstrap.min.js"></script>
<script src="public/assets/js/jquery.nicescroll.js"></script>

<!-- JS Libraies -->

<!-- Template JS File -->
<script src="public/web/js/stisla.js"></script>
<script src="public/web/js/scripts.js"></script>
<!-- Page Specific JS File -->
</body>
</html>
