<form action="{{ route('CarierDetailStore') }}" method="POST" id="FormDetailCarier" enctype="multipart/form-data" files="true" @submit.prevent>
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
								<div class="new__form__field">
									<label>Category</label>
									<select name="carier_category_id" v-model="models.carier_category_id">
											<option value="">Select Category</option>
											<option v-for="category_list in responseData.carier_categori" value="@{{ category_list.id }}">@{{ category_list.category_name }}</option>
										</select>
									<div class="form--error--message" id="form--error--message--carier_category_id"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>Job Title</label>
									<div class="field__icon">
										<input v-model="models.job_title" name="job_title" type="text" id="job_title" class="form-control" placeholder="Enter the job title here">
									</div>
									<div class="form--error--message" id="form--error--message--job_title"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>Slug</label>
									<div class="field__icon">
										<input v-model="models.job_title | lowercase | strSlug" name="slug" type="text" id="slug" class="form-control" placeholder="Enter the slug name here" readonly>
									</div>
									<div class="form--error--message" id="form--error--message--slug"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field width-auto">
									<label>Job Description</label>
									<label class="cms__insert__template" @click="importTemplate('template-job-description')">Import Template</label>
									<div class="field__icon">
										<textarea v-model="models.job_description" class="ckeditor" id="editor-1" name="job_description" style="margin: 0px; width: 500px; height: 125px;"></textarea>
									</div>
									<div class="form--error--message" id="form--error--message--job_description"></div>
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

<div style="display: none" id="template-job-description">
	@include('nusantara.cms.content-template.pages.carier.job-description')
</div>