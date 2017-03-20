<form action="#" method="POST" id="StaticPageForm" enctype="multipart/form-data" files="true" @submit.prevent>
	<div class="main__content__form__layer" id="toggle-form-content" style="display: none; margin-top: 2%;">
		<div class="create__form__wrapper">
			<div class="form--top flex-between">
				<div class="form__title"><h2>Form Static Page</h2></div>
				<div class="form--top__btn">
					<a href="#" class="btn__add__cancel" @click="resetForm">Cancel</a>
				</div>
			</div>
			<div class="form--mid" v-if="edit == true">
				<div class="create__form content__tab active__content">
					<div class="form__group__row">
						<div id="form-accordion">
							<div class="create__form__row">
								<div class="new__form__field">
									<label>Site Title</label>
									<div class="field__icon">
										<input v-model="models.site_title" name="site_title" type="text" id="site_title" class="form-control" placeholder="Enter the site title here">
									</div>
									<div class="form--error--message" id="form--error--message--site_title"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>Site Name</label>
									<div class="field__icon">
										<input v-model="models.site_name" name="site_name" type="text" id="site_name" class="form-control" placeholder="Enter the site name here">
									</div>
									<div class="form--error--message" id="form--error--message--site_name"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field upload__image">
									<label>Logo Image</label>
									<div class="upload__img" v-bind:class="{hide__element: logo_images}">
										<input name="logo_images" class="upload__img__input" type="file" id="logo_images" @change="onImageChange('logo_images', $event)">
										<label for="logo_images" class="upload__img__label"></label>
									</div>
									<div class="upload__img" v-bind:class="{hide__element: !logo_images}">
										<img class="upload__img__preview" :src="logo_images" />
										<input type="text" v-model="image" hidden="hidden" />
										<button class="upload__img__remove" @click="removeImage('logo_images')"></button>
									</div>


									<div class="form--error--message" id="form--error--message--logo_images"></div>
												<!-- upload tip -->
									<div class="upload__tip">
										<span><b>Upload Tip: </b>Please upload high resolution photo only with format of *png. (With maximum width of {{ LOGO_WIDTH }} x {{ LOGO_HEIGHT }} px)</span>
									</div>
									<input type="hidden" name="old_logo_images" value="@{{ models.old_logo_images }}">
								</div>
								
							</div>

							<div class="create__form__row">
								<div class="new__form__field upload__image">
									<label>Favicon Image</label>
									<div class="upload__img" v-bind:class="{hide__element: favicon_images}">
										<input name="favicon_images" class="upload__img__input" type="file" id="favicon_images" @change="onImageChange('favicon_images', $event)">
										<label for="favicon_images" class="upload__img__label"></label>
									</div>
									<div class="upload__img" v-bind:class="{hide__element: !favicon_images}">
										<img class="upload__img__preview" :src="favicon_images" />
										<input type="text" v-model="image" hidden="hidden" />
										<button class="upload__img__remove" @click="removeImage('favicon_images')"></button>
									</div>
									<div class="form--error--message" id="form--error--message--favicon_images"></div>
									<!-- upload tip -->
									<div class="upload__tip">
										<span><b>Upload Tip: </b>Please upload high resolution photo only with format of *png / ico. (With maximum width of {{ FAVICON_WIDTH }} x {{ FAVICON_HEIGHT }} px)</span>
									</div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field upload__image">
									<label>Og Image</label>
									<div class="upload__img" v-bind:class="{hide__element: og_images}">
										<input name="og_images" class="upload__img__input" type="file" id="og_images" @change="onImageChange('og_images', $event)">
										<label for="og_images" class="upload__img__label"></label>
									</div>
									<div class="upload__img" v-bind:class="{hide__element: !og_images}">
										<img class="upload__img__preview" :src="og_images" />
										<input type="text" v-model="image" hidden="hidden" />
										<button class="upload__img__remove" @click="removeImage('og_images')"></button>
									</div>
									<div class="form--error--message" id="form--error--message--og_images"></div>
									<!-- upload tip -->
									<div class="upload__tip">
										<span><b>Upload Tip: </b>Please upload high resolution photo only with format of *png / jpg / jpeg. (With maximum width of {{ OG_IMAGE_WIDTH }} x {{ OG_IMAGE_HEIGHT }} px)</span>
									</div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>Og Title</label>
									<div class="field__icon">
										<input v-model="models.og_title" name="og_title" type="text" id="og_title" class="form-control" placeholder="Enter the site name here">
									</div>
									<div class="form--error--message" id="form--error--message--og_title"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field width-auto">
									<label>Og Description</label>
									<div class="field__icon">
										<textarea v-model="models.og_description" name="og_description" style="margin: 0px; width: 500px; height: 125px;"></textarea>
									</div>
									<div class="form--error--message" id="form--error--message--og_description"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field width-auto">
									<label>Box Wrapper Left</label>
									<label class="cms__insert__template" @click="importTemplate('template-box-wrapper-left')">Import Template</label>
									<div class="field__icon">
										<textarea v-model="models.box_wrapper_left" name="box_wrapper_left" style="margin: 0px; width: 500px; height: 125px;"></textarea>
									</div>
									<div class="form--error--message" id="form--error--message--box_wrapper_left"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field width-auto">
									<label>Box Wrapper Center</label>
									<label class="cms__insert__template" @click="importTemplate('template-box-wrapper-center')">Import Template</label>
									<div class="field__icon">
										<textarea v-model="models.box_wrapper_center" name="box_wrapper_center" style="margin: 0px; width: 500px; height: 125px;"></textarea>
									</div>
									<div class="form--error--message" id="form--error--message--box_wrapper_center"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field width-auto">
									<label>Box Wrapper Right</label>
									<label class="cms__insert__template" @click="importTemplate('template-box-wrapper-right')">Import Template</label>
									<div class="field__icon">
										<textarea v-model="models.box_wrapper_right" name="box_wrapper_right" style="margin: 0px; width: 500px; height: 125px;"></textarea>
									</div>
									<div class="form--error--message" id="form--error--message--box_wrapper_right"></div>
								</div>
							</div>

							<div class="create__form__row form--media">
								<div class="new__form__field" style="width: 500px;">
									<label>Meta Title</label>
									<div class="field__icon">
										<input v-model="models.meta_title" name="meta_title" type="text" id="meta_title" class="form-control" placeholder="Enter the site name here">
									</div>
									<div class="form--error--message" id="form--error--message--meta_title"></div>
								</div>
							</div>

							<div class="create__form__row form--media">
								<div class="new__form__field" style="width: 500px;">
									<label>Meta Description</label>
									<div class="field__icon">
										<textarea v-model="models.meta_description" name="meta_description" style="margin: 0px; width: 500px; height: 125px;"></textarea>
									</div>
									<div class="form--error--message" id="form--error--message--meta_description"></div>
								</div>
							</div>

							<div class="create__form__row form--media">
								<div class="new__form__field" style="width: 500px;">
									<label>Meta Keyword</label>
									<div class="field__icon">
										<input v-model="models.meta_keyword" name="meta_keyword" type="text" id="meta_keyword" class="form-control" placeholder="Enter the site name here">
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
							<input v-model="models.id" type="hidden" name="id">
							<button class="btn__form" type="submit" @click="storeData">Save</button>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</form>

<div style="display: none" id="template-box-wrapper-left">
	@include('nusantara.cms.content-template.pages.static-page.box-wrapper-left')
</div>
<div style="display: none" id="template-box-wrapper-center">
	@include('nusantara.cms.content-template.pages.static-page.box-wrapper-center')
</div>
<div style="display: none" id="template-box-wrapper-right">
	@include('nusantara.cms.content-template.pages.static-page.box-wrapper-right')
</div>