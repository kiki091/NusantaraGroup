
function crudEventCategory() {
    Vue.http.headers.common['X-CSRF-TOKEN'] = $("#_token").attr("value");

    var controller = new Vue({
    	el: '#app',
        data: {
            models: {
                id:'',
                name : '',

            },
            delete_payload: {
                id: '',
            },
            thumbnail : '',
            form_add_title: "Event Category",
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

            fetchData: function(){
                this.$http.get('/event/category/data', []).then(function (response) {
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

                $("#FormEventCategori").ajaxForm(optForm);
                $("#FormEventCategori").submit();
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

                this.$http.post('/event/category/edit', form).then(function(response) {
                    response = response.data
                    if (response.status) {
                        this.models = response.data
                        this.thumbnail = response.data.thumbnail_url

                        this.form_add_title = "Edit Category"
                        $('.btn__add').click()

                    } else {
                        pushNotifV3(response.status,response.message)
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

                var domain = '/event/category/change-status';
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
                        console.log('ready for order...')
                    });

                }, 100);
            },

            reorder: function(oldIndex, newIndex) {
                //get id list
                var ids = document.getElementsByClassName('sort-item'),
                    id_order  = [].map.call(ids, function(input) {
                        return input.getAttribute('data-id');
                    });

                var domain  = '/event/category/order';

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
                this.models.name = ''
                this.thumbnail = ''

                this.form_add_title = "Event Category"

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
