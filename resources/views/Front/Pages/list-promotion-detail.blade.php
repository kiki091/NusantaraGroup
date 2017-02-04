@extends('Front.main')
    @section('content')

        <div id="bootstrap-touch-slider" class="carousel bs-slider fade  control-round indicators-line" data-ride="carousel" data-pause="hover" data-interval="5000" >

            <!-- Wrapper For Slides -->
            <div class="carousel-inner" role="listbox">
                    <!-- Third Slide -->
                    <div class="item active">
                        <!-- Slide Background -->
                        <img src="{{ $promotion_detail['detail_images']['banner_image'] }}" alt="Promotion Detail {{ strtoupper($promotion_detail['title']) }}"  class="slide-image"/>
                        <div class="bs-slider-overlay"></div>

                        <div class="container">
                            <div class="row">
                                <!-- Slide Text Layer -->
                                <div class="slide-text slide_style_left">
                                    <h1 data-animation="animated zoomInRight">Nusantara Group</h1>
                                    <p data-animation="animated fadeInLeft">{{ strtoupper($promotion_detail['title']) }}</p>
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
                        {{ strtoupper($promotion_detail['title']) }}
                    </h1>
                </div>

            </div>
            <div class="row" data-scrollreveal="enter top after 0.5s">
                <div class="col-lg-8">
                    <img id="img-content" class="img-responsive img-rounded" src="{{ $promotion_detail['thumbnail'] }}">
                    <!-- take out img-rounded if you don't want the rounded corners on the image -->
                </div>
                <div class="col-lg-4">
                    {!! $promotion_detail['content']['introduction'] !!}
                    {!! $promotion_detail['content']['description'] !!}
                </div>
            </div>

            <hr>

            <div class="row" data-scrollreveal="enter top after 0.5s">
                <div class="col-lg-12">
                    <div class="well text-center">
                        <h3 class="headerClass">
                            <span class="header-rule"></span>accessories<span class="header-rule"></span>
                        </h3>
                        {!! $promotion_detail['content']['accesories_description'] !!}
                    </div>
                </div>
            </div>

            <div class="row" data-scrollreveal="enter top after 0.5s">
                <div class="col-lg-4">
                    <h3 class="headerClass">
                        <span class="header-rule"></span>- interior design -<span class="header-rule"></span>
                    </h3>
                    <br/>
                    <img id="img-content" class="img-responsive img-rounded" src="{{ $promotion_detail['detail_images']['interior_image'] }}">
                    {!! $promotion_detail['content']['interior_description'] !!}
                </div>
                <div class="col-lg-4">
                    <h3 class="headerClass">
                        <span class="header-rule"></span>- exterior design -<span class="header-rule"></span>
                    </h3>
                    <br/>
                    <img id="img-content" class="img-responsive img-rounded" src="{{ $promotion_detail['detail_images']['exterior_image'] }}">
                    {!! $promotion_detail['content']['exterior_description'] !!}
                </div>
                <div class="col-lg-4">
                    <h3 class="headerClass">
                        <span class="header-rule"></span>- safety -<span class="header-rule"></span>
                    </h3>
                    <br/>
                    <img id="img-content" class="img-responsive img-rounded" src="{{ $promotion_detail['detail_images']['safety_image'] }}">
                    {!! $promotion_detail['content']['safety_description'] !!}
                </div>
            </div>
            @if(isset($promotion_detail['gallery']))
            <div class="row" data-scrollreveal="enter top after 0.5s">
                <div class="col-lg-12">
                    <h3 class="headerClass">
                        <span class="header-rule"></span>- gallery -<span class="header-rule"></span>
                    </h3>
                    <hr/>
                    <br/>
                    @foreach($promotion_detail['gallery'] as $key=> $image)
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                        <div class="hover ehover11">
                            <img id="img-content" class="img-responsive img-rounded" src="{{ $image['filename'] }}">
                        </div>
                        <div class="overlay"></div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            @if(isset($promotion_detail['detail']))
            <div class="row" data-scrollreveal="enter top after 0.5s">
                <div class="col-lg-12">
                        <h3 class="headerClass">
                            <span class="header-rule"></span>- equipment -<span class="header-rule"></span>
                        </h3>

                        <hr/>
                        <br/>
                        <div class="col-lg-12">
                            {!! $promotion_detail['detail']['equipment'] !!}
                        </div>
                        <div class="col-lg-6">
                            {!! $promotion_detail['detail']['equipment_interior'] !!}
                        </div>
                        <div class="col-lg-6">
                            {!! $promotion_detail['detail']['equipment_exterior'] !!}
                        </div>
                </div>
            </div>
            @endif

            @if(isset($promotion_detail['detail']))
            <div class="row" data-scrollreveal="enter top after 0.5s">
                <div class="col-lg-12">
                    <h3 class="headerClass">
                        <span class="header-rule"></span>- information -<span class="header-rule"></span>
                    </h3>
                    <hr/>
                    <br/>
                    {!! $promotion_detail['detail']['information'] !!}
                </div>
            </div>
            @endif

        </div>
        <!-- /.container -->

    @endsection