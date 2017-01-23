Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");
new Vue({
    el: '#app-company-history',

    methods: {
        getData: function(){
            this.$http.get('/profil/sejarah-perusahaan/data').then((response) => {
                this.$set('history_page', response.data.history_page);
            });
        },
    },
    ready: function () {
        this.getData()
    }
});