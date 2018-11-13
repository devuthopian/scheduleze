
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VeeValidate from 'vee-validate';
import { Validator } from 'vee-validate';
/*import VueResource from "vue-resource";*/
const dict = {
  	custom: {
	    email: {
	      required: 'Your email is empty'
	    },
	    name: {
			required: () => 'Your name is empty',
			excluded: 'This Username is already taken',
			included: 'We don\'t have this username in our database.'
	    }
  	}
};
// or use the instance method
Vue.use(VeeValidate);
Validator.localize('en', dict);
/*Vue.use(VueResource);*/

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('signupform-component', require('./components/SignupformComponent.vue'));

const app = new Vue({
    el: '#signup',
    data: () => ({
	    email: null,
	    name: null
	}),
    methods: {
        clickagreementcheck: function(event) {
            if (event.target.checked){
                $('.cls-agree-btn').removeAttr('disabled');
            }else{
                $('.cls-agree-btn').attr('disabled', 'disabled');
            }           
        },
        validateBeforeSubmit() {
			this.$validator.validateAll().then((result) => {
				if (result) {
					$('form#PostForm').submit();
					//$('form#msform').submit();
					// eslint-disable-next-line
					//alert('Form Submitted!');
					//return;
				}
			//alert('Correct them errors!');
			});
	    }
    }
});