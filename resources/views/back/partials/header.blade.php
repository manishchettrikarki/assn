<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ site('name') }} | @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Association on spine surgeons of nepal" name="description" />
    <meta content="ASSN" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <!-- slick css -->
    @laravelPWA
    <script type="text/javascript">
        // Initialize the service worker
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/serviceworker.js', {
                scope: '.'
            }).then(function (registration) {
                // Registration was successful
                console.log('Laravel PWA: ServiceWorker registration successful with scope: ', registration.scope);
            }, function (err) {
                // registration failed :(
                console.log('Laravel PWA: ServiceWorker registration failed: ', err);
            });
        }
    </script>
    <!-- App Css-->
    <link href="{{ asset('back/css/app.css') }}" rel="stylesheet" type="text/css" />
    @yield('style')
    <script src="{{ asset('/back/js/app.js') }}"></script>



</head>
<body data-sidebar="dark">

<!-- Begin page -->
    <div id="layout-wrapper">
