@extends('layouts.app')
@section('title','Scientific Committee')
@section('content')
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Scientific Committee</li>
        </ol>
    </nav>

    <!-- Heading -->
    <div class="container">
        <div class="heading-about">
            <div class="text-center">
                <h2>Scientific Committee</h2>
                <div class="small-line"></div>
            </div>
        </div>
    </div>

    <!-- Members photos section start -->
    <div class="team-area sp">
        <div class="container">
            <div class="row">
                @foreach($committees as $committee)
                    <div class="col-sm-6 col-md-4 col-lg-4 single-team">
                        <div class="inner">
                            <div class="team-img">
                                <img src="{{$committee->image}}" alt="Member Photo">
                            </div>
                            <div class="team-content">
                                <h4>{{$committee->name}}</h4>
                                <h5>{{$committee->email}}</h5>
                                <h5>{{$committee->designation}}</h5>
                                <h5>{{$committee->membertype}}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
