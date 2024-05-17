<script>
import { useAppOptionStore } from '@/stores/app-option';

const appOption = useAppOptionStore();

export default {
    data() {
        return {
            countdown: 3 // Initial countdown value in seconds
        };
    },
    mounted() {
        appOption.appSidebarHide = true;
        appOption.appHeaderHide = true;
        appOption.appContentClass = 'p-0';

        // Start countdown
        this.startCountdown();
    },
    beforeUnmount() {
        appOption.appSidebarHide = false;
        appOption.appHeaderHide = false;
        appOption.appContentClass = '';
    },
    methods: {
        startCountdown() {
            // Update countdown every second
            this.countdownInterval = setInterval(() => {
                this.countdown--;
                // Redirect to login page when countdown reaches 0
                if (this.countdown === 0) {
                    clearInterval(this.countdownInterval);
                    this.$router.push('/page/login');
                }
            }, 1000); // Interval in milliseconds
        }
    },
    beforeDestroy() {
        // Clear countdown interval to avoid memory leaks
        clearInterval(this.countdownInterval);
    }
}
</script>

<style scoped>
body {
    text-align: center;
    padding: 40px 0;
    background: #EBF0F5;
}

h1 {
    color: #88B04B;
    font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
    font-weight: 900;
    font-size: 40px;
    margin-bottom: 10px;
}

p {
    color: #404F5E;
    font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
    font-size: 20px;
    margin: 0;
}

p.countDown{
    color: #9ABC66;
    font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
    font-size: 20px;
    margin: 0;
}

.checkmark {
    color: #9ABC66;
    font-size: 100px;
    line-height: 200px;
    margin-left: -15px;
}

.card {
    background: white;
    padding: 60px;
    border-radius: 4px;
    box-shadow: 0 2px 3px #C8D0D8;
    display: flex;
    margin: 0 auto;
    text-align: center;

}
</style>

<template>
    <div class="card">
        <div class="success-icon"
            style="border-radius: 200px; height: 200px; width: 200px; background: #F8FAF5; margin: 0 auto;">
            <i class="checkmark">✓</i>
        </div>
        <h1>Success</h1>
        <p>We received your purchase request;<br />we'll be in touch shortly!</p>
        <p class="countDown">Redirecting to login page in {{ countdown }} seconds...</p>
    </div>
</template>