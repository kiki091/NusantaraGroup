
function crudBookingServices() {
    Vue.http.headers.common['X-CSRF-TOKEN'] = $("#_token").attr("value");

    var controller = new Vue({
    	el: '#app',
        data: {
            models: {
                id: '',
            	no_booking : '',
                no_kendaraan : '',
                jenis_kendaraan : '',
                nama_lengkap : '',
                no_telpon : '',
                email : '',
                tanggal_booking : '',
                keterangan : '',
                branch_office_trans_id : '',
            },
            delete_payload: {
                id: '',
            },
            form_add_title: "Form Booking Services",
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

            searchData: function() {
                param = $('#filter-function').val()
                var domain  = laroute.url('/cms/booking-services/search', []);
                this.$http.get(domain+'?param='+param).then(function (response) {
                    this.$set('data', response.data)
                });
            },

            showData: function(id){
                this.edit = true
                var payload = []
                payload['id'] = id

                var form = new FormData();

                for (var key in payload) {
                    form.append(key, payload[key])
                }

                var domain = laroute.url('/cms/booking-services/show', []);
                this.$http.post(domain, form).then(function(response) {
                    response = response.data
                    if (response.status) {
                        this.models = response.data;

                        this.form_add_title = "Booking Services"
                        $('#toggle-form-content').slideUp()

                    } else {
                        pushNotifMessage(response.status,response.message)
                    }
                })
            },

            
            fetchData: function(){
                var domain  = laroute.url('/cms/booking-services/data', []);

                    this.$http.get(domain).then(function (response) {
                        if(response.data.status == true) {
                            this.$set('responseData', response.data.data)
                        } else {
                            pushNotifMessage(response.data.status, response.data.message)
                        }
                    })
            },

        },

        ready: function () {
            this.fetchData()
        }
    });
}
