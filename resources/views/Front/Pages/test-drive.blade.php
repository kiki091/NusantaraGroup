@extends('Front.main')
    @section('content')

        <div id="bootstrap-touch-slider" class="carousel bs-slider fade  control-round indicators-line" data-ride="carousel" data-pause="hover" data-interval="5000" >

            <!-- Wrapper For Slides -->
            <div class="carousel-inner" role="listbox">
                    <!-- Third Slide -->
                    <div class="item active">
                        <!-- Slide Background -->
                        <img src="{{ asset('images/db/promotion/booking_test_drive/summer-test-drive-banner.png') }}" alt="Awards"  class="slide-image"/>
                        <div class="bs-slider-overlay"></div>

                        <div class="container">
                            <div class="row">
                                <!-- Slide Text Layer -->
                                <div class="slide-text slide_style_left">
                                    <h1 data-animation="animated zoomInRight">Nusantara Group</h1>
                                    <p data-animation="animated fadeInLeft">Booking Seervice</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End of Slide -->
            </div><!-- End of Wrapper For Slides -->

        </div>
        <!-- ==== ABOUT ==== -->
        <div class="container" id="booking-test-drive" name="booking-test-drive" data-scrollreveal="enter top after 0.5s">
            <div class="row white">
                <br/>
                <div class="col-md-12">
                    <h1 class="centered medium-version">Booking Test Drive</h1>
                    <h2 class="centered">Jadwalkan kehadiran di showroom kami untuk mendapatkan test kendaraan idaman anda gratis.</h2>
                    <hr>
                    <br/>
                    <form method="POST" v-on:submit.prevent="storeBookingTestDrive">

                        <div class="col-sm-6 col-xs-12 text-justify">
                            <div class="form-group">
                                <label>Jenis Kendaraan</label>
                                <input v-model="models.jenis_kendaraan" type="text" name="jenis_kendaraan" class="form-control" placeholder="Masukan Jenis Kendaraan">
                                <div class="form--error--message" id="form--error--message--jenis_kendaraan"></div>
                            </div>
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input v-model="models.nama_lengkap" type="text" name="nama_lengkap" class="form-control" placeholder="Masukan Nama Lengkap Anda">
                                <div class="form--error--message" id="form--error--message--nama_lengkap"></div>
                            </div>
                            <div class="form-group">
                                <label>Nomer Telepon</label>
                                <input v-model="models.no_telpon" type="text" name="no_telpon" class="form-control" placeholder="Masukan Nomer Telepon Anda">
                                <div class="form--error--message" id="form--error--message--no_telpon"></div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xs-12 text-justify">
                            <div class="form-group">
                                <label>Email</label>
                                <input v-model="models.email" type="email" name="email" class="form-control" placeholder="Masukan Email Anda">
                                <div class="form--error--message" id="form--error--message--email"></div>
                            </div>

                            <div class="form-group">
                                <label>Tanggal Test Drive</label>
                                <input v-model="models.tanggal_booking" type="date" name="tanggal_booking" class="form-control" placeholder="Pilih Tanggal Service">
                                <div class="form--error--message" id="form--error--message--tanggal_booking"></div>
                            </div>

                            <div class="form-group">
                                <label>Permintaan / Request</label>
                                <textarea v-model="models.keterangan" name="keterangan" class="form-control" placeholder="Isikan Keterangan Untuk Detail Service Kendaraan"></textarea>
                                <div class="form--error--message" id="form--error--message--keterangan"></div>
                            </div>
                            <input type="hidden" id="token" name="token" value="{{ csrf_token() }}">
                        </div>

                        <div class="right-cta-container visible-md visible-lg">
                            <input type="submit" value="Submit" class="square-cta large-version light-blue-black-version">
                        </div>

                    </form>
                </div>
            </div><!-- row -->

            <div class="row">
                <div class="col-xs-6">
                    <table class="table table-striped">
                        <thead>
                            <th class="centered">Our Address</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="centered">
                                    PT. Nusantara Batavia Motor
                                    <br/>
                                    Jl. Suryopranoto No 77-79, Jakarta Pusat
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <section class="section-divider textdividerFooter divider6" id="map"></section>
                </div>
                <div class="col-xs-6">
                </div>
        </div><!-- container -->
        @include('Front.partials.maps-landing')
    @endsection