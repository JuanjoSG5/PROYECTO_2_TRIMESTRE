<template lang="">
    <section class="landing">
      <section class="top-section">
        <section class="top-section-content">
          <h1 class="section-title">
            <span class="app-color">TimeSync:</span> Your schedule always up to date, effortlessly and quickly.
          </h1>
          <h2 class="section-subtitle">
            Empower your schedule with TimeSync: effortlessly create, delete, and edit events in your calendar with ease.
          </h2>
          <LandingButtons />
          <p class="section-description">
            You have the flexibility to test out TimeSync at no cost for as long as you desire.
          </p>
        </section>
        <img class="top-section-image" src="https://dummyimage.com/391x366/000000/fff" alt="sample image">
      </section>
      <section class="section-separator">
        Create and manage your Events
      </section>
    </section>
  </template>
  
  <script>
  import LandingButtons from '../components/LandingButtons.vue';
  
  export default {
    components: {
      LandingButtons,
    }
  }
  </script>
  
  <style scoped>
  .landing {
    padding: 0;
  }
  
  .top-section {
    display: grid;
    margin: 24px 153px;
    grid-template-columns: 1.3fr 1fr;
    grid-gap: 0.4fr;
  }
  
  .top-section-content {
    margin-right: 10vw;
  }
  
  .top-section-image {
    width: 391px;
    height: 366px;
    border-radius: 8px;
    justify-self: center;
    align-self: center;
  }
  
  .section-title {
    &,
    .app-color {
      font-size: 36px;
      margin-top: 8px;
      margin-bottom: 8px;
      font-weight: normal;
    }
  }
  
  .section-subtitle,
  .section-description {
    font-size: 24px;
    margin-top: 8px;
    margin-bottom: 8px;
    font-weight: normal;
  
    &.section-description {
      font-size: 20px;
    }
  }
  
  .section-separator {
    background-color: var(--vt-c-black-contrast);
    color: var(--vt-c-black);
    margin-top: 8px;
    margin-bottom: 34px;
    padding-left: 8px;
    padding-right: 16px;
    width: 100%;
    height: 10vh;
    text-align: center;
    line-height: 10vh;
    font-size: 2rem;
    font-weight: bold;
  }
  </style>
  