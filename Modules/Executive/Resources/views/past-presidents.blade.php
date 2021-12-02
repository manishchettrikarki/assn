@extends('layouts.app')
@section('title','Past-Presidents')
@section('content')
<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Past Presidents</li>
    </ol>
</nav>

<!-- Heading -->
<div class="container">
    <div class="heading-about">
        <div class="text-center">
            <h2>ASSN Past Presidents</h2>
            <div class="small-line"></div>
        </div>
    </div>
</div>

<!-- Members photos section start -->
<div class="team-area sp">
    <div class="container">
        <div class="row">
            @foreach($presidents as $president)
            <div class="col-sm-6 col-md-4 col-lg-4 single-team">
                <div class="inner">
                    <div class="team-img">
                        <img src="{{$president->image}}" alt="Member Photo">
                    </div>
                    <div class="team-content">
                        <h4>{{$president->name}}</h4>
                        <h5>{{$president->tenure}} term</h5>
                        <h5>{{$president->duration}}</h5>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
    @endsection
