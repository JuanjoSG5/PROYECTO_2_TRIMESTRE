<template lang="">
    <section class="top-container">
        <section class="top-container-content">
            <h1>Sample Container</h1>
            <p>Sample Container Description</p>
        </section>
        <section class="top-container-image">
            <img src="https://dummyimage.com/361x284/000000/fff" alt="landing-image">
        </section>
        
    </section>
</template>
<script>
export default {
    
}
</script>
<style scoped>
    .top-container{
        display:grid;
        grid-template-columns: 1fr 1fr;
        margin: 34px 153px;
        width: 80%;
        height: 20%;
        background-color: var(--vt-c-black-mute);
    }
</style>