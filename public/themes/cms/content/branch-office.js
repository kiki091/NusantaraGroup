
function crudBranchOffice() {
    Vue.http.headers.common['X-CSRF-TOKEN'] = $("#_token").attr("value");

    var controller = new Vue({
    	el: '#app',
        data: {
            models: {
                id:'',
                title: '',
                slug : '',
                side_description: '',
                description: '',
                address: '',
                thumbnail: '',
                office_name: '',
                meta_title: '',
                meta_keyword: '',
                meta_description: '',
                images: {0: '', 1:'', 2:'', 3: ''},
                branch_office: [
                    {title_description: '',address: '',latitude: '',longitude: '',}
                ],

            },
            thumbnail: '',
            images: {0: '', 1:'', 2:'', 3: ''},
            delete_payload: {
                id: '',
            },
            form_add_title: "Form Branch Office",
            id: '',
            edit: false,
            default_total_detail_image : [0],
            total_detail_image : [],
            default_total_office : [0],
            total_office : [],
            responseData: {},
            image_big_preview: '',
        },
        filters: {
            strSlug: function(data) {
                return data.replace(/ /g, "-")
            }
        },
        methods: {

            previewImage: function (image_url) {
                this.image_big_preview = image_url
            },

            addMoreOffice: function() {
                this.models.branch_office.splice(this.models.branch_office.length + 1, 0, {title_description: '',address: '',latitude: '',longitude: '',});
            },

            addMoreImageSlider: function() {
                this.default_total_detail_image.splice(this.default_total_detail_image.length + 1, 0, {});
            },

            removeMoreOffice: function(item, index) {
                this.models.branch_office.$remove(item);
            },

            onImageSliderChange: function(element, index, e) {
                var files = e.target.files || e.dataTransfer.files

                if (!files.length)
                    return;

                this.models[element][index] = files[0]
                this.createImageSlider(files[0], element, index);
            },

            createImageSlider: function(file, setterTo, index) {
                var image = new Image();
                var reader = new FileReader();
                var vm = this;

                reader.onload = function (e) {
                    vm[setterTo][index] = e.target.result
                };
                reader.readAsDataURL(file);
            },

            removeImageSlider: function (element, index) {
                this[element][index] = '';
                this.models[element][index] = ''
            },

            removeImageWrapper: function(item, index) {
                this.removeImageSlider('images', index)
                this.default_total_detail_image.$remove(item);
            },

            showDeleteModal: function(id, sectionDelete) {
                this.showModal = true;
                this.delete_payload.id = id;
                this.sectionDelete = sectionDelete

                $('.popup__mask__alert').addClass('is-visible');

                // add class di container saat popup
                $('.main_container').addClass('popupContainer');
            },

            closeDeleteModal: function() {
                this.showModal = false;

                // remove class di container saat popup
                setTimeout(function() {
                    $('.popup__mask__alert').removeClass('is-visible');
                }, 300);
            },

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
                var domain  = laroute.url('/cms/branch-office/data', []);

                    this.$http.get(domain).then(function (response) {
                        if(response.data.status == true) {
                            this.$set('responseData', response.data.data)
                        } else {
                            pushNotifMessage(response.data.status, response.data.message)
                        }
                    })
            },

            storeData: function(event){

                /*this.clearErorrMessage()    
                showLoadingData();

                var form = new FormData();

                for (var key in this.models) {
                    form.append(key, this.models[key])
                }

                var domain = laroute.url('/cms/branch-office/store', []);
                this.$http.post(domain, form, function(response) {
                    if (response.status == false) {
                        if(response.is_error_form_validation) {

                            var message_validation = ''
                            $.each(response.message, function(key, value){
                                $('input[name="' + key.replace(".", "_") + '"]').focus();
                                $("#form--error--message--" + key).text(value)
                                message_validation += '<li class="notif__content__li"><span class="text" >' + value + '</span></li>'
                            });

                            hideLoading()
                            pushNotifMessage(response.status,response.message, message_validation);
                        } else {
                            hideLoading()
                        }
                    } else {
                        this.resetForm()
                        $('.btn__add__cancel').click()
                        pushNotifMessage(response.status, response.message);
                        this.clearErorrMessage()
                        this.fetchData()
                        hideLoading()
                    }
                })*/

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
                                pushNotifMessage(response.status,response.message, message_validation);

                            } else {
                                pushNotifMessage(response.status, response.message);
                            }
                        } else {
                            vm.fetchData()
                            vm.resetForm()
                            pushNotifMessage(response.status, response.message);
                            $('.btn__add__cancel').click();
                        }
                    },
                    complete: function(response){
                        hideLoading()
                    }

                };

                $("#BranchOfficeForm").ajaxForm(optForm);
                $("#BranchOfficeForm").submit();
                
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

                var domain = laroute.url('/cms/branch-office/edit', []);
                this.$http.post(domain, form).then(function(response) {
                    response = response.data
                    if (response.status) {
                        this.models = response.data;
                        this.images = response.data.image_url

                        this.form_add_title = "Edit Main Banner"
                        $('.btn__add').click()

                    } else {
                        pushNotifMessage(response.status,response.message)
                    }
                })
            },

            changeStatus: function(id) {
                console.log(id)
                var payload = []
                payload['id'] = id

                var form = new FormData();

                for (var key in payload) {
                    form.append(key, payload[key])
                }

                var domain = laroute.url('/cms/branch-office/change-status', []);
                this.$http.post(domain, form).then(function(response) {
                    response = response.data
                    if (response.status == false) {
                        this.fetchData()
                        pushNotifMessage(response.status,response.message);
                    }
                    else{
                        pushNotifMessage(response.status,response.message);
                    }
                })
            },

            deleteData: function(id) {
                
                var domain = laroute.url('/cms/branch-office/delete', []);
                var form = new FormData();

                form.append('id', id);
                
                this.$http.post(domain, form).then(function (response) {
                    response = response.data
                    if (response.status === true)
                    {
                        this.delete_payload.id = '';
                        this.fetchData()
                    }
                    this.showModal = false
                    setTimeout(function() {
                        $('.popup__mask__alert').removeClass('is-visible');
                    }, 300);
                    pushNotifMessage(response.status, response.message);
                });
            },

            clearErorrMessage: function(){
                $(".form--error--message").text('')
            },
            
            resetForm: function(){
                this.models.title = ''
                this.models.slug  = ''
                this.models.side_description = ''
                this.models.description = ''
                this.models.office_name = ''
                this.models.meta_title = ''
                this.models.meta_keyword = ''
                this.models.meta_description = ''
            	this.models.id = ''

                this.models.branch_office = [
                    {title_description: '',address: '',latitude: '',longitude: '',}
                ]

                this.thumbnail = ''
                this.branch_office = [];
                this.images = {0: '', 1:'', 2:'', 3: ''};
                this.default_total_detail_image = [0];
                this.total_detail_image = [0];
                this.default_total_office = [0];
                this.total_office = [];
                this.form_add_title = "Add Branch Office"
                this.id = ''

                document.getElementById("BranchOfficeForm");

                $('select').prop('selectedIndex', 0);
                $('textarea').val('');

                this.clearErorrMessage()

            },

            importTemplate: function(id) {
                try {
                    switch(id) {
                        case 'template-description':
                            CKEDITOR.instances['editor-1'].setData($('#' + id).html());
                        break;
                    default :

                    }
                } catch (err) {
                    pushNotifMessage(false, err.message);
                }
            }

        },

        ready: function () {
            this.fetchData()
        }
    });
}
