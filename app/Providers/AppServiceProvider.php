<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\Contracts\Front\MainBanner', 'App\Repositories\Implementation\Front\MainBanner');
        $this->app->bind('App\Repositories\Contracts\Front\LandingPage', 'App\Repositories\Implementation\Front\LandingPage');
        $this->app->bind('App\Repositories\Contracts\Front\FooterContent', 'App\Repositories\Implementation\Front\FooterContent');
        $this->app->bind('App\Repositories\Contracts\Front\BranchOffice', 'App\Repositories\Implementation\Front\BranchOffice');
        $this->app->bind('App\Repositories\Contracts\Front\Awards', 'App\Repositories\Implementation\Front\Awards');
        $this->app->bind('App\Repositories\Contracts\Front\Service', 'App\Repositories\Implementation\Front\Service');
        $this->app->bind('App\Repositories\Contracts\Front\CompanyProfile', 'App\Repositories\Implementation\Front\CompanyProfile');
        $this->app->bind('App\Repositories\Contracts\Front\PromotionContent', 'App\Repositories\Implementation\Front\PromotionContent');
        $this->app->bind('App\Repositories\Contracts\Front\Carier', 'App\Repositories\Implementation\Front\Carier');
        $this->app->bind('App\Repositories\Contracts\Front\CompanyHistory', 'App\Repositories\Implementation\Front\CompanyHistory');
        $this->app->bind('App\Repositories\Contracts\Front\Subscribe', 'App\Repositories\Implementation\Front\Subscribe');


        
        $this->app->bind('App\Repositories\Contracts\Auth\User', 'App\Repositories\Implementation\Auth\User');
        $this->app->bind('App\Repositories\Contracts\Cms\StaticPage', 'App\Repositories\Implementation\Cms\StaticPage');
        $this->app->bind('App\Repositories\Contracts\Cms\MainBanner', 'App\Repositories\Implementation\Cms\MainBanner');
        $this->app->bind('App\Repositories\Contracts\Cms\BookingServices', 'App\Repositories\Implementation\Cms\BookingServices');
        $this->app->bind('App\Repositories\Contracts\Cms\BranchOffice', 'App\Repositories\Implementation\Cms\BranchOffice');
        $this->app->bind('App\Repositories\Contracts\Cms\Awards', 'App\Repositories\Implementation\Cms\Awards');
        $this->app->bind('App\Repositories\Contracts\Cms\PromotionCategory', 'App\Repositories\Implementation\Cms\PromotionCategory');
        $this->app->bind('App\Repositories\Contracts\Cms\Promotion', 'App\Repositories\Implementation\Cms\Promotion');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array(
            'App\Repositories\Contracts\Front\MainBanner',
            'App\Repositories\Contracts\Front\LandingPage',
            'App\Repositories\Contracts\Front\FooterContent',
            'App\Repositories\Contracts\Front\BranchOffice',
            'App\Repositories\Contracts\Front\Awards',
            'App\Repositories\Contracts\Front\Service',
            'App\Repositories\Contracts\Front\CompanyProfile',
            'App\Repositories\Contracts\Front\PromotionContent',
            'App\Repositories\Contracts\Front\Carier',
            'App\Repositories\Contracts\Front\CompanyHistory',
            'App\Repositories\Contracts\Auth\User',
            'App\Repositories\Contracts\Front\Subscribe',
            
            'App\Repositories\Contracts\Cms\StaticPage',
            'App\Repositories\Contracts\Cms\MainBanner',
            'App\Repositories\Contracts\Cms\BookingServices',
            'App\Repositories\Contracts\Cms\BranchOffice',
            'App\Repositories\Contracts\Cms\Awards',
            'App\Repositories\Contracts\Cms\PromotionCategory',
            'App\Repositories\Contracts\Cms\Promotion',
        );
    }
}
