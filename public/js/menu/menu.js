function menuBookingServices()
{
    $('.right_col').load(laroute.url('/cms/booking-services', []), function()
    {
    	initBookingServices()
    });
}

function menuStaticPage()
{
    $('.right_col').load(laroute.url('/cms/static-page', []), function()
    {
    	initStaticPage()
    });
}

function menuMainBanner()
{
    $('.right_col').load(laroute.url('/cms/main-banner', []), function()
    {
    	initMainBanner()
    });
}

function menuBranchOffice()
{
    $('.right_col').load(laroute.url('/cms/branch-office', []), function()
    {
        initBranchOffice()
    });
}