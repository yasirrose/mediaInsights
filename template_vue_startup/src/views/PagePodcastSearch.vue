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
            <div class="input-field">
                <input type="text" class="form-control form-control-lg" v-model="searchQuery"
                placeholder="Search Podcasts" />
                <i class="fas fa-search"></i>
            </div>
            <button @click="searchPodcasts" class="btn search-btn">Search</button>
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
                            <button class="social-podcast">
                                <i class="fab fa-apple"></i>
                                Podcasts
                            </button>
                            <button class="social-podcast"> 
                                <i class="fas fa-rss"></i>
                                RSS
                            </button>
                            <button class="social-podcast">
                                <i class="fas fa-link"></i>
                                Web
                            </button>
                            <button class="social-podcast">
                                <i class="fa fa-envelope"></i>
                                Email
                            </button>
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
                                    <span><a href=""> Business</a></span>
                                    <span><a href=""> Education</a></span>
                                    <span><a href=""> Society & Culture</a></span>
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

        <div class="past-episode-sec">
            <div class="past-episode-wrapper">
                <div class="past-episode-content w-75">
                    <h2 class="pb-3">Search Past Episode</h2>
                    <div class="form-group">
                        <div class="input-field">
                            <input type="text" class="form-control form-control-lg" v-model="searchQuery"
                            placeholder="Search Podcasts" />
                            <button @click="searchPodcasts" class="btn search-btn">search</button>
                        </div>
                        <label for="" class="search-label">Search past episodes of Heal squad x Maria Menounos</label>
                    </div>
                    <div class="embed-field">
                        <a href="#">
                            <i class="fas fa-code"></i>
                            Embed this search bar to your website
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="previous-episode-sec">
            <div class="previous-episode-wrapper">
                <div class="previous-episode-content w-75">
                    <div class="top-content">
                        <div class="top-heading">
                            <h2>PREVIOUS EPISODES</h2>
                            <a href="#"><i class="fas fa-link"></i></a>
                        </div>
                        <select class="form-select">
                            <option value="Newest First">Newest First</option>
                            <option value="Oldest First">Oldest First</option>
                        </select>
                    </div>
                    <div class="episode-listing" v-for="podcast in this.podcasts.episodes" :key="podcast.uuid">
                        <div class="episode-content">
                            <div class="episode-heading-content">
                                <div class="episode-img">
                                    <a href="#">
                                        <img v-if="podcast.imageUrl" :src="podcast.imageUrl" alt="" />
                                        <img v-else :src="this.podcasts.imageUrl" alt="" />
                                    </a>
                                </div>
                                <div class="episode-heading-text">
                                    <h3>{{ podcast.name }}</h3>
                                    <p class="date">May 2, 2024</p>
                                </div>
                            </div>
                            <div class="episode-description">
                                <p class="description">
                                    <div v-html="podcast.description"></div>
                                </p>
                            </div>
                        </div>
                        <div class="episode-media-box">
                            <div class="episode-media-content">
                                <div class="episode-media">
                                    <!-- <a href="#">
                                        <div class="play-img">
                                            <img src="/assets/img/product/play.svg" >
                                        </div>
                                    </a>
                                    <label for="" class="voice-text" aria-label="Audio length: 00:18:51">00:18:51</label> -->
                                    <audio controls>
                                        <source :src="podcast.audioUrl" type="audio/mpeg">
                                        Your browser does not support the audio element.
                                    </audio>
                                </div>
                                <div class="episode-media-buttons">
                                    <button class="media-podcast">
                                        <i class="fas fa-share"></i>
                                        Share
                                    </button>
                                    <button class="media-podcast"> 
                                        <i class="fas fa-bookmark"></i>
                                        Save
                                    </button>
                                    <button class="media-podcast">
                                        <i class="fas fa-cut"></i>
                                        Clip
                                    </button>
                                    <button class="media-podcast">
                                        ...
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!-- 
        <div class="search-result">
            <div class="search-result-list">
                <div class="search-result-item" v-for="podcast in this.podcasts.episodes" :key="podcast.uuid">

                    <div class="search-result-media">
                        <img v-if="podcast.imageUrl" :src="podcast.imageUrl" alt="" />
                        <img v-else :src="this.podcasts.imageUrl" alt="" />

                    </div>
                    <div class="search-result-content">
                        <h3>
                            {{ podcast.name }}
                        </h3>
                        <div v-html="podcast.description"></div>
                        <audio controls>
                            <source :src="podcast.audioUrl" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    </div>
                </div>
            </div>
        </div> -->
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
    gap: 20px;
    padding: 10px;
}

.search-input .input-field {
    position: relative;
    margin: 0;
    width: 100%;
}

.search-input .input-field i {
    position: absolute;
    top: 17px;
    right: 10px;
    font-size: 18px;
}

.search-input .input-field input {
    font-size: 18px;
    padding: 10px 30px 10px 20px;
    border-radius: 0px;
    border: 1px solid #000;
    min-height: 50px;
    box-shadow: none;
    background-color: transparent;
}

.search-input .search-btn {
    background-color: #000;
    color: #fff;
    padding: 10px 20px;
    min-width: 150px;
    border-radius: 0px;
    min-height: 50px;
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
    padding: 0px;
    color: white;
    font-size: 10px;
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
    gap: 10px;
    flex-wrap: wrap;
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
    align-items: center;
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





.icon-boxes .social-podcast {
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
    align-items: center;
    justify-content: center;
    cursor: pointer;
}

.icon-boxes .social-podcast i {
    font-size: 13px;
}

.past-episode-sec .past-episode-wrapper {
    padding: 1.875rem 0;
    border-bottom: 1px solid var(--bs-border-color);
}
.past-episode-sec .past-episode-wrapper .past-episode-content h2 {
    color: rgba(0, 0, 0, .6);
    font-size: 1rem;
    font-weight: 700;
    line-height: 1.5rem;
    margin-bottom: 0;
    text-transform: uppercase;
}
.past-episode-sec .past-episode-wrapper .past-episode-content .form-group {
    margin-bottom: 15px;
}
.past-episode-sec .past-episode-wrapper .past-episode-content .form-group .input-field {
    display: flex;
    align-items: center;
    width: 100%;
}
.past-episode-sec .past-episode-wrapper .past-episode-content .form-group .input-field input {
    min-height: 50px;
    height: 50px;
    padding: 10px 20px 10px 20px;
    font-size: 16px;
    background-color: transparent;
    box-shadow: none;
    border-top-right-radius: 0px;
    border-bottom-right-radius: 0px;
}
.past-episode-sec .past-episode-wrapper .past-episode-content .form-group .input-field .search-btn {
    min-height: 50px;
    height: 50px;
    background-color: #B82F00;
    color: #fff;
    font-size: 16px;
    border-top-left-radius: 0px;
    border-bottom-left-radius: 0px;
}
.past-episode-sec .past-episode-wrapper .past-episode-content .form-group label.search-label {
    color: rgba(0, 0, 0, .6);
    font-size: 14px;
    line-height: 1.25rem;
}
.past-episode-sec .past-episode-wrapper .past-episode-content .embed-field a {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #B82F00;
    font-size: 14px;
    text-decoration: none;
}
.previous-episode-sec .previous-episode-wrapper {
    padding: 1.875rem 0;
}
.previous-episode-sec .previous-episode-wrapper .previous-episode-content .top-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1rem;
}
.previous-episode-sec .previous-episode-wrapper .previous-episode-content .top-content select {
    width: max-content;
    font-size: 14px;
    line-height: 1rem;
    color: #00000099;
    padding: 8px 36px 8px 12px;
    background-color: transparent;
    border-color: #6b7280;
}
.previous-episode-sec .previous-episode-wrapper .previous-episode-content .top-content .top-heading {
    display: flex;
    align-items: center;
    gap: 10px;
}
.previous-episode-sec .previous-episode-wrapper .previous-episode-content .top-content .top-heading h2 {
    color: rgba(0, 0, 0, .6);
    font-size: 1rem;
    font-weight: 700;
    line-height: 1.5rem;
    margin-bottom: 0;
    text-transform: uppercase;
}
.previous-episode-sec .previous-episode-wrapper .previous-episode-content .top-content .top-heading a {
    color: rgba(0, 0, 0, .6);
}

.previous-episode-sec .previous-episode-wrapper .previous-episode-content  .episode-listing {
    padding: 20px 0;
    border-bottom: 1px solid var(--bs-border-color);
}

.episode-content .episode-heading-content {
    display: flex;
    gap: 15px;
    margin-bottom: 16px;
}
.episode-content .episode-heading-content .episode-img {
    height: 4.8rem;
    width: 4.8rem;
    min-height: 4.8rem;
    min-width: 4.8rem;
    border-radius: .25rem;
}
.episode-content .episode-heading-content .episode-img img {
    height: 100%;
    width: 100%;
    object-fit: cover;
    border-radius: .25rem;
}

.episode-content .episode-heading-content .episode-heading-text h3 {
    font-size: 1rem;
    line-height: 1.5rem;
    font-weight: 600;
    margin-bottom: .5rem;
    color: #000;
}
.episode-content .episode-heading-content .episode-heading-text p.date {
    font-size: 14px;
    line-height: 18px;
    font-weight: 400;
    margin-bottom: .5rem;
    color: #8E8E8E;
}
.episode-content .episode-description {
    margin-bottom: 16px;
}
.episode-content .episode-description p.description {
    font-size: 14px;
    line-height: 1.625;
    -webkit-box-orient: vertical;
    display: -webkit-box;
    overflow: hidden;
    -webkit-line-clamp: 2;
    margin-bottom: 0px;
}

.episode-media-box .episode-media-content {
    display: flex;
    align-items: center;
    gap: 30px;
    flex-wrap: wrap;
}
.episode-media-box .episode-media-content .episode-media {
    display: flex;
    gap: 10px;
    align-items: center;
    flex-wrap: wrap;
}
.episode-media-box .episode-media-content .episode-media .play-img {
    height: 40px;
    width: 40px;
    border-radius: 50%;
}
.episode-media-box .episode-media-content .episode-media .play-img img {
    height: 100%;
    width: 100%;
    border-radius: 50%;
    object-fit: cover;
}
.episode-media-buttons {
    display: flex;
    align-items: center;
    gap: 8px;
}
.episode-media-buttons .media-podcast {
    color: rgba(0, 0, 0, .95);
    background-color: rgba(0, 0, 0, .05);
    border: 1px solid #bebfc0;
    border-radius: .25rem;
    font-size: .875rem;
    line-height: 1.25rem;
    padding: .25rem .5rem;
    display: flex;
    gap: 6px;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    text-transform: capitalize;
}

.episode-media audio {
    margin: 0;
}


@media (max-width: 1200px) {
    .w-75 {
        width: 90% !important;
    }
}

@media (max-width: 767px) {
    .search-input .search-btn {
        min-width: 100px;
    }
    .w-75 {
        width: 100% !important;
    }
    .top-info-single .col-heading-text h1 {
        font-size: 22px;
    }
    .search-input .input-field input {
        font-size: 16px;
    }
    .page-header {
        font-size: 24px;
    }
}

@media (max-width: 450px) {
    .search-result .search-input {
        flex-wrap: wrap;
        gap: 10px;
    }
    .search-input .search-btn {
        min-width: 100%;
    }

    .episode-media-box .episode-media-content {
        flex-wrap: wrap;
        gap: 10px;
    }
    .previous-episode-sec .previous-episode-wrapper .previous-episode-content .top-content {
        flex-wrap: wrap;
        gap: 10px;
    }
    .episode-media audio {
        width: 270px;
        margin: 0;
    }
    .podcast-content {
        padding: 20px 0px !important;
    }
    .episode-media-box .episode-media-content .episode-media .play-img {
        height: 30px;
        width: 30px;
    }
    .pt-5 {
        padding-top: 1rem !important;
    }
    .page-header {
        font-size: 22px;
    }
    .top-info-single .col-heading-text h1 {
        font-size: 20px;
    }
}
</style>