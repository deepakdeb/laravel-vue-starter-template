<template>
    <div class="" v-if="can_ccess">
        
        <v-container  class="ml-0 pa-0">
            <div class="">
                <v-container class="pa-0">
                    <v-row no-gutters>
                        <!-- <v-text-field label="solo" solo dense ></v-text-field> -->
                        <v-col cols="3"><v-text-field v-model="searchValue" label="Search.." clearable variant="outlined" class='mt-4'></v-text-field></v-col>
                        <v-col cols="3" align="right"  offset="6"><v-btn color="primary" @click="addNew"><v-icon class="mr-2">fa fa-plus</v-icon>Add New</v-btn></v-col>
                    </v-row> 
                    <v-row></v-row>
                </v-container>
            </div>    
        
            <EasyDataTable :headers="headers" :items="users" table-class-name="customize-table" buttons-pagination :rows-per-page="25" :fixedCheckbox="true"  :fixedIndex="true" :search-value="searchValue">

                <template #item-operation="item">
                <div class="">
                    <v-btn class="mr-2" size="x-small" icon="mdi-pencil" color="primary" @click.prevent="editItem(item)" />
                </div>
                </template>

            </EasyDataTable>  
        
        
            <v-dialog v-model="showForm" width="1000">
                <v-card>
                    <v-card-title class="headline black" primary-title>User Info</v-card-title>
                    <v-card-text class="pa-5">

                        <v-form ref="form" @submit.prevent="saveForm" lazy-validation>
                            <v-text-field prepend-icon="mdi-account" v-model="user.name" label="Name" :rules="[rules.required]"></v-text-field>
                            <v-text-field v-model="user.email" :disabled="disabled" prepend-icon="mdi-email"  label="Email" :rules="[rules.required, rules.email]"></v-text-field>    
                            
                            <v-checkbox-btn label="Update Password" v-model="enabled" class="pe-2" v-if="user.id > 0"></v-checkbox-btn>

                            <template v-if="enabled">
                                <v-text-field label="Password" prepend-icon="mdi-lock" v-model="user.password" variant="outlined" :rules="[rules.required]" type="password" required></v-text-field>
                                <v-text-field label="Confirm Password" prepend-icon="mdi-lock" variant="outlined" v-model="user.password_confirmation" :rules="[(user.password === user.password_confirmation) || 'Password must match']" type="password" required></v-text-field>
                            </template>                
                                
                        </v-form>
                    </v-card-text>
                    <v-card-actions class="pa-5">
                        <v-btn @click="saveForm" outlined color="primary">Save</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>  
        </v-container>
    </div>  
</template>
<script setup>
    document.title = 'Admin Users';
</script>
<script>
import Auth from '@/auth.js';
    export default {
        data() {
            return {               

                can_ccess : false,
                showForm : false,  
                enabled : true,   
                disabled : false,

                user: {
                    id: '',
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation:''
                },
                
                rules : Rules,
                users : [],
                headers : [
                        { text: "Name", value: "name" , sortable: true},
                        { text: "Email", value: "email" , sortable: true},
                        { text: "Operation", value: "operation" },
                    ],
                searchValue : '',
                itemsSelected : [],

                statusOptions : [
                    { id: 0, text: "Disabled" },
                    { id: 1, text: "Enabled" },
                ],

                file_upload : null,
                file_url : null,                
            }
        },
        methods: {
            
            addNew() {
                this.showForm = true;
                this.user = {name: '', email: '', password: '', password_confirmation:''};
                this.enabled = true;
                this.disabled = false;
            },
            editItem(item) {
                this.showForm = true;
                this.user = item;
                this.enabled = false;
                this.disabled = true;
                
            },           
            allItem(){
                this.axios
                    .get('/api/users')
                    .then(response => {
                        this.users = response.data;
                    });
            },

            async saveForm() 
            { 

                const { valid } = await this.$refs.form.validate();

                if (!valid) return;

                let call_url = '/api/createuser';
               

                if(this.user.id != null)
                {
                    call_url = '/api/updateuser';
                }

                this.axios.post(call_url, this.user)
                    .then(({data}) => {
                        
                        this.showSuccess('User Saved');
                        this.$refs.form.reset();
                        this.showForm = false;
                        this.allItem();
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        },
        created() {            
            this.allItem();  
            
            if(Auth.user.role == 1)           
                this.can_ccess = true;
        },
        
    }
</script>