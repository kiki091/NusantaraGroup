Vue.http.headers.common['X-CSRF-TOKEN'] = $("#_token").attr("value");
new Vue({
	el: '#footer-content-js',
    data: {
        models: {
        	email : '',
        },
        formAttr: {"email": ""},
    },
    methods: {

        storeSubscribe: function(event){

            var config_notif = [
                toastr.options.showMethod = 'slideDown',
                toastr.options.closeButton = true,
                toastr.options.newestOnTop = false,
            ];
            var vm = this;
            var optForm      = {

                dataType: "json",

                beforeSend: function(){
                    vm.clearErorrMessage()
                },
                success: function(response){
                    if (response.status == false) {
                        if(response.is_error_form_validation) {

                            var message_validation = ''
                            $.each(response.message, function(key, value){
                                $('input[name="' + key.replace(".", "_") + '"]').focus();
                                $("#form--error--message--" + key.replace(".", "_")).text(value)
                            });
                            vm.config_notif
                            toastr.error('Subscribe Failed')

                        } else {
                            vm.config_notif
                            toastr.error('Subscribe Failed')
                        }
                    } else {
                        vm.config_notif
                        vm.resetForm()
                        toastr.success(response.message);
                    }
                },

            };

            $("#desktop-footer-mailing-list-form").ajaxForm(optForm);
            $("#desktop-footer-mailing-list-form").submit();
        },

        clearErorrMessage: function(){
            $(".form--error--message").text('')
        },
        
        resetForm: function(){
        	this.formAttr.email = ''
        }

    },
});