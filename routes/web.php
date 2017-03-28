<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['web']], function ()
{
	Route::group(['domain' => env('WORLD_WIDE_WEB') . env('DOMAIN_PREFIX') . env('APP_DOMAIN')], function()
	{
		Route::group(['prefix' => LaravelLocalization::setLocale()], function()
		{
			Route::get('/', 'Nusantara\front\LandingController@index')->name('homePage');

			Route::group(array('prefix' => 'contact-us'), function (){
				Route::get('/', 'Nusantara\front\ContactUsController@index')->name('contactUsPage');
				Route::get('data', 'Nusantara\front\ContactUsController@getData')->name('GetDataDontactUsPage');
				Route::post('create', 'Nusantara\front\ContactUsController@store')->name('contactUsPageStore');
			});

			Route::group(array('prefix' => 'berita'), function (){
				Route::get('/', 'Nusantara\front\NewsController@index')->name('newsPage');
				Route::get('data', 'Nusantara\front\NewsController@getData')->name('GetDataNewsPage');
			});


			Route::group(array('prefix' => 'event'), function (){
				Route::get('category/{slug}', 'Nusantara\front\ServiceController@category')->name('categoryEvent');
				Route::get('{slug}', 'Nusantara\front\ServiceController@detail')->name('detailEvent');
			});

			Route::group(array('prefix' => 'profil'), function (){
				Route::group(array('prefix' => 'perusahaan'), function () {
					Route::get('/', 'Nusantara\front\OfficeController@companyProfile')->name('companyProfilePage');
				});

				/*Route::group(array('prefix' => 'visi-misi'), function () {
					Route::get('/', 'Nusantara\front\CompanyVisiMisiController@index')->name('companyVisiMisiPage');
					Route::get('data', 'Nusantara\front\CompanyVisiMisiController@getData')->name('companyVisiMisiPageGetData');
				});*/

				Route::group(array('prefix' => 'sejarah-perusahaan'), function () {
					Route::get('/', 'Nusantara\front\OfficeController@companyHistory')->name('companyHistoryPage');
				});

				Route::group(array('prefix' => 'kantor-cabang'), function () {
					Route::get('{slug}', 'Nusantara\front\OfficeController@branchOffice')->name('branchOfficeDetail');
				});

				Route::group(array('prefix' => 'penghargaan'), function () {
					Route::get('/', 'Nusantara\front\OfficeController@awards')->name('awardsPage');
				});
			});

			Route::group(array('prefix' => 'promosi'), function(){
				
				Route::group(array('prefix' => 'category'), function(){
					Route::get('/', 'Nusantara\front\PromotionController@promotionCategory')->name('promotionCategory');
					Route::get('{slug_category}', 'Nusantara\front\PromotionController@promotion')->name('promotionCategoryList');
					Route::get('detail/{slug}', 'Nusantara\front\PromotionController@promotionDetail')->name('promotionDetail');

				});

				Route::group(array('prefix' => 'booking-service'), function(){
					Route::get('/', 'Nusantara\front\PromotionController@bookingServices')->name('bookingServices');
					Route::get('data', 'Nusantara\front\PromotionController@getDataLocation')->name('getLocationBookingServices');
					Route::post('store', 'Nusantara\front\PromotionController@storeBookingServices')->name('storeBookingServices');
				});

				Route::group(array('prefix' => 'test-drive'), function(){
					Route::get('/', 'Nusantara\front\PromotionController@testDrive')->name('testDrive');
					Route::post('store', 'Nusantara\front\PromotionController@storeBookingTestDrive')->name('storeTestDrive');
				});

			});

			Route::group(array('prefix' => 'karir'), function(){
				Route::get('/', 'Nusantara\front\CairerController@index')->name('carier');
			});

			Route::post('subscribe-mail', 'Nusantara\front\SubscribeMailController@store')->name('subscribeMail');
		});

	});

	Route::group(['domain' => env('DOMAIN_PREFIX_CMS') . env('APP_DOMAIN')], function() 
    {
		Route::get('/', 'Nusantara\cms\AuthController@index')->name('login');
		Route::post('auth', 'Nusantara\cms\AuthController@authenticate')->name('authenticate');
		Route::get('logout', 'Nusantara\cms\AuthController@logout')->name('logout');
		Route::get('dashboard', 'Nusantara\cms\DashboardController@index')->name('CmsDashboard');

		// Booking Services
		Route::group(array('prefix' => 'booking-services' ), function(){
			Route::get('/', 'Nusantara\cms\reservation\BookingServicesController@index')->name('BookingServices');
			Route::get('data', 'Nusantara\cms\reservation\BookingServicesController@getData')->name('getDataBookingServices');
			Route::post('store', 'Nusantara\cms\reservation\BookingServicesController@store')->name('storeBookingServices');
			Route::post('show', 'Nusantara\cms\reservation\BookingServicesController@showData')->name('showDataBookingServices');
			Route::get('search', 'Nusantara\cms\reservation\BookingServicesController@searchData')->name('searchBookingServices');
		});

		// Static Page

		Route::group(array('prefix' => 'static-page' ), function(){
			Route::get('/', 'Nusantara\cms\pages\StaticPageController@index')->name('StaticPage');
			Route::get('data', 'Nusantara\cms\pages\StaticPageController@getData')->name('StaticPageGetData');
			Route::post('store', 'Nusantara\cms\pages\StaticPageController@store')->name('StoreStaticPage');
			Route::post('edit', 'Nusantara\cms\pages\StaticPageController@edit')->name('EditStaticPage');
			Route::post('change-status', 'Nusantara\cms\pages\StaticPageController@changeStatus')->name('ChangeStatusStaticPage');
		});

		// Main Banner

		Route::group(array('prefix' => 'main-banner' ), function(){
			Route::get('/', 'Nusantara\cms\pages\MainBannerController@index')->name('MainBanner');
			Route::get('data', 'Nusantara\cms\pages\MainBannerController@getData')->name('MainBannerGetData');
			Route::post('store', 'Nusantara\cms\pages\MainBannerController@store')->name('StoreMainBanner');
			Route::post('edit', 'Nusantara\cms\pages\MainBannerController@edit')->name('EditMainBanner');
			Route::post('change-status', 'Nusantara\cms\pages\MainBannerController@changeStatus')->name('ChangeStatusMainBanner');
			Route::post('order', 'Nusantara\cms\pages\MainBannerController@order')->name('OrderMainBanner');
			Route::post('delete', 'Nusantara\cms\pages\MainBannerController@delete')->name('DeleteMainBanner');
		});

		// Branch Office

		Route::group(array('prefix' => 'branch-office' ), function(){
			Route::get('/', 'Nusantara\cms\pages\BranchOfficeController@index')->name('BranchOffice');
			Route::get('data', 'Nusantara\cms\pages\BranchOfficeController@getData')->name('GetDataBranchOffice');
			Route::post('store', 'Nusantara\cms\pages\BranchOfficeController@store')->name('StoreBranchOffice');
			Route::post('edit', 'Nusantara\cms\pages\BranchOfficeController@edit')->name('EditBranchOffice');
			Route::post('order', 'Nusantara\cms\pages\BranchOfficeController@order')->name('OrderDataBranchOffice');
			Route::post('change-status', 'Nusantara\cms\pages\BranchOfficeController@changeStatus')->name('ChangeStatusBranchOffice');
			Route::post('delete', 'Nusantara\cms\pages\BranchOfficeController@delete')->name('DeleteBranchOffice');

			Route::post('edit-slider', 'Nusantara\cms\pages\BranchOfficeController@editImageSlider')->name('BranchOfficeEditImageSlider');
			Route::post('delete-image-slider', 'Nusantara\cms\pages\BranchOfficeController@deleteImageSlider')->name('DeleteImageSliderBranchOffice');
			
			Route::post('delete-office-detail', 'Nusantara\cms\pages\BranchOfficeController@deleteOfficeDetail')->name('DeleteDetailBranchOffice');
		});

		// Awards

		Route::group(array('prefix' => 'awards' ), function(){
			Route::get('/', 'Nusantara\cms\pages\AwardsController@index')->name('Awards');
			Route::get('data', 'Nusantara\cms\pages\AwardsController@getData')->name('AwardsGetData');

			Route::post('store', 'Nusantara\cms\pages\AwardsController@store')->name('AwardsStore');
			Route::post('store-banner', 'Nusantara\cms\pages\AwardsController@storeBanner')->name('AwardsStoreBanner');

			Route::post('edit', 'Nusantara\cms\pages\AwardsController@edit')->name('AwardsEditData');
			Route::post('edit-banner', 'Nusantara\cms\pages\AwardsController@editBanner')->name('AwardsEditBanner');

			Route::post('order', 'Nusantara\cms\pages\AwardsController@order')->name('AwardsOrderData');
			Route::post('order-banner', 'Nusantara\cms\pages\AwardsController@orderBanner')->name('AwardsOrderBanner');

			Route::post('change-status', 'Nusantara\cms\pages\AwardsController@changeStatus')->name('AwardsChangeStatus');
			Route::post('change-status-banner', 'Nusantara\cms\pages\AwardsController@changeStatusBanner')->name('AwardsChangeStatusBanner');

			Route::post('delete', 'Nusantara\cms\pages\AwardsController@delete')->name('AwardsDeleteData');
			Route::post('delete-banner', 'Nusantara\cms\pages\AwardsController@deleteBanner')->name('AwardsDeleteBanner');

		});
    	
    });
});