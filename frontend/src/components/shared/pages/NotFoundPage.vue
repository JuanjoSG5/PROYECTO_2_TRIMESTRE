<template>
  <div class="error-404">
    <h1>404</h1>
    <p>Oops! Page not found</p>
    <div class="animation-container">
      <div class="circle"></div>
    </div>
  </div>
</template>

<script>
  // You can add any script logic here if needed
</script>

<style scoped>
  .error-404 {
    text-align: center;
    padding: 50px;
  }

  .error-404 h1 {
    font-size: 5em;
    margin: 0;
    color: #ff5e7d;
  }

  .error-404 p {
    font-size: 1.5em;
    margin: 20px 0;
  }

  .animation-container {
    position: relative;
    height: 100px;
    width: 100px;
    margin: auto;
    perspective: 1000px;
  }

  .circle {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background-color: #ff5e7d;
    position: absolute;
    top: 0;
    animation: spin 2s linear infinite;
  }

  @keyframes spin {
    from {
      transform: rotateY(0deg);
    }
    to {
      transform: rotateY(360deg);
    }
  }
</style>
