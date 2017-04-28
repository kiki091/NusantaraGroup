@extends('nusantara.front.layout.main')
    @section('content')
        <div id="bootstrap-touch-slider" class="carousel bs-slider fade  control-round indicators-line" data-ride="carousel" data-pause="hover" data-interval="5000" >

            <!-- Wrapper For Slides -->
            <div class="carousel-inner" role="listbox">
                    <!-- Third Slide -->
                    <div class="item active">
                        <!-- Slide Background -->
                        <img src="{{ asset('images/db/awards/awards-banner.jpg') }}" alt="Awards"  class="slide-image"/>
                        <div class="bs-slider-overlay"></div>

                        <div class="container">
                            <div class="row">
                                <!-- Slide Text Layer -->
                                <div class="slide-text slide_style_left">
                                    <h1 data-animation="animated zoomInRight">Nusantara Group</h1>
                                    <p data-animation="animated fadeInLeft">PENGHARGAAN</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End of Slide -->
            </div><!-- End of Wrapper For Slides -->

        </div>
        <!-- ==== ABOUT ==== -->
        <div class="container" id="about" name="about">
            <div class="row white">
                <div class="col-md-12" data-scrollreveal="enter top after 0.5s">
                    <br>
                    <h1 class="centered">PENGHARGAAN </h1>
                    <h2 class="centered">
                        NUSANTARA GROUP telah memenangkan beberapa pengahargaan prestigius dari instansi yang memiliki reputasi terbaik di bidangnya.
                    </h2>
                    <hr>
                    @foreach($awards as $office_name)
                        @foreach($office_name as $key=> $item)
                        <div class="row">
                            <div class="col-lg-4 centered">
                                <p>
                                    <img class="img-responsive images-awards"  src="{{ $item['thumbnail'] }}" alt="{{ $item['office_name'] or '' }}">
                                </p>
                            </div>

                            <div class="col-lg-8">
                                
                                <p>
                                    <table class="table table-striped table-awards">
                                        <thead>
                                            <th class="centered">{{ $item['office_name'] or '' }}</th>
                                        </thead>
                                        <tbody>
                                            @foreach($item['awards_description'] as $key=> $value)
                                                <tr>
                                                    <td>{{ $value }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </p>
                            </div>
                            <!-- col-lg-6 -->
                        </div>
                        @endforeach
                    @endforeach
                </div>
            </div><!-- row -->
        </div><!-- container -->
 	@endsection