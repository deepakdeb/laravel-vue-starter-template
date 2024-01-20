<template>
  <v-app class="front-wrapper" :class="showHover"> 

  <v-main >      
    <v-container no-gutters  class="fill-height body-content fill-height p-0" fluid>
      <router-view v-on:quickEdit="showUpdateForm" :key="childKey" />
    </v-container>      
  </v-main>

    
</v-app>
</template>

<script setup>

  
</script>

<script>

  import Auth from '@/auth.js';
  import store from '@/store';
  export default {
    data() {
      return {
      };
    },
    methods:{
      
    },
    created() {            

    }
  };
</script>