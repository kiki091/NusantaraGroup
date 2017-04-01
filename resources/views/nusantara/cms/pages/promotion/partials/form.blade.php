<form action="#" method="POST" id="PromotionForm" enctype="multipart/form-data" files="true" @submit.prevent>
	<div class="main__content__form__layer" id="toggle-form-promotion-content" style="display: none; margin-top: 5%;">
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
							<button class="btn__form" type="submit" @click="storeDataPromotion">Save</button>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</form>
