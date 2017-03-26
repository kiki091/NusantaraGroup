
function crudMainBanner() {
    Vue.http.headers.common['X-CSRF-TOKEN'] = $("#_token").attr("value");

    var controller = new Vue({
    	el: '#app',
        data: {
            models: {
                id:'',
                title: '',
                images : '',
            },
            images : '',
            delete_payload: {
                id: '',
            },
            form_add_title: "Form Main Banner",
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
                var domain  = laroute.url('/main-banner/data', []);

                this.$http.get(domain).then(function (response) {
                    if(response.data.status == true) {
                        this.$set('responseData', response.data.data)
                    } else {
                        pushNotifMessage(response.data.status, response.data.message)
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

                $("#FormMainBanner").ajaxForm(optForm);
                $("#FormMainBanner").submit();
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

                this.$http.post('/main-banner/edit', form).then(function(response) {
                    response = response.data
                    if (response.status) {
                        this.models = response.data;
                        this.images = response.data.image_url

                        this.form_add_title = "Edit Main Banner"
                        $('.btn__add').click()

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

                this.$http.post('/main-banner/change-status', form).then(function(response) {
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
                
                var form = new FormData();

                form.append('id', id);
                
                this.$http.post('/main-banner/delete', form).then(function (response) {
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

            clearErorrMessage: function(){
                $(".form--error--message").text('')
            },
            
            resetForm: function(){
            	this.models.id = ''
                this.models.title = ''
                this.images = ''
            },

            sortable: function() {
                var vm = this;

                setTimeout(function(){
                    Sortable.create(document.getElementById('sort'), {
                        draggable: 'li.sort-item',
                        ghostClass: "sort-ghost",
                        handle: '.handle',
                        animation: 300,
                        onUpdate: function(evt) {
                            vm.reorder(evt.oldIndex, evt.newIndex);
                        }
                    });

                }, 100);
            },

            reorder: function(oldIndex, newIndex) {
                //get id list
                var ids = document.getElementsByClassName('sort-item'),
                id_order  = [].map.call(ids, function(input) {
                    return input.getAttribute('data-id');
                });

                var payload = {list_order: id_order };

                this.$http.post('/main-banner/order', payload).then(function(response) {
                    response = response.data
                    if (response.status == false) {
                        this.fetchData()
                        pushNotifV3(response.status, response.message);
                    }
                    else{
                        
                        this.fetchData()
                        pushNotifV3(response.status, response.message);
                    }
                });
            },

        },

        ready: function () {
            this.sortable()
            this.fetchData()
        }
    });
}
