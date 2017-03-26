function menuBookingServices()
{
    $('.right_col').load(laroute.url('/booking-services', []), function()
    {
    	initBookingServices()
    });
}

function menuStaticPage()
{
    $('.right_col').load(laroute.url('/static-page', []), function()
    {
    	initStaticPage()
    });
}

function menuMainBanner()
{
    $('.right_col').load(laroute.url('/main-banner', []), function()
    {
    	initMainBanner()
    });
}

function menuBranchOffice()
{
    $('.right_col').load(laroute.url('/branch-office', []), function()
    {
        initBranchOffice()
    });
}

function menuAwards()
{
    $('.right_col').load(laroute.url('/awards', []), function()
    {
        initAwards()
    });
}