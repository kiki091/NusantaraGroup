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
                    <h1 class="page-header centered" data-scrollreveal="enter top after 0.5s">
                        TEMUKAN MOBIL IMPIAN ANDA
                    </h1>
                </div>

            </div>
            @if(isset($promotion_category) && !empty($promotion_category))
                <div class="row" data-scrollreveal="enter top after 0.5s">
                    @foreach($promotion_category as $key=> $value)

                        <div class="col-md-6">
                            <a href="#">
                                <img id="img-content" class="img-responsive" src="{{ $value['thumbnail_category'] }}" alt="{{ $value['category_name'] }}">
                            </a>
                            <div class="col-lg-12">
                                <h3>{{ $value['category_name']  or '' }}</h3>
                                {!! $value['introduction']  or '' !!}
                                <a href="{{ route('promotionCategoryList', $value['category_slug']) }}" class="arrow-cta">
                                    Lihat Lebih Lanjut
                                    <span class="icon icon-arrow-right-2" style="font-size: 12px;"></span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
        <!-- /.container -->
    @endsection