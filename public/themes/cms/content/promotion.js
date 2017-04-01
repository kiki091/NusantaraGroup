
function crudPromotions() {
    Vue.http.headers.common['X-CSRF-TOKEN'] = $("#_token").attr("value");

    var controller = new Vue({
    	el: '#app',
        data: {

            banner:{
                id:'',
                title: '',
                images : '',
            },

            category : {
                id : '',
                category_name : '',
                category_slug : '',
                thumbnail_category : '',
                introduction : '',
            },

            promotion: {
                id:'',
                title: '',
                thumbnail: '',
                equipment_interior : '',
                equipment_exterior : '',
                information : '',
                filename : {0: '', 1: '', 2: '', 3: '', 4: '', 5: '', 6: '', 7: ''},
                banner_image : '',
                interior_image : '',
                exterior_image : '',
                safety_image : '',
                accesories_image : '',
                introduction : '',
                side_description : '',
                description : '',
                interior_description : '',
                exterior_description : '',
                safety_description : '',
                accesories_description : '',
                meta_title : '',
                meta_keyword : '',
                meta_description : '',
            },

            thumbnail: '',
            thumbnail_category : '',
            filename : {0: '', 1: '', 2: '', 3: '', 4: '', 5: '', 6: '', 7: ''},
            banner_image : '',
            interior_image : '',
            exterior_image : '',
            safety_image : '',
            accesories_image : '',
            delete_payload: {
                id: '',
            },
            form_add_title_banner: "Banner",
            form_add_title_category: "Category Promotions",
            form_add_title: "Promotions",
            sectionDelete : 'awards',
            default_total_description : [0],
            total_description : [],
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
                this.$http.get('/promotions/data', []).then(function (response) {
                    if(response.data.status == true) {
                        this.$set('responseData', response.data.data)
                    } else {
                        pushNotifV3(response.data.status, response.data.message)
                    }
                })
            },

            resetFormCategoryPromotion: function() {

                this.category.id = ''
                this.category.category_name = ''
                this.category.category_slug = ''
                this.category.introduction = ''
                this.thumbnail_category = ''
            },
            
            resetForm: function() {

            	this.promotion.id = ''
                this.promotion.title = ''
                this.promotion.equipment_interior = ''
                this.promotion.equipment_exterior = ''
                this.promotion.information = ''
                this.promotion.introduction = ''
                this.promotion.side_description = ''
                this.promotion.description = ''
                this.promotion.interior_description = ''
                this.promotion.exterior_description = ''
                this.promotion.safety_description = ''
                this.promotion.accesories_description = ''
                this.promotion.meta_title = ''
                this.promotion.meta_keyword = ''
                this.promotion.meta_description = ''

                this.thumbnail = ''
                this.banner_image = ''
                this.interior_image = ''
                this.exterior_image = ''
                this.safety_image = ''
                this.accesories_image = ''
                this.filename = {0: '', 1: '', 2: '', 3: '', 4: '', 5: '', 6: '', 7: ''};
                this.default_total_description = [0];
                this.total_description = [];
            },

        },

        ready: function () {
            this.fetchData()
        }
    });
}
