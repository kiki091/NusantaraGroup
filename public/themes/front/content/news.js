Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");
new Vue({
    el: '#app-news',

    methods: {
        getData: function(){
            this.$http.get('/berita/data').then((response) => {
                this.$set('news', response.data.data);
            });
        },
    },
    ready: function () {
        this.getData()
    }
});