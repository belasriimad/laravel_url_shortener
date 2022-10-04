<template>
    <div class="col-md-5">
        <div class="card my-4">
            <div class="card-body">
                <h4 class="mb-2 border p-2 rounded">
                    All Links
                </h4>
                <div class="list-group"
                    v-for="url in store.getLinks"
                    :key="url.id"
                    @click="data.url_id = url.id"
                    >
                    <li class="list-group-item list-group-item-action" style="cursor:pointer;" aria-current="true">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">
                                {{url.shorten_url}}
                            </h6>
                            <small>{{url.created_at}}</small>
                        </div>
                        <div class="mb-1">
                            <p>{{url.url_desc}}</p>
                            <p>
                                <span class="fw-bold">
                                    {{url.visits}}
                                    <i class="fas fa-eye"></i>
                                </span>
                            </p>
                        </div>
                    </li>
                    <p v-if="data.url_id === url.id" class="d-flex justify-content-around align-items-center my-2">
                        <button
                            @click="store.editLink(url)"
                            class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger"
                            @click="store.deleteLink(url.shorten_url, user_id)">
                            <i class="fas fa-trash"></i>
                        </button>
                        <button @click="copyLink(url.shorten_url)" class="btn btn-sm btn-dark">
                            <i class="fas fa-copy"></i>
                        </button>
                        <a :href="url.full_url" target="_blank" class="btn btn-sm btn-primary">
                            <i class="fas fa-arrow-up-right-from-square"></i>
                        </a>
                    </p>
                </div>
            </div>
            <div class="card-footer bg-white">
                <div class="d-flex justify-content-between">
                    <button class="btn btn-sm btn-link" 
                        :disabled="!store.links.prev_page_url" 
                        @click="store.previous(user_id)" 
                        style="cursor: pointer;">
                        <i class="fas fa-chevron-left"></i>
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="btn btn-sm btn-link" 
                        :disabled="!store.links.next_page_url" 
                        @click="store.next(user_id)" 
                        style="cursor: pointer;">
                        <i class="fas fa-chevron-right"></i>
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { onMounted, reactive } from "vue";
    import { useLinksStore } from '../stores/useLinksStore';
    import Swal from 'sweetalert2';
    import { inject } from 'vue';
    
    //get user id
    const user_id = inject('user_id');

    const data = reactive({
        url_id: ''
    });

    const store = useLinksStore();

    const copyLink = (link) => {
        // Copy the text inside the text field
        navigator.clipboard.writeText(`127.0.0.1:8000/visit/${link}`);
        // Alert the copied text
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Your link has been copied: ' + link,
            showConfirmButton: false,
            timer: 1500
        });
    }

    onMounted(() => store.fetchLinks(user_id));
</script>

<style>
</style>