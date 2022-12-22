<template>
    <div class="col-md-5">
        <div class="card my-4">
            <div class="card-body">
                <h4 class="mb-2 border p-2 rounded">
                    All Links
                </h4>
                <div class="list-group" v-for="link in store.getLinks" :key="link.id">
                    <li @click="data.url_id = link.id"
                        class="list-group-item list-group-item-action" style="cursor:pointer;">
                        <div class="d-flex w-100 justify-content-between">
                            <h6>
                                {{link.shorten_url}}
                            </h6>
                            <small>
                                {{link.created_at}}
                            </small>
                        </div>
                        <div class="mb-1">
                            <div>
                                <p>
                                    {{link.url_desc}}
                                </p>
                                <span class="fw-bold">
                                    {{link.visits}}
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                    </li>
                    <p 
                        v-if="data.url_id === link.id"
                        class="d-flex justify-content-around align-items-center my-2">
                        <button 
                            @click="store.editLink(link)"
                            class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button 
                            @click="store.deleteLink(link.shorten_url, user_id)"
                            class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i>
                        </button>
                        <button 
                            @click="copy(link.shorten_url)"
                            class="btn btn-dark btn-sm">
                            <i class="fas fa-copy"></i>
                        </button>
                        <a :href="link.full_url" target="_blank" class="btn btn-primary btn-sm">
                            <i class="fas fa-arrow-up-right-from-square"></i>
                        </a>
                    </p>
                </div>
            </div>
            <div class="card-footer bg-white">
                <div class="d-flex justify-content-between">
                    <button 
                        :disabled="!store.links.prev_page_url"
                        @click="store.previous(user_id)"
                        class="btn btn-sm btn-link">
                        <i class="fas fa-chevron-left"></i>
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button 
                        :disabled="!store.links.next_page_url"
                        @click="store.next(user_id)"
                        class="btn btn-sm btn-link">
                        <i class="fas fa-chevron-right"></i>
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { inject, onMounted, reactive } from "vue";
    import { useLinkStore } from '@/stores/useLinkStore';
    import Swal from 'sweetalert2';

    //get store
    const store = useLinkStore();

    const data = reactive({
        url_id : ''
    });

    const user_id = inject('user_id');

    const copy = (shorten_url) => {
        navigator.clipboard.writeText(`127.0.0.1:8000/visit/${shorten_url}`);
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Your link has been copied: ' + shorten_url,
            showConfirmButton: false,
            timer: 2500
        });
    }

    onMounted(() => store.fetchLinks(user_id));
</script>

<style>

</style>