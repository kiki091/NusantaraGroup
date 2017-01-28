@extends('Front.main')
    @section('content')
        <div id="slider">
            <div class="slides">
                <!-- Looping Slider Images -->
                @if(isset($service_detail['slider']))
                    @foreach($service_detail['slider'] as $key=> $slider)
                        <div class="slider">
                            <div class="content">
                                        <div class="content-txt">
                                            <h1>Lorem ipsum dolor</h1>
                                        </div>
                                    </div>
                            <div class="image">
                                <img src="{{ $slider }} " style="height: 500px" class="img-responsive">
                            </div>
                        </div>
                    @endforeach
                @endif 
            </div>
        </div>
        <!-- ==== ABOUT ==== -->
        <div class="container" id="about" name="about">
            <div class="row white">
                <div class="col-md-12" data-scrollreveal="enter top after 0.5s">
                    <br>
                    <h1 class="centered">{{ strtoupper($service_detail['title']) }}</h1>
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