<template>
    <section :class="[isMenuRetracted ? 'main-event-content' : 'main-content']">
        <LateralMenu :isMenuRetracted="isMenuRetracted" @toggle-menu="toggleMenu" />
        <section class="events">
            <header class="events-header">
                <button class="routines-button">Routines</button>
                <Icon v-if="isImportant" @click="toggleImportant" class="important-icon"
                    icon="fluent:important-12-regular" />
                <Icon v-else @click="toggleImportant" class="important-icon-filled" icon="fluent:important-12-filled" />
                <button @click="toggleEditMode" v-if="!isEditMode">Edit</button>
                <button @click="saveChanges" v-if="isEditMode">Save</button>
            </header>
            <section class="events-content">
                <h1>{{ currentEvent.name }}</h1>
                <p>{{ currentEvent.description }}</p>
                <p v-if="!isEditMode">Time: {{ getFormattedTime(currentEvent.start_date) }}</p>
                <input v-model="editedEvent.name" v-if="isEditMode">
                <textarea v-model="editedEvent.description" v-if="isEditMode"></textarea>
                <input type="datetime-local" v-model="editedEvent.start_date" v-if="isEditMode">
            </section>
        </section>
    </section>
</template>

<script>
import { Icon } from '@iconify/vue'; // Ensure this import statement is present
import LateralMenu from '../components/LateralMenu.vue';

export default {
    components: { LateralMenu, Icon }, // Make sure Icon component is registered
    data() {
        return {
            isMenuRetracted: false,
            isImportant: false,
            isEditMode: false,
            currentEvent: {},
            events: [],
            editedEvent: {} 
        };
    },
    async mounted() {
        await this.getEventFrontApi();
    },
    methods: {
        toggleMenu() {
            this.isMenuRetracted = !this.isMenuRetracted;
        },
        toggleImportant() {
            this.isImportant = !this.isImportant;
        },
        async getEventFrontApi() {
            const eventsData = await fetch('http://localhost:9000/api/v1/events')
                .then(response => response.json());
                console.log("fecth Done");
            this.events = eventsData;
            this.currentEvent = this.events.data[0];
        },
        getFormattedTime(dateTimeString) {
            const date = new Date(dateTimeString);
            const hours = date.getHours();
            const minutes = date.getMinutes();
            return `${hours}:${minutes < 10 ? '0' + minutes : minutes}`;
        },
        toggleEditMode() {
            this.isEditMode = !this.isEditMode;
        },
        saveChanges() {
            // TODO: Save changes to the backend
            console.log('Changes saved:', this.editedEvent);
            this.currentEvent = { ...this.editedEvent };
            this.toggleEditMode(); 
        },
    },
};
</script>
<style scoped>
.main-content {
    display: grid;
    grid-template-columns: 1fr 3fr;
    align-items: center;
    justify-items: center;
    height: 100%;

}

.main-event-content {
    display: grid;
    grid-template-columns: 1fr;
    height: 100%;
}

.events {
    display: flex;
    flex-direction: column;
    position: relative;
    background-color: var(--vt-c-black);
    color: var(--vt-c-black-contrast);
    width: 100%;
    height: 100%;

    & .events-header {
        position: absolute;
        right: 5rem;


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
            /* Increase the duration from 0.5s to 1s */
        }

    }
}</style>

  