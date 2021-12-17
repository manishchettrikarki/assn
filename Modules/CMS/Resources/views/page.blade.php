@extends('layouts.app')
@section('title',$page->title)
@section('meta')
    <meta name="title" content="{{ $page->meta_title }}">
    <meta name="description" content="{{ $page->meta_description }}">
    <meta name="keywords" content="{{ $page->tags }}">
@endsection
@section('content')
    <nav style="--bs-breadcrumb-divider: '&gt;';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $page->title }}</li>
        </ol>
    </nav><!-- Heading -->
    <div class="container">
        <div class="heading-about">
            <div class="text-center">
                <h2>{{ $page->title }}</h2>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">

            {!! $page->content !!}

        </div>
    </div>

@endsection
