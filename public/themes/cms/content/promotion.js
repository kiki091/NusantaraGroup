
function crudPromotions() {
    Vue.http.headers.common['X-CSRF-TOKEN'] = $("#_token").attr("value");

    var controller = new Vue({
    	el: '#app',
        data: {

            promotion: {
                id:'',
                promotion_category_id: '',
                title: '',
                thumbnail: '',
                equipment_interior : '',
                equipment_exterior : '',
                information : '',
                filename : {0: '', 1: '', 2: '', 3: '', 4: '', 5: '', 6: '', 7: ''},
                banner_image : '',
                interior_image : '',
                exterior_image : '',
                safety_image : '',
                accesories_image : '',
                introduction : '',
                side_description : '',
                description : '',
                interior_description : '',
                exterior_description : '',
                safety_description : '',
                accesories_description : '',
                meta_title : '',
                meta_keyword : '',
                meta_description : '',
            },

            thumbnail: '',
            filename : {0: '', 1: '', 2: '', 3: '', 4: '', 5: '', 6: '', 7: ''},
            filename_edit : {0: '', 1: '', 2: '', 3: '', 4: '', 5: '', 6: '', 7: ''},
            gallery_edit : {0: '', 1: '', 2: '', 3: '', 4: '', 5: '', 6: '', 7: ''},
            banner_image : '',
            interior_image : '',
            exterior_image : '',
            safety_image : '',
            accesories_image : '',
            delete_payload: {
                id: '',
            },
            form_add_title: "Detail Promotions",
            default_total_detail_image : [0],
            total_detail_image : [],
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

            previewImage: function (filename) {
                this.image_big_preview = filename
            },

            onImageSliderChange: function(element, index, e) {
                var files = e.target.files || e.dataTransfer.files

                if (!files.length)
                    return;

                this.promotion[element][index] = files[0]
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
                this.promotion[element][index] = ''
            },

            removeImageWrapper: function(item, index) {
                this.removeImageSlider('filename', index)
                this.default_total_detail_image.$remove(item);
            },

            removeImageSliderFromServer: function (id, index) {

                var payload = []
                payload['id'] = id

                var form = new FormData();

                for (var key in payload) {
                    form.append(key, payload[key])
                }

                var domain = '/promotions/delete-image-slider';
                this.$http.post(domain, form).then(function(response) {
                    response = response.data

                    if (response.status) {
                        this.total_detail_image.$remove(index)
                        
                        pushNotifV3(response.status, response.message)
                    }

                    pushNotifV3(response.status, response.message)
                })
            },

            addMoreImageSlider: function() {
                this.default_total_detail_image.splice(this.default_total_detail_image.length + 1, 0, {});
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

                this.promotion[element] = files[0]
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
                this.promotion[variable] = ''
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

                $("#PromotionForm").ajaxForm(optForm);
                $("#PromotionForm").submit();
                
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

                this.$http.post('/promotions/edit', form).then(function(response) {
                    response = response.data
                    if (response.status) {
                        this.promotion = response.data;
                        this.thumbnail = response.data.thumbnail_url
                        this.banner_image = response.data.banner_image_url
                        this.interior_image = response.data.interior_image_url
                        this.exterior_image = response.data.exterior_image_url
                        this.accesories_image = response.data.accesories_image_url
                        this.safety_image = response.data.safety_image_url

                        this.form_add_title = "Edit Detail Promotion"
                        $('#toggle-form-detail-content').slideDown(400)

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

                var domain = '/promotions/edit';
                this.$http.post(domain, form).then(function(response) {
                    response = response.data
                    if (response.status) {
                        this.id = response.data.id
                        this.filename_edit = response.data.filename_url
                        this.total_detail_image = response.data.total_detail_image
                        this.gallery_edit = response.data.gallery

                        this.form_add_title = "Edit Image Slider Promotion"
                        this.default_total_detail_image = [];
                        $('#toggle-form-photo-uploader-content').slideDown(400)

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

                $("#PromotionFormEditImageSliderForm").ajaxForm(optForm);
                $("#PromotionFormEditImageSliderForm").submit();
            },

            changeStatus: function(id) {
                
                var payload = []
                payload['id'] = id

                var form = new FormData();

                for (var key in payload) {
                    form.append(key, payload[key])
                }

                var domain = '/promotions/change-status';
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

            deleteData: function(id) {
                
                var domain = '/promotions/delete';
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

            fetchData: function(){
                this.$http.get('/promotions/data', []).then(function (response) {
                    if(response.data.status == true) {
                        this.$set('responseData', response.data.data)
                    } else {
                        pushNotifV3(response.data.status, response.data.message)
                    }
                })
            },
            
            resetForm: function() {

            	this.promotion.id = ''
                this.promotion.title = ''
                this.promotion.equipment_interior = ''
                this.promotion.equipment_exterior = ''
                this.promotion.information = ''
                this.promotion.introduction = ''
                this.promotion.side_description = ''
                this.promotion.description = ''
                this.promotion.interior_description = ''
                this.promotion.exterior_description = ''
                this.promotion.safety_description = ''
                this.promotion.accesories_description = ''
                this.promotion.meta_title = ''
                this.promotion.meta_keyword = ''
                this.promotion.meta_description = ''

                this.thumbnail = ''
                this.banner_image = ''
                this.interior_image = ''
                this.exterior_image = ''
                this.safety_image = ''
                this.accesories_image = ''
                this.filename = {0: '', 1: '', 2: '', 3: '', 4: '', 5: '', 6: '', 7: ''};
                this.default_total_image = [0];
                this.total_image = [];


                document.getElementById("PromotionDateilForm");

                $('select').prop('selectedIndex', 0);
                $('textarea').val('');

                
                destroyInstanceCkEditor()
                replaceToCkEditor()

                this.clearErorrMessage()
            },

            clearErorrMessage: function(){
                $(".form--error--message").text('')
            },

            importTemplate: function(id) {
                try {
                    switch(id) {
                        case 'template-introduction':
                            CKEDITOR.instances['editor-1'].setData($('#' + id).html());
                        break;
                        case 'template-side-description':
                            CKEDITOR.instances['editor-2'].setData($('#' + id).html());
                        break;
                        case 'template-description':
                            CKEDITOR.instances['editor-3'].setData($('#' + id).html());
                        break;
                        case 'template-equipment-interior':
                            CKEDITOR.instances['editor-4'].setData($('#' + id).html());
                        break;
                        case 'template-interior-description':
                            CKEDITOR.instances['editor-5'].setData($('#' + id).html());
                        break;
                        case 'template-equipment-exterior':
                            CKEDITOR.instances['editor-6'].setData($('#' + id).html());
                        break;
                        case 'template-exterior-description':
                            CKEDITOR.instances['editor-7'].setData($('#' + id).html());
                        break;
                        case 'template-safety-description':
                            CKEDITOR.instances['editor-8'].setData($('#' + id).html());
                        break;
                        case 'template-accesories-description':
                            CKEDITOR.instances['editor-9'].setData($('#' + id).html());
                        break;
                        case 'template-information':
                            CKEDITOR.instances['editor-10'].setData($('#' + id).html());
                        break;
                    default :

                    }
                } catch (err) {
                    pushNotifV3(false, err.message);
                }
            },

        },

        ready: function () {
            this.fetchData()
        }
    });
}
