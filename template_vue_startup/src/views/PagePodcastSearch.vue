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
            <div class="search-tab-item"><a href="#" class="search-tab-link active">PODCAST</a></div>
        </div>


        <div class="main-wrap pt-5" v-if="this.podcasts.name != null">
            <div class="top-info-single">
                <div class="heading-info pb-2">
                    <div class="col-heading-text">
                        <h1>{{ this.podcasts.name }}</h1>
                    </div>
                    <div class="col-heading-icon">
                        <span>✓</span>Claim
                    </div>
                </div>
                <div class="image-info">
                    <div class="image-left-col">
                        <!-- <img src="/assets/img/product/product.png" alt=""> -->

                        <img :src="this.podcasts.imageUrl" alt="" />

                    </div>
                    <div class="text-right-col">
                        <h5>NPR</h5>
                        <div class="icon-boxes pb-3">
                            <span> <img src="/assets/img/product/download.svg" style="width: 12px;"> Podcasts</span>
                            <span> <img src="/assets/img/product/download.svg" style="width: 12px;"> RSS</span>
                            <span> <img src="/assets/img/product/attach.svg" style="width: 12px;"> Web</span>
                            <span> <img src="/assets/img/product/email.svg" style="width: 12px;"> Email</span>
                        </div>
                        <div class="last-update">
                            <span>last updated:</span> May 15, 2024
                        </div>
                    </div>
                </div>
                <div class="tabs-content pt-4">
                    <ul class="nav nav-tabs px-3" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active px-0" id="home-tab" data-bs-toggle="tab"
                                data-bs-target="#home" type="button" role="tab" aria-controls="home"
                                aria-selected="true"><img src="/assets/img/product/pod.svg" style="width: 12px;">
                                Podcast</button>
                        </li>
                        <li class="nav-item search" role="presentation">
                            <form action="">
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text p-1" id="addon-wrapping"><img
                                            src="/assets/img/product/search.svg" style="width: 12px;"></span>
                                    <input type="text" class="form-control" placeholder="SEARCH EPISODES"
                                        aria-label="Username" aria-describedby="addon-wrapping">
                                </div>
                            </form>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link"><img src="/assets/img/product/emb.svg" style="width: 12px;">
                                Podcast</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="podcast-content pt-5  px-3">
                                <div class="tab-content-box w-75">
                                    <h2 class="pb-3">ABOUT THIS PODCAST <span class="ps-2">🔗</span></h2>
                                    <!-- <p>Wanna see a trick? Give us any topic and we can tie it back to the economy. At
                                        Planet
                                        Money, we explore the forces that shape our lives and bring you along for the
                                        ride.
                                        Don't just understand the economy – understand the world.Wanna see a trick? Give
                                        us any topic and we can tie it back to the economy. At Planet
                                        Money, we explore the forces that shape our lives and bring you along for the
                                        ride.
                                        Don't just understand the economy – understand the world.</p>
                                    <p>Join At: <a href="">understand the world</a></p> -->
                                    <div v-html="this.podcasts.description"></div>
                                </div>
                                <div class="icon-boxes link-boxes pt-4">
                                    <span><a href=""> Podcasts</a></span>
                                    <span><a href=""> Podcasts</a></span>
                                    <span><a href=""> Podcasts</a></span>
                                    <span><a href=""> Podcasts</a></span>
                                </div>
                                <div class="flex flex-wrap pt-5 text-helper-color align-items-center">
                                    <img src="/assets/img/product/mic.svg" style="width: 12px;" class="me-2">Hosts:
                                    <a href="">NPR</a>
                                </div>
                                <div class="icon-boxes simple-list pt-3">
                                    <span> <img src="/assets/img/product/refresh.svg" style="width: 12px;"> Update
                                        frequency: <span>semiweekly</span></span>
                                    <span> <img src="/assets/img/product/sound.svg" style="width: 12px;"> Average audio
                                        length: <span>22 minutes</span></span>
                                    <span> <img src="/assets/img/product/dol.svg" style="width: 12px;"> Has
                                        sponsors</span>
                                </div>
                                <div class="icon-boxes simple-list pb-3 pt-3">
                                    <span> <img src="/assets/img/product/glob.svg" style="width: 12px;"> English</span>
                                    <span> <img src="/assets/img/product/map.svg" style="width: 12px;">United
                                        States</span>
                                    <span> <img src="/assets/img/product/epi.svg" style="width: 12px;"> 758
                                        episodes</span>
                                    <span> <img src="/assets/img/product/sin.svg" style="width: 12px;">since May 12,
                                        2017</span>
                                    <span> <img src="/assets/img/product/dic.svg" style="width: 12px;">episodic</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="search-result">
            <div class="search-result-list">
                <!-- {{ this.podcasts.episodes[0].name }} -->
                <!-- {{ this.podcasts.name}} -->
                <div class="search-result-item" v-for="podcast in this.podcasts.episodes" :key="podcast.uuid">

                    <div class="search-result-media">
                        <!-- <a href="#"><img src="/assets/img/product/product.png" alt="" /></a> -->
                        <img v-if="podcast.imageUrl" :src="podcast.imageUrl" alt="" />
                        <img v-else :src="this.podcasts.imageUrl" alt="" />

                    </div>
                    <div class="search-result-content">
                        <h3>
                            {{ podcast.name }}
                        </h3>
                        <!-- <div>
                            {{ podcast.description }}
                        </div> -->
                        <div v-html="podcast.description"></div>
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

.top-info-single .col-heading-text h1 {
    font-size: 24px;
    font-weight: 700;
}

.top-info-single .heading-info {
    display: flex;
    align-items: center;
    column-gap: 20px;
}

.top-info-single .col-heading-icon span {
    width: 16px;
    height: 16px;
    text-align: center;
    background: rgb(209 213 219);
    display: inline-flex;
    border-radius: 50%;
    justify-content: center;
    align-items: center;
    margin-right: 6px;
    padding: 8px;
    color: white;
}

.top-info-single .col-heading-icon {
    color: rgb(142 142 142);
    font-weight: 600;
}

.top-info-single .image-info {
    display: flex;
    gap: 20px;
}

.top-info-single .image-info .image-left-col {
    max-width: 97px;
}

.top-info-single .image-info .image-left-col img {
    width: 100%;
    border-radius: 10px;
}

.top-info-single .image-info .text-right-col {
    flex: 1;
}

.icon-boxes {
    display: flex;
    column-gap: 10px;
}

.icon-boxes:not(.link-boxes, .simple-list) span {
    color: rgba(0, 0, 0, .95);
    background-color: rgba(0, 0, 0, .05);
    padding: 4px 8px;
    border: 1px solid #bebfc0;
    border-radius: 5px;
    font-size: 12px;
    font-weight: 600;
    display: flex;
    gap: 6px;
    min-width: 96px;
    text-align: center;
    justify-content: center;
}

.icon-boxes.link-boxes span a {
    color: rgba(0, 0, 0, .95);
    background-color: rgba(0, 0, 0, .05);
    padding: 4px 8px;
    border: 1px solid #bebfc0;
    border-radius: 5px;
    font-size: 12px;
    font-weight: 600;
    display: flex;
    gap: 6px;
    min-width: 96px;
    text-align: center;
    justify-content: center;
    text-decoration: none;
}

.last-update {
    color: rgb(142 142 142);
    font-size: 12px;
}

.icon-boxes.simple-list {
    column-gap: 20px;
}

.icon-boxes.simple-list img {
    margin-right: 7px;
}

.icon-boxes.simple-list>span>span {
    font-weight: 600;
}

.podcast-content {
    border-bottom: 1px solid lightgray;
    padding-bottom: 15px;
}

.podcast-content .tab-content-box h2 {
    color: rgba(0, 0, 0, .6);
    font-size: 16px;
    font-weight: 700;
}

.tabs-content .nav-item .nav-link {
    color: rgba(0, 0, 0, .95);
    font-weight: 600;
    display: flex;
    align-items: center;
    column-gap: 7px;
}

.tabs-content .nav-item .nav-link.active {
    border: 0;
    border-bottom: 2px solid rgb(184 47 0);
}

.tabs-content .nav.nav-tabs {
    column-gap: 20px;
    max-width: 600px;
}

.tabs-content .nav.nav-tabs .nav-item.search {
    flex: 1;
}

.tabs-content .nav.nav-tabs .nav-item.search input,
.input-group-text.p-1 {
    background: transparent;
    border: 0;
    border-radius: 0px;
}

.tabs-content .nav.nav-tabs .nav-item.search input,
.tabs-content .nav.nav-tabs .nav-item.search input::placeholder {
    font-weight: 600;
}
</style>