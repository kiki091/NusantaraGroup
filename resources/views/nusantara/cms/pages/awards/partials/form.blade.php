<form action="{{ route('AwardsStore') }}" method="POST" id="AwardsForm" enctype="multipart/form-data" files="true" @submit.prevent>
	<div class="main__content__form__layer" id="toggle-form-awards-content" style="display: none; margin-top: 5%;">
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
									<label>Office Name</label>
									<div class="field__icon">
										<input v-model="models.office_name" name="office_name" type="text" id="office_name" class="form-control" placeholder="Enter the office_name here">
									</div>
									<div class="form--error--message" id="form--error--message--title"></div>
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
										<span><b>Upload Tip: </b>Please upload high resolution photo only with format of *jpg, jpeg. (With maximum width of {{ AWARDS_THUMBNAIL_WIDTH }} x {{ AWARDS_THUMBNAIL_HEIGHT }} px)</span>
									</div>
								</div>
								
							</div>

							<div class="create__form__row">
								<div class="new__form__field upload__image">
									<label>Images</label>
									<div class="upload__img" v-bind:class="{hide__element: filename}">
										<input name="filename" class="upload__img__input" type="file" id="filename" @change="onImageChange('filename', $event)">
										<label for="filename" class="upload__img__label"></label>
									</div>
									<div class="upload__img" v-bind:class="{hide__element: !filename}">
										<img class="upload__img__preview" :src="filename" />
										<input type="text" v-model="image" hidden="hidden" />
										<button class="upload__img__remove" @click="removeImage('filename')"></button>
									</div>


									<div class="form--error--message" id="form--error--message--filename"></div>
												<!-- upload tip -->
									<div class="upload__tip">
										<span><b>Upload Tip: </b>Please upload high resolution photo only with format of *jpg, jpeg. (With maximum width of {{ AWARDS_IMAGES_WIDTH }} x {{ AWARDS_IMAGES_HEIGHT }} px)</span>
									</div>
								</div>
								
							</div>
							<hr />

							<div class="create__form__row">
								<span class="form__group__title">Awards Description</span>
							</div>
							<div v-for="awards in models.awards">
								<div class="create__form__row">
									<div class="new__form__field width-auto">
										<label>Description</label>
										<div class="field__icon">
											<textarea :value="awards.description" name="awards[@{{ $index }}][description]" style="margin: 0px; width: 500px; height: 125px;"></textarea>
										</div>
										<div class="form--error--message" id="form--error--message--description"></div>
									</div>
								</div>

								<div class="create__form__row" v-if="edit == false">
									<a href="javascript:void(0);" v-if="$index != 0" class="btn__delete" @click="removeMoreDescription(awards, $index)">
										<i class="ico-delete">@include('nusantara.cms.svg-logo.ico-delete')</i>
									</a>
								</div>
							</div>

							<div class="create__form__row" id="add-more-office">
								<a href="javascript:void(0);" class="add__link" @click="addMoreDescription" v-if="default_total_description.length + total_description.length != 4">+ Add another description</a>
							</div>
							<hr />

							<div class="create__form__row">
								<span class="form__group__title">Seo</span>
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
							<button class="btn__form" type="submit" @click="storeDataAwards">Save</button>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</form>
