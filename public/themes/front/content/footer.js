Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");
new Vue({
	el: '#footer-content-js',
    data: {
        models: {
        	email : '',
        },
        formAttr: {"email": ""},
    },
    methods: {

        storeSubscribe: function(){
            var config_notif = [
                toastr.options.showMethod = 'slideDown',
                toastr.options.closeButton = true,
                toastr.options.newestOnTop = false,
            ];
        	var input = this.formAttr;
            this.$http.post('/subscribe-mail',input).then((response) => {
                if (response.data.success == false) {
                    $.each(response.data.errors, function(input, value){
                        $('input[name="' + input + '"]').focus();
                        $("#form--error--message--" + input).text(value);
                        
                    });
                    this.config_notif;
                    toastr.error('Gagal menyimpan data !!')
                }
                else
                {
                    this.resetForm()
                    this.clearErorrMessage()
                    this.config_notif;
                    toastr.success('Subscribe berhasil');
                }
                
            },(response) => {
                this.formErrors = response.data;
            });
        },

        clearErorrMessage: function(){
            $(".form--error--message").text('')
        },
        
        resetForm: function(){
        	this.formAttr.email = ''
        }

    },
});