<template>
  <div class="col-md-7">
    <div class="card my-4">
        <div class="card-body">
            <div class="mb-2" v-if="store.getValidationErrors">
                <ul 
                    v-for="(errorArray, index) in store.getValidationErrors"
                    :key="index"
                    class="list-group">
                    <li 
                        v-for="(error, index) in errorArray"
                        :key="index"
                        class="listgroup-item bg-danger text-white mb-1 p-2 rounded">
                        {{error}}
                    </li>
                </ul>
            </div>
            <form @submit.prevent="store.addLink(user_id)">
                <div class="form-group mb-2">
                    <input 
                        v-model="store.link.data.full_url"
                        type="text" class="form-control" placeholder="Full Url">
                </div>
                <div class="form-group mb-">
                    <textarea 
                        v-model="store.link.data.url_desc"
                        class="form-control mb-2"
                        cols="30" rows="5" placeholder="Description"></textarea>
                </div>
                <div class="form-group" v-if="store.link.updating">
                    <button 
                        @click="store.updateLink(user_id)"
                        type="button" class="btn btn-warning">
                        Update
                    </button>
                    <button 
                        @click="store.cancelEdit"
                        type="button" class="btn btn-danger mx-2">
                        Cancel
                    </button>
                </div>
                <div class="form-group" v-else>
                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
  </div>
</template>

<script setup>
    import { inject } from 'vue';
    import { useLinkStore } from '@/stores/useLinkStore';

    //get store
    const store = useLinkStore();

    //get user id
    const user_id = inject('user_id');
</script>

<style>

</style>