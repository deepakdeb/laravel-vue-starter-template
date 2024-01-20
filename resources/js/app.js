
import { createApp } from 'vue';

import axios from 'axios';
import VueAxios from 'vue-axios';

import VueSidebarMenu from 'vue-sidebar-menu'
import 'vue-sidebar-menu/dist/vue-sidebar-menu.css'

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

// Vuetify
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

const vuetify = createVuetify({
  theme: {
    themes: {
      light: {
        colors:{
        primary: '#EC6640',
        secondary: '#001659',
        accent: '#8c9eff',
        error: '#b71c1c',
        },
      },
    },
  },
  components,
  directives,
  
})

import Vue3EasyDataTable from 'vue3-easy-data-table';
import 'vue3-easy-data-table/dist/style.css';



import App from '@/app.vue';
import router from '@/router';
import store from '@/store';



const app = createApp(App);

const toolbarOptions =  [
  ['bold', 'italic', 'underline'], 
  [{ 'color': [] }, { 'background': [] }], 
  [{ 'list': 'ordered'}, { 'list': 'bullet' }],
  [{ 'header': 1 }, { 'header': 2 }],
 ];

app.use(vuetify);
app.use(VueAxios, axios);
app.use(store).use(router);
app.use(VueSidebarMenu);


window.Swal =  app.config.globalProperties.$swal;

app.config.globalProperties.$toolbarOptions = toolbarOptions;


app.component('EasyDataTable', Vue3EasyDataTable);


app.mount('#app');


if(axios.interceptors)
{
  axios.interceptors.response.use(
    function(response) {
      return response;
    },
    function(error) {

      
      if (error.response.status == 401) {
          //location.reload(); 
          router.push('/admin/login');
        }
      else if (error.response.status == 422)
      {
        Swal.fire({
          position: 'bottom-end',
          icon: 'warning',
          title: (Object.values(error.response.data.errors)),
          showConfirmButton: false,
          timer: 2000
        })
        //Swal.fire('Please fill all required inputs', '', 'warning');
      }
      else if (error.response.status == 500)
      { 
        Swal.fire({
          position: 'bottom-end',
          icon: 'error',
          title: 'Server error.',
          showConfirmButton: false,
          timer: 2000
        })
      }
      else if((error.response.status == 419) || (error.response.status == 401))
              location.reload();
        
      }
    );
}

window.Rules = {
  required: value => !!value || "This field is required",
  email: v => /.+@.+\..+/.test(v) || "Must be a valid email",
  max(value,max) { 
    return (value || '').length <= max || `This field is too long (maximum is ${max} characters).`;
  },
  min(value,min) { 
    return (value || '').length >= min || `This field is too short (minimum is ${min} characters).`;
  },

};


app.mixin({
  methods: {
    
        checkNet: function () 
        {
          var ifConnected = window.navigator.onLine;
          
          if (ifConnected) {
              return true;
          } 
          else {
                        
            Swal.fire('You are offline.', '', 'warning');    
              return false;
          }
        },
        showSuccess(title){
          Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: title,
              showConfirmButton: false,
              timer: 1500
          })
        },
        serverError: function (error)
        {
    	    if(!error.response)return;
          if(!error.response.status)return;
          if(error.response.status == 500)
          {
            //Swal.fire('Server error.', '', 'danger')
            
            Swal.fire({
              position: 'top-end',
              icon: 'warning',
              title: 'Server error.',
              showConfirmButton: false,
              timer: 1500
            })

            return false;
          }
              
          else if((error.response.status == 419) || (error.response.status == 401))
              location.reload();
        },
        
    
    }
});