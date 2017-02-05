<footer id="desktop-footer" class="visible-md" id="footer" name="footer" data-scrollreveal="enter top after 0.5s">
    <div class="top-footer">
        <div class="container-fluid has-breakpoint">
            <div class="row">
                <br/>
                <div class="col-lg-3 col-md-3 col-sm-6" id="footer-left">
                    <div class="desktop-footer-block footer-block-01">
                        <div id="desktop-footer-logo-container">
                            <a href="" id="desktop-footer-logo" class="desktop-footer-logo nusantara-version">
                                <img src="{{ asset('images/db/main_page/logo/nusantara-group-2.png') }}" width="200">
                            </a>
                            <p>
                            {{ $footer_content['footer_box_center'] or '' }}
                            </p>

                        </div>
                    </div>
                </div>
                <!-- col -->
                <div class="col-md-5 col-sm-8" id="footer-center">
                    <div class="desktop-footer-block footer-block-02">
                        <div id="desktop-footer-links">
                            <h3>Nusantara Group</h3>
                            <div class="desktop-footer-links-column-container">
                                <nav>
                                    <ul>
                                      <li><a href=""><h4>HUBUNGI KAMI</h4></a></li>
                                      <li><a href=""><h4>TENTANG KAMI</h4></a></li>
                                    </ul>
                                </nav>
                                <nav>
                                    <ul>
                                      <li><a href=""><h4>BERITA</h4></a></li>
                                      <li><a href="{{ route('companyHistoryPage') }}"><h4>SEJARAH PERUSAHAAN</h4></a></li>
                                    </ul>
                                </nav>
                                <nav>
                                    <ul>
                                      <li><a href=""><h4>LAYANAN</h4></a></li>
                                      <li><a href="{{ route('carier') }}"><h4>KARIR</h4></a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                        
                <div class="col-md-4 col-sm-8" id="footer-right">
                    <div id="footer-content-js">
                        <div class="desktop-footer-block footer-block-03">
                            <div id="desktop-footer-mailing-list">
                                <h4>BERGABUNG DI MAILING LIST KAMI</h4>
                                <p>
                                    Jadilah yang pertama untuk tahu penawaran, events, dan promosi Kami!
                                </p>
                                <form id="desktop-footer-mailing-list-form" method="post" class="simple-form-check" v-on:submit.prevent="storeSubscribe">
                                    <div class="form-group">
                                        <input v-model="formAttr.email" name="email" type="text" class="required only-email" placeholder="Masukan alamat email anda">
                                        <div class="form--error--message" id="form--error--message--email"></div>
                                        
                                    </div>
                                    <input type="hidden" id="token" name="token" value="{{ csrf_token() }}">
                                    <input type="submit" value=">">
                                </form><!-- form -->
                            </div>
                            <div id="desktop-footer-social-links">
                                <h4>Ikuti Kami</h4>
                                <ul>
                                    <li>
                                        <a href="https://www.instagram.com/" target="_blank">
                                            <span class="icon icon-instagram"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.facebook.com/" target="_blank">
                                            <span class="icon icon-facebook"></span>
                                        </a>
                                    </li>
                                      
                                    <li>
                                        <a href="https://twitter.com/" target="_blank">
                                            <span class="icon icon-twitter"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.youtube.com/user/" target="_blank">
                                            <span class="icon icon-youtube"></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- col -->
    </div><!-- row -->   
</div><!-- container -->

<div class="bottom-footer">
    <div class="container-fluid has-breakpoint">
        <div class="row">
            <div class="col-md-6">
                <p class="desktop-footer-copywrite">© 2016 Nusantara Group. All rights reserved</p>
            </div>
        </div>
    </div>
</div>