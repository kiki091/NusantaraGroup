function menuStaticPage()
{
    $('.right_col').load(laroute.url('/cms/static-page', []), function()
    {
    	initStaticPage()
        console.log('menu runing')
    });


}