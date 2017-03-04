<form action="#" method="POST" id="StoreBookingServicesData" enctype="multipart/form-data" files="true" @submit.prevent>
	<div class="main__content__form__layer" id="toggle-form-content" style="display: none; margin-top: 2%;">
		<div class="create__form__wrapper">
			<div class="form--top flex-between">
				<div class="form__title"><h2>Booking Services</h2></div>
				<div class="form--top__btn">
					<a href="#" class="btn__add__cancel">Cancel</a>
				</div>
			</div>
			<div class="form--mid">
				<div class="create__form content__tab active__content">
					<div class="form__group__row">
						<div id="form-accordion">
							<div class="create__form__row">
								<div class="new__form__field">
									<label>Booking Number</label>
									<div class="field__icon">
										<input v-model="models.no_booking" name="no_booking" type="text" id="no_booking" class="form-control" placeholder="Enter the site title here">
									</div>
									<div class="form--error--message" id="form--error--message--no_booking"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>Nomor Kendaraan</label>
									<div class="field__icon">
										<input v-model="models.no_kendaraan" name="no_kendaraan" type="text" id="no_kendaraan" class="form-control" placeholder="Enter the site title here">
									</div>
									<div class="form--error--message" id="form--error--message--no_kendaraan"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>Jenis Kendaraan</label>
									<div class="field__icon">
										<input v-model="models.jenis_kendaraan" name="jenis_kendaraan" type="text" id="jenis_kendaraan" class="form-control" placeholder="Enter the site title here">
									</div>
									<div class="form--error--message" id="form--error--message--jenis_kendaraan"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>Nama Lengkap</label>
									<div class="field__icon">
										<input v-model="models.nama_lengkap" name="nama_lengkap" type="text" id="nama_lengkap" class="form-control" placeholder="Enter the site title here">
									</div>
									<div class="form--error--message" id="form--error--message--nama_lengkap"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>No Telpon</label>
									<div class="field__icon">
										<input v-model="models.no_telpon" name="no_telpon" type="text" id="no_telpon" class="form-control" placeholder="Enter the site title here">
									</div>
									<div class="form--error--message" id="form--error--message--no_telpon"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>Email</label>
									<div class="field__icon">
										<input v-model="models.email" name="email" type="text" id="email" class="form-control" placeholder="Enter the site title here">
									</div>
									<div class="form--error--message" id="form--error--message--email"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>Tanggal Booking</label>
									<div class="field__icon">
										<input v-model="models.tanggal_booking" name="tanggal_booking" type="text" id="tanggal_booking" class="form-control" placeholder="Enter the site title here">
									</div>
									<div class="form--error--message" id="form--error--message--tanggal_booking"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>Tanggal Booking</label>
									<div class="field__icon">
										<input v-model="models.tanggal_booking" name="tanggal_booking" type="text" id="tanggal_booking" class="form-control" placeholder="Enter the site title here">
									</div>
									<div class="form--error--message" id="form--error--message--tanggal_booking"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>Keterangan</label>
									<div class="field__icon">
										<textarea v-model="models.keterangan" name="keterangan" class="form-control"></textarea>
									</div>
									<div class="form--error--message" id="form--error--message--keterangan"></div>
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
							<button class="btn__form" type="submit">Save</button>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</form>