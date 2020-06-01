<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('const.app_name') }}@yield('sub_title')</title>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="{{ asset('js/admin_article_textarea.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="@yield('content_css')">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    {{-- favicon --}}
    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">

</head>
<body>
    <main class="content">
        @yield('content')
    </main>
</body>
</html>
