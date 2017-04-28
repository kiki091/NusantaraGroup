
function crudEventDetail() {
    Vue.http.headers.common['X-CSRF-TOKEN'] = $("#_token").attr("value");

    var controller = new Vue({
    	el: '#app',
        data: {
            models: {
                id:'',
                title : '',
                introduction : '',
                side_description : '',
                description : '',
                service_category_id : '',
                meta_title : '',
                meta_keyword : '',
                meta_description : '',

            },
            delete_payload: {
                id: '',
            },
            images : '',
            banner_images : {0: '', 1:'', 2:'', 3: ''},
            banner_images_edit : {0: '', 1:'', 2:'', 3: ''},
            banner_edit: {0: '', 1:'', 2:'', 3: ''},
            default_total_detail_image : [0],
            total_detail_image : [],
            folder_class : 'event--detail folder--selected',
            form_add_title: "Event Detail",
            id: '',
            edit: false,
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

            addMoreImageSlider: function() {
                this.default_total_detail_image.splice(this.default_total_detail_image.length + 1, 0, {});
            },

            onImageSliderChange: function(element, index, e) {
                var files = e.target.files || e.dataTransfer.files

                if (!files.length)
                    return;

                this[element][index] = files[0]
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
            },

            removeImageWrapper: function(item, index) {
                this.removeImageSlider('banner_images', index)
                this.default_total_detail_image.$remove(item);
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

            showDeleteModal: function(id, sectionDelete) {
                this.showModal = true;
                this.delete_payload.id = id;

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

            removeImageSliderFromServer: function (id, index) {

                var payload = []
                payload['id'] = id

                var form = new FormData();

                for (var key in payload) {
                    form.append(key, payload[key])
                }

                var domain = '/event/detail/delete-image-slider';
                this.$http.post(domain, form).then(function(response) {
                    response = response.data

                    if (response.status) {
                        this.total_detail_image.$remove(index)
                        
                        pushNotifV3(response.status, response.message)
                    }

                    pushNotifV3(response.status, response.message)
                })
            },

            fetchData: function(){
                this.$http.get('/event/detail/data', []).then(function (response) {
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
                        vm.clearErrorMessage()
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

                $("#FormEventDetail").ajaxForm(optForm);
                $("#FormEventDetail").submit();
            },

            editData: function (id) {
                this.edit = true
                var payload = []
                payload['id'] = id

                var form = new FormData();

                for (var key in payload) {
                    form.append(key, payload[key])
                }

                this.$http.post('/event/detail/edit', form).then(function(response) {
                    response = response.data
                    if (response.status) {
                        this.models = response.data
                        this.images = response.data.images_url

                        this.form_add_title = "Edit Service Detail"
                        $('.btn__add').click()

                        destroyInstanceCkEditor()
                        replaceToCkEditor()

                    } else {
                        pushNotifV3(response.status,response.message)
                    }
                })
            },

            editImageSlider: function (id) {
                this.edit   = true

                var payload = []
                payload['id'] = id

                var form = new FormData();

                for (var key in payload) {
                    form.append(key, payload[key])
                }

                this.resetForm()

                var domain = '/event/detail/edit';
                this.$http.post(domain, form).then(function(response) {
                    response = response.data
                    if (response.status) {
                        this.id = response.data.id
                        this.banner_images_edit = response.data.banner_images_url
                        this.total_detail_image = response.data.total_detail_image
                        this.banner_edit = response.data.banner

                        this.form_add_title = "Edit Image Slider"
                        this.default_total_detail_image = [];
                        $('#toggle-form-photo-uploader-content').slideDown('swing')

                    } else {
                        pushNotifV3(response.status, response.message)
                    }
                })
            },

            postEditImageSlider: function(event) {
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
                                    $('input[id="' + key.replace(".", "_") + '"]').focus();
                                    $("#form--error--message--" + key.replace(".", "_")).text(value)
                                    message_validation += '<li class="notif__content__li"><span class="text" >' + value + '</span></li>'
                                });
                                pushNotifMessage(response.status,response.message, message_validation);

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

                $("#FormEventDetailImageSliderForm").ajaxForm(optForm);
                $("#FormEventDetailImageSliderForm").submit();
            },

            changeStatus: function(id) {
                console.log(id)
                var payload = []
                payload['id'] = id

                var form = new FormData();

                for (var key in payload) {
                    form.append(key, payload[key])
                }

                var domain = '/event/detail/change-status';
                this.$http.post(domain, form).then(function(response) {
                    response = response.data
                    if (response.status == false) {
                        this.fetchData()
                        pushNotifV3(response.status,response.message);
                    }
                    else{

                        this.fetchData()
                        pushNotifV3(response.status,response.message);
                    }
                })
            },

            deleteData: function(id) {
                
                var domain = '/event/detail/delete';
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
                    pushNotifV3(response.status, response.message);
                });
            },

            sortable: function() {
                var vm = this;

                setTimeout(function(){

                    $('.sortable').each(function(){
                        Sortable.create(this, {
                            draggable: 'li.sort-item',
                            ghostClass: "sort-ghost",
                            handle: '.handle',
                            animation: 300,
                            onUpdate: function(evt) {
                                vm.reorder(evt.oldIndex, evt.newIndex);
                            },
                            onChange: function(evt) {
                                vm.reorder(evt.oldIndex, evt.newIndex);
                            }
                        });
                    });

                }, 100);
            },

            reorder: function(oldIndex, newIndex) {
                //get id list
                var ids = document.getElementsByClassName('sort-item'),
                    id_order  = [].map.call(ids, function(input) {
                        return input.getAttribute('data-id');
                    });

                var domain  = '/event/detail/order';

                var payload = {list_order: id_order };

                this.$http.post(domain, payload).then(function(response) {
                    response = response.data
                    if (response.status == false) {
                        this.fetchData()
                        pushNotifV3(response.status, response.message);
                    }
                    this.fetchData()
                    pushNotifV3(response.status, response.message);
                });
            },

            clearErrorMessage: function(){
                $(".form--error--message").text('')
            },
            
            resetForm: function(){

            	this.models.id = ''
                this.models.title = ''
                this.models.introduction = ''
                this.models.side_description = ''
                this.models.description = ''
                this.models.service_category_id = ''
                this.models.meta_title = ''
                this.models.meta_keyword = ''
                this.models.meta_description = ''
                this.images = ''
                this.banner_images = {0: '', 1:'', 2:'', 3: ''};
                this.default_total_detail_image = [0];
                this.total_detail_image = [0];
                this.edit = false

                this.form_add_title = "Event Detail"

                document.getElementById("FormEventDetail");

                $('select').prop('selectedIndex', 0);
                $('textarea').val('');

                
                destroyInstanceCkEditor()
                replaceToCkEditor()

                this.clearErrorMessage()
            },

            resetFormImageSlider: function(){

                this.models.id = ''
                this.banner_images = {0: '', 1:'', 2:'', 3: ''};
                this.banner_images_edit = {0: '', 1:'', 2:'', 3: ''};
                this.banner_edit = {0: '', 1:'', 2:'', 3: ''};
                this.default_total_detail_image = [0];
                this.total_detail_image = [0];

                this.edit = false

                this.form_add_title = "Event Detail"

                this.clearErrorMessage()
            },



            importTemplate: function(id) {
                try {
                    switch(id) {
                        case 'template-job-description':
                            CKEDITOR.instances['editor-1'].setData($('#' + id).html());
                        break;
                    default :

                    }
                } catch (err) {
                    pushNotifV3(false, err.message);
                }
            },

        },

        ready: function () {
            this.sortable()
            this.fetchData()
        }
    });
}
