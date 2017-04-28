
function crudCategoriPromotions() {
    Vue.http.headers.common['X-CSRF-TOKEN'] = $("#_token").attr("value");

    var controller = new Vue({
    	el: '#app',
        data: {

            categori : {
                id : '',
                category_name : '',
                category_slug : '',
                thumbnail_category : '',
                introduction : '',
                meta_title : '',
                meta_keyword : '',
                meta_description : '',
            },

            thumbnail_category : '',
            delete_payload: {
                id: '',
            },
            form_add_title_category: "Category Promotions",
            id: '',
            edit: false,
            responseData: {},
        },

        filters: {
            strSlug: function(data) {
                return data.replace(/ /g, "-")
            }
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

                this.categori[element] = files[0]
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
                this.categori[variable] = ''
            },

            fetchData: function(){
                this.$http.get('/promotions/categori/data', []).then(function (response) {
                    if(response.data.status == true) {
                        this.$set('responseData', response.data.data)
                    } else {
                        pushNotifV3(response.data.status, response.data.message)
                    }
                })
            },

            storeDataCategori: function(event){

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

                $("#PromotionCategoriForm").ajaxForm(optForm);
                $("#PromotionCategoriForm").submit();
            },

            editCategori: function (id) {
                this.edit = true
                var payload = []
                payload['id'] = id

                var form = new FormData();

                for (var key in payload) {
                    form.append(key, payload[key])
                }

                this.resetForm()

                this.$http.post('/promotions/categori/edit', form).then(function(response) {
                    response = response.data
                    if (response.status) {
                        this.categori = response.data;
                        this.thumbnail_category = response.data.thumbnail_category_url

                        this.form_add_title = "Edit Categori Promotion"
                        $('#toggle-form-categori-content').slideDown(400)

                        destroyInstanceCkEditor()
                        replaceToCkEditor()

                    } else {
                        pushNotifV3(response.status,response.message)
                    }
                })
            },

            changeStatusCategori: function(id) {
                var payload = []
                payload['id'] = id

                var form = new FormData();

                for (var key in payload) {
                    form.append(key, payload[key])
                }

                var domain = '/promotions/categori/change-status';
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

            deleteDataCategori: function(id) {
                
                var domain = '/promotions/categori/delete';
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

            sortableCategori: function() {
                var vm = this;

                setTimeout(function(){
                    Sortable.create(document.getElementById('sort-categori'), {
                        draggable: 'li.sort-item-categori',
                        ghostClass: "sort-ghost",
                        handle: '.handle',
                        animation: 300,
                        onUpdate: function(evt) {
                            vm.reorderCategori(evt.oldIndex, evt.newIndex);
                        }
                    });

                }, 100);
            },

            reorderCategori: function(oldIndex, newIndex) {
                //get id list
                var ids = document.getElementsByClassName('sort-item-categori'),
                    id_order  = [].map.call(ids, function(input) {
                        return input.getAttribute('data-id');
                    });

                var domain  = '/promotions/categori/order';

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

            clearCkEditor: function() {
                destroyInstanceCkEditor()
                replaceToCkEditor()
                this.resetFormCategoryPromotion(true)
            },

            resetFormCategoryPromotion: function() {

                this.categori.id = ''
                this.categori.category_name = ''
                this.categori.category_slug = ''
                this.categori.introduction = ''
                this.categori.meta_title = ''
                this.categori.meta_keyword = ''
                this.categori.meta_description = ''
                this.thumbnail_category = ''

                document.getElementById("PromotionCategoriForm");

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
                    default :

                    }
                } catch (err) {
                    pushNotifV3(false, err.message);
                }
            },

        },

        ready: function () {
            this.sortableCategori()
            this.fetchData()
        }
    });
}
