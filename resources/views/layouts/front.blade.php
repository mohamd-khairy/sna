<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ trans('panel.site_title') }}</title>

    <!-- EN start -->
    <meta name="theme-color" content="#014656" />

    <link rel="icon" type="image/png" href="{{ asset('frontend/img/IDU LOGO-inverted-02.png') }}" />

    <link href="{{ asset('frontend/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/normalize.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/iduniGrid.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/style.css') }}?v={{time()}}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <!-- EN end -->

    @yield('styles')
</head>

<body class="header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden login-page">
    @include('frontend.partials.header',[$ContentCategory])
    @yield("content")
    @include('frontend.partials.footer')


    <!-- <script src="{{ asset('js/main.js') }}"></script> -->
    <script src="{{ asset('frontend/js/jquery-3.2.1.min.js') }} "></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }} "></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/script.js') }}?v=2"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>

    <!-- <script src="{{ asset('js/main.js') }}"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script> -->


    @yield('scripts')
</body>

</html>
