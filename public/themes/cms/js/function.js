function buttonClickOpen() {
    $('.content__btn a').click(function(){
        var id = $(this).attr('id');
        $('#'+ id + '-content').slideDown(400);
        $('.content__btn a').removeClass('btn__disable');
        $(this).addClass('btn__disable');
        $('.main__content__form__layer').not($('#'+ id + '-content')).slideUp(400);

        $('.folder--nav').addClass('folder--hidden');

        var filter = $('#filter-function');
        filter.fadeOut(400);
    });
}
function buttonClickClose() {
    $('.form--top__btn a').click(function(){

        $('.content__btn a').removeClass('btn__disable');
        $(this).closest('.main__content__form__layer').slideUp(400);

        $('.folder--nav').removeClass('folder--hidden');

        var filter = $('#filter-function');
        filter.fadeIn(400);
    });
}
