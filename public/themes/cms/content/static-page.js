
function crudStaticPage() {
    Vue.http.headers.common['X-CSRF-TOKEN'] = $("#_token").attr("value");

    var controller = new Vue({
    	el: '#app',
        data: {
            models: {
                id: '',
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
            id: '',
            edit: false,
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
                var domain  = '/static-page/data';

                this.$http.get(domain).then(function (response) {
                    if(response.data.status == true) {
                        this.$set('responseData', response.data.data)
                    } else {
                        pushNotifV3(response.data.status, response.data.message)
                    }
                })
            },

            storeData: function(event){

                var vm = this;
                var optForm      = {

                    dataType: "json",

                    beforeSerialize: function(form, options) {
                        for (instance in CKEDITOR.instances)
                            CKEDITOR.instances[instance].updateElement();
                    },
                    beforeSend: function(){
                        showLoadingData(true)
                        vm.clearErorrMessage()
                    },
                    success: function(response){
                        if (response.status == false) {
                            if(response.is_error_form_validation) {

                                var message_validation = ''
                                $.each(response.message, function(key, value){
                                    $('input[name="' + key.replace(".", "_") + '"]').focus();
                                    $("#form--error--message--" + key.replace(".", "_")).text(value)
                                    message_validation += '<li class="notif__content__li"><span class="text" >' + value + '</span></li>'
                                });
                                pushNotifV3(response.status,response.message, message_validation);

                            } else {
                                pushNotifV3(response.status, response.message);
                            }
                        } else {
                            vm.fetchData()
                            vm.resetForm()
                            pushNotifV3(response.status, response.message);
                            $('.btn__add__cancel').click();
                        }
                    },
                    complete: function(response){
                        hideLoading()
                    }

                };

                $("#StaticPageForm").ajaxForm(optForm);
                $("#StaticPageForm").submit();
                
            },

            editData: function (id) {
                this.edit = true
                var payload = []
                payload['id'] = id

                var form = new FormData();

                for (var key in payload) {
                    form.append(key, payload[key])
                }

                this.resetForm()

                var domain = '/static-page/edit';
                this.$http.post(domain, form).then(function(response) {
                    response = response.data
                    if (response.status) {
                        this.models = response.data;
                        this.logo_images = response.data.logo_url
                        this.favicon_images = response.data.favicon_url
                        this.og_images = response.data.og_url

                        this.form_add_title = "Edit Static Page"
                        $('.btn__add').click()

                        destroyInstanceCkEditor()
                        replaceToCkEditor()

                    } else {
                        pushNotifV3(response.status,response.message)
                    }
                })
            },

            changeStatus: function(id) {
                var payload = []
                payload['id'] = id

                var form = new FormData();

                for (var key in payload) {
                    form.append(key, payload[key])
                }

                var domain = '/static-page/change-status';
                this.$http.post(domain, form).then(function(response) {
                    response = response.data
                    if (response.status == false) {
                        this.fetchData()
                        pushNotifV3(response.status,response.message);
                    }
                    else{
                        pushNotifV3(response.status,response.message);
                    }
                })
            },

            clearErorrMessage: function(){
                $(".form--error--message").text('')
            },
            
            resetForm: function(){
            	this.models.site_title = ''
                this.models.site_name = ''
                this.models.og_title = ''
                this.models.og_description = ''
                this.models.box_wrapper_left = ''
                this.models.box_wrapper_center = ''
                this.models.box_wrapper_right = ''
                this.models.meta_title = ''
                this.models.meta_keyword = ''
                this.models.meta_description = ''

                this.logo_images = ''
                this.favicon_images = ''
                this.og_images = ''
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
