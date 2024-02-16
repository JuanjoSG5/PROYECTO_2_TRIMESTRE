<template>
    <header class="events-header">
        <button class="routines-button">Routines</button>
        <Icon v-if="isImportant" @click="toggleImportant" class="important-icon"
            icon="fluent:important-12-regular" />
        <Icon v-else @click="toggleImportant" class="important-icon-filled" icon="fluent:important-12-filled" />
        
    </header>
</template>

<script>
    import { Icon } from '@iconify/vue';
    export default {
        components:{Icon},
        data(){
            return {
                isImportant: false,
            }
        },
        methods:{
            toggleImportant() {
                this.isImportant = !this.isImportant;
            }
        }
    }

</script>

<style scoped>
.events-header {
        position: absolute;
        right: 5rem;
        z-index: 1;

        & .routines-button {
            background-color: var(--vt-c-black);
            color: var(--vt-c-black-contrast);
            border: none;
            padding: 1rem;
            border-radius: 5px;
            font-size: 1.5rem;
            font-weight: bold;
            transition: color 0.5s ease-in-out;
            cursor: pointer;
        }

        & .routines-button:hover {
            color: var(--vt-c-black-mute);
        }

        & .important-icon,
        .important-icon-filled {
            display: inline-block;
            margin-left: 1rem;
            font-size: 2rem;
            font-weight: bold;

            color: var(--vt-c-black-contrast);
            vertical-align: middle;
            transition: 5s ease-in-out;
        }

    }

</style>