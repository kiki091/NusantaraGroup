function crudStaticPage() {
    Vue.http.headers.common['X-CSRF-TOKEN'] = $("#_token").attr("value");
    Vue.use(VueHtml5Editor)

    var controller = new Vue({
    	el: '#static-page',
        data: {
            models: {
            	site_title : '',
                logo_images : '',
                site_name : '',
                favicon_images : '',
                og_title : '',
                og_images : '',
                og_description : '',
                box_wrapper_left : '',
                box_wrapper_center : '',
                box_wrapper_right : '',
                is_active : '',
                meta_title : '',
                meta_keyword : '',
                meta_description : ''
            },
            logo_images : '',
            favicon_images : '',
            og_images : '',
            form_add_title: "Form Static Page",
            responseData: {},
        },
        methods: {

            onImageChange: function(element, e) {
                var files = e.target.files || e.dataTransfer.files

                if (!files.length)
                    return;

                this.models[element] = files[0]
                this.createImage(files[0], element);
            },

            createImage: function(file, setterTo) {
                var image = new Image();
                var reader = new FileReader();
                var vm = this;

                reader.onload = function (e) {
                    vm[setterTo] = e.target.result;
                };
                reader.readAsDataURL(file);
            },

            removeImage: function (variable) {
                this[variable] = '';
                this.models[variable] = ''
            },

            fetchData: function(){
                var domain  = laroute.url('/cms/static-page/data', []);

                    this.$http.get(domain).then(function (response) {
                        if(response.data.status == true) {
                            this.$set('responseData', response.data.data)
                        } else {
                            toastr.error('Gagal !!')
                        }
                    })
            },

            storeData: function(event){

                this.clearErorrMessage();

                var form = new FormData();

                for (var key in this.models) {
                    form.append(key, this.models[key])
                }

                var domain = laroute.url('/cms/static-page/store', []);
                this.$http.post(domain, form, function(response) {
                    if (response.status == false) {
                        if(response.is_error_form_validation) {

                            var message_validation = ''
                            $.each(response.message, function(key, value){
                                $('input[name="' + key + '"]').focus();
                                $("#form--error--message--" + key).text(value)
                            });

                            pushNotifErrorMessage();
                        } else {
                            pushNotifErrorMessage();
                        }
                    } else {
                        $('.btn__add__cancel').click();
                        this.fetchData()
                        this.clearErorrMessage()
                        pushNotif(response.status, response.message);
                        this.resetForm()
                    }
                })
                
            },

            clearErorrMessage: function(){
                $(".form--error--message").text('')
            },
            
            resetForm: function(){
            	this.models.site_title = ''
                this.models.logo_images = ''
                this.models.site_name = ''
                this.models.favicon_images = ''
                this.models.og_title = ''
                this.models.og_images = ''
                this.models.og_description = ''
                this.models.box_wrapper_left = ''
                this.models.box_wrapper_center = ''
                this.models.box_wrapper_right = ''
                this.models.meta_title = ''
                this.models.meta_keyword = ''
                this.models.meta_description = ''
            },

            importTemplate: function(id) {
                try {
                    switch(id) {
                        case 'template-box-wrapper-left':
                            CKEDITOR.instances['editor-1'].setData($('#' + id).html());
                        break;
                        case 'template-box-wrapper-center':
                            CKEDITOR.instances['editor-2'].setData($('#' + id).html());
                        break;
                        case 'template-box-wrapper-right':
                            CKEDITOR.instances['editor-3'].setData($('#' + id).html());
                        break;
                    default :

                    }
                } catch (err) {
                    toastr.error(false, err.message);
                }
            }

        },

        ready: function () {
            this.fetchData()
        }
    });
}
