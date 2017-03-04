//true devtools and config vue js
Vue.config.devtools = true;
Vue.config.debug = true;
//end true devtools and config vue js

//vue custome directive sortable js https://github.com/RubaXa/Sortable

Vue.directive("sort", {
    bind: function(){
        $(this.el).sortable({
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
        }) // fin sortable
    },
    update: function (value) {
            $(this.el).val(value).trigger('drop')
        },
    unbind: function () {
        $(this.el).off().sortable('destroy')
    }
})

//end vue custome directive sortable js


function property() {
    $('.btn__add').click(function()
    {
        var btn = $(this);
        var text = $(this).html();
        
        btn.removeClass('btn__add').addClass('btn__add btn__disable');
        //$('.new__form__input__field').val("");
        btn.parent().closest('.main__wrapper__content').find('.main__content__form__layer').slideDown(400);
    });

    $('.btn__add__cancel').click(function()
    {
        var btn = $(this);
        var text = $(this).html();
        
        btn.removeClass('btn__add__cancel').addClass('btn__add__cancel');
        $('.btn__disable').removeClass('btn__disable');
        $('.new__form__input__field').val("");
        btn.parent().closest('.main__wrapper__content').find('.main__content__form__layer').slideUp(400);
    });

}

function setupCKEDITOR(){
	$(document).ready(function(){

		Vue.directive('rich-editor', {
	        twoWay: true,
	        /*bind: function () {
	            Vue.nextTick(this.setupEditor.bind(this));
	        },*/
	        bind: function () {
	            var self = this;
	            CKEDITOR.replace(this.el.id);
	            CKEDITOR.instances[this.el.id].setData(this);
	            CKEDITOR.instances[this.el.id].on('change', function () {
	                self.set(CKEDITOR.instances[self.el.id].getData());
	            });
	        },
	        setupEditor: function () {
	            // if (!document.contains(this.el))
	            //    return Vue.nextTick(this.bind.bind(this));
	            var vm = this;
	            CKEDITOR.replace(this.el.id);
	            CKEDITOR.instances[this.el.id].on('change', function () {
	                vm.set(CKEDITOR.instances[vm.el.id].getData());
	            });
	        },
	        update: function (value) {
	            if (!CKEDITOR.instances[this.el.id])
	                return Vue.nextTick(this.update.bind(this, value));
	            CKEDITOR.instances[this.el.id].setData(value);
	        },
	        unbind: function () {
	            CKEDITOR.instances[this.el.id].destroy();
	        }
	    })
	});
}

function pushNotifMessage(status,message, validation)
{
    
    var time = '10000';
    var container = $('.notifyjs-corner');
    var message_error_title = 'Sorry, there are few missing contents detected, please complete all the required fields.';

    if(status == true)
    {
        $('.notifyjs-corner').removeClass('hidden');
        $('.notif__form').addClass('notif__success');
        $("#data-value").text(message);
        $('.notifyjs-corner').slideDown(400).fadeIn('slow');
    }
    else
    {
        $('.notifyjs-corner').removeClass('hidden');
        $('.notif__form').addClass('notif__error');
        $("#data-value").text(message_error_title);
        $("#data-validation").html(validation);
        $('.notifyjs-corner').slideDown(400).fadeIn('slow');
    }

    function remove_notice() {
        container.stop().fadeOut('slow').remove()
    }
    
    var timer =  setInterval(remove_notice, time);
}

function pushNotifV2(status, title, message, autoHide, position)
{
    if (typeof autoHide == 'undefined') {
        autoHide = true
    }

    if (typeof title == 'undefined' || title == '' || title == 'default') {
        title = 'Sorry, there are few missing contents detected, please complete all the required fields.'
    }

    if (typeof position == 'undefined') {
        position = 'bottom left'
    }

    var className = '';
    if (status == false) {
        var className = 'error';
    }

    $.notify({
        title: title,
        message: message,
    }, {
        style: 'notif-msg',
        autoHide: autoHide,
        clickToHide: false,
        position: position,
        className: className
    });
}


function showLoadingData()
{
    var options = {
        theme:"sk-cube-grid",
        textColor:"white"
    };
    HoldOn.open(options);
}

function hideLoading()
{
    HoldOn.close();
}

function replaceToCkEditor()
{
	$(".ckeditor").each(function(){
        CKEDITOR.replace( $(this).attr('id') );
    });

}

function destroyInstanceCkEditor()
{
    for (instance in CKEDITOR.instances) {
        if (CKEDITOR.instances[instance]) {
            CKEDITOR.instances[instance].destroy(true);
        }
    }
}

function showModalDelete()
{
    swal({
        title: "Ajax request example",
        text: "Submit to run ajax request",
        type: "info",
        showCancelButton: true,
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
    },
    function(){
        setTimeout(function(){
            swal("Ajax request finished!");
        }, 2000);
    });
}

function mainGeneral(){
    notify();
}

// INIT FUNCTION WEB CMS
function initBookingServices()
{
    crudBookingServices();
    buttonClickOpen();
    buttonClickClose();
}

function initStaticPage()
{
    crudStaticPage();
    buttonClickOpen();
    buttonClickClose();
    replaceToCkEditor();
}

function initMainBanner()
{
    crudMainBanner();
    buttonClickOpen();
    buttonClickClose();
    replaceToCkEditor();
}

function initBranchOffice()
{
    crudBranchOffice();
    buttonClickOpen();
    buttonClickClose();
    replaceToCkEditor();
}