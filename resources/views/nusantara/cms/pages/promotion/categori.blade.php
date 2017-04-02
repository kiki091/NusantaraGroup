	<div id="app">
        
    	@include('nusantara.cms.include.page-title')
        <div class="row">
	        <div class="col-md-12 col-sm-12 col-xs-12">

	        	<modal :show.sync="showModal">
					<div class="popup__mask__alert">
						<div class="popup__wrapper__alert">
							<div class="popup__layer__alert">
								<div class="alert__message__wrapper">
									<div class="alert__message">
										<img src="{{ asset('themes/cms/images/logo-alert.png') }}" alt="">
										<h3>Alert!</h3>
										<label>Are you sure that you want to delete this?</label>
									</div>
									<div class="alert__message__btn">
										<div class="new__form__btn">
											<a href="#" class="btn__form__reset" @click.prevent="closeDeleteModal">Cancel</a>
											
                                    		<a href="#" class="btn__form__create" @click="deleteDataCategori(delete_payload.id)">Confirm</a>
										</div>
									</div>
									<button class="alert__message__close" @click.prevent="closeDeleteModal"></button>
								</div>
							</div>
						</div>
					</div>
				</modal>

				@include('nusantara.cms.pages.promotion.partials.folder')
				@include('nusantara.cms.pages.promotion.partials.form-categori')

		        <div id="categori-promotion" class="main__content__layer" style="margin-top: 5%;">
		        	<div class="content__top flex-between">
		        		<div class="content__title">
		        			<h2>@{{ form_add_title_category }}</h2>

		        		</div>
		        		<div class="content__btn">
		        			<a href="#" class="btn__add btn_add_category" id="toggle-form-categori" @click="resetForm">Add Category Promotion</a>
		        		</div>
		        	</div>
		        	<div class="content__bottom">
						<ul class="news__list sortable" id="sort-categori" v-sort>
							<li class="news__list__wrapper sort-item-categori" v-for="category_promotion in responseData.category_promotion" data-id="@{{ category_promotion.id }}">
								<div class="news__list__detail">
									<div class="drag__control">
										<div class="handle">
											@include('nusantara.cms.svg-logo.handle-drag')
										</div>
									</div>
									<div class="news__list__detail__left">
										<img :src="category_promotion.thumbnail_category_url">
									</div>
									<div class="news__list__detail__middle-right">
										<div class="news__list__detail__middle">
											<div class="news__list__desc">
												<div class="news__name">
													<a href="#categori-promotion" class="title__name content__edit__hover" title="Edit Data" @click="editCategori(category_promotion.id)">@{{ category_promotion.category_name }}</a>
												</div>
											</div>
										</div>
										<div class="news__list__detail__right">
											<label class="switch">
												<input class="switch-input" id="check_1" type="checkbox" :checked="category_promotion.is_active == true" @change="changeStatusCategori(category_promotion.id)"/>
                                            	<span class="switch-label" data-on="Active" data-off="Inactive"></span> <span class="switch-handle"></span>
											</label>

											<a href="#delete-data" class="btn__delete" @click="showDeleteModal(category_promotion.id,'category_promotion')">
												<i class="ico-delete">@include('nusantara.cms.svg-logo.ico-delete')</i>
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