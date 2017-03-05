<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['middleware' => ['web']], function () 
{
    Route::group(['domain' => env('WORLD_WIDE_WEB') . env('DOMAIN_PREFIX') . env('APP_DOMAIN')], function() 
    {
		Route::get('/', 'Front\LandingController@index')->name('homePage');

		Route::group(array('prefix' => 'contact-us'), function (){
			Route::get('/', 'Front\ContactUsController@index')->name('contactUsPage');
			Route::get('data', 'Front\ContactUsController@getData')->name('GetDataDontactUsPage');
			Route::post('create', 'Front\ContactUsController@store')->name('contactUsPageStore');
		});

		Route::group(array('prefix' => 'berita'), function (){
			Route::get('/', 'Front\NewsController@index')->name('newsPage');
			Route::get('data', 'Front\NewsController@getData')->name('GetDataNewsPage');
		});


		Route::group(array('prefix' => 'event'), function (){
			Route::get('category/{slug}', 'Front\ServiceController@category')->name('categoryEvent');
			Route::get('{slug}', 'Front\ServiceController@detail')->name('detailEvent');
		});

		Route::group(array('prefix' => 'profil'), function (){
			Route::group(array('prefix' => 'perusahaan'), function () {
				Route::get('/', 'Front\CompanyProfileController@index')->name('companyProfilePage');
			});

			Route::group(array('prefix' => 'visi-misi'), function () {
				Route::get('/', 'Front\CompanyVisiMisiController@index')->name('companyVisiMisiPage');
				Route::get('data', 'Front\CompanyVisiMisiController@getData')->name('companyVisiMisiPageGetData');
			});

			Route::group(array('prefix' => 'sejarah-perusahaan'), function () {
				Route::get('/', 'Front\CompanyHistoryController@index')->name('companyHistoryPage');
			});

			Route::group(array('prefix' => 'kantor-cabang'), function () {
				Route::get('{slug}', 'Front\CompanyBranchOfficeController@getDetail')->name('branchOfficeDetail');
			});

			Route::group(array('prefix' => 'penghargaan'), function () {
				Route::get('/', 'Front\AwardsController@index')->name('awardsPage');
			});
		});

		Route::group(array('prefix' => 'promosi'), function(){
			
			Route::group(array('prefix' => 'category'), function(){
				Route::get('/', 'Front\PromotionController@promotionCategory')->name('promotionCategory');
				Route::get('{slug_category}', 'Front\PromotionController@promotion')->name('promotionCategoryList');
				Route::get('detail/{slug}', 'Front\PromotionController@promotionDetail')->name('promotionDetail');

			});

			Route::group(array('prefix' => 'booking-service'), function(){
				Route::get('/', 'Front\PromotionController@bookingServices')->name('bookingServices');
				Route::get('data', 'Front\PromotionController@getDataLocation')->name('getLocationBookingServices');
				Route::post('store', 'Front\PromotionController@storeBookingServices')->name('storeBookingServices');
			});

			Route::group(array('prefix' => 'test-drive'), function(){
				Route::get('/', 'Front\PromotionController@testDrive')->name('testDrive');
				Route::post('store', 'Front\PromotionController@storeBookingTestDrive')->name('storeTestDrive');
			});

		});

		Route::group(array('prefix' => 'karir'), function(){
			Route::get('/', 'Front\CairerController@index')->name('carier');
		});

		Route::post('subscribe-mail', 'Front\SubscribeMailController@store')->name('subscribeMail');

	});

	Route::group(['domain' => env('DOMAIN_PREFIX_CMS') . env('APP_DOMAIN')], function() 
    {

		Route::group(array('prefix' => 'cms'), function(){
			Route::get('/', 'Cms\AuthController@index')->name('login');
			Route::post('auth', 'Cms\AuthController@authenticate')->name('authenticate');
			Route::get('logout', 'Cms\AuthController@logout')->name('logout');
			Route::get('dashboard', 'Cms\DashboardController@index')->name('CmsDashboard');

			// Booking Services
			Route::group(array('prefix' => 'booking-services' ), function(){
				Route::get('/', 'Cms\pages\BookingServicesController@index')->name('BookingServices');
				Route::get('data', 'Cms\pages\BookingServicesController@getData')->name('getDataBookingServices');
				Route::post('store', 'Cms\pages\BookingServicesController@store')->name('storeBookingServices');
				Route::post('show', 'Cms\pages\BookingServicesController@showData')->name('showDataBookingServices');
				Route::get('search', 'Cms\pages\BookingServicesController@searchData')->name('searchBookingServices');
			});

			// Static Page

			Route::group(array('prefix' => 'static-page' ), function(){
				Route::get('/', 'Cms\pages\StaticPageController@index')->name('StaticPage');
				Route::get('data', 'Cms\pages\StaticPageController@getData')->name('StaticPageGetData');
				Route::post('store', 'Cms\pages\StaticPageController@store')->name('StoreStaticPage');
				Route::post('edit', 'Cms\pages\StaticPageController@edit')->name('EditStaticPage');
				Route::post('change-status', 'Cms\pages\StaticPageController@changeStatus')->name('ChangeStatusStaticPage');
			});

			// Main Banner

			Route::group(array('prefix' => 'main-banner' ), function(){
				Route::get('/', 'Cms\pages\MainBannerController@index')->name('MainBanner');
				Route::get('data', 'Cms\pages\MainBannerController@getData')->name('MainBannerGetData');
				Route::post('store', 'Cms\pages\MainBannerController@store')->name('StoreMainBanner');
				Route::post('edit', 'Cms\pages\MainBannerController@edit')->name('EditMainBanner');
				Route::post('change-status', 'Cms\pages\MainBannerController@changeStatus')->name('ChangeStatusMainBanner');
				Route::post('order', 'Cms\pages\MainBannerController@order')->name('OrderMainBanner');
				Route::post('delete', 'Cms\pages\MainBannerController@delete')->name('DeleteMainBanner');
			});

			// Branch Office

			Route::group(array('prefix' => 'branch-office' ), function(){
				Route::get('/', 'Cms\pages\BranchOfficeController@index')->name('BranchOffice');
				Route::get('data', 'Cms\pages\BranchOfficeController@getData')->name('GetDataBranchOffice');
				Route::post('store', 'Cms\pages\BranchOfficeController@store')->name('StoreBranchOffice');
				Route::post('edit', 'Cms\pages\BranchOfficeController@edit')->name('EditBranchOffice');
				Route::post('order', 'Cms\pages\BranchOfficeController@order')->name('OrderDataBranchOffice');
				Route::post('change-status', 'Cms\pages\BranchOfficeController@changeStatus')->name('ChangeStatusBranchOffice');
				Route::post('delete', 'Cms\pages\BranchOfficeController@delete')->name('DeleteBranchOffice');

				Route::post('edit-slider', 'Cms\pages\BranchOfficeController@editImageSlider')->name('BranchOfficeEditImageSlider');
				Route::post('delete-image-slider', 'Cms\pages\BranchOfficeController@deleteImageSlider')->name('DeleteImageSliderBranchOffice');
				
				Route::post('delete-office-detail', 'Cms\pages\BranchOfficeController@deleteOfficeDetail')->name('DeleteDetailBranchOffice');
			});

			// Awards

			Route::group(array('prefix' => 'awards' ), function(){
				Route::get('/', 'Cms\pages\AwardsController@index')->name('Awards');
				Route::get('data', 'Cms\pages\AwardsController@getData')->name('AwardsGetData');

				Route::post('store', 'Cms\pages\AwardsController@store')->name('AwardsStore');
				Route::post('store-banner', 'Cms\pages\AwardsController@storeBanner')->name('AwardsStoreBanner');

				Route::post('edit', 'Cms\pages\AwardsController@edit')->name('AwardsEditData');
				Route::post('edit-banner', 'Cms\pages\AwardsController@editBanner')->name('AwardsEditBanner');

				Route::post('order', 'Cms\pages\AwardsController@order')->name('AwardsOrderData');
				Route::post('order-banner', 'Cms\pages\AwardsController@orderBanner')->name('AwardsOrderBanner');

				Route::post('change-status', 'Cms\pages\AwardsController@changeStatus')->name('AwardsChangeStatus');
				Route::post('change-status-banner', 'Cms\pages\AwardsController@changeStatusBanner')->name('AwardsChangeStatusBanner');

				Route::post('delete', 'Cms\pages\AwardsController@delete')->name('AwardsDeleteData');
				Route::post('delete-banner', 'Cms\pages\AwardsController@deleteBanner')->name('AwardsDeleteBanner');

			});
		});

	});

	/*Route::group(['domain' => env('DOMAIN_PREFIX_CMS') . env('APP_DOMAIN')], function()
	{
		//Login Group
        Route::group(array('prefix' => 'login'), function () {
            Route::get('/', 'Ayana\Cms\AuthController@index')->name('login');
            Route::post('auth', 'Ayana\Cms\AuthController@authenticate')->name('authenticate');
        });

        //Logout
        Route::get('logout', 'Ayana\Cms\AuthController@logout')->name('logout');

        //Change Password
        Route::post('change-password', 'Ayana\Cms\AuthController@changePassword')->name('changePassword');

	});*/
});

