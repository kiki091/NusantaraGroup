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

		Route::group(array('prefix' => 'cms'), function(){
			Route::get('/', 'Cms\AuthController@index')->name('login');
			Route::post('auth', 'Cms\AuthController@authenticate')->name('authenticate');
			Route::get('logout', 'Cms\AuthController@logout')->name('logout');
			Route::get('dashboard', 'Cms\DashboardController@index')->name('CmsDashboard');

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
				Route::post('delete', 'Cms\pages\MainBannerController@delete')->name('DeleteMainBanner');
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

