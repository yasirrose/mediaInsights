    <script>
    import { useAppOptionStore } from '@/stores/app-option';

    const appOption = useAppOptionStore();

    export default {
      mounted() {
        appOption.appSidebarHide = true;
        appOption.appHeaderHide = true;
        appOption.appContentClass = 'p-0';
      },
      beforeUnmount() {
        appOption.appSidebarHide = false;
        appOption.appHeaderHide = false;
        appOption.appContentClass = '';
      },
    }
</script>
    
    <style scoped>
    body {
      text-align: center;
      padding: 40px 0;
      background: #EBF0F5;
    }

    h1 {
      color: red;
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

    .times {
      color: #E74C3C;
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
    <div class="cancel-icon"
      style="border-radius: 200px; height: 200px; width: 200px; background: #F8FAF5; margin: 0 auto;">
      <i class="times">×</i>
    </div>
    <h1>Payment Canceled</h1>
    <p>Your payment has been canceled. If you have any questions, please contact us.</p>
  </div>
</template>
