<template>
    <el-form-item :error="errorMessage" :label="label">
      <el-input
        :placeholder="label"
        v-model="value"
        v-bind="$attrs"
        :validate-event="false"
      />
    </el-form-item>
  </template>
  
  <script lang="ts">
  export default {
    inheritAttrs: false,
  };
  </script>
  
  <script setup lang="ts">
  import { useField } from 'vee-validate';
  import { toRef } from 'vue';
  
  const props = defineProps({
    name: {
      type: String,
      required: true,
    },
    label: {
      type: String,
      required: true,
    },
  });
  
  const { value, errorMessage } = useField(toRef(props, 'name'));
  </script>
  