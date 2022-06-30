<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>{{ setting('settings.general_settings.app_name')?setting('settings.general_settings.app_name'):'' }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ setting('settings.general_settings.app_favicon')?setting('settings.general_settings.app_favicon'):'' }}">

    <!-- Fontfamily -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;1,400&display=swap">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">

    <!-- Notification CSS -->
    <link rel="stylesheet" href="{{ asset('notification/css/wnoty.css') }}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @yield("page-css")
</head>
<body>

<!-- Main Wrapper -->
<div class="main-wrapper {{ request()->path() === 'login' ? 'login-body':'' }}">
    @if(request()->path() !== 'login')
        @include('backend.partials.head-nav')
        @include('backend.partials.side-nav')
    @endif
    @yield("content")
</div>
<!-- /Main Wrapper -->

<!-- jQuery -->
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>

<!-- Bootstrap Core JS -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Slimscroll JS -->
<script src="{{ asset('assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

<!-- Notification JS -->
<script src="{{ asset('notification/js/wnoty.js') }}"></script>

<!-- Custom JS -->
<script src="{{ asset('assets/js/script.js') }}"></script>

<script type="text/javascript">
    function notify(message,type) {
        $.wnoty({
            message: '<strong class="text-'+(type)+'">'+(message)+'</strong>',
            type: type,
            autohideDelay: 3000
        });
    }
</script>

@if(session()->has('success'))
    <script type="text/javascript">
        $(document).ready(function() {
            notify('{{session()->get('success')}}','success');
        });
    </script>
@endif

@if(session()->has('danger'))
    <script type="text/javascript">
        $(document).ready(function() {
            notify('{{session()->get('danger')}}','danger');
        });
    </script>
@endif

@if(session()->has('warning'))
    <script type="text/javascript">
        $(document).ready(function() {
            notify('{{session()->get('warning')}}','warning');
        });
    </script>
@endif

@if($errors->any())
    <script type="text/javascript">
        $(document).ready(function() {
            var errors=<?php echo json_encode($errors->all()); ?>;
            $.each(errors, function(index, val) {
                notify(val,'danger');
            });
        });
    </script>
@endif
@yield("page-script")
</body>
</html>
