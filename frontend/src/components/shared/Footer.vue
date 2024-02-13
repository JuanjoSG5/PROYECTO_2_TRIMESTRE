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
    position: absolute; /* Position the footer relative to its closest positioned ancestor */
    width: 100%;
    background-color: var(--vt-c-black-contrast);
    color: var(--vt-c-black); 
    text-align: center;
    padding: 8px;
    bottom: 0; /* Align the bottom edge of the footer with the bottom edge of its containing block */
    margin-top: 20px; /* Add margin-top to push the footer up from the bottom */
}


.text {
    font-weight: bold;
    font-size: 16px;
}
</style>
