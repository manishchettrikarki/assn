@extends('layouts.app')
@section('title','Provincial Representative')
@section('content')
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Provincial Representative</li>
        </ol>
    </nav>

    <!-- Heading -->
    <div class="container">
        <div class="heading-about">
            <div class="text-center">
                <h2>Provincial Representative</h2>
                <div class="small-line"></div>
            </div>
        </div>
    </div>

    <!-- Members photos section start -->
    <div class="team-area sp">
        <div class="container">
            <div class="row">
                @foreach($representatives as $representative)
                    <div class="col-sm-6 col-md-4 col-lg-4 single-team">
                        <div class="inner">
                            <div class="team-img">
                                <img src="{{$representative->image}}" alt="Member Photo">
                            </div>
                            <div class="team-content">
                                <h4>{{$representative->name}}</h4>
                                <h5>{{$representative->email}}</h5>
                                <h5>{{$representative->designation}}</h5>
                                <h5>{{$representative->membertype}}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
