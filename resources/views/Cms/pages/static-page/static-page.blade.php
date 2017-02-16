
    <!-- page content -->
    <div id="static-page">
        
    @include('Cms.include.page-title')
        <div class="row">
	        <div class="col-md-12 col-sm-12 col-xs-12">

				@include('Cms.pages.static-page.partials.form')

		        <div class="main__content__layer">
		        	<div class="content__top flex-between">
		        		<div class="content__title">
		        			<h2>Static Page</h2>
		        		</div>
		        		<div class="content__btn">
		        			<a href="#" class="btn__add" id="toggle-form" onclick="buttonClickOpen()">Edit</a>
		        		</div>
		        	</div>
		        	<div class="content__bottom">
						<ul class="news__list sortable" id="sort">
							<li class="news__list__wrapper sort-item" v-for="page in responseData">
								<div class="news__list__detail">
									<div class="drag__control">
										<div class="handle">
											@include('Cms.svg-logo.handle-drag')
										</div>
									</div>
									<div class="news__list__detail__left">
										<img :src="page.logo_images">
									</div>
									<div class="news__list__detail__middle-right">
										<div class="news__list__detail__middle">
											<div class="news__list__desc">
												<div class="news__name">
													<a href="#" class="title__name content__edit__hover">@{{ page.site_name }}</a>
												</div>
												<div class="news__desc flex">
													<a href="#" class="news__cat pin-item pin-item-disable" data-hover-pin="Pin to landing page" data-hover-unpin="Unpin from landing page">
														<i class="ico-pin">@include('Cms.svg-logo.ico-pin')
														</i>
														<span>Not pinned to landing page</span>
													</a>
												</div>
											</div>
										</div>
										<div class="news__list__detail__right">
											<label class="switch">
												<input class="switch-input" name="is_active" id="check_1" type="checkbox"/>
												<span class="switch-label" data-on="Active" data-off="Inactive"></span> 
												<span class="switch-handle"></span>
											</label>

											{{--<a href="#" class="btn__action__list">
												<i class="ico-photo-edit flex">@include('Cms.svg-logo.ico-photo-edit')</i>
											</a>
											<a href="#" class="btn__delete">
												<i class="ico-delete">@include('Cms.svg-logo.ico-delete')</i>
											</a>--}}
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