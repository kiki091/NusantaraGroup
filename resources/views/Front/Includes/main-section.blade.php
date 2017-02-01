<!-- ==== GREYWRAP ==== -->
<div id="greywrap" data-scrollreveal="enter top">
    <div class="row">
        <div class="col-sm-4 col-lg-4 callout">
            <span class="icon icon-stack"></span>
            <h2>Booking Services</h2>
            {!! $landing_page['box_wrapper_left'] or '' !!}
            <p>
                <a href="{{ route('bookingServices') }}">Lihat Selengkapnya <span class="icon icon-arrow-right-2" style="font-size: 14px;"></span></a>
            </p>
        </div><!-- col-lg-4 -->
                        
        <div class="col-sm-4 col-lg-4 callout">
            <span class="icon icon-car"></span>
            <h2>Test Drive</h2>
            {!! $landing_page['box_wrapper_center'] or '' !!}
            <p>
                <a href="{{ route('testDrive') }}">Lihat Selengkapnya <span class="icon icon-arrow-right-2" style="font-size: 14px;"></span></a>
            </p>
        </div><!-- col-lg-4 --> 
                    
        <div class="col-sm-4 col-lg-4 callout">
            <span class="icon icon-tag"></span>
            <h2>Harga Mobil</h2>
            {!! $landing_page['box_wrapper_right'] or '' !!}
            <p>
                <a href="{{ route('promotionCar') }}">Lihat Selengkapnya <span class="icon icon-arrow-right-2" style="font-size: 14px;"></span></a>
            </p>
        </div><!-- col-lg-4 --> 
    </div><!-- row -->
</div><!-- greywrap -->