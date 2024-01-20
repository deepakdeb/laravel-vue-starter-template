<template>
    <div :class="[$store.state.layout_style, $store.state.menu_style]">
       
        <v-card theme="light"><component v-bind:is="layout"></component></v-card>        
    </div>
</template>
<script setup>
    import { computed } from 'vue';
    //import { useStore } from 'vuex';
   
   
    //const store = useStore();

    import store from '@/store';


    const layout = computed(() => {
        return store.state.layout;
    });

   
</script>
<script>  

   
    import appLayout from '@/AppLayout.vue';
    import authLayout from '@/AuthLayout.vue';
    import frontLayout from '@/FrontLayout.vue';

    export default {
        components: {
            app: appLayout,
            auth: authLayout,
            front: frontLayout,
        },

        methods: {
        }
    };
</script>