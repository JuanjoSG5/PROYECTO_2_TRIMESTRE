<template>
    <section v-if="!isLoading" class="profile-page">
        <section class="user-details">
            <h1 class="user-name">{{ user.name }}</h1>
            <p class="user-text">Email: {{ user.email }}</p>
            <p class="user-text">Rol: User</p>
        </section>
        <section>
            
            <h2 class="high-priority-title">High priority events</h2>
            <section class="prioritary-events">
                <section v-for="event in highPriorityEvents" :key="event.id">
                    <p class="event">
                        <span class="event-name-time">{{ event.name }} -
                            <span 
                                :class="getPriorityClass(event.priority)"
                            >
                            {{ capitalize(event.priority) }}
                            </span>
                        </span>
                        <span class="time">{{ event.end_date == '01/01/1970 01:00' ? '' :  event.end_date}}</span>
                    </p>
                </section>
            </section>
            <h2 class="event-title">Events</h2>
            <section class="events">
                <section v-for="event in events" key="event.id">
                    <p class="event">
                        <span class="event-name-time">{{ event.name }} -
                            <span 
                                :class="getPriorityClass(event.priority)"
                            >
                            {{ capitalize(event.priority) }}
                            </span>
                        </span>
                        <span class="time">{{ event.end_date == '01/01/1970 01:00' ? '' :  event.end_date}}</span>
                    </p>
                </section>
            </section>
        </section>
    </section>
    <Loader v-else />
</template>

<script>

import { useAuthStore } from '../../../store/UserStore.js';
import Loader from '../../shared/Loader.vue';

export default {
    components: { Loader },
    data() {
        return {
            user: {},
            authStore: useAuthStore(),
            highPriorityEvents: [],
            events: [],
            isLoading: false
        };
    },
    methods: {
        toggleLoader() {
            this.isLoading = !this.isLoading;
        },
        async getUserData() {
            console.log('Fetching user data...'); // Log before making the API call
            this.toggleLoader();
            const currentUser = JSON.parse(localStorage.getItem('my-user-store'));

            const request = {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'Authorization': `Bearer ${this.authStore.store.token}`
                }
            };

            try {
                const response = await fetch(`${import.meta.env.VITE_DATABASE_URL}/users/${currentUser.store.user.id}`, request);
                console.log('Response:', response);
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                const userData = await response.json();
                console.log('User data:', userData);
                console.log('User data:', userData.data);
                this.user = { ...userData.data };
            } catch (error) {
                console.error('Error fetching user data:', error);
            } finally {
                this.toggleLoader();
            }
        },
        capitalize(priority) {
            return priority.charAt(0).toUpperCase() + priority.slice(1);
        },

        async getEventFrontApi() {
            this.toggleLoader();
            const currentUser = JSON.parse(localStorage.getItem('my-user-store'));
            const userId = currentUser.store.user.id;
            const getRequest = {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'Authorization': `Bearer ${this.authStore.store.token}`
                }
            };

            try {
                const response = await fetch(`http://localhost:9000/api/v1/events`, getRequest);
                const eventsData = await response.json();
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
                console.error('Error fetching events:', error);
            } finally {
                this.toggleLoader();
            }
        },
        getPriorityClass(priority) {
            const lowerPriority = priority.toLowerCase();
            switch (lowerPriority) {
                case 'high':
                    return 'high-priority';
                case 'medium':
                    return 'medium-priority';
                case 'low':
                    return 'low-priority';
                default:
                    return ''; 
            }
        }
    },
    async mounted() {
        console.log('Component mounted');
        await this.getUserData();
        await this.getEventFrontApi();
    }
};
</script>

<style scoped>
.profile-page{
    display:flex;
    flex-direction: column;
    justify-content: center;
    padding: 3rem;
}
.user-details{
    display: flex;
    flex-direction: column;
    margin-bottom: 2rem;
}
.user-name{
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 1rem;
    text-align: center;
}
.user-text{
    font-size: 1.5rem;
    margin-bottom: 1rem;
}

.prioritary-events,.events{
    display: flex;
    flex-direction: row;
    justify-content: start;
    align-items: center;
    flex-wrap: wrap;
    max-width: 90vw;
    padding: 5rem;
}

.high-priority-title{
    display: block;
    font-size: 2rem;
    font-weight: bold;
    margin-bottom: 1rem;
    text-align: center;

}

.event-title{
    display: block;
    font-size: 2rem;
    font-weight: bold;
    margin-bottom: 1rem;
    text-align: center;
}

.event{
    background-color: var(--vt-c-black-contrast);
    color: var(--vt-c-black);
    padding: 2rem;
    margin: 1rem; /* Add some margin between events */
    flex: 1 0 calc(25% - 2rem); /* Each event takes up 25% width with some margin */
    width: 20vw;
    height: 20vh;
    border-radius: 2rem;
    box-shadow: 0px 10px 5px 2px rgba(0, 0, 0, 0.1);
}
.loader {
    position: absolute;
    top: 40%;
    left: 40%;
    justify-content: center;
}
</style>
