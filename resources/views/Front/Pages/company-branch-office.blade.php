@extends('Front.main')
    @section('content')

        <div id="bootstrap-touch-slider" class="carousel bs-slider fade  control-round indicators-line" data-ride="carousel" data-pause="hover" data-interval="5000" >

            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#bootstrap-touch-slider" data-slide-to="0" class="active"></li>
                <li data-target="#bootstrap-touch-slider" data-slide-to="1"></li>
            </ol>

            <!-- Wrapper For Slides -->
            <div class="carousel-inner" role="listbox">
                @if(isset($branch_office['banner']))
                    @foreach($branch_office['banner'] as $key=> $slider)
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
                                        <p data-animation="animated fadeInLeft">{{ strtoupper($branch_office['title']) }}</p>
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
        <!-- ==== ABOUT ==== -->
        <div class="container" id="about" name="about">
            <div class="row white">
                <div class="col-md-12" data-scrollreveal="enter top after 0.5s">
                    <br>
                    <h1 class="centered">KANTOR CABANG {{ strtoupper($branch_office['title']) }}</h1>
                    <hr>
                    
                    <div class="col-lg-6">
                        <p>
                            <table class="table table-striped">
                                <thead>
                                    <th>Office</th><th>Address</th>
                                </thead>
                                <tbody>
                                    @foreach($branch_office['translations'] as $key=> $value)
                                         <tr>
                                            <td>{{ $value['title_description'] }}</td>
                                            <td>{{ $value['address'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </p>
                    </div><!-- col-lg-6 -->
                    <div class="col-lg-6">
                        <p>
                            <span class="first-letter">
                                {{ substr($branch_office['description'],0,1) }}
                            </span>
                            {{ substr($branch_office['description'],1) }}
                        </p>
                        <!-- ==== MAPS ==== -->
                        <section class="section-divider textdividerFooter divider6" id="map-office"></section>
                    </div>
                </div>
            </div><!-- row -->
        </div><!-- container -->
        <script type="text/javascript">

            // Put all locations into array
            var markers = [
            @foreach ($branch_office['translations'] as $key=> $location)
                ["{{ $location['title_description'] }}", "{{ $location['latitude'] }}", "{{ $location['longitude'] }}" ], 
            @endforeach
            ];
            //alert(this.markers);

        </script>
        @include('Front.partials.maps-branch-office')
        
 	@endsection