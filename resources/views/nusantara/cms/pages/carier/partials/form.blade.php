<form action="{{ route('CarierStore') }}" method="POST" id="FormCarier" enctype="multipart/form-data" files="true" @submit.prevent>
	<div class="main__content__form__layer" id="toggle-form-categori-content" style="display: none; margin-top: 5%;">
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
								<div class="new__form__field">
									<label>Category</label>
									<div class="field__icon">
										<input v-model="models.category_name" name="category_name" type="text" id="category_name" class="form-control" placeholder="Enter the category name here">
									</div>
									<div class="form--error--message" id="form--error--message--category_name"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field upload__image">
									<label>Thumbnail Image</label>
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
										<span><b>Upload Tip: </b>Please upload high resolution photo only with format of *jpg | jpeg. (With maximum width of {{ MAIN_BANNER_WIDTH }} x {{ MAIN_BANNER_HEIGHT }} px in landscape)</span>
									</div>
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
							<input v-if="edit == true" v-model="models.id" type="hidden" name="id">
							<button class="btn__form" type="submit" @click="storeCarier">Save</button>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</form>