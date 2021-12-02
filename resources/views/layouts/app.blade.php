{{--<!doctype html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport"--}}
{{--          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">--}}
{{--    <meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
{{--    @yield('meta')--}}
{{--    <title>{{ site('name') }} | @yield('title')</title>--}}
{{--    <link rel="stylesheet" href="{{ asset('css/app.css') }}">--}}
{{--</head>--}}
{{--<body>--}}
{{--<header id="header-area">--}}
{{--    @include('partials.top-nav')--}}
{{--    @include('partials.nav')--}}
{{--</header>--}}

{{--@yield('content')--}}

{{--@include('partials.footer')--}}

{{--<script src="{{ asset('js/app.js') }}"></script>--}}
{{--</body>--}}
{{--</html>--}}

    <!DOCTYPE html>
<html lang="en">

<head>
    <title>ASSN- Associtaion of Spine Surgeons of Nepal | @yield('title')</title>
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png"/>
    <!-- Required meta tags -->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">


</head>

<body>
<!-- top navbar -->
    @include('partials.top-nav')
<!-- top nav ends -->
<!-- menu nav starts -->
    @include('partials.nav')
<!-- menu nav ends -->    <!-- slider starts -->
@yield('content')
@include('partials.footer')

<script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
