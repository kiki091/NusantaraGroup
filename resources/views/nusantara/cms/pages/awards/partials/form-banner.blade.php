<form action="{{ route('AwardsStoreBanner') }}" method="POST" id="FormBannerAwards" enctype="multipart/form-data" files="true" @submit.prevent>
	<div class="main__content__form__layer" id="toggle-form-content" style="display: none; margin-top: 5%;">
		<div class="create__form__wrapper">
			<div class="form--top flex-between">
				<div class="form__title"><h2>@{{ form_add_title }}</h2></div>
				<div class="form--top__btn">
					<a href="#" class="btn__add__cancel" @click="resetFormBanner">Cancel</a>
				</div>
			</div>
			<div class="form--mid">
				<div class="create__form content__tab active__content">
					<div class="form__group__row">
						<div id="form-accordion">
							<div class="create__form__row">
								<div class="new__form__field">
									<label>Title</label>
									<div class="field__icon">
										<input v-model="banner.title" name="title" type="text" id="title" class="form-control" placeholder="Enter the title here">
									</div>
									<div class="form--error--message" id="form--error--message--title"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field upload__image">
									<label>Image</label>
									<div class="upload__img" v-bind:class="{hide__element: images}">
										<input name="images" class="upload__img__input" type="file" id="images" @change="onImageChange('images', $event)">
										<label for="images" class="upload__img__label"></label>
									</div>
									<div class="upload__img" v-bind:class="{hide__element: !images}">
										<img class="upload__img__preview" :src="images" />
										<input type="text" v-model="image" hidden="hidden" />
										<button class="upload__img__remove" @click="removeImage('images')"></button>
									</div>


									<div class="form--error--message" id="form--error--message--images"></div>
									<!-- upload tip -->
									<div class="upload__tip">
										<span><b>Upload Tip: </b>Please upload high resolution photo only with format of *jpg | jpeg. (With maximum width of {{ MAIN_BANNER_WIDTH }} x {{ MAIN_BANNER_HEIGHT }} px in landscape)</span>
									</div>
									<input type="hidden" name="old_images" value="@{{ banner.old_images }}">
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
							<input v-if="edit == true" v-model="banner.id" type="hidden" name="id">
							<button class="btn__form" type="submit" @click="storeData">Save</button>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</form>
