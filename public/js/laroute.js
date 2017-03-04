(function () {

    var laroute = (function () {

        var routes = {

            absolute: false,
            rootUrl: 'http://127.0.0.1/',
            routes : [{"host":"","methods":["GET","HEAD"],"uri":"api\/user","name":null,"action":"Closure"},{"host":"","methods":["GET","HEAD"],"uri":"\/","name":"homePage","action":"App\Http\Controllers\Front\LandingController@index"},{"host":"","methods":["GET","HEAD"],"uri":"contact-us","name":"contactUsPage","action":"App\Http\Controllers\Front\ContactUsController@index"},{"host":"","methods":["GET","HEAD"],"uri":"contact-us\/data","name":"GetDataDontactUsPage","action":"App\Http\Controllers\Front\ContactUsController@getData"},{"host":"","methods":["POST"],"uri":"contact-us\/create","name":"contactUsPageStore","action":"App\Http\Controllers\Front\ContactUsController@store"},{"host":"","methods":["GET","HEAD"],"uri":"berita","name":"newsPage","action":"App\Http\Controllers\Front\NewsController@index"},{"host":"","methods":["GET","HEAD"],"uri":"berita\/data","name":"GetDataNewsPage","action":"App\Http\Controllers\Front\NewsController@getData"},{"host":"","methods":["GET","HEAD"],"uri":"event\/category\/{slug}","name":"categoryEvent","action":"App\Http\Controllers\Front\ServiceController@category"},{"host":"","methods":["GET","HEAD"],"uri":"event\/{slug}","name":"detailEvent","action":"App\Http\Controllers\Front\ServiceController@detail"},{"host":"","methods":["GET","HEAD"],"uri":"profil\/perusahaan","name":"companyProfilePage","action":"App\Http\Controllers\Front\CompanyProfileController@index"},{"host":"","methods":["GET","HEAD"],"uri":"profil\/visi-misi","name":"companyVisiMisiPage","action":"App\Http\Controllers\Front\CompanyVisiMisiController@index"},{"host":"","methods":["GET","HEAD"],"uri":"profil\/visi-misi\/data","name":"companyVisiMisiPageGetData","action":"App\Http\Controllers\Front\CompanyVisiMisiController@getData"},{"host":"","methods":["GET","HEAD"],"uri":"profil\/sejarah-perusahaan","name":"companyHistoryPage","action":"App\Http\Controllers\Front\CompanyHistoryController@index"},{"host":"","methods":["GET","HEAD"],"uri":"profil\/kantor-cabang\/{slug}","name":"branchOfficeDetail","action":"App\Http\Controllers\Front\CompanyBranchOfficeController@getDetail"},{"host":"","methods":["GET","HEAD"],"uri":"profil\/penghargaan","name":"awardsPage","action":"App\Http\Controllers\Front\AwardsController@index"},{"host":"","methods":["GET","HEAD"],"uri":"promosi\/category","name":"promotionCategory","action":"App\Http\Controllers\Front\PromotionController@promotionCategory"},{"host":"","methods":["GET","HEAD"],"uri":"promosi\/category\/{slug_category}","name":"promotionCategoryList","action":"App\Http\Controllers\Front\PromotionController@promotion"},{"host":"","methods":["GET","HEAD"],"uri":"promosi\/category\/detail\/{slug}","name":"promotionDetail","action":"App\Http\Controllers\Front\PromotionController@promotionDetail"},{"host":"","methods":["GET","HEAD"],"uri":"promosi\/booking-service","name":"bookingServices","action":"App\Http\Controllers\Front\PromotionController@bookingServices"},{"host":"","methods":["GET","HEAD"],"uri":"promosi\/booking-service\/data","name":"getLocationBookingServices","action":"App\Http\Controllers\Front\PromotionController@getDataLocation"},{"host":"","methods":["POST"],"uri":"promosi\/booking-service\/store","name":"storeBookingServices","action":"App\Http\Controllers\Front\PromotionController@storeBookingServices"},{"host":"","methods":["GET","HEAD"],"uri":"promosi\/test-drive","name":"testDrive","action":"App\Http\Controllers\Front\PromotionController@testDrive"},{"host":"","methods":["POST"],"uri":"promosi\/test-drive\/store","name":"storeTestDrive","action":"App\Http\Controllers\Front\PromotionController@storeBookingTestDrive"},{"host":"","methods":["GET","HEAD"],"uri":"karir","name":"carier","action":"App\Http\Controllers\Front\CairerController@index"},{"host":"","methods":["POST"],"uri":"subscribe-mail","name":"subscribeMail","action":"App\Http\Controllers\Front\SubscribeMailController@store"},{"host":"","methods":["GET","HEAD"],"uri":"cms","name":"login","action":"App\Http\Controllers\Cms\AuthController@index"},{"host":"","methods":["POST"],"uri":"cms\/auth","name":"authenticate","action":"App\Http\Controllers\Cms\AuthController@authenticate"},{"host":"","methods":["GET","HEAD"],"uri":"cms\/logout","name":"logout","action":"App\Http\Controllers\Cms\AuthController@logout"},{"host":"","methods":["GET","HEAD"],"uri":"cms\/dashboard","name":"CmsDashboard","action":"App\Http\Controllers\Cms\DashboardController@index"},{"host":"","methods":["GET","HEAD"],"uri":"cms\/static-page","name":"StaticPage","action":"App\Http\Controllers\Cms\pages\StaticPageController@index"},{"host":"","methods":["GET","HEAD"],"uri":"cms\/static-page\/data","name":"StaticPageGetData","action":"App\Http\Controllers\Cms\pages\StaticPageController@getData"},{"host":"","methods":["POST"],"uri":"cms\/static-page\/store","name":"StoreStaticPage","action":"App\Http\Controllers\Cms\pages\StaticPageController@store"},{"host":"","methods":["POST"],"uri":"cms\/static-page\/edit","name":"EditStaticPage","action":"App\Http\Controllers\Cms\pages\StaticPageController@edit"},{"host":"","methods":["POST"],"uri":"cms\/static-page\/change-status","name":"ChangeStatusStaticPage","action":"App\Http\Controllers\Cms\pages\StaticPageController@changeStatus"},{"host":"","methods":["GET","HEAD"],"uri":"cms\/main-banner","name":"MainBanner","action":"App\Http\Controllers\Cms\pages\MainBannerController@index"},{"host":"","methods":["GET","HEAD"],"uri":"cms\/main-banner\/data","name":"MainBannerGetData","action":"App\Http\Controllers\Cms\pages\MainBannerController@getData"},{"host":"","methods":["POST"],"uri":"cms\/main-banner\/store","name":"StoreMainBanner","action":"App\Http\Controllers\Cms\pages\MainBannerController@store"},{"host":"","methods":["POST"],"uri":"cms\/main-banner\/edit","name":"EditMainBanner","action":"App\Http\Controllers\Cms\pages\MainBannerController@edit"},{"host":"","methods":["POST"],"uri":"cms\/main-banner\/change-status","name":"ChangeStatusMainBanner","action":"App\Http\Controllers\Cms\pages\MainBannerController@changeStatus"},{"host":"","methods":["POST"],"uri":"cms\/main-banner\/delete","name":"DeleteMainBanner","action":"App\Http\Controllers\Cms\pages\MainBannerController@delete"}],
            prefix: '',

            route : function (name, parameters, route) {
                route = route || this.getByName(name);

                if ( ! route ) {
                    return undefined;
                }

                return this.toRoute(route, parameters);
            },

            url: function (url, parameters) {
                parameters = parameters || [];

                var uri = url + '/' + parameters.join('/');

                return this.getCorrectUrl(uri);
            },

            toRoute : function (route, parameters) {
                var uri = this.replaceNamedParameters(route.uri, parameters);
                var qs  = this.getRouteQueryString(parameters);

                if (this.absolute && this.isOtherHost(route)){
                    return "//" + route.host + "/" + uri + qs;
                }

                return this.getCorrectUrl(uri + qs);
            },

            isOtherHost: function (route){
                return route.host && route.host != window.location.hostname;
            },

            replaceNamedParameters : function (uri, parameters) {
                uri = uri.replace(/\{(.*?)\??\}/g, function(match, key) {
                    if (parameters.hasOwnProperty(key)) {
                        var value = parameters[key];
                        delete parameters[key];
                        return value;
                    } else {
                        return match;
                    }
                });

                // Strip out any optional parameters that were not given
                uri = uri.replace(/\/\{.*?\?\}/g, '');

                return uri;
            },

            getRouteQueryString : function (parameters) {
                var qs = [];
                for (var key in parameters) {
                    if (parameters.hasOwnProperty(key)) {
                        qs.push(key + '=' + parameters[key]);
                    }
                }

                if (qs.length < 1) {
                    return '';
                }

                return '?' + qs.join('&');
            },

            getByName : function (name) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].name === name) {
                        return this.routes[key];
                    }
                }
            },

            getByAction : function(action) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].action === action) {
                        return this.routes[key];
                    }
                }
            },

            getCorrectUrl: function (uri) {
                var url = this.prefix + '/' + uri.replace(/^\/?/, '');

                if ( ! this.absolute) {
                    return url;
                }

                return this.rootUrl.replace('/\/?$/', '') + url;
            }
        };

        var getLinkAttributes = function(attributes) {
            if ( ! attributes) {
                return '';
            }

            var attrs = [];
            for (var key in attributes) {
                if (attributes.hasOwnProperty(key)) {
                    attrs.push(key + '="' + attributes[key] + '"');
                }
            }

            return attrs.join(' ');
        };

        var getHtmlLink = function (url, title, attributes) {
            title      = title || url;
            attributes = getLinkAttributes(attributes);

            return '<a href="' + url + '" ' + attributes + '>' + title + '</a>';
        };

        return {
            // Generate a url for a given controller action.
            // laroute.action('HomeController@getIndex', [params = {}])
            action : function (name, parameters) {
                parameters = parameters || {};

                return routes.route(name, parameters, routes.getByAction(name));
            },

            // Generate a url for a given named route.
            // laroute.route('routeName', [params = {}])
            route : function (route, parameters) {
                parameters = parameters || {};

                return routes.route(route, parameters);
            },

            // Generate a fully qualified URL to the given path.
            // laroute.route('url', [params = {}])
            url : function (route, parameters) {
                parameters = parameters || {};

                return routes.url(route, parameters);
            },

            // Generate a html link to the given url.
            // laroute.link_to('foo/bar', [title = url], [attributes = {}])
            link_to : function (url, title, attributes) {
                url = this.url(url);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given route.
            // laroute.link_to_route('route.name', [title=url], [parameters = {}], [attributes = {}])
            link_to_route : function (route, title, parameters, attributes) {
                var url = this.route(route, parameters);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given controller action.
            // laroute.link_to_action('HomeController@getIndex', [title=url], [parameters = {}], [attributes = {}])
            link_to_action : function(action, title, parameters, attributes) {
                var url = this.action(action, parameters);

                return getHtmlLink(url, title, attributes);
            }

        };

    }).call(this);

    /**
     * Expose the class either via AMD, CommonJS or the global object
     */
    if (typeof define === 'function' && define.amd) {
        define(function () {
            return laroute;
        });
    }
    else if (typeof module === 'object' && module.exports){
        module.exports = laroute;
    }
    else {
        window.laroute = laroute;
    }

}).call(this);

