@extends('layouts.app')
@section('title','Past-General Secretary')
@section('content')
<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Past General Secretary</li>
    </ol>
</nav>

<!-- Heading -->
<div class="container">
    <div class="heading-about">
        <div class="text-center">
            <h2>ASSN Past General Secretary</h2>
            <div class="small-line"></div>
        </div>
    </div>
</div>

<!-- Members photos section start -->
<div class="team-area sp">
    <div class="container">
        <div class="row">
            @foreach($secretaries as $secretary)
            <div class="col-sm-6 col-md-4 col-lg-4 single-team">
                <div class="inner">
                    <div class="team-img">
                        <img src="{{$secretary->image}}" alt="Member Photo">
                    </div>
                    <div class="team-content">
                        <h4>{{$secretary->name}}</h4>
                        <h5>{{$secretary->tenure}} Term</h5>
                        <h5>{{$secretary->duration}}</h5>
                    </div>
                </div>
            </div>
                @endforeach
        </div>
    </div>
</div>
    @endsection
