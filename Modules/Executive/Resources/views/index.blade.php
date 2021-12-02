@extends('executive::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('executive.name') !!}
    </p>
@endsection
