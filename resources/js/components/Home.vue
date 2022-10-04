<template>
  <div class="row mt-4">
    <LinksList/>
    <CreateLink/>
  </div>
</template>

<script setup>
    import CreateLink from '../pages/CreateLink.vue';
    import LinksList from './LinksList.vue';
    import { provide } from 'vue';

    //provide user id for the child components
    provide('user_id', props.user_id);

    //get props
    const props = defineProps({
      user_id: {
        type: Number,
        required: true
      }
    });

</script>

<style>

</style>