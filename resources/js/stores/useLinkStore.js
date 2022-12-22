import { defineStore } from 'pinia';
import Swal from 'sweetalert2';

export const useLinkStore = defineStore('links', {
    state: () => ({ 
        links: [],
        errors: null,
        current_page: 1,
        link: {
            updating: false,
            data: {
                full_url: '',
                url_desc: ''
            }
        }
    }),
    getters: {
        getLinks: (state) => state.links.data,
        getValidationErrors: (state) => state.errors
    },
    actions: {
        async addLink(user_id){
            this.errors = null;
            try {
                await axios.post('/api/add/url', {
                    full_url: this.link.data.full_url,
                    url_desc: this.link.data.url_desc,
                    user_id
                });
                this.fetchLinks(user_id);
                this.link = {
                    updating: false,
                    data: {
                        full_url: '',
                        url_desc: '',
                    }
                };
                this.errors = null;
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Your link has been saved',
                    showConfirmButton: false,
                    timer: 2500
                });
            } catch (error) {
                this.errors = error.response && error.response.data.errors;
                console.log(error);
            }
        },
        async fetchLinks(user_id) {
            try {
                const response = await axios.get(`/api/user/urls/${user_id}`);
                this.links = response.data;
            } catch (error) {
                console.log(error);
            }
        },
        deleteLink(shorten_url, user_id){
            try {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        await axios.delete(`/api/url/delete/${shorten_url}`);
                        this.fetchLinks(user_id);
                        Swal.fire(
                            'Deleted!',
                            'Your link has been deleted.',
                            'success'
                        )
                    }
                });
            } catch (error) {
                console.log(error);
            }
        },
        async next(user_id) {
            try {
                const response = await axios.get(`/api/user/urls/${user_id}?page=${this.current_page += 1}`);
                this.links = response.data;
            } catch (error) {
                console.log(error);
            }
        },
        async previous(user_id) {
            try {
                const response = await axios.get(`/api/user/urls/${user_id}?page=${this.current_page -= 1}`);
                this.links = response.data;
            } catch (error) {
                console.log(error);
            }
        },
        editLink(url){
            this.errors = null;
            this.link = {
                updating: true,
                data: url
            };
        },
        async updateLink(user_id){
            this.errors = null;
            try {
                await axios.put(`/api/urls/${this.link.data.shorten_url}`, {
                    full_url: this.link.data.full_url,
                    url_desc: this.link.data.url_desc,
                    user_id
                });
                this.fetchLinks(user_id);
                this.link = {
                    updating: false,
                    data: {
                        full_url: '',
                        url_desc: '',
                    }
                };
                this.errors = null;
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Your link has been updated',
                    showConfirmButton: false,
                    timer: 2500
                });
            } catch (error) {
                this.errors = error.response && error.response.data.errors;
                console.log(error);
            }
        },
        cancelEdit(){
            this.errors = null;
            this.link = {
                updating: false,
                data: {
                    full_url: '',
                    url_desc: ''
                }
            };
        }
    },
});
