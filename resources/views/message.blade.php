@extends('layouts.app')
@section('title','Contact Us')
@section('content')
    <div class="container-fluid message">
        <div class="row">
            <div class="col-md-10 col-11 mx-auto">
                <div class="row float-start">
                    <div class="col-md-6">
                        <img src="{{$message->image}}" class="img-fluid" alt="ASSN" />
                    </div>
                    <div class="col-md-6 p-2">
                        <h3>Message From {{$message->post}}</h3>
                        <div class="underline"></div>
                        <p>{{$message->message}}</p>

                    </div>

                </div>
            </div>
        </div>
    </div>
    @endsection
