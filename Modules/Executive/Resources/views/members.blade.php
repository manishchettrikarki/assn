@extends('layouts.app')
@section('title','Member Directory')
@section('content')

  <!--== Directory Page Content Start ==-->
  <section id="page-content-wrap">
    <div class="directory-page-content-warp section-padding">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <div class="directory-text-wrap">
              <h2><strong class="funfact-count">Members Directory</strong>  </h2>


              <div class="directory-table table-responsive">
                <table class="table table-bordered">
                  <thead>
                  <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Hospital</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($members as $member)
                  <tr>
                    <td><img src="{{ $member->image }}" alt="table">{{ $member->name }}</td>
                    <td>{{ $member->email }}</td>
                    <td>{{ $member->hospital }}</td>
                  </tr>
                  @endforeach

                  </tbody>
                </table>
              </div>
              <p class="show-memeber text-right">

              </p>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <div class="pagination-wrap text-center">
              <nav>
                <ul class="pagination">

                {{ $members->links() }}
{{--                  <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-left"></i></a></li>--}}
{{--                  <li class="page-item active"><a class="page-link" href="#">1</a></li>--}}
{{--                  <li class="page-item"><a class="page-link" href="#">2</a></li>--}}
{{--                  <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
{{--                  <li class="page-item"><a class="page-link" href="#">...</a></li>--}}
{{--                  <li class="page-item"><a class="page-link" href="#">50</a></li>--}}
{{--                  <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-right"></i></a></li>--}}
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--== Directory Page Content End ==-->
  @endsection
