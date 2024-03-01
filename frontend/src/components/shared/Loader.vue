<template>
    <span class="loader"></span>
</template>
<script>
export default {
    
}
</script>
<style scoped>
.loader {
  box-sizing: border-box;
  display: inline-block;
  width: 5vw;
  height: 12.7vh;
  border-top: 5px solid #654321;
  border-bottom: 5px solid #654321;
  position: relative;
  background: linear-gradient(#D2B48C 6vh, transparent 0) no-repeat;
  background-size: 2px 40px;
  background-position: 50% 0px;
  animation: spinx 5s linear infinite;
}
.loader:before, .loader:after {
  content: "";
  width: 4vw;
  left: 50%;
  height: 5.75vh;
  position: absolute;
  top: 0;
  transform: translatex(-50%);
  background: rgba(255, 255, 255, 0.4);
  border-radius: 0 0 4vh 4vh;
  background-size: 100% auto;
  background-repeat: no-repeat;
  background-position: 0 0px;
  animation: lqt 5s linear infinite;
}
.loader:after {
  top: auto;
  bottom: 0;
  border-radius: 4vh 4vh 0 0;
  animation: lqb 5s linear infinite;
}
@keyframes lqt {
  0%, 100% {
    background-image: linear-gradient(#D2B48C 5.5vh, transparent 0);
    background-position: 0% 0px;
  }
  50% {
    background-image: linear-gradient(#D2B48C 5.5vh, transparent 0);
    background-position: 0% 5.5vh;
  }
  50.1% {
    background-image: linear-gradient(#D2B48C 5.5vh, transparent 0);
    background-position: 0% -5.5vh;
  }
}
@keyframes lqb {
  0% {
    background-image: linear-gradient(#D2B48C 5.5vh, transparent 0);
    background-position: 0 5.5vh;
  }
  100% {
    background-image: linear-gradient(#D2B48C 5.5vh, transparent 0);
    background-position: 0 -5.5vh;
  }
}
@keyframes spinx {
  0%, 49% {
    transform: rotate(0deg);
    background-position: 50% 6vh;
  }
  51%, 98% {
    transform: rotate(180deg);
    background-position: 50% .5vh;
  }
  100% {
    transform: rotate(360deg);
    background-position: 50% 6vh;
  }
}
    

</style>
    