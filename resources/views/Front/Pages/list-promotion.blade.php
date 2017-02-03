@extends('Front.main')
    @section('content')

        <div id="bootstrap-touch-slider" class="carousel bs-slider fade  control-round indicators-line" data-ride="carousel" data-pause="hover" data-interval="5000" >

            <!-- Wrapper For Slides -->
            <div class="carousel-inner" role="listbox">
                    <!-- Third Slide -->
                    <div class="item active">
                        <!-- Slide Background -->
                        <img src="{{ asset('images/db/promotion/promotion/banner/promotional-banner-template.jpg') }}" alt="Awards"  class="slide-image"/>
                        <div class="bs-slider-overlay"></div>

                        <div class="container">
                            <div class="row">
                                <!-- Slide Text Layer -->
                                <div class="slide-text slide_style_left">
                                    <h1 data-animation="animated zoomInRight">Nusantara Group</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End of Slide -->
            </div><!-- End of Wrapper For Slides -->

        </div>
        
        <div class="container">
        
            <div class="row">

                <div class="col-lg-12">
                    <h1 class="page-header centered">
                        Temukan Mobil Impian Anda
                    </h1>
                </div>

            </div>
            @if(isset($promotion) && !empty($promotion))
                @foreach($promotion as $key=> $value)

                    <div class="row">

                        <div class="col-lg-7 col-md-7">
                            <a href="#">
                                <img id="img-content" class="img-responsive" src="{{ $value['thumbnail'] }}" alt="{{ $value['title'] }}">
                            </a>
                        </div>

                        <div class="col-lg-5 col-md-5">
                            <h3>{{ $value['title']  or '' }}</h3>
                            @foreach($value['side_description'] as $key=> $item)
                                {!! $item or '' !!}
                            @endforeach
                            <a href="{{ route('promotionDetail', $value['slug']) }}" class="arrow-cta">
                                Lihat Lebih Lanjut
                                <span class="icon icon-arrow-right-2" style="font-size: 14px;"></span>
                            </a>
                        </div>
                    </div>
                    <br/>
                    <br/>

                @endforeach
            @endif
        </div>
        <!-- /.container -->
    @endsection