@extends('nusantara.front.layout.main')
    @section('content')

        <div id="bootstrap-touch-slider" class="carousel bs-slider fade  control-round indicators-line" data-ride="carousel" data-pause="hover" data-interval="5000" >

            <!-- Wrapper For Slides -->
            <div class="carousel-inner" role="listbox">
                @if(isset($company_profile['images']))
                    <!-- Third Slide -->
                    <div class="item active">
                        <!-- Slide Background -->
                        <img src="{{$company_profile['images']}}" alt="{{ $company_profile['title'] }}"  class="slide-image"/>
                        <div class="bs-slider-overlay"></div>

                        <div class="container">
                            <div class="row">
                                <!-- Slide Text Layer -->
                                <div class="slide-text slide_style_left">
                                    <h1 data-animation="animated zoomInRight">Nusantara Group</h1>
                                    <p data-animation="animated fadeInLeft">{{ strtoupper($company_profile['title']) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End of Slide -->
                @endif 
            </div><!-- End of Wrapper For Slides -->

        </div>
        <!-- ==== ABOUT ==== -->
        <div class="container" id="about" name="about" data-scrollreveal="enter top after 0.5s">
            <div class="row white">
                <br/>
                <div class="col-md-12">
                    <h1 class="centered medium-version">{{ $company_profile['title'] }}</h1>
                    <h2 class="centered"> {{ $company_profile['introduction'] }} </h2>
                    <hr>
                    
                    <div class="col-sm-6 col-xs-12 text-justify">
                        <p>
                            <span class="first-letter">
                                {!! substr($company_profile['side_description'],0,1) !!}
                            </span>
                            {!! substr($company_profile['side_description'],1) !!}
                        </p>
                        <p>
                            <table class="table table-striped">
                                <thead>
                                    <th class="centered">Our Address</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="centered">
                                        PT. Nusantara Batavia Motor
                                        <br/>
                                        Jl. Suryopranoto No 77-79, Jakarta Pusat
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <section class="section-divider textdividerFooter divider6" id="map"></section>
                        </p>
                    </div><!-- col-lg-6 -->
                    <div class="col-sm-6 col-xs-12 text-justify">
                        <p>
                            <span class="first-letter">
                                {!! substr($company_profile['description'],0,1) !!}
                            </span>
                            {!! substr($company_profile['description'],1) !!}
                        </p>
                    </div>
                </div>
            </div><!-- row -->
        </div><!-- container -->
        @include('nusantara.front.partials.maps-landing')
    @endsection