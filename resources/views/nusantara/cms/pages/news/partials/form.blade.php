<form action="{{ route('NewsStoreData') }}" method="POST" id="FormNews" enctype="multipart/form-data" files="true" @submit.prevent>
	<div class="main__content__form__layer" id="toggle-form-content" style="display: none; margin-top: 5%;">
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
								<span class="form__group__title">General</span>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>Title</label>
									<div class="field__icon">
										<input v-model="models.title" name="title" type="text" id="title" class="form-control" placeholder="Enter the title here">
									</div>
									<div class="form--error--message" id="form--error--message--title"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>Slug</label>
									<div class="field__icon">
										<input v-model="models.title | lowercase | strSlug" name="slug" type="text" id="slug" class="form-control" placeholder="Enter the slug here" readonly>
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
										<span><b>Upload Tip: </b>Please upload high resolution photo only with format of *jpg | jpeg. (With maximum width of {{ NEWS_THUMBNAIL_WIDTH }} x {{ NEWS_THUMBNAIL_HEIGHT }} px in landscape)</span>
									</div>
								</div>
							</div>

							<div class="create__form__row" v-if="edit == false">
								<div class="new__form__field width-auto">
									<label>Slider Image</label>
									<div class="form__photo__uploader single__image">
										<small>Drop <span><b>Main image</b></span> in this area. Sort images by "draging and droping" in the desired position</small>

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
											<a href="javascript:void(0);" class="form__photo__placeholder" id="add-card-photo-uploader-en" @click="addMoreImageSlider()" v-if="default_total_detail_image.length != 4"><i>&plus;</i><span>Add New</span></a>
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
											(<b>Desktop</b> With Dimension: {{ NEWS_IMAGES_DETAIL_WIDTH }} x {{ NEWS_IMAGES_DETAIL_HEIGHT }} pixels)
										</small>
									</div>
								</div>
							</div>

							<div class="create__form__row" >
								<div class="new__form__field width100">
									<label>You May Also Like</label>
									<div class="moving--check">
										<div class="moving--check--table">
											<div class="new--table__header">
												<span>SELECTED NEWS</span>
											</div>
											<div class="table-test">
												<div class="bg--placeholder" v-if="edit == false">
													@include('nusantara.cms.svg-logo.ico-max3')
													<p>Select three related dining venue from the list</p>
												</div>
												<ul id="ul-checked">
												{{--
													<li v-for="diningVenuesValue in eat_and_drink_venues_related_id" v-if="edit == true && diningVenuesValue.is_checked == true">
														<div class="form--checkbox__wrapper">
															<span class="priority"></span>
															<input type="checkbox" id="checkbox-en-@{{ $index }}" class="checkbox--input" name="eat_and_drink_venues_related_id[]" value="@{{ diningVenuesValue.id }}" :checked="diningVenuesValue.is_checked == true">
															<label for="checkbox-en-@{{ $index }}" class="checkbox--label">@{{ diningVenuesValue.title }}</label>
															<div class="handle">
																<span class="handle-bar1"></span>
																<span class="handle-bar2"></span>
																<span class="handle-bar3"></span>
															</div>
														</div>
													</li>
												--}}
												</ul>
											</div>
										</div>
										<div class="moving--check--checkbox">
											<div class="new--checkbox__header">
												<span>NEWS LIST</span>
											</div>
											<div class="test__list__checkbox checkbox-test">
												<ul v-if="edit == false">
													<li v-for="news in responseData.news" id="@{{ news.id }}">
														<div class="form--checkbox__wrapper">
															<span class="priority"></span>
															<input type="checkbox" id="checkbox-en-@{{ $index }}" class="checkbox--input" name="news_releted_id[]" value="@{{ news.id }}">
															<label for="checkbox-en-@{{ $index }}" class="checkbox--label">@{{ news.title }}</label>
															<div class="handle">
																<span class="handle-bar1"></span>
																<span class="handle-bar2"></span>
																<span class="handle-bar3"></span>
															</div>
														</div>
													</li>
												</ul>
												{{--
												<ul v-if="edit == true">
													<li v-for="diningVenuesValue in eat_and_drink_venues_related_id" v-if="edit == true && diningVenuesValue.is_checked == false">
														<div class="form--checkbox__wrapper">
															<span class="priority"></span>
															<input type="checkbox" id="checkbox-en-@{{ $index }}" class="checkbox--input" name="eat_and_drink_venues_related_id[]" value="@{{ diningVenuesValue.id }}" :checked="diningVenuesValue.is_checked == true">
															<label for="checkbox-en-@{{ $index }}" class="checkbox--label">@{{ diningVenuesValue.title }}</label>
															<div class="handle">
																<span class="handle-bar1"></span>
																<span class="handle-bar2"></span>
																<span class="handle-bar3"></span>
															</div>
														</div>
													</li>
												</ul>
												--}}
											</div>
										</div>
									</div>
									<div class="form--error--message" id="form--error--message--news_releted_id"></div>
								</div>
							</div>

							<div class="create__form__row form--media">
								<div class="new__form__field" style="width: 500px;">
									<label>Side Description</label>
									<div class="field__icon">
										<textarea v-model="models.side_description" name="side_description" style="margin: 0px; width: 500px; height: 125px;"></textarea>
									</div>
									<div class="form--error--message" id="form--error--message--side_description"></div>
								</div>
							</div>

							<div class="create__form__row form--media">
								<div class="new__form__field" style="width: 500px;">
									<label>Quote Description</label>
									<div class="field__icon">
										<textarea v-model="models.quote_description" name="quote_description" style="margin: 0px; width: 500px; height: 125px;"></textarea>
									</div>
									<div class="form--error--message" id="form--error--message--quote_description"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field width-auto">
									<label>Description</label>
									<div class="field__icon">
										<textarea v-model="models.description" class="ckeditor" id="editor-1" name="description" style="margin: 0px; width: 500px; height: 125px;"></textarea>
									</div>
									<div class="form--error--message" id="form--error--message--description"></div>
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
							<input v-if="edit == true" v-model="models.id" type="hidden" name="id">
							<button class="btn__form" type="submit" @click="storeData">Save</button>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</form>
