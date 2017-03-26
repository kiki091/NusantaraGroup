Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");
new Vue({
    el: '#app-company-visi-misi',

    methods: {
        getData: function(){
            this.$http.get('/profil/visi-misi/data').then((response) => {
                this.$set('visi_misi_page', response.data.visi_misi);
            });
        },
    },
    ready: function () {
        this.getData()
    }
});