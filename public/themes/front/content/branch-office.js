Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");
new Vue({
    el: '#app-branch-office',

    methods: {
    
    },
    ready: function () {
        this.getData()
    }
});