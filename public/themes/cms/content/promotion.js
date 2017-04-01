
function crudPromotions() {
    Vue.http.headers.common['X-CSRF-TOKEN'] = $("#_token").attr("value");

    var controller = new Vue({
    	el: '#app',
        data: {

            banner:{
                id:'',
                title: '',
                images : '',
            },

            category : {
                id : '',
                category_name : '',
                category_slug : '',
                thumbnail_category : '',
                introduction : '',
            },

            promotion: {
                id:'',
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

            images : '',
            thumbnail: '',
            thumbnail_category : '',
            filename : {0: '', 1: '', 2: '', 3: '', 4: '', 5: '', 6: '', 7: ''},
            banner_image : '',
            interior_image : '',
            exterior_image : '',
            safety_image : '',
            accesories_image : '',
            delete_payload: {
                id: '',
            },
            form_add_title_banner: "Banner Promotions",
            form_add_title_category: "Category Promotions",
            form_add_title: "Detail Promotions",
            sectionDelete : 'banner',
            default_total_description : [0],
            total_description : [],
            id: '',
            edit: false,
            responseData: {},
        },
        methods: {

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

                this.banner[element] = files[0]
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
                this.banner[variable] = ''
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

            storeData: function(event){

                var vm = this;
                var optForm      = {

                    dataType: "json",

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

                $("#FormBannerPromotion").ajaxForm(optForm);
                $("#FormBannerPromotion").submit();
            },

            editBanner: function (id) {
                this.edit = true
                var payload = []
                payload['id'] = id

                var form = new FormData();

                for (var key in payload) {
                    form.append(key, payload[key])
                }

                this.resetForm()

                this.$http.post('/promotions/edit-banner', form).then(function(response) {
                    response = response.data
                    if (response.status) {
                        this.banner = response.data;
                        this.images = response.data.image_url

                        this.form_add_title = "Edit Banner Promotion"
                        $('.btn_add_banner').click()

                    } else {
                        pushNotifV3(response.status,response.message)
                    }
                })
            },

            changeStatusBanner: function(id) {
                console.log(id)
                var payload = []
                payload['id'] = id

                var form = new FormData();

                for (var key in payload) {
                    form.append(key, payload[key])
                }

                var domain = '/promotions/change-status-banner';
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

            deleteDataBanner: function(id) {
                
                var domain = '/promotions/delete-banner';
                var form = new FormData();

                form.append('id', id);
                
                this.$http.post(domain, form).then(function (response) {
                    response = response.data
                    if (response.status === true)
                    {
                        this.delete_payload.id = '';
                        this.fetchData()
                        pushNotifV3(response.status, response.message);
                    }

                    this.showModal = false
                    setTimeout(function() {
                        $('.popup__mask__alert').removeClass('is-visible');
                    }, 300);
                    pushNotifV3(response.status, response.message);
                });
            },

            sortableBanner: function() {
                var vm = this;

                setTimeout(function(){
                    Sortable.create(document.getElementById('sort-banner'), {
                        draggable: 'li.sort-item-banner',
                        ghostClass: "sort-ghost",
                        handle: '.handle',
                        animation: 300,
                        onUpdate: function(evt) {
                            vm.reorderBanner(evt.oldIndex, evt.newIndex);
                        }
                    });

                }, 100);
            },

            reorderBanner: function(oldIndex, newIndex) {
                //get id list
                var ids = document.getElementsByClassName('sort-item-banner'),
                    id_order  = [].map.call(ids, function(input) {
                        return input.getAttribute('data-id');
                    });

                var domain  = '/promotions/order-banner';

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

            resetFormBanner: function() {

                this.banner.id = ''
                this.banner.title = ''
                this.images = ''
            },

            resetFormCategoryPromotion: function() {

                this.category.id = ''
                this.category.category_name = ''
                this.category.category_slug = ''
                this.category.introduction = ''
                this.thumbnail_category = ''
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
                this.default_total_description = [0];
                this.total_description = [];
            },

            clearErorrMessage: function(){
                $(".form--error--message").text('')
            },

        },

        ready: function () {
            this.sortableBanner()
            this.fetchData()
        }
    });
}
