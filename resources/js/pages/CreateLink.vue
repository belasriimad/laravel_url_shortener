<template>
    <div class="col-md-7">
        <div class="card my-4">
            <div class="card-body">
                <div class="mb-2" v-if="store.getErrors">
                    <ul class="list-group" v-for="(errorArray, index) in store.getErrors" :key="index">
                        <li class="list-group-item bg-danger text-white mb-1" v-for="(error, index) in errorArray" :key="index">
                            {{error}}
                        </li>
                    </ul>
                </div>
                <form>
                    <div class="form-group mb-2">
                        <input type="text" 
                            v-model="store.link.data.full_url"
                            class="form-control" placeholder="Full Link">
                    </div>
                    <div class="form-group mb-2">
                        <textarea 
                            cols="30"
                            rows="5"
                            v-model="store.link.data.url_desc"
                            class="form-control" 
                            placeholder="Description"></textarea>
                    </div>
                    <div v-if="store.link.updating" class="form-group mb-2">
                        <button @click="store.updateLink(user_id)"
                            type="button" class="btn btn-warning">
                            Update
                        </button>
                        <button @click="store.cancelUpdate()"
                            type="button" class="btn btn-danger mx-1">
                            Cancel
                        </button>
                    </div>
                    <div v-else>
                        <button @click="store.storeLink(user_id)"
                            type="button" class="btn btn-primary">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { useLinksStore } from '../stores/useLinksStore';
    import { inject } from 'vue';
    
    //get user id
    const user_id = inject('user_id');

    const store = useLinksStore();
    
</script>

<style>
</style> 