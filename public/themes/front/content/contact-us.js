Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");
new Vue({
    el: '#app-contact-us',
    data: {
        models: {
        	title : '',
            subtitle : '',
            address : '',
            call_center : '',
            mail : '',
            longitute : '',
            latitude : '',
            meta_title : '',
            meta_keyword : '',
            meta_description : '',
    	},
    	formAttr: {"firstname": "", "lastname": "", "email": "", "subject": "", "message": ""},
    	formErrors : {},

    },
    methods: {
        getData: function(){
            this.$http.get('/contact-us/data').then((response) => {
                this.$set('pageContactUs', response.data);
            });
        },

    	storeData: function(){
    		var input = this.formAttr;
            this.$http.post('/contactUsFormInput',input).then((response) => {
                if (response.data.success == false) {
                    $.each(response.data.errors, function(input, value){
                        $('input[name="' + input + '"]').focus();
                        $("#form--error--message--" + input).text(value);
                        
                    });
                    toastr.error('Gagal menyimpan data !!', {timeOut: 5000})
                }
                else
                {
                    this.getData();
                    this.resetForm();
                    toastr.success('Submit successfully.', 'Success Alert', {timeOut: 5000});
                }
                
            },(response) => {
                this.formErrors = response.data;
            });
    	},
        resetForm: function(){
            this.formAttr.firstname = ''
            this.formAttr.lastname = ''
            this.formAttr.email = ''
            this.formAttr.subject = ''
            this.formAttr.message = ''
        }
    },
    ready: function () {
        this.getData()
    }
});