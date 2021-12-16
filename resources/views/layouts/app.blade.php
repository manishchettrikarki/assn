

<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ site('name') }} | @yield('title')</title>
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png"/>
    <!-- Required meta tags -->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
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
