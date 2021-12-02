<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ config('app.name') }} | @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="TravelDome-One Solution for your travel." name="description" />
    <meta content="TravelDome" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <!-- slick css -->

    <!-- App Css-->
    <link href="{{ asset('back/css/app.css') }}" rel="stylesheet" type="text/css" />
    @yield('style')
    <script src="{{ asset('/back/js/app.js') }}"></script>



</head>
<body data-sidebar="dark">

<!-- Begin page -->
    <div id="layout-wrapper">
