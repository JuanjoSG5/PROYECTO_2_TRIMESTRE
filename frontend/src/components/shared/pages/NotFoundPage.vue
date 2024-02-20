<template>
    <div id="clock">
      {{ formattedTime }}
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        currentTime: new Date(),
        timeMultiplier: 1
      };
    },
    computed: {
      formattedTime() {
        let currentTime = new Date(this.currentTime.getTime()); // Clone the current time to avoid mutation
        const hours = this.padZero(currentTime.getHours());
        const minutes = this.padZero(currentTime.getMinutes());
        let seconds = Math.round(currentTime.getSeconds() * this.timeMultiplier);
        
        if (seconds >= 60) {
          currentTime.setMinutes(currentTime.getMinutes() + Math.floor(seconds / 60)); // Add minutes
          seconds %= 60; // Reset seconds
        }
        
        seconds = this.padZero(seconds); // Pad seconds
        return `${hours}:${minutes}:${seconds}`;
      }
    },
    methods: {
      padZero(num) {
        return num < 10 ? '0' + num : num;
      },
      updateClock() {
        this.currentTime = new Date();
        this.timeMultiplier *= 1.1; // Increase the time multiplier
      }
    },
    mounted() {
      setInterval(this.updateClock, 1000);
    }
  }
  </script>
  
  <style scoped>
  #clock {
    font-family: Arial, sans-serif;
    font-size: 48px;
    text-align: center;
    margin-top: 100px;
  }
  </style>
  