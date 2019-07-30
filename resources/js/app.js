
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 Vue.component('modal', {
 	template: '#modal-template'
 })

const app = new Vue({
    el: '#app',
    data: {
    	newItem: {'name':'', 'email':''},
    	hasError: true,
    	showModal: false,
    	items: [],
    	e_id: '',e_name: '',e_email: ''	
    },
    mounted: function mounted(){
    	this.getItem();
    },
    methods: {
    	getItem: function getItem(){
    		var _this = this;
    		axios.get('get-item').then(function(response){
    			_this.items = response.data;
    		})
    	},
    	setVal(val_id, val_name, val_email){
    		this.e_id 		= val_id;
    		this.e_name 	= val_name;
    		this.e_email	= val_email;
    	},
    	createItem: function createItem(){
    	 	var input = this.newItem;
    	 	var _this = this;
    	 	if(input['name'] == '' || input['email'] == ''){
    	 		this.hasError = false;
    	 	}else{
    	 		this.hasError = true;
    	 		axios.post('store-item', input).then(function(res){
    	 			_this.newItem = {'name':'', 'email':''}
    	 			_this.getItem();
    	 		});
    	 	}
    	 },
    	 deleteItem: function deleteItem(item){
    	 	var _this = this;
    	 	axios.post('delete-item/'+item.id).then(function(res){
    	 		_this.getItem();
    	 	});
    	 },
    	 editItem: function editItem(){
    	 	var _this = this;
    	 	var i_id 	= document.getElementById('e_id');
    	 	var i_name 	= document.getElementById('e_name');
    	 	var i_email = document.getElementById('e_email');
    	 	axios.post('edit-item/'+i_id.value, {val1:i_name.value, val2:i_email.value}).then(function(res){
    	 		_this.getItem();
    	 		_this.showModal = false;
    	 	});
    	 }
    }
});
