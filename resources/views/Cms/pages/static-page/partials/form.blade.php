<form action="{{ route('StoreStaticPage') }}" method="POST" id="StaticPageForm" enctype="multipart/form-data" @submit.prevent>
	<div class="main__content__form__layer" id="toggle-form-content" style="display: none;">
		<div class="create__form__wrapper">
			<div class="form--top flex-between">
				<div class="form__title"><h2>Form Static Page</h2></div>
				<div class="form--top__btn">
					<a href="#" class="btn__add__cancel" onclick="buttonClickClose()">Cancel</a>
				</div>
			</div>
			<div class="form--mid">
				<div class="create__form content__tab active__content">
					<div class="form__group__row">
						<div id="form-accordion">
							<div class="create__form__row">
								<div class="new__form__field">
									<label>Site Title</label>
									<div class="field__icon">
										<input v-model="models.site_title" name="site_title" type="text" id="site_title" class="form-control" placeholder="Enter the site name here">
									</div>
									<div class="form--error--message" id="form--error--message--"></div>
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
										<span><b>Upload Tip: </b>Please upload high resolution photo only with format of *png. (With maximum width of {{ LOGO_WIDTH }} x {{ LOGO_HEIGHT }} px on landscape)</span>
									</div>
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
										<span><b>Upload Tip: </b>Please upload high resolution photo only with format of *png. (With maximum width of {{ LOGO_WIDTH }} x {{ LOGO_HEIGHT }} px on landscape)</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<hr class="form__line">
				</div>
			</div>
		</div>
	</div>
</form>