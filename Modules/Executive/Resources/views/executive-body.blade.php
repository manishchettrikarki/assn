@extends('layouts.app')
@section('title','Executive-Body')
@section('content')
<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Executive Bodies</li>
    </ol>
</nav>

<!-- Heading -->
<div class="container">
    <div class="heading-about">
        <div class="text-center">
            <h2>ASSN Executive Bodies</h2>
            <div class="small-line"></div>
        </div>
    </div>
</div>

<!-- Members photos section start -->
<div class="team-area sp">
    <div class="container">
        <div class="row">
            @foreach($executiveBodies ->filter(function($item){
    return $item->post=='President'||$item->post=='Vice-President'||$item->post=='Imm. Past President';
}) as $executiveBody)
            <div class="col-sm-6 col-md-4 col-lg-4 single-team">
                <div class="inner">
                    <div class="team-img">
                        <img src="{{$executiveBody->image}}" alt="Member Photo">
                    </div>
                    <div class="team-content">
                        <h4>{{$executiveBody->name}}</h4>
                        <h5>{{$executiveBody->post}}</h5>
                        <div class="team-social">
                            <a href="#" class="fab fa-facebook"></a>
                            <a href="#" class="fab fa-twitter"></a>
                            <a href="#" class="fab fa-linkedin"></a>
                        </div>
                    </div>
                </div>
            </div>
                @endforeach
        </div>
        <div class="row">
            @foreach($executiveBodies ->filter(function($item){
    return $item->post=='General Secretary'||$item->post=='Treasurer'||$item->post=='Joint Secretary';
}) as $executiveBody)
                <div class="col-sm-6 col-md-4 col-lg-4 single-team">
                    <div class="inner">
                        <div class="team-img">
                            <img src="{{$executiveBody->image}}" alt="Member Photo">
                        </div>
                        <div class="team-content">
                            <h4>{{$executiveBody->name}}</h4>
                            <h5>{{$executiveBody->post}}</h5>
                            <div class="team-social">
                                <a href="#" class="fab fa-facebook"></a>
                                <a href="#" class="fab fa-twitter"></a>
                                <a href="#" class="fab fa-linkedin"></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            @foreach($executiveBodies ->filter(function($item){
    return $item->post=='Member';
}) as $executiveBody)
                <div class="col-sm-6 col-md-4 col-lg-3 single-team">
                    <div class="inner">
                        <div class="team-img">
                            <img src="{{$executiveBody->image}}" alt="Member Photo">
                        </div>
                        <div class="team-content">
                            <h4>{{$executiveBody->name}}</h4>
                            <h5>{{$executiveBody->post}}</h5>
                            <div class="team-social">
                                <a href="#" class="fab fa-facebook"></a>
                                <a href="#" class="fab fa-twitter"></a>
                                <a href="#" class="fab fa-linkedin"></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
