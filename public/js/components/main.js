$(document).ready(function(){
  //vue();
  //dragOrderTable();
});

/* BUTTON SHOW CARD PHOTO UPLOADER */
$(document).on('click', '.upload__img__show__preview', function(){
    var id = $(this).attr('id');
    // add class di container saat popup
    $('.container__main').addClass('popupContainer');
    $('body').addClass('popup__upload__preview__container');
    $('#'+ id + '-popup').fadeIn(200);
});

/* BUTTON CLOSE PREVIEW CARD PHOTO UPLOADER */
$(document).on('click', '.img__preview__big__close', function(){
    $(this).parents('.img__preview__overlay').fadeOut(200);

    // remove class di container saat close popup
    setTimeout(function() {
        $('.container__main').removeClass('popupContainer');
        $('body').removeClass('popup__upload__preview__container');
    }, 200);
});

function dragOrderTable() {
	
	//Make diagnosis table sortable
	$(".sortable").sortable({
		    axis: 'y',
        opacity: 0.7,
        handle: '.handle',
        placeholder: 'plcehldr',
        start: function(ev, ui){
          isMoved = false;
          init_X = cX = ev.pageX;
          init_Y = cY = ev.pageY;
          sortingEl = ui.item;
          placeholderEl = ui.placeholder;
          sortingEl.addClass("sort-el").siblings().addClass("sort-items sort-trans");
          sortingItems = $(this).find('.sort-items');
          $(this).addClass("sort-active");
          sort_items_length = sortingItems.length;
          if (!isMoved) {
          minTop = sortingEl[0].offsetTop;
            maxTop = sortingEl.parent().outerHeight() - minTop - sortingEl.outerHeight();
            sortingElHeight = sortingEl.outerHeight()+5; // 3 is[margin(top+bottom)/2]
          }
        },
        sort: function(ev,ui){
          isMoved = true;
          cX = ev.pageX;
          cY = ev.pageY;
          new_Y =  cY - init_Y;

          if (new_Y < -minTop){
            new_Y = -minTop;
          }
          if (new_Y > maxTop){
            new_Y = maxTop;
          }
          sortingEl.css({"transform":"translateY("+new_Y+"px)"});

          sortingItems.each(function () {
            var currentEl = $(this);
            if (currentEl[0] === sortingEl[0]) return;
            var currentElOffset = currentEl[0].offsetTop;
            var currentElHeight = currentEl.outerHeight();
            var sortingElOffset = sortingEl[0].offsetTop + new_Y;

            if ((sortingElOffset >= currentElOffset - currentElHeight / 2) && sortingEl.index() < currentEl.index()) {
              currentEl.css({"transform":"translateY(-"+sortingElHeight+"px)"});
              placeholderEl.insertAfter(currentEl);
            }
            else if ((sortingElOffset <= currentElOffset + currentElHeight / 2) && sortingEl.index() > currentEl.index()) {
            currentEl.css({"transform":"translateY("+sortingElHeight+"px)"});
              placeholderEl.insertBefore(currentEl);
              return false;
            }
            else {
              $(this).css({"transform":"translateY(0px)"});
            }
          });
        },
        stop: function(ev,ui){
          $(this).removeClass("sort-active");
          isMoved = false;
          sortingEl.removeAttr("style").removeClass("sort-el");
          sortingItems.removeClass("sort-trans sort-items").removeAttr("style");
        }
	});
}