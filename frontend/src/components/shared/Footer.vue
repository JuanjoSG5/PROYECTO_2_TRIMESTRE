<template lang="">
    <footer class="footer">
        <p class="text">2024 TimeSync. All rights reserved</p>
    </footer>
</template>

<script>
export default {

}
</script>

<style scoped>
.footer {
    bottom: 0;
    width: 100%;
    background-color: var(--vt-c-black-contrast);
    color: var(--vt-c-black);
    text-align: center;
    padding: 8px;
    box-sizing: border-box;
}


.text {
    font-weight: bold;
    font-size: 1.4vw;
}

@media (max-width: 1024px) {
    .text {
        font-size: 2.5vw;
        padding-right: 2rem;
        
    }
}

@media (max-width: 768px) {
    .text {
        font-size: 3.5vw;
    }
}
</style>
