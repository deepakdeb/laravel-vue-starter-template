<template>
  <v-container class="fluid fill-height">
    <v-layout class="align-center justify-center pt-5 pb-8">
      
        <v-card class="elevation-12 auth_card">
          <v-container>
            <div align="center">
              <router-link to="/" tag="span" style="cursor: pointer">
                <v-img src="images/logo.png" max-width="150"></v-img>
              </router-link>

              <p class="pa-1 font-bold">
                Sign In
              </p>
            </div>
          </v-container>
          <v-toolbar class="auth_toolbar" light color="primary" width="450px">
            <v-toolbar-title align="center" class="ma-0">Login</v-toolbar-title>
          </v-toolbar>
          <v-card-text>
            <v-form ref="form" lazy-validation>
              <v-text-field prepend-icon="mdi-email" v-model="user.email" label="Email"
                :rules="[rules.required, rules.email]"></v-text-field>
              <v-text-field prepend-icon="mdi-lock" type="password" v-model="user.password" label="Password"
                :rules="[rules.required]"></v-text-field>
            </v-form>
            <div class="text-left">
              <router-link to="/admin/forgot-password" tag="span" style="cursor: pointer">Forgot Your Password?
              </router-link>
            </div>
          </v-card-text>
          <v-card-actions class="pa-5">
            <v-btn class="ml-auto" @click="saveForm" outlined color="primary">Login</v-btn>
          </v-card-actions>
        </v-card>
    </v-layout>
  </v-container>
</template>

<script setup>
document.title = "Login";
</script>

<script>
import Auth from "@/auth.js";
import { ref } from "vue";
const theme = ref("light");

export default {
  data() {
    return {
      value: String,
      user: {
        email: "",
        password: "",
      },

      rules: Rules,
    };
  },

  methods: {
    async saveForm() {
      const { valid } = await this.$refs.form.validate();

      if (!valid) return;

      this.axios
        .post("/api/login", this.user)
        .then(({ data }) => {
          Auth.login(data.access_token, data.user); //set local storage
          this.$router.push("/admin");
        })
        .catch((error) => {
          console.log(error);
          alert("wrong access");
        });
    },
  },
};
</script>
