
    <!-- page content -->
    <div id="app">
        
    @include('nusantara.cms.include.page-title')
        <div class="row">
	        <div class="col-md-12 col-sm-12 col-xs-12">

	        	@include('nusantara.cms.pages.booking-services.partials.form')
	        	
		        <div class="main__content__layer" style="margin-top: 5%;"  v-for="(key, title) in responseData.booking_services">
		        	<div class="content__top flex-between">
		        		<div class="content__title">
		        			<h2>@{{ key }}</h2>

		        		</div>
		        	</div>
		        	<div class="content__bottom">
						<ul class="news__list sortable" id="sort">
							<li class="news__list__wrapper sort-item" v-for="booking in title">
								<div class="news__list__detail">
									<div class="drag__control">
										<div class="handle">
											@include('nusantara.cms.svg-logo.handle-drag')
										</div>
									</div>
									<div class="news__list__detail__left">
										<img :src="booking.office_thumbnail">
									</div>
									<div class="news__list__detail__middle-right">
										<div class="news__list__detail__middle">
											<div class="news__list__desc">
												<div class="news__name">
													<a href="#" class="title__name content__edit__hover" >@{{ booking.nama_lengkap }}</a>
												</div>
												<div class="news__desc flex">
													<a href="#" class="news__cat pin-item">
													Booking Nomer : @{{ booking.no_booking }}
													</a>
												</div>
											</div>
										</div>
										<div class="news__list__detail__right">
											<a href="#" class="btn__action__list" @click="showData(booking.id)">
												<i class="ico-photo-edit flex">@include('nusantara.cms.svg-logo.ico-photo-edit')</i>
											</a>
										</div>
									</div>
								</div>
							</li>
						</ul>
					</div>
		        </div>
	        </div>
        </div>
    </div>
    <!-- /page content -->