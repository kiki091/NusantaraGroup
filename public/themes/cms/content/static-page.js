    new Vue({
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

            store: function(){
                var config_notif = [
                    toastr.options.showMethod = 'slideDown',
                    toastr.options.closeButton = true,
                    toastr.options.newestOnTop = false,
                ];
            	var input = this.models;
                this.$http.post('/cms/static-page/store',input, function(response) {
                    if (response.status == false) {
                        $.each(response.message, function(input, value){
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
                        toastr.success('Berhasil');
                    }
                    
                },(response) => {
                    this.formErrors = response.data;
                });
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
            }

        },

        ready: function () {
            this.fetchData()
        }
    });
