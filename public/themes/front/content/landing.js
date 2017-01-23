Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");
new Vue({
    el: '#app',
    data: {
        models: {
        	
	        email : '',
    	},
        responseData: {},

    },
    methods: {
    	
    },
    
});