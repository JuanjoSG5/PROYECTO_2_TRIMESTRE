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
        <section class="events" :class="{ 'hidden': !isMenuRetracted }">

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
        },
        toggleEditMode() {
            this.isEditMode = !this.isEditMode;
            this.editedEvent = { ...this.currentEvent };
        },
        validateToken(token) {
            if (!token) {
                this.$router.push('/');
            }
        },
        async getEventFrontApi() {
    this.toggleLoading();
    this.validateToken(this.authStore.store.token);
    const getRequest = {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'Authorization': `Bearer ${this.authStore.store.token}`
        }
    }

    try {
        const userId = JSON.parse(localStorage.getItem('my-user-store')).store.user.id;
        const response = await fetch(`${import.meta.env.VITE_DATABASE_URL}v1/events`, getRequest);
        const eventsData = await response.json();
        console.log('eventsData', eventsData);
        if (eventsData && eventsData.data && eventsData.data.length > 0) {
            this.highPriorityEvents = eventsData.data.filter(
                event => event.priority === 'high' && event.user_id === userId
            );
            this.events = eventsData.data.filter(
                event => event.priority !== 'high' && event.user_id === userId
            );
            this.currentEvent = localStorage.getItem('currentEvent') ?
                JSON.parse(localStorage.getItem('currentEvent')) :
                this.events[this.events.length - 1];
        } else {
            console.log('No data received from the API');
        }
    } catch (error) {
        console.error(error);
        this.$router.push('/error');
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
.main-content {
    display: flex;
    flex-direction: row;
    height: 100%;
}

.main-event-content {
    display: flex;
    height: 100%;
}

.events {
    display: flex;
    flex-direction: column;
    background-color: var(--vt-c-black);
    color: var(--vt-c-black-contrast);
    width: 100%;
    height: 100%;
    padding-left: 2rem;
    
    & .loader{
        position: absolute;
        top: 50%;
        left: 50%;
        justify-content: center;
    }
}

@media (max-width:1024px) {
    .main-content {
        display: flex;
        flex-direction: row;
        height: 100%;
    }
    
}

@media (max-width:768px){
    
    .main-content {
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    .retrated{
        width: 3%;
    }
    .hidden {
        display: none;
    }
}

</style>

  