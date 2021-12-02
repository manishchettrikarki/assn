@extends('layouts.app')
@section('title',$page->title)
@section('meta')
    <meta name="title" content="{{ $page->meta_title }}">
    <meta name="description" content="{{ $page->meta_description }}">
    <meta name="keywords" content="{{ $page->tags }}">
@endsection
@section('content')
 {!! $page->content !!}
@endsection
