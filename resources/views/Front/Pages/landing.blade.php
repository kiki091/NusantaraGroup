        @extends('Front.main')
        @section('content')
        <div id="home" name="home">       
            <!-- Slider -->
            <div id="slider">
                <div class="slides">
                    <!-- Looping Slider Images -->
                    @if(isset($main_banners))
                        @foreach($main_banners as $key=> $slider)
                            <div class="slider">
                                <div class="legend"></div>
                                <div class="content">
                                    <div class="content-txt">
                                        <h1>Lorem ipsum dolor</h1>
                                        <h2>Nam ultrices pellentesque facilisis. In semper tellus mollis nisl pulvinar vitae vulputate lorem consequat. Fusce odio tortor, pretium sit amet auctor ut, ultrices vel nibh.</h2>
                                    </div>
                                </div>
                                <div class="image">
                                    <img src="{{ $slider['images'] }} " class="img-responsive">
                                </div>
                            </div>
                        @endforeach
                    @endif 
                </div>
            </div>
            <!-- ==== GREYWRAP ==== -->
            <div id="greywrap" data-scrollreveal="enter top">
                <div class="row">
                    <div class="col-lg-4 callout">
                        <span class="icon icon-stack"></span>
                        <h2>Booking Services</h2>
                        {!! $landing_page['box_wrapper_left'] or '' !!}
                    </div><!-- col-lg-4 -->
                        
                    <div class="col-lg-4 callout">
                        <span class="icon icon-eye"></span>
                        <h2>Test Drive</h2>
                        {!! $landing_page['box_wrapper_center'] or '' !!}
                    </div><!-- col-lg-4 --> 
                    
                    <div class="col-lg-4 callout">
                        <span class="icon icon-heart"></span>
                        <h2>Harga Mobil</h2>
                        {!! $landing_page['box_wrapper_right'] or '' !!}
                    </div><!-- col-lg-4 --> 
                </div><!-- row -->
            </div><!-- greywrap -->

            <!-- ==== ABOUT ==== -->
            <div class="container" id="about" name="about" data-scrollreveal="enter top">
                <div class="row">
                <br>
                    <h1 class="centered">{{ strtoupper('Profil Perusahaan') }}</h1>
                    <hr>
                    
                    <div class="col-lg-6">
                        <p>
                        <span class="first-letter">
                            {{ substr($company_profile['description'],0, 1) }}
                        </span>
                        {{ substr($company_profile['description'],1, 489) }}
                        </div><!-- col-lg-6 -->
                    
                    <div class="col-lg-6">
                        <p>
                        <span class="first-letter">
                            {{ substr($company_profile['description'],490, 1) }}
                        </span>
                            {{ substr($company_profile['description'],491, 578) }}, 
                            <a href="{{ route('companyProfilePage') }}">see more</a>
                        </div><!-- col-lg-6 -->
                </div><!-- row -->
            </div><!-- container -->

            <!-- ==== SECTION DIVIDER1 -->
            <section class="section-divider textdivider divider1" data-scrollreveal="enter top">
                <div class="container">
                    <h1>DESIGN EXPAND BOUNDARIES</h1>
                    <hr>
                    <p>To achieve real change, we have to expand boundaries. Because the Wild West of what-could-be is unexplored but rife with opportunity.</p>
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
                                    <h4> {{ strtoupper($item['title']) }} </h4>
                                    <p>
                                        {{ $item['side_description'] }} 
                                        <a href="{{ route('detailEvent', $item['slug']) }}">See more .. </a>
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
                            <h2>Awards!</h2>
                            <p>Success is the sum of small efforts, repeated day and the day out By Robert Collier</p>
                            <p><a href="{{ route('awardsPage') }}" class="btn btn-success">See more</a></p>
                        </div>                  
                    </div><!-- row -->
                </div>
            </div><!-- greywrap -->

            <!-- ==== SECTION DIVIDER3 -->
            <section class="section-divider textdivider divider3" data-scrollreveal="enter top">
                <div class="container">
                    @if(isset($services_category))
                        @foreach($services_category as $data)
                            @if($data['id'] == '2')
                                <h1>
                                <a href="{{ route('categoryEvent',$data['slug']) }}">
                                    {{ strtoupper($data['name']) }}</h1>
                                </a>
                            @endif
                        @endforeach
                    @endif
                    <hr>
                    <p>Pastikan kendaraan anda senantiasa dalam keadaan prima dengan mengikuti tips2 perawatan.</p>
                    
                </div><!-- container -->
            </section><!-- section -->

            <!-- ==== PORTFOLIO ==== -->
            <div class="container" id="portfolio" name="portfolio">
                <br>
                <div class="row">
                    <br>
                    <h1 class="centered">KANTOR CABANG</h1>
                    <hr>
                    <br>
                    <br>
                </div><!-- /row -->
                <div class="container">
                    <div class="row">   
                        <!-- PORTFOLIO IMAGE 1 -->
                        @if(isset($branch_office))
                        @foreach($branch_office as $title)
                            @foreach($title as $key=> $value)
                            <div class="col-md-4" data-scrollreveal="enter top after 0.5s">
                                <div class="grid mask">
                                    <figure>
                                        <img class="img-responsive" style="height: 250px;" src="{{ $value['thumbnail'] or '' }}" alt="{{ $value['title'] or '' }}">
                                        <figcaption>
                                            <h5>{{ strtoupper($value['title']) }}</h5>
                                            <a href="{{ route('branchOfficeDetail', $value['slug']) }}" class="btn btn-primary btn-lg">See more</a>
                                        </figcaption><!-- /figcaption -->
                                    </figure><!-- /figure -->
                                </div><!-- /grid-mask -->
                            </div><!-- /col -->
                            @endforeach
                        @endforeach
                        @endif
                    </div><!-- /row -->
                    <br>
                    <br>
                </div><!-- /row -->
            </div><!-- /container -->

            <!-- ==== SECTION DIVIDER6 ==== -->
            <section class="section-divider textdividerFooter divider6" id="map"></section><!-- section -->

        </div>
        <!-- /.app -->
        <!-- *** BLOG HOMEPAGE END *** -->
        @endsection