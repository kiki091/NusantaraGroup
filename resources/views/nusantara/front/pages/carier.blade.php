@extends('nusantara.front.layout.main')
    @section('content')

        <div id="bootstrap-touch-slider" class="carousel bs-slider fade  control-round indicators-line" data-ride="carousel" data-pause="hover" data-interval="5000" >

            <!-- Wrapper For Slides -->
            <div class="carousel-inner" role="listbox">
                    <!-- Third Slide -->
                    <div class="item active">
                        <!-- Slide Background -->
                        <img src="{{ asset('images/db/carier/banner-career.jpg') }}" alt="Karir Nusantara Group"  class="slide-image"/>
                        <div class="bs-slider-overlay"></div>

                        <div class="container">
                            <div class="row">
                                <!-- Slide Text Layer -->
                                <div class="slide-text slide_style_left">
                                    <h1 data-animation="animated zoomInRight">Nusantara Group</h1>
                                    <p data-animation="animated fadeInLeft">Karir</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End of Slide -->
            </div><!-- End of Wrapper For Slides -->

        </div>
        
        <div class="container">
        
            <div class="row">
                <div class="col-md-12">
                    <h2 class="centered">KARIR</h2>
                    <h4 class="centered">
                        To be able under all circumstances to practice five things are gravity,generosity of soul, sincerity, earnestness, and kindness By Confucious
                    </h4>
                    <hr/>
                    <div class="col-md-6">
                        <p>
                            <span class="first-letter">N</span>
                            usantara group adalah sebuah perusahaan yg dimiliki secara private dan mainly bergerak dibidang otomotif. Kami terus menerus mengembangkan cabang-cabang kami  ke seluruh pelosok Indonesia termasuk Kalimantan, Sumatera dan Jawa. Beroperasi lebih dari 25 cabang dan mempekerjakan lebih dari 1000 karyawan.
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p>
                            <span class="first-letter">K</span>ami mengundang seluruh professional untuk dapat bersama-sama mengembangkan karir, kualitas hidup, berpikir lebih terbuka dan tidak lupa mengesampingkan kerja keras. Kami menyadari bahwa karyawan adalah suatu asset yang berharga bagi perusahaan. Maka dari itu kami mengharapkan kerja sama dari kedua belah pihak dan komunikasi dua arah yang akan menghasilkan sebuah kesuksesan.
                        </p>
                        <p>
                            Silakan melihat lowongan yang tersedia dibawah ini dan jika tidak ada lowongan yang tersedia atau yang tidak sesuai dengan harapan anda, mohon dapat mengisi formulir yang telah disediakan.
                        </p>
                    </div>
                    <br/>
                    <table class="table table-striped">
                        <thead>
                            @foreach($carier as $key=> $title)
                            
                            <th> {{ $key }} </th>
                            @foreach($title as $key=> $content)
                            <tr>
                            <td>{{ $content['job_title']}}</td>
                            </tr>
                            @endforeach
                            @endforeach
                        </thead>
                        <tbody>
                            <tr>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <!-- /.container -->
    @endsection