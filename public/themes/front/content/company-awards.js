Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");
new Vue({
    el: '#app-awards',

    methods: {
        getData: function(){
            this.$http.get('/profil/penghargaan/data').then((response) => {
                this.$set('awards', response.data.awards);
            });
        },
    },
    ready: function () {
        this.getData()
    }
});