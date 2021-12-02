@extends('layouts.app')
@section('title','Executive Committee')
@section('content')


  <!--== Committee Page Content Start ==-->
  <section id="page-content-wrap">
    <div class="committee-content-wrap section-padding">
      <div class="committee-member-list">
        <div class="container">
          <h3 class="text-bold text-center">Executive Committee</h3>
          @if($president)
            <div class="row">
              <div class="col-lg-4 col-sm-10 col-md-7 m-auto">
                <div class="single-committee-member">
                  <img src="{{ $president->image }}" class="img-fluid" alt="Committee"/>
                  <h3>{{ $president->name }} <span class="committee-deg">President</span></h3>
                </div>
              </div>
            </div>
          @endif

          <div class="row">

            @foreach($vicePresidents as $vicePresident)
              <div class="col-lg-4 col-sm-6">
                <div class="single-committee-member">
                  <img src="{{ $vicePresident->image }}" class="img-fluid" alt="Committee"/>
                  <h3>{{ $vicePresident->name }} <span class="committee-deg">Vice President</span></h3>
                </div>
              </div>
            @endforeach

          </div>


          <div class="row">

            @foreach($generalSecretaries as $generalSecretary)
              <div class="col-lg-4 col-sm-6">
                <div class="single-committee-member">
                  <img src="{{ $generalSecretary->image }}" class="img-fluid" alt="Committee"/>
                  <h3>{{ $generalSecretary->name }} <span class="committee-deg">General Secretary</span></h3>
                </div>
              </div>
            @endforeach
          </div>
          <div class="row">

            @foreach($treasurers as $treasurer)
              <div class="col-lg-4 col-sm-6">
                <div class="single-committee-member">
                  <img src="{{ $treasurer->image }}" class="img-fluid" alt="Committee"/>
                  <h3>{{ $treasurer->name }}<span class="committee-deg">Treasurer</span></h3>
                </div>
              </div>

           @endforeach
          </div>

          <div class="row">
            @foreach($executiveMembers as $executiveMember)
              <div class="col-lg-3 col-sm-6">
                <div class="single-committee-member">
                  <img src="{{ $executiveMember->image }}" class="img-fluid" alt="Committee"/>
                  <h3> {{ $executiveMember->name }} <span class="committee-deg">Member</span></h3>
                </div>
              </div>
            @endforeach

          </div>


          <h3 class="text-bold text-center mt-5">Scientific Committee</h3>
          @if($sciChairman)
            <div class="row">
              <div class="col-lg-4 col-sm-10 col-md-7 m-auto">
                <div class="single-committee-member">
                  <img src="{{ $sciChairman->image }}" class="img-fluid" alt="Committee"/>
                  <h3>{{ $sciChairman->name }} <span class="committee-deg">Chairman</span></h3>
                </div>
              </div>
            </div>
          @endif


          <div class="row">
            @foreach($sciMembers as $sciMember)
              <div class="col-lg-3 col-sm-6">
                <div class="single-committee-member">
                  <img src="{{ $sciMember->image }}" class="img-fluid" alt="Committee"/>
                  <h3> {{ $sciMember->name }} <span class="committee-deg">Member</span></h3>
                </div>
              </div>
            @endforeach

          </div>

          <h3 class="text-bold text-center">Regional Coordinators</h3>

          <div class="row">
            @foreach($coordinators as $coordinator)
              <div class="col-lg-3 col-sm-6">
                <div class="single-committee-member">
                  <img src="{{ $coordinator->image }}" class="img-fluid" alt="Committee"/>
                  <h3> {{ $coordinator->name }} <span class="committee-deg">{{ $coordinator->location }}</span></h3>
                </div>
              </div>
            @endforeach

          </div>

        </div>
      </div>
    </div>
  </section>
  <!--== Committee Page Content End ==-->
@endsection
