@extends('nusantara.front.layout.main')
    @section('content')

        <div id="bootstrap-touch-slider" class="carousel bs-slider fade  control-round indicators-line" data-ride="carousel" data-pause="hover" data-interval="5000" >

            <!-- Wrapper For Slides -->
            <div class="carousel-inner" role="listbox">
                    <!-- Third Slide -->
                    <div class="item active">
                        <!-- Slide Background -->
                        <img src="{{ asset('images/db/promotion/booking_services/fast-lane-booking-service.jpg') }}" alt="Awards"  class="slide-image"/>
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
        <div class="container" id="booking-service" name="booking-service" data-scrollreveal="enter top after 0.5s">
            <div class="row white">
                <br/>
                <div class="col-md-12">
                    <h1 class="centered medium-version">Booking Service</h1>
                    <h2 class="centered">Nikmati pelayanan perjanjian yang mudah dan efisien secara online</h2>
                    <hr>
                    <br/>
                    <form method="POST" v-on:submit.prevent="storeBookingServices">

                        <div class="col-sm-6 col-xs-12 text-justify">
                            <div class="form-group">
                                <label>Lokasi Service</label>
                                <select name="branch_office_id" class="form-control" v-model="models.branch_office_id">
                                    <option value="">Pilih Tempat / Astra Langganan Anda</option>
                                    <option v-for="office in responseData.branch_office" value="@{{ office.id }}">@{{ office.title }}</option>
                                </select>
                                <div class="form--error--message" id="form--error--message--branch_office_id"></div>
                            </div>
                            <div class="form-group">
                                <label>Nomer Kendaraan</label>
                                <input v-model="models.no_kendaraan" type="text" name="no_kendaraan" class="form-control" placeholder="Masukan Nomer Kendaraan Anda">
                                <div class="form--error--message" id="form--error--message--no_kendaraan"></div>
                            </div>
                        </div>
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
                        </div>

                        <div class="col-sm-6 col-xs-12 text-justify">
                            <div class="form-group">
                                <label>Nomer Telepon</label>
                                <input v-model="models.no_telpon" type="text" name="no_telpon" class="form-control" placeholder="Masukan Nomer Telepon Anda">
                                <div class="form--error--message" id="form--error--message--no_telpon"></div>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input v-model="models.email" type="email" name="email" class="form-control" placeholder="Masukan Email Anda">
                                <div class="form--error--message" id="form--error--message--email"></div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xs-12 text-justify">
                            <div class="form-group">
                                <label>Tanggal Service</label>
                                <input v-model="models.tanggal_booking" type="date" name="tanggal_booking" class="form-control" placeholder="Pilih Tanggal Service">
                                <div class="form--error--message" id="form--error--message--tanggal_booking"></div>
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
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
        </div><!-- container -->
    @endsection