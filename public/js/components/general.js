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

// INIT FUNCTION WEB CMS

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