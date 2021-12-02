@extends('layouts.app')
@section('title','Latest Events')
@section('content')
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{}}</li>
        </ol>
    </nav>
    <!-- Heading -->
    <div class="container">
        <div class="heading-about">
            <div class="text-center">
                <h2>Latest Events</h2>
                <div class="small-line">

                </div>
            </div>
        </div>
    </div>

    <!-- Tabular format of meeting -->
    <div class="tabsection">
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="container py-5">
                    <!-- DEMO 1 -->
                    <div class="py-5">
                        <div class="row">
                            <!-- DEMO 1 Item-->
                            <div class="col-lg-6 mb-3 mb-lg-0">
                                <a href="/Downloads/SpinalCordInjuryFinal.pdf" target="_blank">
                                    <div class="hover hover-1 text-white rounded"><img src="images/Events/assn-sci.png" alt="">
                                        <div class="hover-overlay"></div>
                                        <div class="hover-1-content px-5 py-4">
                                            <h3 class="hover-1-title text-uppercase font-weight-bold mb-0"> <span class="font-weight-light">Spinal</span>Cord Injury(SCI):</h3>
                                            <p class="hover-1-description font-weight-light mb-0">Socio-ecinomic impact,prevention advocay & research avenues</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <br/>
@endsection
