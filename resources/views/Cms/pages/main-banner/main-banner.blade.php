
    <!-- page content -->
    <div id="app">
        
    @include('Cms.include.page-title')
        <div class="row">
	        <div class="col-md-12 col-sm-12 col-xs-12">

	        	@include('Cms.pages.main-banner.partials.form')
		        <div class="main__content__layer" style="margin-top: 5%;">
		        	<div class="content__top flex-between">
		        		<div class="content__title">
		        			<h2>Main Banner</h2>

		        		</div>
		        		<div class="content__btn">
		        			<a href="#" class="btn__add" id="toggle-form">Add Banner</a>
		        		</div>
		        	</div>
		        	<div class="content__bottom">
						<ul class="news__list sortable" id="sort">
							<li class="news__list__wrapper sort-item" v-for="banner in responseData.banner">
								<div class="news__list__detail">
									<div class="drag__control">
										<div class="handle">
											@include('Cms.svg-logo.handle-drag')
										</div>
									</div>
									<div class="news__list__detail__left">
										<img :src="banner.banner_url">
									</div>
									<div class="news__list__detail__middle-right">
										<div class="news__list__detail__middle">
											<div class="news__list__desc">
												<div class="news__name">
													<a href="#" class="title__name content__edit__hover" @click="editData(banner.id)">@{{ banner.title }}</a>
												</div>
											</div>
										</div>
										<div class="news__list__detail__right">
											<label class="switch">
												<input class="switch-input" id="check_1" type="checkbox" :checked="banner.is_active == true" @change="changeStatus(banner.id)"/>
                                            	<span class="switch-label" data-on="Active" data-off="Inactive"></span> <span class="switch-handle"></span>
											</label>

											{{--<a href="#" class="btn__action__list">
												<i class="ico-photo-edit flex">@include('Cms.svg-logo.ico-photo-edit')</i>
											</a>--}}
											<a href="#" class="btn__delete">
												<i class="ico-delete">@include('Cms.svg-logo.ico-delete')</i>
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