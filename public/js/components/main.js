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

$(document).ready(function() {
  var cnt = 10;

  TabbedNotification = function(options) {
    var message = "<div id='ntf" + cnt + "' class='text alert-" + options.type + "' style='display:none'><h2> " + options.title +
      "</h2><div class='close'><a href='javascript:;' class='notification_close'><i class='fa fa-close'></i></a></div><p>" + options.text + "</p></div>";

    if (!document.getElementById('custom_notifications')) {
      alert('doesnt exists');
    } else {
      $('#custom_notifications #notif-group').append(message);
      cnt++;
      CustomTabs(options);
    }
  };

  CustomTabs = function(options) {
    $('.tabbed_notifications > div').hide();
    $('.tabbed_notifications > div:first-of-type').show();
    $('#custom_notifications').removeClass('dsp_none');
    $('.notifications a').click(function(e) {
      e.preventDefault();
      var $this = $(this),
        tabbed_notifications = '#' + $this.parents('.notifications').data('tabbed_notifications'),
        others = $this.closest('li').siblings().children('a'),
        target = $this.attr('href');
      others.removeClass('active');
      $this.addClass('active');
      $(tabbed_notifications).children('div').hide();
      $(target).show();
    });
  };

  CustomTabs();

  var tabid = idname = '';

  $(document).on('click', '.notification_close', function(e) {
    idname = $(this).parent().parent().attr("id");
    tabid = idname.substr(-2);
    $('#ntf' + tabid).remove();
    $('.notifications a').first().addClass('active');
    $('#notif-group div').first().css('display', 'block');
  });
});