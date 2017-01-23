@extends('Front.main')
    @section('content')
        <div id="slider">
                    <div class="image">
                        <img src="{{ asset('images/db/awards/awards-banner.jpg') }} " class="img-responsive">
                    </div>
        </div>
        <!-- ==== GREYWRAP ==== -->
        <div id="greywrap" data-scrollreveal="enter top">
            <div class="row">
                <div class="col-lg-4 callout">
                    <span class="icon icon-stack"></span>
                    <h2>Booking Services</h2>
                </div><!-- col-lg-4 -->
                        
                 <div class="col-lg-4 callout">
                    <span class="icon icon-eye"></span>
                    <h2>Test Drive</h2>
                </div><!-- col-lg-4 --> 
                    
                <div class="col-lg-4 callout">
                    <span class="icon icon-heart"></span>
                    <h2>Harga Mobil</h2>
                </div><!-- col-lg-4 --> 
            </div><!-- row -->
        </div><!-- greywrap -->
        <!-- ==== ABOUT ==== -->
        <div class="container" id="about" name="about">
            <div class="row white">
                <div class="col-md-12" data-scrollreveal="enter top after 0.5s">
                    <br>
                    <h1 class="centered">PENGHARGAAN </h1>
                    <hr>
                    @foreach($awards as $office_name)
                        @foreach($office_name as $key=> $item)
                        <div class="row">
                            <h3 class="centered"> {{ $item['office_name'] or '' }} </h3>
                            <div class="col-lg-6">
                                <p>
                                    <img src="{{ $item['thumbnail'] }}" class="img-responsive">
                                </p>
                            </div>

                            <div class="col-lg-6">
                                
                                <p>
                                    <table class="table table-striped">
                                        @foreach($item['awards_description'] as $key=> $value)
                                             <tr>
                                                <td>{{ $value }}</td>
                                            </tr>
                                        @endforeach
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
        <!-- ==== GREYWRAP ==== -->
        <div id="greywrap" data-scrollreveal="enter top">
            <div class="row">
                <div class="col-lg-6" style="padding-top: 3%;">
                    <span class="icon icon-stack"></span>
                    <h2>Lorem Ipsum</h2>
                </div>
                <div class="col-lg-6">
                    <blockquote>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
                    </blockquote>
                </div><!-- col-lg-4 -->
            </div><!-- row -->
        </div><!-- greywrap -->
 	@endsection