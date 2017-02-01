Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");
new Vue({
	el: '#booking-service',
    data: {
        models: {
        	jenis_kendaraan : '',
            no_kendaraan : '',
            nama_lengkap : '',
            no_telpon : '',
            email : '',
            tanggal_booking : '',
            keterangan : '',
            branch_office_id : '',
        },
        responseData: {},
    },
    methods: {

        fetchData: function(){
            this.$http.get('/promosi/booking-service/data').then((response) => {
                this.$set('responseData', response.data.data);
            });
        },

        storeBookingServices: function(){
            var config_notif = [
                toastr.options.showMethod = 'slideDown',
                toastr.options.closeButton = true,
                toastr.options.newestOnTop = false,
            ];
        	var input = this.models;
            this.$http.post('/promosi/booking-service/store',input, function(response) {
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
                    toastr.success('Subscribe berhasil');
                }
                
            },(response) => {
                this.formErrors = response.data;
            });
        },

        clearErorrMessage: function(){
            $(".form--error--message").text('')
        },
        
        resetForm: function(){
        	this.models.no_kendaraan = ''
            this.models.jenis_kendaraan = ''
            this.models.nama_lengkap = ''
            this.models.no_telpon = ''
            this.models.email = ''
            this.models.tanggal_booking = ''
            this.models.keterangan = ''
            this.models.branch_office_id = ''
        }

    },

    ready: function () {
        this.fetchData()
    }
});