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
</script>

<style scoped>
  .error-404 {
    text-align: center;
    padding: 50px;
  }

  .error-404 h1 {
    font-size: 5em;
    margin: 0;
    color: var(--vt-c-black-contrast);
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
    background-color: var(--vt-c-black-contrast);

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
