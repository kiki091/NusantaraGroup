        @extends('nusantara.front.layout.main')
        @section('content')
            <div id="home" name="home">       
                <div id="bootstrap-touch-slider" class="carousel bs-slider fade  control-round indicators-line" data-ride="carousel" data-pause="hover" data-interval="5000" >

                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        @for($i=1;$i<=$count;$i++)
                        @if($i == 1)
                        <li data-target="#bootstrap-touch-slider" data-slide-to="{{ $i }}" class="active"></li>
                        @else
                        <li data-target="#bootstrap-touch-slider" data-slide-to="{{ $i }}"></li>
                        @endif
                        @endfor
                    </ol>

                    <!-- Wrapper For Slides -->
                    <div class="carousel-inner" role="listbox">
                        @if(isset($main_banners))
                            @foreach($main_banners as $key=> $slider)
                                <!-- Third Slide -->
                                @if($key == 0)
                                <div class="item active">
                                @else
                                <div class="item">
                                @endif
                                    <!-- Slide Background -->
                                    <img src="{{ $slider['images'] }}" alt="Bootstrap Touch Slider"  class="slide-image"/>
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

                </div> <!-- End  bootstrap-touch-slider Slider -->
                
            </div>
            @include('nusantara.front.include.main-section')

            <!-- ==== ABOUT ==== -->
            <div class="container" id="about" name="about" data-scrollreveal="enter top">
                <div class="row">
                <br>
                    <h2 class="centered">{{ strtoupper('Profil Perusahaan') }}</h2>
                    <hr>
                    
                    <div class="col-lg-6">
                        <p>
                        <span class="first-letter">
                            {!! substr($company_profile['description'],0, 1) !!}
                        </span>
                        {!! substr($company_profile['description'],1, 493) !!}
                        </div><!-- col-lg-6 -->
                    
                    <div class="col-lg-6">
                        <p>
                        <span class="first-letter">
                            {!! substr($company_profile['description'],494, 1) !!}
                        </span>
                            {!! substr($company_profile['description'],495, 455) !!}, 
                            <a href="{{ route('companyProfilePage') }}">Baca Selengkapnya</a>
                        </div><!-- col-lg-6 -->
                </div><!-- row -->
            </div><!-- container -->

            <!-- ==== SECTION DIVIDER1 -->
            <section class="section-divider textdivider divider1" data-scrollreveal="enter top">
                <div class="container">
                    @if(isset($services_category))
                        @foreach($services_category as $data)
                            @if($data['id'] == '2')
                                <h2>
                                    <a href="{{ route('categoryEvent',$data['slug']) }}">
                                        {{ strtoupper($data['name']) }}
                                    </a>
                                </h2>
                            @endif
                        @endforeach
                    @endif
                    <hr>
                    <p>Pastikan kendaraan anda senantiasa dalam keadaan prima dengan mengikuti tips2 perawatan.</p>
                    <div class="row group-landing-events-row">
                        @if(isset($services))
                            @foreach($services as $value)
                                @foreach($value as $key=> $item)
                                    @if($item['service_category_id'] == '2')
                                        <div class="col-md-6">
                                            <div class="group-landing-events-item">
                                                <div class="manic-image-container has-full-width image-loaded-version" style="overflow: hidden; position: relative; height: 250px;">
                                                    <img src="{{ $item['images'] }}" style="display: block; position: absolute; top: 0px; left: 0px; overflow: hidden; width: 100%;">
                                                </div>
                                                <h2>{{ strtoupper($item['title']) }}</h2>
                                                <p>{{ substr($item['side_description'],0, 100) }}</p>
                                                <a href="{{ route('detailEvent', $item['slug']) }}" class="arrow-cta">
                                                    Lihat Lebih Lanjut
                                                    <span class="icon icon-arrow-right-2" style="font-size: 14px;"></span>
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endforeach
                        @endif
                    </div>
                </div><!-- container -->
            </section><!-- section -->

            <!-- ==== SERVICES ==== -->
            <div class="container" id="services" name="services" data-scrollreveal="enter top">
                <br>
                <br>
                <div class="row">
                    <h2 class="centered">{{ strtoupper('Acara dan Program') }}</h2>
                    <hr>
                    <br>
                    <div class="col-md-12">
                    @if(isset($services))
                        @foreach($services as $value)
                            @foreach($value as $key=> $item)
                                @if($item['service_category_id'] == '1')
                                <div class="col-md-4">
                                    <div class="manic-image-container has-full-width image-loaded-version" style="overflow: hidden; position: relative; height: 296px;">
                                        <img src="{{ $item['images'] }}" style="display: block; position: absolute; top: 0px; left: 0px; overflow: hidden; height: auto;">
                                    </div>
                                    <h4> {{ strtoupper($item['title']) }} </h4>
                                    <p>
                                        {{ substr($item['side_description'],0,60) }} 
                                    </p>
                                    <p>
                                        <a style="color: #464646;" href="{{ route('detailEvent', $item['slug']) }}" class="arrow-cta">
                                            Lihat Lebih Lanjut
                                            <span class="icon icon-arrow-right-2" style="font-size: 14px;"></span>
                                        </a>
                                    </p>
                                    
                                </div>
                                @endif
                            @endforeach
                        @endforeach
                    @endif
                    </div><!-- col-lg -->
                </div><!-- row -->
            </div><!-- container -->

            <!-- ==== GREYWRAP ==== -->
            <div id="greywrap" style="padding-bottom: 3%;" data-scrollreveal="enter top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 centered">
                            <img class="img-responsive" src="{{ asset('images/db/awards/opener_trophies.png') }}" align="">
                        </div>
                        <div class="col-lg-4">
                            <h2>Awards & Accolades</h2>
                            <p>Success is the sum of small efforts, repeated day and the day out By Robert Collier</p>
                            <p><a href="{{ route('awardsPage') }}" class="btn btn-success">Lihat Lebih Lanjut</a></p>
                        </div>                  
                    </div><!-- row -->
                </div>
            </div><!-- greywrap -->
            <br/>
            <br/>

            <!-- <div class="container" style="margin-bottom: 5%">
                <div class="captions">
                    <div class="caption" name="c0">
                        <h2>Energias Renovables</h2>
                        <p><span class="first-letter">S</span>tunningly located on rocks amidst of the sparkling Indian Ocean, these two awe–inspiring spa villas are the pinnacle of our Bali luxury spa. Surrounded by the sea, each spa villa has been ingeniously designed </p>
                    </div>
                    <div class="caption" name="c1">
                        <h2>Energia Eolica</h2>
                        <p><span class="first-letter">S</span>tunningly located on rocks amidst of the sparkling Indian Ocean, these two awe–inspiring spa villas are the pinnacle of our Bali luxury spa. Surrounded by the sea, each spa villa has been ingeniously designed</p>
                    </div>
                    <div id="buttons">
                        <div id="left" value="left" onClick="show_previous()"></div>
                        <div id="rigth" value="rigth" onClick="show_next()"></div>
                    </div>
                </div>
                <div class="slider">
                    <div class="slide" name="0" style="background-image:url(/themes/front/carousel/images/eolic.jpg)"></div>
                    <div class="slide" name="1" style="background-image:url(/themes/front/carousel/images/eolic2.jpg)"></div>
                </div>
            </div> -->

            <!-- ==== PORTFOLIO ==== -->
            <div class="container" id="branch_office" name="branch_office">
                <div class="row">
                    <h2 class="centered">KANTOR CABANG</h2>
                    <h4 class="centered">
                        The greatest result in life usually attained by simple means 
                        and the exercise of ordinary qualities 
                        These may for the most part be summed in these two : Common sense and perseverance 
                        By Owen Feltham
                        </h4>
                    <hr/>
                    <br/>
                    @if(isset($branch_office))
                        @foreach($branch_office as $title)
                            @foreach($title as $key=> $value)
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">              
                                    <div class="hover ehover11">
                                        <img class="img-responsive" src="{{ $value['thumbnail'] or '' }}" alt="{{ $value['title'] or '' }}">
                                        <div class="overlay">
                                            <h2>
                                                <a href="{{ route('branchOfficeDetail', $value['slug']) }}">
                                                    {{ strtoupper($value['title']) }}
                                                </a>
                                            </h2>
                                        </div>              
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    @endif
                </div><!-- /row -->
            </div><!-- /container -->

        <!-- /.app -->
        <!-- *** BLOG HOMEPAGE END *** -->
        @endsection