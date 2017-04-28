<form action="{{ route('PromotionStoreData') }}" method="POST" id="PromotionForm" enctype="multipart/form-data" files="true" @submit.prevent>
	<div class="main__content__form__layer" id="toggle-form-detail-content" style="display: none; margin-top: 5%;">
		<div class="create__form__wrapper">
			<div class="form--top flex-between">
				<div class="form__title"><h2>@{{ form_add_title }}</h2></div>
				<div class="form--top__btn">
					<a href="#" class="btn__add__cancel" @click="resetForm">Cancel</a>
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
									<label>Categori Promotion</label>
									<select name="promotion_category_id" v-model="promotion.promotion_category_id">
										<option value="">Select Categori Promotion</option>
										<option v-for="category_promotion in responseData.category_promotion" v-bind:value="category_promotion.id">@{{ category_promotion.category_name }}</option>
									</select>
									<div class="form--error--message" id="form--error--message--promotion_category_id"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>Title</label>
									<div class="field__icon">
										<input v-model="promotion.title" name="title" type="text" id="title" class="form-control" placeholder="Enter the title here">
									</div>
									<div class="form--error--message" id="form--error--message--title"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>Slug</label>
									<div class="field__icon">
										<input name="slug" value="@{{ promotion.title | lowercase | strSlug }}" type="text" id="slug" class="form-control" placeholder="Enter the slug here" readonly>
									</div>
									<div class="form--error--message" id="form--error--message--slug"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field upload__image">
									<label>Thumbnail</label>
									<div class="upload__img" v-bind:class="{hide__element: thumbnail}">
										<input name="thumbnail" class="upload__img__input" type="file" id="thumbnail" @change="onImageChange('thumbnail', $event)">
										<label for="thumbnail" class="upload__img__label"></label>
									</div>
									<div class="upload__img" v-bind:class="{hide__element: !thumbnail}">
										<img class="upload__img__preview" :src="thumbnail" />
										<input type="text" v-model="image" hidden="hidden" />
										<button class="upload__img__remove" @click="removeImage('thumbnail')"></button>
									</div>


									<div class="form--error--message" id="form--error--message--thumbnail"></div>
									<!-- upload tip -->
									<div class="upload__tip">
										<span><b>Upload Tip: </b>Please upload high resolution photo only with format of *jpg | jpeg. (With maximum width of {{ PROMOTION_THUMBNAIL_WIDTH }} x {{ PROMOTION_THUMBNAIL_HEIGHT }} px in landscape)</span>
									</div>
								</div>
							</div>

							<div class="create__form__row" v-if="edit == false">
								<div class="new__form__field width-auto">
									<label>Galleri Image</label>
									<div class="form__photo__uploader single__image">
										
										<div class="form__photo__uploader__wrapper flex flex-align-center">
											<ul class="form__photo__uploader__ul photo-sortable" >
												<li class="form__photo__uploader__li" v-for="detailImage in default_total_detail_image">
													<div class="form__photo__handle handle">
														@include('nusantara.cms.svg-logo.handle-drag')
													</div>

													<div class="form__photo__group">
														<div class="form__photo__left">
															<div class="upload__img" v-bind:class="{hide__element: filename[$index]}">
																<input name="filename[@{{ $index }}]" class="upload__img__input" type="file" id="filename_@{{$index }}" @change="onImageSliderChange('filename', $index, $event)">
																<label for="filename_@{{$index }}" class="upload__img__label"></label>
															</div>
															<div class="upload__img" v-bind:class="{hide__element: !filename[$index]}">
																<img class="upload__img__preview" :src="filename[$index]" />
																<a href="javascript:void(0);" class="upload__img__show__preview" id="img-preview" @click="previewImage(filename[$index])">&times;</a>
																<button class="upload__img__remove" @click="removeImageSlider('filename', $index)" v-if="edit == false">&times;</button>
															</div>
															<span class="form__photo__title">Desktop</span>
														</div>
													</div>
													<a href="javascript:void(0);" class="form__photo__remove" v-if="$index != 0" @click="removeImageWrapper(detailImage, $index)">&times;</a>
												</li>
											</ul>
											<!-- POPUP UPLOAD PREVIEW LARGE -->
											<a href="javascript:void(0);" class="form__photo__placeholder" id="add-card-photo-uploader-en" @click="addMoreImageSlider()" v-if="default_total_detail_image.length != 8"><i>&plus;</i><span>Add New</span></a>
										</div>
										<div class="image__upload__preview__wrapper">
											<div class="img__preview__overlay" id="img-preview-popup">
												<div class="img__preview__popup">
													<div class="img__preview__popup__wrapper">
														<a href="javascript:void(0);" class="img__preview__big__close">&times;</a>
														<img class="upload__img__preview__big" :src="image_big_preview" />
													</div>
												</div>
											</div>
										</div>
										<small>
											<span>Upload Tip: </span>
											Please upload high resolution photo only with format of *jpeg. 
											<br />
											(<b>Desktop</b> With Dimension: {{ PROMOTION_GALLERY_WIDTH }} x {{ PROMOTION_GALLERY_HEIGHT }} pixels)
										</small>
									</div>
								</div>
							</div>

							<hr/>

							<div class="create__form__row">
								<span class="form__group__title">Detail Information</span>
							</div>

							<div class="create__form__row">
								<div class="new__form__field upload__image">
									<label>Banner Image</label>
									<div class="upload__img" v-bind:class="{hide__element: banner_image}">
										<input name="banner_image" class="upload__img__input" type="file" id="banner_image" @change="onImageChange('banner_image', $event)">
										<label for="banner_image" class="upload__img__label"></label>
									</div>
									<div class="upload__img" v-bind:class="{hide__element: !banner_image}">
										<img class="upload__img__preview" :src="banner_image" />
										<input type="text" v-model="image" hidden="hidden" />
										<button class="upload__img__remove" @click="removeImage('banner_image')"></button>
									</div>


									<div class="form--error--message" id="form--error--message--banner_image"></div>
									<!-- upload tip -->
									<div class="upload__tip">
										<span><b>Upload Tip: </b>Please upload high resolution photo only with format of *jpg | jpeg. (With maximum width of {{ PROMOTION_BANNER_IMAGES_WIDTH }} x {{ PROMOTION_BANNER_IMAGES_HEIGHT }} px in landscape)</span>
									</div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field width-auto">
									<label>Introduction</label>
									<label class="cms__insert__template" @click="importTemplate('template-introduction')">Import Template</label>
									<div class="field__icon">
										<textarea v-model="promotion.introduction" class="ckeditor" id="editor-1" name="introduction" style="margin: 0px; width: 500px; height: 125px;"></textarea>
									</div>
									<div class="form--error--message" id="form--error--message--introduction"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field width-auto">
									<label>Side Description</label>
									<label class="cms__insert__template" @click="importTemplate('template-side-description')">Import Template</label>
									<div class="field__icon">
										<textarea v-model="promotion.side_description" class="ckeditor" id="editor-2" name="side_description" style="margin: 0px; width: 500px; height: 125px;"></textarea>
									</div>
									<div class="form--error--message" id="form--error--message--side_description"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field width-auto">
									<label>Description</label>
									<label class="cms__insert__template" @click="importTemplate('template-description')">Import Template</label>
									<div class="field__icon">
										<textarea v-model="promotion.description" class="ckeditor" id="editor-3" name="description" style="margin: 0px; width: 500px; height: 125px;"></textarea>
									</div>
									<div class="form--error--message" id="form--error--message--description"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field upload__image">
									<label>Interior Image</label>
									<div class="upload__img" v-bind:class="{hide__element: interior_image}">
										<input name="interior_image" class="upload__img__input" type="file" id="interior_image" @change="onImageChange('interior_image', $event)">
										<label for="interior_image" class="upload__img__label"></label>
									</div>
									<div class="upload__img" v-bind:class="{hide__element: !interior_image}">
										<img class="upload__img__preview" :src="interior_image" />
										<input type="text" v-model="image" hidden="hidden" />
										<button class="upload__img__remove" @click="removeImage('interior_image')"></button>
									</div>


									<div class="form--error--message" id="form--error--message--interior_image"></div>
									<!-- upload tip -->
									<div class="upload__tip">
										<span><b>Upload Tip: </b>Please upload high resolution photo only with format of *jpg | jpeg. (With maximum width of {{ PROMOTION_IMAGES_WIDTH }} x {{ PROMOTION_IMAGES_HEIGHT }} px in landscape)</span>
									</div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field width-auto">
									<label>Equipment Interior</label>
									<label class="cms__insert__template" @click="importTemplate('template-equipment-interior')">Import Template</label>
									<div class="field__icon">
										<textarea v-model="promotion.equipment_interior" class="ckeditor" id="editor-4" name="equipment_interior" style="margin: 0px; width: 500px; height: 125px;"></textarea>
									</div>
									<div class="form--error--message" id="form--error--message--equipment_interior"></div>
								</div>
							</div>


							<div class="create__form__row">
								<div class="new__form__field width-auto">
									<label>Interior Description</label>
									<label class="cms__insert__template" @click="importTemplate('template-interior-description')">Import Template</label>
									<div class="field__icon">
										<textarea v-model="promotion.interior_description" class="ckeditor" id="editor-5" name="interior_description" style="margin: 0px; width: 500px; height: 125px;"></textarea>
									</div>
									<div class="form--error--message" id="form--error--message--interior_description"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field upload__image">
									<label>Exterior Image</label>
									<div class="upload__img" v-bind:class="{hide__element: exterior_image}">
										<input name="exterior_image" class="upload__img__input" type="file" id="exterior_image" @change="onImageChange('exterior_image', $event)">
										<label for="exterior_image" class="upload__img__label"></label>
									</div>
									<div class="upload__img" v-bind:class="{hide__element: !exterior_image}">
										<img class="upload__img__preview" :src="exterior_image" />
										<input type="text" v-model="image" hidden="hidden" />
										<button class="upload__img__remove" @click="removeImage('exterior_image')"></button>
									</div>


									<div class="form--error--message" id="form--error--message--exterior_image"></div>
									<!-- upload tip -->
									<div class="upload__tip">
										<span><b>Upload Tip: </b>Please upload high resolution photo only with format of *jpg | jpeg. (With maximum width of {{ PROMOTION_IMAGES_WIDTH }} x {{ PROMOTION_IMAGES_HEIGHT }} px in landscape)</span>
									</div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field width-auto">
									<label>Equipment Exterior</label>
									<label class="cms__insert__template" @click="importTemplate('template-equipment-exterior')">Import Template</label>
									<div class="field__icon">
										<textarea v-model="promotion.equipment_exterior" class="ckeditor" id="editor-6" name="equipment_exterior" style="margin: 0px; width: 500px; height: 125px;"></textarea>
									</div>
									<div class="form--error--message" id="form--error--message--equipment_exterior"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field width-auto">
									<label>Exterior Description</label>
									<label class="cms__insert__template" @click="importTemplate('template-exterior-description')">Import Template</label>
									<div class="field__icon">
										<textarea v-model="promotion.exterior_description" class="ckeditor" id="editor-7" name="exterior_description" style="margin: 0px; width: 500px; height: 125px;"></textarea>
									</div>
									<div class="form--error--message" id="form--error--message--exterior_description"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field upload__image">
									<label>Safety Image</label>
									<div class="upload__img" v-bind:class="{hide__element: safety_image}">
										<input name="safety_image" class="upload__img__input" type="file" id="safety_image" @change="onImageChange('safety_image', $event)">
										<label for="safety_image" class="upload__img__label"></label>
									</div>
									<div class="upload__img" v-bind:class="{hide__element: !safety_image}">
										<img class="upload__img__preview" :src="safety_image" />
										<input type="text" v-model="image" hidden="hidden" />
										<button class="upload__img__remove" @click="removeImage('safety_image')"></button>
									</div>


									<div class="form--error--message" id="form--error--message--safety_image"></div>
									<!-- upload tip -->
									<div class="upload__tip">
										<span><b>Upload Tip: </b>Please upload high resolution photo only with format of *jpg | jpeg. (With maximum width of {{ PROMOTION_IMAGES_WIDTH }} x {{ PROMOTION_IMAGES_HEIGHT }} px in landscape)</span>
									</div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field width-auto">
									<label>Safety Description</label>
									<label class="cms__insert__template" @click="importTemplate('template-safety-description')">Import Template</label>
									<div class="field__icon">
										<textarea v-model="promotion.safety_description" class="ckeditor" id="editor-8" name="safety_description" style="margin: 0px; width: 500px; height: 125px;"></textarea>
									</div>
									<div class="form--error--message" id="form--error--message--safety_description"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field upload__image">
									<label>Accesories Image</label>
									<div class="upload__img" v-bind:class="{hide__element: accesories_image}">
										<input name="accesories_image" class="upload__img__input" type="file" id="accesories_image" @change="onImageChange('accesories_image', $event)">
										<label for="accesories_image" class="upload__img__label"></label>
									</div>
									<div class="upload__img" v-bind:class="{hide__element: !accesories_image}">
										<img class="upload__img__preview" :src="accesories_image" />
										<input type="text" v-model="image" hidden="hidden" />
										<button class="upload__img__remove" @click="removeImage('accesories_image')"></button>
									</div>


									<div class="form--error--message" id="form--error--message--accesories_image"></div>
									<!-- upload tip -->
									<div class="upload__tip">
										<span><b>Upload Tip: </b>Please upload high resolution photo only with format of *jpg | jpeg. (With maximum width of {{ PROMOTION_IMAGES_WIDTH }} x {{ PROMOTION_IMAGES_HEIGHT }} px in landscape)</span>
									</div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field width-auto">
									<label>Accesories Description</label>
									<label class="cms__insert__template" @click="importTemplate('template-accesories-description')">Import Template</label>
									<div class="field__icon">
										<textarea v-model="promotion.accesories_description" class="ckeditor" id="editor-9" name="accesories_description" style="margin: 0px; width: 500px; height: 125px;"></textarea>
									</div>
									<div class="form--error--message" id="form--error--message--accesories_description"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field width-auto">
									<label>Information</label>
									<label class="cms__insert__template" @click="importTemplate('template-information')">Import Template</label>
									<div class="field__icon">
										<textarea v-model="promotion.information" class="ckeditor" id="editor-10" name="information" style="margin: 0px; width: 500px; height: 125px;"></textarea>
									</div>
									<div class="form--error--message" id="form--error--message--information"></div>
								</div>
							</div>

							<hr/>

							<div class="create__form__row">
								<span class="form__group__title">Seo</span>
							</div>
							<div class="create__form__row form--media">
								<div class="new__form__field" style="width: 500px;">
									<label>Meta Title</label>
									<div class="field__icon">
										<input v-model="promotion.meta_title" name="meta_title" type="text" id="meta_title" class="form-control" placeholder="Enter the site name here">
									</div>
									<div class="form--error--message" id="form--error--message--meta_title"></div>
								</div>
							</div>

							<div class="create__form__row form--media">
								<div class="new__form__field" style="width: 500px;">
									<label>Meta Description</label>
									<div class="field__icon">
										<textarea v-model="promotion.meta_description" name="meta_description" style="margin: 0px; width: 500px; height: 125px;"></textarea>
									</div>
									<div class="form--error--message" id="form--error--message--meta_description"></div>
								</div>
							</div>

							<div class="create__form__row form--media">
								<div class="new__form__field" style="width: 500px;">
									<label>Meta Keyword</label>
									<div class="field__icon">
										<input v-model="promotion.meta_keyword" name="meta_keyword" type="text" id="meta_keyword" class="form-control" placeholder="Enter the site name here">
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
							<button class="btn__form" type="submit" @click="storeData">Save</button>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</form>

<div style="display: none" id="template-introduction">
	@include('nusantara.cms.content-template.pages.promotion.detail.introduction')
</div>
<div style="display: none" id="template-side-description">
	@include('nusantara.cms.content-template.pages.promotion.detail.side-description')
</div>
<div style="display: none" id="template-description">
	@include('nusantara.cms.content-template.pages.promotion.detail.description')
</div>
<div style="display: none" id="template-equipment-interior">
	@include('nusantara.cms.content-template.pages.promotion.detail.equipment-interior')
</div>
<div style="display: none" id="template-interior-description">
	@include('nusantara.cms.content-template.pages.promotion.detail.interior-description')
</div>
<div style="display: none" id="template-equipment-exterior">
	@include('nusantara.cms.content-template.pages.promotion.detail.equipment-exterior')
</div>
<div style="display: none" id="template-exterior-description">
	@include('nusantara.cms.content-template.pages.promotion.detail.exterior-description')
</div>
<div style="display: none" id="template-safety-description">
	@include('nusantara.cms.content-template.pages.promotion.detail.safety-description')
</div>
<div style="display: none" id="template-accesories-description">
	@include('nusantara.cms.content-template.pages.promotion.detail.accesories-description')
</div>
<div style="display: none" id="template-information">
	@include('nusantara.cms.content-template.pages.promotion.detail.information')
</div>