@extends('nusantara.front.layout.main')
    @section('content')

        <div id="bootstrap-touch-slider" class="carousel bs-slider fade  control-round indicators-line" data-ride="carousel" data-pause="hover" data-interval="5000" >

            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#bootstrap-touch-slider" data-slide-to="0" class="active"></li>
                <li data-target="#bootstrap-touch-slider" data-slide-to="1"></li>
            </ol>

            <!-- Wrapper For Slides -->
            <div class="carousel-inner" role="listbox">
                @if(isset($service_detail['slider']))
                    @foreach($service_detail['slider'] as $key=> $slider)
                        <!-- Third Slide -->
                        @if($key=='0')
                            <div class="item active">
                        @else
                            <div class="item">
                        @endif
                            <!-- Slide Background -->
                            <img src="{{ $slider }}" alt="Bootstrap Touch Slider"  class="slide-image"/>
                            <div class="bs-slider-overlay"></div>

                            <div class="container">
                                <div class="row">
                                     <!-- Slide Text Layer -->
                                    <div class="slide-text slide_style_left">
                                        <h1 data-animation="animated zoomInRight">Nusantara Group</h1>
                                        <p data-animation="animated fadeInLeft">There no happiness except in the realization that we have accomplished something By Henry Ford</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End of Slide -->
                    @endforeach
                @endif 
            </div><!-- End of Wrapper For Slides -->

            <!-- Left Control -->
            <a class="left carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="prev">
                <span class="fa fa-angle-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>

            <!-- Right Control -->
            <a class="right carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="next">
                <span class="fa fa-angle-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>

        </div>
        <!-- End  bootstrap-touch-slider Slider -->
        <!-- ==== ABOUT ==== -->
        <div class="container" id="about" name="about">
            <div class="row white">
                <div class="col-md-12" data-scrollreveal="enter top after 0.5s">
                    <br>
                    <h1 class="centered">{{ strtoupper($service_detail['title']) }}</h1>
                    <p>
                        <h3 class="centered"> {{ $service_detail['introduction'] }} </h3>
                    </p>
                    <hr>
                    
                    <div class="col-lg-6 text-justify">
                        <p>
                            {!! $service_detail['side_description'] !!}
                        </p>
                        <p>
                        <img src="{{ $service_detail['images'] }}" class="img-responsive">
                        </p>
                    </div><!-- col-lg-6 -->
                    <div class="col-lg-6 text-justify">
                        <p>
                            <span class="first-letter">
                                {!! substr($service_detail['description'],0,1) !!}
                            </span>
                            {!! substr($service_detail['description'],1) !!}
                        </p>
                    </div>
                </div>
            </div><!-- row -->
        </div><!-- container -->
        <!-- ==== GREYWRAP ==== -->
        
 	@endsection