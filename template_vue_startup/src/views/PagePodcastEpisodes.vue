<template>
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">PAGES</a></li>
        <li class="breadcrumb-item active">PODCAST EPISODES</li>
    </ul>

    <h1 class="page-header">
        Podcast Episodes <small></small>
    </h1>
    <!-- Add Podcast button -->
    <!-- <button class="btn btn-primary" @click="showAddForm">ADD PODCAST</button> -->

    <!-- <button type="button" id="addPodcast" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalXl"
        ref="modalXl">ADD
        PODCAST</button> -->

    <!-- <div class="modal fade" id="modalXl" v-show="showForm">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form @submit.prevent="handleSubmit" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ editing ? 'EDIT PODCAST' : 'ADD PODCAST' }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label class="form-label" for="podcast-name">Podcast Title:</label>
                            <input type="text" class="form-control" id="podcast-name" v-model="podcast.name" />
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="podcast-description">Podcast Description:</label>
                            <textarea class="form-control" id="podcast-description" v-model="podcast.description"
                                rows="3"></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="podcast-image">Podcast Image:</label>
                            <input type="file" class="form-control" id="podcast-image" v-on:change="onFileChange" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">{{ editing ? 'UPDATE' :
                            'SAVE' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div> -->

    <!-- Podcasts table -->
    <!-- <table class="table table-hover" v-if="podcasts.length >= 0">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="podcast in paginatedPodcasts" :key="podcast.id">
                <td>{{ podcast.name }}</td>
                <td>{{ podcast.description }}</td>
                <td>
                    <img :src="`${this.$backendappUrl}` + podcast.imageUrl" alt="Podcast Image" height="100px"
                        width="100px">
                </td>
                <td>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalXl"
                        @click="editPodcast(podcast)">EDIT</button>
                    <button class="btn btn-danger btn-sm" @click="deletePodcast(podcast)">DELETE</button>
                </td>
            </tr>
        </tbody>
        <div class="pagination" v-if="Math.ceil(this.podcasts.length / this.perPage) > 1">
            <button @click="currentPage = 1" :disabled="currentPage === 1">First</button>
            <button @click="currentPage -= 1" :disabled="currentPage === 1">Previous</button>
            <button @click="currentPage += 1"
                :disabled="currentPage >= Math.ceil(this.podcasts.length / this.perPage)">Next</button>
            <button @click="currentPage = Math.ceil(this.podcasts.length / this.perPage)"
                :disabled="currentPage >= Math.ceil(this.podcasts.length / this.perPage)">Last</button>
        </div>
    </table> -->
</template>

<script>
import axios from 'axios';
import { useToast } from 'vue-toastification';


const toast = useToast();


// export default {
//     data() {
//         return {
//             showForm: false,
//             currentPage: 1,
//             perPage: 5, // number of records per page
//             podcast: {
//                 name: '',
//                 description: '',
//                 imageUrl: '',
//             },
//             podcasts: [], // array to store podcasts data
//             editing: false,
//         }
//     },
//     computed: {
//         paginatedPodcasts() {
//             const start = (this.currentPage - 1) * this.perPage;
//             return this.podcasts.slice(start, start + this.perPage);
//         }
//     },
//     methods: {
//         showAddForm() {
//             this.showForm = true;
//             this.editing = false;
//         },
//         onFileChange(event) {
//             // const file = event.target.files[0];
//             // this.podcast.imageUrl = URL.createObjectURL(file);
//             this.podcast.imageUrl = event.target.files[0];
//         },
//         handleSubmit() {
//             if (this.editing) {
//                 // alert('edit button clicked');
//                 this.updatePodcast();
//             } else {
//                 this.savePodcast();
//             }
//         },
//         savePodcast() {
//             // alert('save podcast');
//             const formData = new FormData();
//             formData.append('name', this.podcast.name);
//             formData.append('description', this.podcast.description);
//             formData.append('imageUrl', this.podcast.imageUrl);

//             // API call to save podcast data
//             axios.post(`${this.$apiBaseUrl}/podcasts-save`, formData, {
//                 headers: {
//                     'Content-Type': 'multipart/form-data'
//                 }
//             })
//                 .then(response => {
//                     // alert('podcast data:', response);
//                     console.log('podcast data:', response);
//                     this.podcasts.push(response.data);
//                     toast.success('Podcast added successfully.');

//                     // this.showForm = false;
//                     // $('#modalXl').hide();
//                     // $('#modalXl').css('display', 'none');

//                 })
//                 .catch(error => {
//                     console.error(error);
//                 });
//         },
//         updatePodcast() {
//             console.log('nam data:', this.podcast.name);
//             const formData2 = {
//                 'name': this.podcast.name,
//                 'description': this.podcast.description,
//                 'imageUrl': this.podcast.imageUrl,
//             };
//             // formData2.append('name', this.podcast.name);
//             // formData.append('description', this.podcast.description);
//             // if (this.podcast.imageUrl instanceof File) {
//             //     formData.append('imageUrl', this.podcast.imageUrl);
//             // } else {
//             //     formData.append('imageUrl', this.podcast.imageUrl);
//             // }
//             console.log('formdata is need: ', formData2);
//             axios.post(`${this.$apiBaseUrl}/podcast-update/${this.podcast.id}`, formData2, {
//                 headers: {
//                     'Content-Type': 'multipart/form-data'
//                 }
//             })
//                 .then(response => {
//                     const index = this.podcasts.findIndex(p => p.id === this.podcast.id);
//                     if (index !== -1) {
//                         this.podcasts.splice(index, 1, response.data);
//                     }
//                     // this.podcasts.splice(this.podcasts, index, response.data);
//                     toast.success('Podcast updated successfully.');
//                     this.closeModal();
//                 })
//                 .catch(error => {
//                     console.error(error);
//                     // toast.error('Failed to update podcast.');
//                 });
//         },
//         editPodcast(podcast) {
//             // alert('edit button');
//             // API call to fetch podcast data
//             axios.get(`${this.$apiBaseUrl}/podcast-edit/${podcast.id}`)
//                 .then(response => {
//                     this.podcast = response.data;
//                     this.editing = true;
//                 })
//                 .catch(error => {
//                     console.error(error);
//                 });
//         },
//         deletePodcast(podcast) {
//             // API call to delete podcast data
//             const confirmDelete = confirm(`Are you sure you want to delete?`);
//             if (confirmDelete) {
//                 axios.delete(`${this.$apiBaseUrl}/podcast-delete/${podcast.id}`)
//                     .then(response => {
//                         this.podcasts = this.podcasts.filter(p => p.id !== podcast.id);
//                         toast.success('Podcast deleted successfully.');
//                     })

//                     .catch(error => {
//                         console.error(error);
//                     });
//             }
//         },
//         closeModal() {
//             this.showForm = false;
//             this.podcast = { name: '', description: '', imageUrl: '' }; // Reset form
//         },
//         handleImageChange(event) {
//             this.podcast.imageUrl = event.target.files[0];
//         },
//     },
//     mounted() {
//         // API call to fetch podcasts data
//         axios.get(`${this.$apiBaseUrl}/podcasts`)
//             .then(response => {
//                 this.podcasts = response.data;
//             })
//             .catch(error => {
//                 console.error(error);
//             });
//     },
// }
</script>
<!-- <style>
#addPodcast {
    float: right;
}

.pagination {
    position: absolute;
    bottom: 0;
    right: 0;
    margin-bottom: 20px;
    margin-right: 20px;
}

.pagination button {
    margin-right: 10px;
}
</style> -->