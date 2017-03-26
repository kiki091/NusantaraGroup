Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");
new Vue({
    el: '#app-company-profile',

    methods: {
        getData: function(){
            this.$http.get('/profil/perusahaan/data').then((response) => {
                this.$set('profile_page', response.data.profile);
            });
        },
    },
    ready: function () {
        this.getData()
    }
});