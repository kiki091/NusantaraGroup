<form action="{{ route('PromotionStoreCategori') }}" method="POST" id="PromotionCategoriForm" enctype="multipart/form-data" files="true" @submit.prevent>
	<div class="main__content__form__layer" id="toggle-form-categori-content" style="display: none; margin-top: 5%;">
		<div class="create__form__wrapper">
			<div class="form--top flex-between">
				<div class="form__title"><h2>@{{ form_add_title_category }}</h2></div>
				<div class="form--top__btn">
					<a href="#" class="btn__add__cancel" @click="resetFormCategoryPromotion">Cancel</a>
				</div>
			</div>
			<div class="form--mid">
				<div class="create__form content__tab active__content">
					<div class="form__group__row">
						<div id="form-accordion">
							<div class="create__form__row">
								<span class="form__group__title">General Information</span>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>Title</label>
									<div class="field__icon">
										<input v-model="categori.category_name" name="category_name" type="text" id="category_name" class="form-control" placeholder="Enter the title here">
									</div>
									<div class="form--error--message" id="form--error--message--category_name"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>Slug</label>
									<div class="field__icon">
										<input name="category_slug" value="@{{ categori.category_name | lowercase | strSlug }}" type="text" id="category_slug" class="form-control" placeholder="Enter the slug here" readonly>
									</div>
									<div class="form--error--message" id="form--error--message--category_slug"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field upload__image">
									<label>Image</label>
									<div class="upload__img" v-bind:class="{hide__element: thumbnail_category}">
										<input name="thumbnail_category" class="upload__img__input" type="file" id="thumbnail_category" @change="onImageChange('thumbnail_category', $event)">
										<label for="thumbnail_category" class="upload__img__label"></label>
									</div>
									<div class="upload__img" v-bind:class="{hide__element: !thumbnail_category}">
										<img class="upload__img__preview" :src="thumbnail_category" />
										<input type="text" v-model="image" hidden="hidden" />
										<button class="upload__img__remove" @click="removeImage('thumbnail_category')"></button>
									</div>


									<div class="form--error--message" id="form--error--message--thumbnail_category"></div>
									<!-- upload tip -->
									<div class="upload__tip">
										<span><b>Upload Tip: </b>Please upload high resolution photo only with format of *jpg | jpeg. (With maximum width of {{ PROMOTION_CATEGORI_WIDTH }} x {{ PROMOTION_CATEGORI_HEIGHT }} px in landscape)</span>
									</div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field width-auto">
									<label>Introduction</label>
									<label class="cms__insert__template" @click="importTemplate('template-introduction')">Import Template</label>
									<div class="field__icon">
										<textarea v-model="categori.introduction" class="ckeditor" id="editor-1" name="introduction" style="margin: 0px; width: 500px; height: 125px;"></textarea>
									</div>
									<div class="form--error--message" id="form--error--message--introduction"></div>
								</div>
							</div>

							<div class="create__form__row">
								<span class="form__group__title">Seo</span>
							</div>
							<div class="create__form__row form--media">
								<div class="new__form__field" style="width: 500px;">
									<label>Meta Title</label>
									<div class="field__icon">
										<input v-model="categori.meta_title" name="meta_title" type="text" id="meta_title" class="form-control" placeholder="Enter the site name here">
									</div>
									<div class="form--error--message" id="form--error--message--meta_title"></div>
								</div>
							</div>

							<div class="create__form__row form--media">
								<div class="new__form__field" style="width: 500px;">
									<label>Meta Description</label>
									<div class="field__icon">
										<textarea v-model="categori.meta_description" name="meta_description" style="margin: 0px; width: 500px; height: 125px;"></textarea>
									</div>
									<div class="form--error--message" id="form--error--message--meta_description"></div>
								</div>
							</div>

							<div class="create__form__row form--media">
								<div class="new__form__field" style="width: 500px;">
									<label>Meta Keyword</label>
									<div class="field__icon">
										<input v-model="categori.meta_keyword" name="meta_keyword" type="text" id="meta_keyword" class="form-control" placeholder="Enter the site name here">
									</div>
									<div class="form--error--message" id="form--error--message--meta_keyword"></div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>

			<div class="form--bot">
				<div class="create__form">
					<div class="create__form__row flex-between">
						<div class="new__form__btn">
							<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
							<input v-model="promotion.id" type="hidden" name="id">
							<button class="btn__form" type="submit" @click="storeDataCategori">Save</button>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</form>

<div style="display: none" id="template-introduction">
	@include('nusantara.cms.content-template.pages.promotion.introduction')
</div>