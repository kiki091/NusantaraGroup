@extends('Front.main')
    @section('content')
        <div id="slider">
            <div class="slides">
                <!-- Looping Slider Images -->
                @if(isset($branch_office['banner']))
                    @foreach($branch_office['banner'] as $key=> $slider)
                        <div class="slider">
                            <div class="image">
                                <img src="{{ $slider }} " class="img-responsive">
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
                    <h1 class="centered">KANTOR CABANG {{ strtoupper($branch_office['title']) }}</h1>
                    <hr>
                    
                    <div class="col-lg-6">
                        <p>
                            <table class="table table-striped">
                                @foreach($branch_office['translations'] as $key=> $value)
                                     <tr>
                                        <td>{{ $value['title_description'] }}</td>
                                        <td>{{ $value['address'] }}</td>
                                    </tr>
                                @endforeach
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
                    </div>
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