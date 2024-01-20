<template>  
    <v-container  class="ml-0 pa-0">
        <v-row class="row ms-sm-4 ms-md-0 mt-0 mt-sm-0 mt-md-2 mx-0">
            <v-col cols="6" md="6" sm="6" class="mb-3 mb-sm-3 mb-md-0 pb-2 pb-sm-2 pb-md-0 pl-0">
            <div class='a'>
                <v-card class='admin-form-card ml-1 mb-5'>
                <v-card-title class="as mb-5 bg-grey-new">
                    <div >Update account information</div>
                </v-card-title>
                <v-card-text>
                    <v-form ref="form" @submit.prevent="saveForm" lazy-validation>
                        <v-text-field prepend-icon="mdi-account" v-model="user.name" label="Name" variant="outlined" :rules="[rules.required]"></v-text-field>
                        <v-text-field v-model="user.email" disabled prepend-icon="mdi-email"  label="Email" variant="outlined" :rules="[rules.required, rules.email]"></v-text-field>                    
                        

                        <v-checkbox-btn label="Update Password"
                        v-model="enabled"
                        class="pe-2"
                        ></v-checkbox-btn>

                        <template v-if="enabled">
                            <v-text-field label="Password" prepend-icon="mdi-lock" v-model="user.password" variant="outlined" :rules="[rules.required]" type="password" required></v-text-field>
                            <v-text-field label="Confirm Password" prepend-icon="mdi-lock" variant="outlined" v-model="user.password_confirmation" :rules="[(user.password === user.password_confirmation) || 'Password must match']" type="password" required></v-text-field>
                        </template>
                                    
                    </v-form>
                </v-card-text>

                </v-card>
            </div>
            </v-col>
        </v-row>
        <v-row class="row ms-sm-4 ms-md-0 mt-0 mt-sm-0 mt-md-2 mx-0">
            <v-col cols="6" md="6" sm="6" class="v-col-sm-6 v-col-md-6 v-col-6 mb-3 mb-sm-3 mb-md-0  pl-0 pb-2">
                <v-btn class="ml-auto" @click="saveForm" outlined color="primary">Save</v-btn>
            </v-col>
        </v-row>
          
        
    </v-container>
</template>

<script setup>
document.title = 'Account Settings';
</script>


<script>
  import Auth from '@/auth.js';
    export default {
      data() {
          return {
              
            
            showForm : false,                       
            rules : Rules,
            loggedUser: null,

                user: {
                  name: '',
                  email: '',
                  password: '',
                  password_confirmation:'',
                  
              }, 

              enabled: false,

          };
      },

      methods: {
        async saveForm() {
                
                const { valid } = await this.$refs.form.validate();

                if (valid)
                {
                    let call_url = '/api/updateuser';
                    const config = { headers: { 'Content-Type': 'multipart/form-data' } };

                    if(!this.enabled)
                        this.user.password = '';

                    
                    this.axios
                        .post(call_url , this.user , config)
                        .then(response => {

                            if(response)
                            {
                                this.showSuccess('Updated.');

                                window.localStorage.setItem('user', JSON.stringify(this.user));
                            }
                            
                        });
                }
            },
        },
        created() {  
            
            
            
            this.loggedUser = Auth.user;

            this.user.name = this.loggedUser.name;
            this.user.email = this.loggedUser.email;
        },
    }
</script>