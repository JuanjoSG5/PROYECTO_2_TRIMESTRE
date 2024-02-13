<template>
    <button type="submit" class="submit-button" @click.prevent="$emit('submit')">
        Submit
    </button>
</template>

<script>
export default {
    
}
</script>

<style scoped>
.submit-button {
    border: 2px solid var(--vt-c-black);
    border-radius: 25px;
    margin: 0 auto;
    display: block;
    padding: 16px 32px;
    color: var(--vt-c-black);
    background-color: var(--vt-c-black-contrast);
    font-size: 16px;
    box-shadow: 4px 4px 8px rgba(82, 109, 130, 0.4);
    cursor: pointer;
    /* Ensure cursor changes on hover */
}

.submit-button:hover {
    background-color: rgba(82, 109, 130, 0.4);
    color: var(--vt-c-black-contrast);
    transition: color 0.3s, background-color 0.3s;
    box-shadow: 4px 4px 8px rgba(221, 230, 237, 0.3);
}

.submit-button:focus {
    outline: 2px solid var(--vt-c-black-contrast);
    box-shadow: 4px 4px 8px rgba(221, 230, 237, 0.3);
}
</style>
