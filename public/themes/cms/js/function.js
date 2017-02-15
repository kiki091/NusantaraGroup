function buttonClickOpen() {
    $('.content__btn a').click(function(){
        var id = $(this).attr('id');
        $('#'+ id + '-content').slideDown(400);
        $('.content__btn a').removeClass('btn__disable');
        $(this).addClass('btn__disable');
        $('.main__content__form__layer').not($('#'+ id + '-content')).slideUp(400);


        var filter = $('#filter-function');
        filter.fadeOut(400);
    });
}
function buttonClickClose() {
    $('.btn__add__cancel a').removeClass('btn__disable');
    $(this).closest('.main__content__form__layer').slideUp(400);
}
