<template>
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">PAGES</a></li>
        <li class="breadcrumb-item active">SEARCH PODCAST</li>
    </ul>

    <h1 class="page-header">
        Search PODCAST <small></small>
    </h1>

    <div class="search-result">
        <div class="search-input">
            <input type="text" class="form-control form-control-lg" v-model="searchQuery"
                placeholder="Search Podcasts" />
            <button @click="searchPodcasts" class="btn btn-secondary">Search</button>
        </div>

        <div class="search-tab">
            <div class="search-tab-item"><a href="#" class="search-tab-link active">Explore</a></div>
            <!-- <div class="search-tab-item"><a href="#" class="search-tab-link">Accessories</a></div>
            <div class="search-tab-item"><a href="#" class="search-tab-link">Support</a></div>
            <div class="search-tab-item"><a href="#" class="search-tab-link">Store</a></div> -->
        </div>

        <div class="search-result">
            <div class="search-result-list">
                <!-- {{ this.podcasts.episodes[0].name }} -->
                <!-- {{ this.podcasts.name}} -->
                <div class="search-result-item" v-for="podcast in this.podcasts.episodes" :key="podcast.uuid">

                    <div class="search-result-media">
                        <!-- <a href="#"><img src="/assets/img/product/product.png" alt="" /></a> -->
                        <img :src="podcast.imageUrl" alt="" />

                    </div>
                    <div class="search-result-content">
                        <h3>
                            {{ podcast.name }}
                        </h3>
                        <div>
                            {{ podcast.description }}
                        </div>
                        <audio controls>
                            <source :src="podcast.audioUrl" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import axios from 'axios';

export default {
    data() {
        return {
            searchQuery: '',
            podcasts: [], // Store multiple podcasts in an array
            podcast: []
        };
    },
    methods: {
        searchPodcasts() {
            if (this.searchQuery.trim() === '') {
                this.podcasts = []; // Clear the podcasts array if search query is empty
                return;
            }
            // alert(this.searchQuery.trim());
            axios.post(`${this.$apiBaseUrl}/podcasts/search?query=${this.searchQuery.trim()}`)
                .then(response => {
                    console.log("Podcast data i need:::", response);
                    const podcasts = response.data.data.getPodcastSeries;
                    console.log('podcast data', podcasts);
                    // console.log('podcast Condition:::>>>>>' , (podcasts));

                    if (podcasts) {
                        // alert('aim herre');
                        this.podcasts = podcasts;
                        console.log('This is podcast data', this.podcasts);
                    } else {
                        this.podcasts = []; // No podcasts found
                    }
                })
                .catch(error => {
                    console.error('Error fetching podcast data:', error);
                    this.podcasts = []; // Clear the podcasts array in case of error
                });
        }
    }
};
</script>
<style scoped>
.podcast-search {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    font-family: Arial, sans-serif;
}

.input-field {
    margin-bottom: 10px;
}

.podcast-list {
    margin-top: 20px;
}

.podcast-item {
    margin-bottom: 20px;
}

h2 {
    font-size: 1.5rem;
    margin-bottom: 5px;
}

p {
    margin-bottom: 10px;
}

.description {
    margin-bottom: 10px;
    /* Add additional styling for the description if needed */
}

audio {
    margin-top: 10px;
}

.search-input {
    display: flex;
    align-items: center;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.form-control-lg {
    font-size: 18px;
    padding: 15px 20px;
    border: none;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.btn-secondary {
    padding: 15px 30px;
    font-size: 18px;
    background-color: #4CAF50;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.btn-secondary:hover {
    background-color: #3e8e41;
}
</style>