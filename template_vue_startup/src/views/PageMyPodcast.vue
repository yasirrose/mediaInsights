<template>
    <!-- Add Podcast button -->
    <!-- <button class="btn btn-primary" @click="showAddForm">ADD PODCAST</button> -->

    <button type="button" id="addPodcast" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalXl">ADD PODCAST</button>

    <div class="modal fade" id="modalXl">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form @submit.prevent="handleSubmit">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ editing ? 'EDIT PODCAST' : 'ADD PODCAST' }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label class="form-label" for="podcast-title">Podcast Title:</label>
                            <input type="text" class="form-control" id="podcast-title" v-model="podcast.title" />
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="podcast-description">Podcast Description:</label>
                            <textarea class="form-control" id="podcast-description" v-model="podcast.description"
                                rows="3"></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="podcast-image">Podcast Image:</label>
                            <input type="file" class="form-control" id="podcast-image" @change="handleImageChange" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"  data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">{{ editing ? 'UPDATE' : 'SAVE' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Podcasts table -->
    <table class="table" v-if="podcasts.length >= 0">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="podcast in podcasts" :key="podcast.id">
                <td>{{ podcast.name }}</td>
                <td>{{ podcast.description }}</td>
                <td><img :src="podcast.imageUrl" alt="Podcast Image" height="100px" width="100px"></td>
                <td>
                    <button class="btn btn-primary" @click="editPodcast(podcast)">EDIT</button>
                    <button class="btn btn-danger" @click="deletePodcast(podcast)">DELETE</button>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            showForm: false,
            podcast: {
                title: '',
                description: '',
                image: '',
            },
            podcasts: [], // array to store podcasts data
            editing: false,
        }
    },
    methods: {
        showAddForm() {
            this.showForm = true;
            this.editing = false;
        },
        savePodcast() {
            // API call to save podcast data
            axios.post('/api/podcasts', this.podcast)
                .then(response => {
                    console.log('podcast data:', response);
                    this.podcasts.push(response.data);
                    this.showForm = false;
                })
                .catch(error => {
                    console.error(error);
                });
        },
        editPodcast(podcast) {
            // API call to fetch podcast data
            axios.get(`/api/podcasts/${podcast.id}`)
                .then(response => {
                    this.podcast = response.data;
                    this.showForm = true;
                    this.editing = true;
                })
                .catch(error => {
                    console.error(error);
                });
        },
        deletePodcast(podcast) {
            // API call to delete podcast data
            axios.delete(`/api/podcasts/${podcast.id}`)
                .then(response => {
                    this.podcasts = this.podcasts.filter(p => p.id !== podcast.id);
                })
                .catch(error => {
                    console.error(error);
                });
        },
        handleImageChange(event) {
            this.podcast.image = event.target.files[0];
        },
    },
    mounted() {
        // API call to fetch podcasts data
        axios.get(`${this.$apiBaseUrl}/podcasts`)
            .then(response => {
                this.podcasts = response.data;
            })
            .catch(error => {
                console.error(error);
            });
    },
}
</script>  
<style>
#addPodcast{
    float: right;
}
</style>