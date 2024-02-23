<template>
    <section :class="[isMenuRetracted ? 'main-event-content' : 'main-content']">
        <LateralMenu 
            :events="events" 
            :highPriorityEvents="highPriorityEvents"
            :editedEvent="editedEvent" 
            :isMenuRetracted="isMenuRetracted" 
            @toggle-menu="toggleMenu" 
            @event="setCurrentEvent($event)"
            @update="getEventFrontApi"
        />
        <section class="events">
            <EventHeader/>
                <section v-if="!isLoading" >
                    <Events 
                        :currentEvent="currentEvent" 
                        :editedEvent="editedEvent"
                        :isEditMode="isEditMode" 
                        @edit="toggleEditMode"
                        @put="handleSaveChanges"
                    />
                </section>
            <Loader class="loader" v-else />
        </section>
    </section>
</template>

<script>
import { Icon } from '@iconify/vue'; 
import Loader from '../../shared/Loader.vue'; 
import LateralMenu from '../components/LateralMenu.vue';
import EventHeader from '../components/EventHeader.vue';
import {getTime} from '../helpers/Time'
import { useAuthStore } from '../../../store/UserStore';
import Events from '../components/Events.vue';

export default {
    components: { LateralMenu, Icon, Loader,EventHeader,Events },
    data() {
        return {
            isLoading: false,
            isMenuRetracted: false,
            isEditMode: false,
            currentEvent: {},
            events: [],
            highPriorityEvents: [],
            editedEvent: {},
            authStore: useAuthStore()
        };
    },
    async mounted() { 
        await this.getEventFrontApi();
    },
    methods: {
        setCurrentEvent(event) {
            this.currentEvent = event;
            localStorage.setItem('currentEvent', JSON.stringify(event));
        },
        toggleLoading() {
            this.isLoading = !this.isLoading;
        },
        toggleMenu() {
            this.isMenuRetracted = !this.isMenuRetracted;
        },toggleEditMode() {
            // TODO: In future chnages make it able to actually change the priority and assign it to the current user
            this.isEditMode = !this.isEditMode;
            this.editedEvent = { ...this.currentEvent };
        },
        async getEventFrontApi() {
            this.toggleLoading();
            console.log('Bearer', this.authStore.store.token);
            const getRequest = {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'Authorization': `Bearer ${this.authStore.store.token}`
                }
            }

            try {
                const response = await fetch('http://localhost:9000/api/v1/events', getRequest);
                const eventsData = await response.json();

                if (eventsData && eventsData.data && eventsData.data.length > 0) {
                    this.highPriorityEvents = eventsData.data.filter(
                        event => event.priority === 'high'
                    );
                    this.events = eventsData.data.filter(
                        event => event.priority !== 'high'
                    );
                    this.currentEvent = localStorage.getItem('currentEvent') ?
                        JSON.parse(localStorage.getItem('currentEvent')) :
                        this.events[this.events.length - 1];
                } else {
                    console.log('No data received from the API');
                }

            } catch (error) {
                console.error('Error fetching events:', error);
            }

            this.toggleLoading();
        },
        getFormattedTime(dateTimeString) {
            const date = new Date(dateTimeString);
            const day = date.getDate();
            const month = date.getMonth() + 1; 
            const hours = date.getHours();
            const minutes = date.getMinutes();
            return `${day}/${month}/${date.getFullYear()} ${hours}:${minutes < 10 ? '0' + minutes : minutes}`;
        },

        handleSaveChanges(){
            this.toggleEditMode()
            this.getEventFrontApi();
        }
        
    },
};
</script>
<style scoped>
/* TODO: Fix the grid display so that it shows properly the size of the */
.main-content {
    display: flex;
    height: 100%;

}

.main-event-content {
    display: flex;
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
    padding-left: 2rem;
    

   
        
    & .loader{
        position: absolute;
        top: 40%;
        left: 40%;
        justify-content: center;
    }
}

</style>

  