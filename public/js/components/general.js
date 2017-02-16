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

function pushNotif(status, message, autoHide, position)
{
    if (typeof autoHide == 'undefined') {
        autoHide = true
    }

    if (typeof position == 'undefined') {
        position = 'bottom left'
    }

    var className = '';
    if (status == false) {
        var className = 'error';
    }
    $.notify({
        title: message
    }, {
        style: 'foo',
        autoHide: autoHide,
        clickToHide: false,
        position: position,
        className: className
    });
}

function pushNotifErrorMessage()
{
	var time = '5000';
	var container = $('.notifyjs-corner');

    $('.notifyjs-corner').removeClass('hidden');
    $('.notifyjs-corner').slideDown(400).fadeIn('slow');

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

function initStaticPage()
{
    crudStaticPage();
    replaceToCkEditor();
}